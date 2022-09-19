import Swup from 'swup';
import SwupFormsPlugin from '@swup/forms-plugin';
import SwupDebugPlugin from '@swup/debug-plugin';
import {once, toArray} from 'lodash';

const swup = new Swup({
    plugins: [
        new SwupFormsPlugin({formSelector: 'form[data-swup-form]'}),
        new SwupDebugPlugin()
    ]
});

require('./bootstrap');
require('alpinejs');

//turn 128 seconds into 2:08
function getTimeCodeFromNum(num) {
    let seconds = parseInt(num);
    let minutes = parseInt(seconds / 60);
    seconds -= minutes * 60;
    const hours = parseInt(minutes / 60);
    minutes -= hours * 60;

    if (hours === 0) return `${minutes}:${String(seconds % 60).padStart(2, 0)}`;
    return `${String(hours).padStart(2, 0)}:${minutes}:${String(
        seconds % 60
    ).padStart(2, 0)}`;
}

var tracks = document.querySelectorAll('.container-player .track');

const audioPlayers = document.querySelectorAll('.audio-player');

//Variables declaration for current song and track name
let currentSong = document.querySelector('.container-player .titre_name');
let trackName = currentSong.innerText;

//get album id to construct the track link
var albumId = document.querySelector('.container-player #album_id').value;
setInterval(() => {
    albumId = albumId
}, 100);

//create audio player & append it into the DOM
var audio = document.createElement('audio');
audio.src = '../storage/albums/titres/' + albumId + '/' + trackName + '.mp3';
audio.setAttribute('preload', 'metadata')
audio.pause();
audio.addEventListener(
    "loadeddata",
    () => {
        audioPlayers.forEach(audioPlayer => {
            if(audioPlayer.querySelector(".time .length")){
                audioPlayer.querySelector(".time .length").innerText = getTimeCodeFromNum(audio.duration);
                audio.volume = .75;
            }
        });
    },
    false
);
if(document.querySelector('.audio-container').innerHTML === "") {
    document.querySelector('.audio-container').appendChild(audio);
}
console.log('newaudio')

//in queue tracks
let showQueue = document.querySelector('.queue');
showQueue.addEventListener('click', function(e) {
    e.preventDefault()
    let titreList = document.querySelector('.container-player .titres-list');
    e.target.classList.toggle('margin')
    titreList.classList.toggle('active')
    document.querySelector('.container-player .audio-player .time').classList.toggle('active')
    document.querySelector('.container-player .audio-player .timeline').classList.toggle('active')
    document.querySelector('.container-player .audio-player .titre_name_container').classList.toggle('active')
    document.querySelector('.container-player .audio-player .wrap-name').classList.toggle('active')
});

//toggle between playing and pausing on button click
function playOrPause() {
    let playBtns = document.querySelectorAll(".toggle-play");
    playBtns.forEach(playBtn => {
        playBtn.addEventListener('click', function () {
            if (audio.paused) {
                for (let index = 0; index < playBtns.length; index++) {
                    playBtns[index].classList.remove("play");
                    playBtns[index].classList.add("pause");
                }
                audio.play();
            } else {
                for (let index = 0; index < playBtns.length; index++) {
                    playBtns[index].classList.remove("pause");
                    playBtns[index].classList.add("play");
                }
                audio.pause();
            }
        })
    })
}
playOrPause();

//like album
let likeAlbums = document.querySelectorAll('.likeAlbum');
if(likeAlbums) {
    likeAlbums.forEach(likeAlbum => {
        likeAlbum.addEventListener('click', function(e) {
            e.target.classList.toggle('liked')
        })
    });
}

//Ajouter d'un fond différent sur la piste en cours de lecture
function makeActiveTrack() {
    if(document.querySelector('.titres-list')) {
        let titleList = document.querySelectorAll('.container-player .titres-list .albumTracks .titre');
        titleList.forEach(elem => {
            if(elem.querySelector('.track').innerText === currentSong.innerText) {
                elem.classList.add('active')
            }else{
                elem.classList.remove('active')
            }
        });
    }
}
makeActiveTrack();

//autoplay next track & loop
let loop = document.querySelector('.loop');
loop.addEventListener('click', function(e) {
    this.classList.toggle('active')
});
//shuffle random track
//Déclaration et définition du bouton shuffle
let shuffle = document.querySelector('.shuffle');
//Ajout d'un eventListener au click
shuffle.addEventListener('click', function(e) {
    //Toggle de la classe active
    this.classList.toggle('active')
});
//Transformation de la node list tracks en array tracksArray
let tracksArray = Array.prototype.slice.call(tracks);

//Création d'une fonction qui mélange aléatoirement les piste
function shuffledTracks(arr) {
    let i = arr.length, j, temp;
    while(--i > 0){
        j = Math.floor(Math.random()*(i+1));
        temp = arr[j];
        arr[j] = arr[i];
        arr[i] = temp;
    }
}
//Appel de la fonction
shuffledTracks(tracksArray)


function init() {
    if(document.querySelector('.audio-player')) {
        //click on button to change track
            //Déclaration et définition sur 1 de la variable trackindex qui permet de déterminer
            //la position de la piste en cours de lecture dans la playlist
            let trackIndex = Array.prototype.indexOf.call(tracks, trackName) + 1;
            audioPlayers.forEach(audioPlayer => {
                //Déclaration des boutons précédent et suivant
                let prev = audioPlayer.querySelector('.prev');
                let next = audioPlayer.querySelector('.next');

                //Changement de l'opacité des boutons
                // si l'on se trouve sur la première ou la dernière piste
                function changePrevNExtOpacity() {
                    if(trackIndex === 0) {
                        prev.style.opacity = "0.5"
                    } else if (trackIndex === tracks.length -1){
                        next.style.opacity = "0.5"
                    } else {
                        prev.style.opacity = "1"
                        next.style.opacity = "1"
                    }
                }
                changePrevNExtOpacity();

                //prev track
                prev.addEventListener("click", e => {
                    //Appel de la fonction permettant le changement du fond de la piste en cours de lecture
                    makeActiveTrack();

                    //Si le bouton lecture aléatoire est actif
                    if(shuffle.classList.contains('active')) {
                        //Si le bouton lecture en boucle est actif
                        if(loop.classList.contains('active')) {
                            //Si c'est la première piste
                            if(trackIndex === tracksArray.length -1) {
                                let track = tracksArray[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                               let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });
                                //Si le document contient la classe .current-track
                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });;
                                audio.play();
                                trackIndex = 0;
                            //Si ce n'est pas la première piste
                            } else {
                                let track = tracksArray[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });
                                //Si le document contient la classe .current-track
                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex--;
                            }
                        //Si le bouton lecture en boucle est inactif
                        }else {
                            if(trackIndex === 0) {

                            }
                            //Si ce n'est pas la première piste
                            else {
                                let track = tracksArray[trackIndex-1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });
                                //Si le document contient la classe .current-track
                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex--;
                            }
                        }
                    //Si le bouton lecture aléatoire est inactif
                    } else {
                        //Si le bouton lecture en boucle est actif
                        if(loop.classList.contains('active')) {
                            //Si c'est la première piste
                            if(trackIndex === 0) {
                                let track = tracks[tracks.length - 1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });

                                prev.setAttribute('display', 'none')
                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex = tracks.length -1;
                            }
                            //Si ce n'est pas la première piste
                            else {
                                let track = tracks[trackIndex -1].innerText;;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });
                                //Si le document contient la classe .current-track
                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                track
                                audio.play();
                                trackIndex--;
                            }
                        //Si le bouton lecture en boucle est inactif
                        } else {
                            if(trackIndex === 0) {

                            }
                            //Si ce n'est pas la première piste
                            else {
                                let track = tracks[trackIndex -1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                               currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });
                                //Si le document contient la classe .current-track
                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                track
                                audio.play();
                                trackIndex--;
                            }
                        }
                    }
                }, false);

                //next track
                next.addEventListener("click", e => {
                    makeActiveTrack();
                    if(shuffle.classList.contains('active')) {
                        if(loop.classList.contains('active')) {
                            if(trackIndex === tracksArray.length -1) {
                                let track = tracksArray[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });

                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex = 0;
                            } else {
                                let track = tracksArray[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                    currentSong.innerText = track;
                                });

                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        } else {
                            if(trackIndex === tracksArray.length -1) {

                            } else {
                                let track = tracksArray[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');


                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                            currentSong.innerText = track;
                                    });


                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        }
                    } else {
                        if(loop.classList.contains('active')) {
                            if(trackIndex === tracks.length -1) {
                                let track = tracks[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                            currentSong.innerText = track;
                                    });

                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex = 0;
                               }
                            else {
                                let track = tracks[trackIndex + 1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                            currentSong.innerText = track;
                                    });

                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        } else {
                            if(trackIndex === tracks.length -1) {

                               }
                            else {
                                let track = tracks[trackIndex + 1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                            currentSong.innerText = track;
                                    });

                                if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        }
                    }
                }, false);

                //Ecouteur d'évènement
                audio.addEventListener("timeupdate", function(){
                    makeActiveTrack();
                    if(loop.classList.contains('active')) {
                        prev.style.opacity = "1"
                        next.style.opacity = "1"
                    } else {
                        changePrevNExtOpacity()
                    }

                    if(this.currentTime === this.duration) {
                    if(shuffle.classList.contains('active')) {
                        if(loop.classList.contains('active')) {
                            if(trackIndex === tracksArray.length -1) {
                                let track = tracksArray[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex = 0;
                            } else {
                                let track = tracksArray[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        } else {
                            if(trackIndex === tracksArray.length -1) {
                                let track = tracksArray[-1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.add("play");
                                    playBtn.classList.remove("pause");
                                });
                                audio.pause();
                            } else {
                                let track = tracksArray[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        }
                    } else {
                        if(loop.classList.contains('active')) {
                            if(trackIndex === tracks.length -1) {
                                let track = tracks[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex = 0;
                            } else {
                                let track = tracks[trackIndex+1].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        } else {
                            if(trackIndex === tracks.length -1) {
                                let track = tracks[0].innerText;
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                    currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.add("play");
                                    playBtn.classList.remove("pause");
                                });
                                audio.pause();
                            } else {
                                let track = tracks[trackIndex+1].innerText;
                                console.log(tracks)
                                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');

                                let currentSongs = document.querySelectorAll('.container-player .titre_name');
                                    currentSongs.forEach(currentSong => {
                                        currentSong.innerText = track;
                                });

                                 if(document.querySelector('.current-track')) {
                                    document.querySelector('.current-song').innerText = track;
                                }
                                document.querySelector('.partial-player .titre_name').innerText = track;

                                const playBtns = document.querySelectorAll(".controls .toggle-play");
                                playBtns.forEach(playBtn => {
                                    playBtn.classList.remove("play");
                                    playBtn.classList.add("pause");
                                });
                                audio.play();
                                trackIndex++;
                            }
                        }
                    }
                }
                });

            })

        //click on timeline to skip around
        const timelines = document.querySelectorAll(".timeline");
        timelines.forEach(timeline => {
            timeline.addEventListener("click", e => {
                let timelineWidth = window.getComputedStyle(timeline).width;
                let timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;

                audio.currentTime = timeToSeek;
            }, false);
        });

        //check audio percentage and update time accordingly
        setInterval(() => {
            //Déclaration et définition des barres de progression
            const progressBars = document.querySelectorAll(".progress");
            //Pour toutes les barres de progression
            progressBars.forEach(progressBar => {
                //On définit la largeur en fonction de la durée écoulée de la piste
                progressBar.style.width = audio.currentTime / audio.duration * 95 + "%";
            });
            //Affichage du temps total et du temps restant
                //Pour tous les lecteurs audio
                audioPlayers.forEach(audioPlayer => {
                    //Si la classe est présente sur la page
                    if(audioPlayer.querySelector(".time .current")) {
                        //On écrit la valeur temporelle
                        audioPlayer.querySelector(".time .current").innerText = getTimeCodeFromNum(audio.currentTime);
                    }
                });
        }, 100);

        if(document.querySelector('.current-song')){
            //show current track
            window.onload = function(){
                let currentTrack = document.querySelector('.current-song');
                currentTrack.innerText = currentSong.innerText;
            };
        }

        //play tracks onclick
            //Création de la fonction
            function playOnCLick() {
                //Déclaration et définition de la variable qui contient toutes les pistes
                let titleList = document.querySelectorAll('.container-player .titres-list .albumTracks .titre .track-infos');
                //On parcours toutes les pistes
                titleList.forEach(title => {
                    //Pour chaque piste on ajoute un écouteur d'événement au clique
                    title.addEventListener('click', (e) => {
                        e.preventDefault()
                        //Suppression de la classe active sur toutes les pistes
                        for (let i = 0; i < titleList.length -1; i ++) {
                            titleList[i].classList.remove('active')
                        }
                        //Ajout de la classe active sur l'élément cliqué
                        e.target.classList.add('active');

                        //Récupération de la piste cliquée
                        let newTrack = e.target.querySelector('.track');
                        //Remplacement l'ancienne piste par ma nouvelle
                        let track = newTrack.innerText;
                        //Remplacement du titre de la piste dans la balise audio
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        //Remplacement du titre de la piste en cours de lecture
                        //partout où elle est affichée sur le site
                        let currentSongs = document.querySelectorAll('.container-player .titre_name');
                        currentSongs.forEach(currentSong => {
                            currentSong.innerText = track;
                        });
                        if(document.querySelector('.current-track')) {
                            document.querySelector('.current-song').innerText = track;
                        }
                        document.querySelector('.partial-player .titre_name').innerText = track;
                        //Modification de tous les boutons play/pause
                        let playBtns = document.querySelectorAll(".toggle-play")
                        playBtns.forEach(playBtn => {
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                        });
                        //On joue la piste audio
                        audio.play();
                        //Calcul de l'index de la piste dans la liste
                        if(e.target.querySelector('.number').innerText > 9) {
                            trackIndex = parseInt(e.target.querySelector('.number').innerText) - 1;
                        } else {
                            trackIndex = parseInt(e.target.querySelector('.number').innerText.replace('0', '')) - 1;
                        }
                    })
                });
            }
            playOnCLick();

        //texte défilant player
        const body = document.querySelector('body');
        const slideTextContainer = document.querySelector('.textSlide');
        const slideTextContainer2 = document.querySelectorAll('.textSlide2');

        if(slideTextContainer) {
            let totalWidth = document.querySelector('body').clientWidth;

            slideTextContainer.parentElement.style.width = totalWidth + 50 + 'px';
            if(slideTextContainer.offsetWidth >= body.offsetWidth /2) {
                slideTextContainer.classList.add('slide')
                setInterval(function(){
                    slideTextContainer.classList.remove('slide')
                }, 7000)
                setInterval(function(){
                    slideTextContainer.classList.add('slide')
                }, 14000)
            }
        }

        //desactivé hors ligne
        if(slideTextContainer2) {
            anime({
                targets: slideTextContainer2,
                translateX: '-100%',
                duration: 12000,
                delay: 2000,
                easing: 'linear',
                loop: true
              });
            slideTextContainer2.forEach(text => {
            })
        }

        //like sur un album
        if(document.querySelector('#like')){
            let likes = document.querySelectorAll('#like')
            likes.forEach(like => {
                like.addEventListener('submit', e => {
                    e.preventDefault()

                    let likeAlbums = document.querySelectorAll('.likeAlbum')

                    let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    let fd = new FormData();

                    fd.append('album_id', e.target.album_id.value)

                    fetch(e.target.action, {
                        method:e.target.method,
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },
                        body: fd
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.liked === true){
                            likeAlbums.forEach(likeAlbum => {
                                likeAlbum.parentElement.classList.add('liked');
                                likeAlbum.value = "Retirer"
                            });
                        } else {
                            likeAlbums.forEach(likeAlbum => {
                                likeAlbum.parentElement.classList.remove('liked');
                                likeAlbum.value = "Ajouter"
                            });
                        }
                    });
                })
            });
        }

        //like sur un artiste
        if(document.querySelector('#likeArtiste')){
            document.querySelector('#likeArtiste').addEventListener('submit', e => {
                e.preventDefault()

                let nbrLike = parseInt(document.querySelector('.likeArtiste').innerHTML)

                let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let fd = new FormData();

                fd.append('artiste_id', e.target.artiste_id.value)

                fetch(e.target.action, {
                    method:e.target.method,
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    body: fd
                })
                .then(response => response.json())
                .then(data => {
                    if(data.likedArtiste === true){
                        e.target.lastElementChild.classList.add('liked');

                        document.querySelector('.likeArtiste').innerHTML = nbrLike + 1

                        e.submitter.value = "Retirer"
                    } else {
                        e.target.lastElementChild.classList.remove('liked');

                        document.querySelector('.likeArtiste').innerHTML = nbrLike - 1

                        e.submitter.value = "Ajouter"
                    }
                });
            })
        }

        //like sur un album dans la playlist
        if(document.querySelector('#likePlaylist')){
            document.querySelector('#likePlaylist').addEventListener('submit', e => {
                e.preventDefault()
                let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let fd = new FormData();
                fd.append('album_id', e.target.album_id.value)
                fetch(e.target.action, {
                    method:e.target.method,
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    body: fd
                })
                .then(response => response.json())
                .then(data => {
                    if(data.liked === true){
                        document.querySelector('.wrapPlaylist').classList.add('liked');
                        document.querySelector('.wrap').classList.add('liked');
                        document.querySelector('#likeAlbum').value = "Retirer"
                    } else {
                        document.querySelector('.wrapPlaylist').classList.remove('liked');
                        document.querySelector('.wrap').classList.remove('liked');
                        document.querySelector('#likeAlbum').value = "Ajouter"
                    }
                });
            })
        }

        // like sur un titre
        function likeTitrePlaylist() {
            if(document.querySelector('.likeTitre')){
                let titres = document.querySelectorAll('.likeTitre')
                titres.forEach(titre => {
                    titre.addEventListener('submit', e => {
                        e.preventDefault()
                        let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        let fd = new FormData();
                        fd.append('titre_id', e.target.titre_id.value)
                        fetch(e.target.action, {
                            method:e.target.method,
                            headers: {
                                'X-CSRF-TOKEN': csrf
                            },
                            body: fd
                        })
                            .then(response => response.json())
                            .then(data => {
                                if(data.likedTitre === true){
                                    e.submitter.parentElement.classList.add('liked');
                                    e.target.lastElementChild.classList.add('liked');
                                } else {
                                    e.submitter.parentElement.classList.remove('liked');
                                    e.target.lastElementChild.classList.remove('liked');
                                }
                            });
                    })
                });
            }
        }
        likeTitrePlaylist();

        //listen and add to recent list
        if(document.querySelector('#listenAndAddRecent')){
            document.querySelector('#listenAndAddRecent').addEventListener('submit', e => {
                e.preventDefault()
                let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                let fd = new FormData();
                fd.append('album_id', e.target.album_id.value)
                fd.append('artiste_id', e.target.artiste_id.value)
                fetch(e.target.action, {
                    method:e.target.method,
                    headers: {
                        'X-CSRF-TOKEN': csrf
                    },
                    body: fd
                })
                .then(response => response.json())
                .then(data => {
                    let clickList = document.querySelector('.container-album .bottom')
                    let container = document.querySelector('.container-player .albumTracks')
                    container.innerHTML = clickList.innerHTML

                    //change album duration
                    let duration = document.querySelector('.container-player .duration')
                    duration.innerHTML = e.target.parentElement.closest('.container-album').querySelector('.duration').innerHTML

                    // change nbr tracks
                    let nbrTracks = document.querySelector('.container-player .titres_count')
                    nbrTracks.innerHTML = e.target.parentElement.closest('.container-album').querySelector('.nbrTracks').innerHTML + ' titres';

                    // change img src
                    let newImg = document.querySelector('.top img')
                    let oldImg1 = document.querySelector('.audio-player-partial .top .left img')
                    let oldImg2 = document.querySelector('.container-player .cover')
                    let oldImg3 = document.querySelector('.container-player .album-cover img')
                    oldImg1.src = newImg.src
                    oldImg2.src = newImg.src
                    oldImg3.src = newImg.src

                    // change album name
                    let newAlbumName = e.target.parentElement.closest('.container-album').querySelector('.album_name')
                    let oldAlbumName = document.querySelector('.container-player h2')
                    let oldAlbumNames2 = document.querySelectorAll('.partial-player .element .album-name')
                    let oldAlbumNames3 = document.querySelectorAll('.container-player .element .album-name')
                    let oldAlbumName4 = document.querySelector('.container-player .album_name')
                    setTimeout(() => {
                        oldAlbumName.innerText = newAlbumName.innerText
                        oldAlbumNames2.forEach(oldAlbumName2 => {
                            oldAlbumName2.innerHTML = newAlbumName.innerHTML
                        });
                        oldAlbumNames3.forEach(oldAlbumName3 => {
                            oldAlbumName3.innerHTML = newAlbumName.innerHTML
                        });
                        oldAlbumName4.innerHTML = newAlbumName.innerHTML
                    }, "500")

                    // change currentsong name
                    let newTitreName = e.target.parentElement.closest('.container-album').querySelectorAll('.titre .track')[0].innerText

                    let titreName = document.querySelector('.audio-player .titre_name')
                    titreName.innerText = newTitreName

                    let titreName2 = document.querySelector('.current-track .current-song')
                    titreName2.innerText = newTitreName

                    let titreName3 = document.querySelector('.audio-player-partial .titre_name')
                    titreName3.innerText = newTitreName

                    // change artist name
                        let newArtistName = e.target.parentElement.closest('.container-album').querySelector('.artiste_name').innerText.replace("par", "")

                        //texte défilant mini player
                        let oldArtistNames2 = document.querySelectorAll('.audio-player-partial .textSlide2 .element .artiste_name')
                        oldArtistNames2.forEach((oldArtistName2, index) => {
                            oldArtistName2.innerText = newArtistName
                        });
                        //texte défilant big player
                        let oldArtistNames3 = document.querySelectorAll('.audio-player .textSlide2 .element .artiste_name')
                        oldArtistNames3.forEach((oldArtistName3, index) => {
                            oldArtistName3.innerText = newArtistName
                        });
                        //texte défilant file d'attente
                        let oldArtistName4 = document.querySelector('.container-player .textSlide .artiste_name')
                        oldArtistName4.innerText = newArtistName


                        let currentSong = document.querySelector('.container-player .titre_name');
                        let trackName = currentSong.innerHTML;

                        var newIds = document.querySelectorAll('input[name=album_id]')
                        newIds.forEach(newId => {
                            albumId = newId.value
                        });

                        albumId = document.querySelectorAll('.container-album input[name=album_id]')[0].value

                        let newListTracks = e.target.parentElement.closest('.container-album').querySelectorAll('.bottom .titre .track')
                        tracks = Array.prototype.slice.call(newListTracks);

                        playOnCLick();
                        likeTitrePlaylist();

                        audio.src = '../storage/albums/titres/' + albumId + '/' + trackName + '.mp3';
                        audio.play()

                        let playBtns = document.querySelectorAll(".toggle-play");
                        playBtns.forEach(playBtn => {
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                        });
                });
            })
        }

        if(document.querySelector('.partial-player')) {
            let littlePLayer = document.querySelector('.partial-player');
            if(document.querySelector('.container-player')) {
                let bigPlayer = document.querySelector('.container-player');
                bigPlayer.classList.remove('active');
                littlePLayer.style.display ='block';

                document.querySelector('.middle').addEventListener('click', e => {
                    bigPlayer.classList.add('active');
                    littlePLayer.style.display ='none';
                    body.style.overflow = 'hidden';
                })
                let close = document.querySelector('.hide');
                close.addEventListener('click', e => {
                    bigPlayer.classList.remove('active');
                    littlePLayer.style.display ='block';
                })
            }
        }

        // play recent album onclick
        let playRecents = document.querySelectorAll('.recents .card');
        // change track list
        playRecents.forEach(playRecent => {
            playRecent.addEventListener('click', e => {

                albumId = e.currentTarget.querySelector('[name="album_id"]').value;

                let formAction = document.getElementById("like");
                formAction.setAttribute('action', window.location.href + 'player/' + albumId);

                let formAction2 = document.getElementById("likePlaylist");
                formAction2.setAttribute('action', window.location.href + 'player/' + albumId);

                let clickListTracks = e.currentTarget.querySelectorAll('.albumTracks .titre .track')
                tracks = clickListTracks;
                tracksArray = Array.prototype.slice.call(tracks);
                shuffledTracks(tracksArray)

                let clickList = e.currentTarget.querySelector('.albumTracks')
                let container = document.querySelector('.container-player .albumTracks')
                container.innerHTML = clickList.innerHTML

                //change album duration
                let duration = document.querySelector('.wrap-infos .duration')
                duration.innerHTML = e.currentTarget.querySelector('[name="duration"]').value + ' min'

                // change nbr tracks
                let nbrTracks = document.querySelector('.wrap-infos .titres_count p')
                nbrTracks.innerHTML = clickListTracks.length + ' titres';

                // change img src
                let newImg = e.currentTarget.querySelector('img')
                let oldImg1 = document.querySelector('.audio-player-partial .top .left img')
                let oldImg2 = document.querySelector('.container-player .cover')
                let oldImg3 = document.querySelector('.container-player .album-cover img')
                oldImg1.src = newImg.src
                oldImg2.src = newImg.src
                oldImg3.src = newImg.src

                // // change album name
                let newAlbumName = e.currentTarget.querySelector('.album_name')
                let oldAlbumName = document.querySelector('.container-player h2')
                let oldAlbumNames2 = document.querySelectorAll('.partial-player .element .album-name')
                let oldAlbumNames3 = document.querySelectorAll('.container-player .element .album-name')
                let oldAlbumName4 = document.querySelector('.container-player .album_name')
                oldAlbumName.innerHTML = newAlbumName.innerHTML
                oldAlbumNames2.forEach(oldAlbumName2 => {
                    oldAlbumName2.innerHTML = newAlbumName.innerHTML
                });
                oldAlbumNames3.forEach(oldAlbumName3 => {
                    oldAlbumName3.innerHTML = newAlbumName.innerHTML
                });
                oldAlbumName4.innerHTML = newAlbumName.innerHTML

                // change title name
                let newTitreName = e.currentTarget.querySelector('.albumTracks .track')
                let titreNames = document.querySelectorAll('.titre_name')
                let titreName2 = document.querySelector('.current-track .current-song')
                titreName2.innerHTML = newTitreName.innerHTML
                titreNames.forEach(titreName => {
                    titreName.innerHTML = newTitreName.innerHTML
                });

                // // change artist name
                let newArtistName = e.currentTarget.querySelector('.artiste_name')
                let oldArtistName = document.querySelector('.container-player h2')
                let oldArtistNames2 = document.querySelectorAll('.partial-player .element .artiste_name')
                let oldArtistNames3 = document.querySelectorAll('.container-player .element .artiste_name')
                let oldArtistName4 = document.querySelector('.container-player .textSlide .artiste_name')
                oldArtistName.innerHTML = newArtistName.innerHTML
                oldArtistNames2.forEach(oldArtistName2 => {
                    oldArtistName2.innerHTML = newArtistName.innerHTML
                });
                oldArtistNames3.forEach(oldArtistName3 => {
                    oldArtistName3.innerHTML = newArtistName.innerHTML
                });
                oldArtistName4.innerHTML = newArtistName.innerHTML

                let currentSong = document.querySelector('.container-player .titre_name');
                let trackName = currentSong.innerText;

                audio.src = '../storage/albums/titres/' + albumId + '/' + trackName + '.mp3';

                var containerPlayer = document.querySelector('.container-player')
                var newIds = containerPlayer.querySelectorAll('[name="album_id"]')

                newIds.forEach(newId => {
                    newId.value = albumId
                });

                let playBtns = document.querySelectorAll(".toggle-play");
                playBtns.forEach(playBtn => {
                    playBtn.classList.remove("play");
                    playBtn.classList.add("pause");
                });

                //play tracks onclick
                playOnCLick()
                //like sur un titre
                if(document.querySelector('.likeTitre')){
                    let titres = document.querySelectorAll('.likeTitre')
                    titres.forEach(titre => {
                    titre.addEventListener('submit', e => {
                            e.preventDefault()
                            let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                            let fd = new FormData();
                            fd.append('titre_id', e.target.titre_id.value)
                            fetch(e.target.action, {
                                method:e.target.method,
                                headers: {
                                    'X-CSRF-TOKEN': csrf
                                },
                                body: fd
                            })
                            .then(response => response.json())
                            .then(data => {
                                if(data.likedTitre === true){
                                    e.submitter.parentElement.classList.add('liked');
                                } else {
                                    e.submitter.parentElement.classList.remove('liked');
                                }
                            });
                        })
                    });
                }
                audio.play()
            })
        });
    }
}
init();

swup.on('contentReplaced', init)
