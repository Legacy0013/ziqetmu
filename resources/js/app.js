import Swup from 'swup';
import SwupFormsPlugin from '@swup/forms-plugin';
import SwupDebugPlugin from '@swup/debug-plugin';

const swup = new Swup({
    plugins: [
        new SwupFormsPlugin({formSelector: 'form[data-swup-form]'}),
        new SwupDebugPlugin()
    ]
});

function init() {

    require('./bootstrap');
    require('alpinejs');

    if(document.querySelector('.audio-player')) {
        let tracks = document.querySelectorAll('.track');

        const audioPlayer = document.querySelector('.audio-player');

        //récupérer une piste de l'album
        let currentSong = document.querySelector('.titre_name');
        let trackName = currentSong.innerText;

        //récupérer l'id de l'album pour construire le lien de la piste
        let albumId = document.querySelector('#album_id').value;

        //create track trackName
        var audio = document.createElement('audio');
        audio.src = '../storage/albums/titres/' + albumId + '/' + trackName + '.mp3';
        audio.setAttribute('preload', 'metadata')
        audio.pause();
        audio.addEventListener(
            "loadeddata",
            () => {
                audioPlayer.querySelector(".time .length").innerText = getTimeCodeFromNum(audio.duration);
                audio.volume = .75;
            },
            false
        );
        document.querySelector('.audio-container').appendChild(audio);

        //shuffle random track
        let shuffle = document.querySelector('.shuffle');
        shuffle.addEventListener('click', function(e) {
            this.classList.toggle('active')
        });
        const tracksArray = Array.prototype.slice.call(tracks);
        function shuffledTracks(arr) {
            var i = arr.length, j, temp;
            while(--i > 0){
            j = Math.floor(Math.random()*(i+1));
            temp = arr[j];
            arr[j] = arr[i];
            arr[i] = temp;
            }
        }
        shuffledTracks(tracksArray)

        //click on button to change track
        let trackIndex = Array.prototype.indexOf.call(tracks, trackName) + 1;

        //prev track
        let prev = audioPlayer.querySelector('.prev');

        if(trackIndex == 0) {
            prev.style.opacity = "0.5"
        } else if (trackIndex == tracks.length -1){
            next.style.opacity = "0.5"
        } else {
            prev.style.opacity = "1"
            next.style.opacity = "1"
        }

        prev.addEventListener("click", e => {
            if(shuffle.classList.contains('active')) {
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracksArray.length -1) {
                        let track = tracksArray[0].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracksArray[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex--;
                    }
                }else {
                    if(trackIndex == 0) {

                    }
                    else {
                        let track = tracksArray[trackIndex-1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex--;
                    }
                }
            } else {
                if(loop.classList.contains('active')) {
                    if(trackIndex == 0) {
                        let track = tracks[tracks.length - 1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        prev.setAttribute('display', 'none')
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = tracks.length -1;
                    }
                    else {
                        let track = tracks[trackIndex -1].innerText;;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        track
                        audio.play();
                        trackIndex--;
                    }
                } else {
                    if(trackIndex == 0) {

                    }
                    else {
                        let track = tracks[trackIndex -1].innerText;;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        track
                        audio.play();
                        trackIndex--;
                    }
                }
            }
        }, false);

        //next track
        let next = audioPlayer.querySelector('.next');
        next.addEventListener("click", e => {
            if(shuffle.classList.contains('active')) {
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracksArray.length -1) {
                        let track = tracksArray[0].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracksArray[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                } else {
                    if(trackIndex == tracksArray.length -1) {

                    } else {
                        let track = tracksArray[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                }
            } else {
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracks.length -1) {
                        let track = tracks[0].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                       }
                    else {
                        let track = tracks[trackIndex + 1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                } else {
                    if(trackIndex == tracks.length -1) {

                       }
                    else {
                        let track = tracks[trackIndex + 1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        currentTrack.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                }
            }
        }, false);

        //autoplay next track & loop
        let loop = document.querySelector('.loop');
        loop.addEventListener('click', function(e) {
            this.classList.toggle('active')
        });

        //in queue tracks
        let showQueue = document.querySelector('.queue');
        let titreList = document.querySelector('.titres-list');
        showQueue.addEventListener('click', function(e) {
            titreList.classList.toggle('active')
        });

        audio.addEventListener("timeupdate", function(){
            if(loop.classList.contains('active')) {
                prev.style.opacity = "1"
                next.style.opacity = "1"
            } else {
                if(trackIndex == 0) {
                    prev.style.opacity = "0.5"
                } else if (trackIndex == tracks.length -1){
                    next.style.opacity = "0.5"
                } else {
                    prev.style.opacity = "1"
                    next.style.opacity = "1"
                }
            }
            let titleList = document.querySelectorAll('.titre');
            titleList.forEach(elem => {
                if(elem.querySelector('.track').innerText == currentSong.innerText) {
                    elem.classList.add('active')
                }else{
                    elem.classList.remove('active')
                }
            });

            if(this.currentTime == this.duration) {
                if(shuffle.classList.contains('active')) {
                    if(loop.classList.contains('active')) {
                        if(trackIndex == tracksArray.length -1) {
                            let track = tracksArray[0].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex = 0;
                        } else {
                            let track = tracksArray[trackIndex+1].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex++;
                        }
                    } else {
                        if(trackIndex == tracksArray.length -1) {
                            let track = tracksArray[-1].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("pause");
                            playBtn.classList.add("play");
                            audio.pause();
                        } else {
                            let track = tracksArray[trackIndex+1].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex++;
                        }
                    }
                } else {
                    if(loop.classList.contains('active')) {
                        if(trackIndex == tracks.length -1) {
                            let track = tracks[0].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex = 0;
                        } else {
                            let track = tracks[trackIndex+1].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex++;
                        }
                    } else {
                        if(trackIndex == tracks.length -1) {
                            let track = tracks[0].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("pause");
                            playBtn.classList.add("play");
                            audio.pause();
                        } else {
                            let track = tracks[trackIndex+1].innerText;
                            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                            currentSong.innerText = track;
                            currentTrack.innerText = track;
                            playBtn.classList.remove("play");
                            playBtn.classList.add("pause");
                            audio.play();
                            trackIndex++;
                        }
                    }
                }
            }
        });

        //click on timeline to skip around
        const timeline = audioPlayer.querySelector(".timeline");
        timeline.addEventListener("click", e => {
            let timelineWidth = window.getComputedStyle(timeline).width;
            let timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
            audio.currentTime = timeToSeek;
        }, false);

        //check audio percentage and update time accordingly
        setInterval(() => {
            const progressBar = audioPlayer.querySelector(".progress");
            progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
            audioPlayer.querySelector(".time .current").innerText = getTimeCodeFromNum(
            audio.currentTime);
        }, 500);

        //toggle between playing and pausing on button click
        const playBtn = audioPlayer.querySelector(".controls .toggle-play");

        playBtn.addEventListener(
        "click",
        () => {
            if (audio.paused) {
            playBtn.classList.remove("play");
            playBtn.classList.add("pause");
            audio.play();
            } else {
            playBtn.classList.remove("pause");
            playBtn.classList.add("play");
            audio.pause();
            }
        },
        false
        );

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

        let currentTrack = document.querySelector('.current-song');
        //show current track
        window.onload = function(){
            currentTrack.innerText = currentSong.innerText;
        };

        //play tracks onclick
        let titleList = document.querySelectorAll('.titre');
        titleList.forEach(title => {
            title.addEventListener('click', function(e) {
                let newTrack = e.target.querySelector('.track').innerText;
                let track = newTrack;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                titleList.forEach(elem => elem.classList.remove('active'));
                e.target.classList.add('active');
                currentSong.innerText = track;
                currentTrack.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                if(e.target.querySelector('.number').innerText > 9) {
                    trackIndex = parseInt(e.target.querySelector('.number').innerText) - 1;
                } else {
                    trackIndex = parseInt(e.target.querySelector('.number').innerText.replace('0', '')) - 1;
                }
            })
        });

        //like album
        let likeAlbum = document.querySelector('#likeAlbum');
        if(likeAlbum) {
            likeAlbum.addEventListener('click', function(e) {
                e.target.classList.toggle('liked')
            })
        }

        //texte défilant player
        const body = document.querySelector('body');
        const slideTextContainer = document.querySelector('.textSlide');
        const slideTextContainer2 = document.querySelector('.textSlide2');
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

        if(slideTextContainer2.offsetWidth >= body.offsetWidth - 65) {
            slideTextContainer2.classList.add('slide2')
        }
    }

    //like sur un album ou un artiste
    if(document.querySelector('#like')){
        document.querySelector('#like').addEventListener('submit', e => {
            e.preventDefault()
            let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let fd = new FormData();
            if(e.submitter.id == 'likeAlbum') {
                fd.append('album_id', e.target.album_id.value)
            }
            else if(e.submitter.id == 'likeArtiste') {
                fd.append('artiste_id', e.target.artiste_id.value)
                location.reload();
            }
            fetch(e.target.action, {
                method:e.target.method,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                body: fd
            })
            .then(response => response.json())
            .then(data => {
                if(data.liked == true){
                    document.querySelector('.wrap').classList.add('liked');
                    document.querySelector('.wrapPlaylist').classList.add('liked');
                } else {
                    document.querySelector('.wrap').classList.remove('liked');
                    document.querySelector('.wrapPlaylist').classList.remove('liked');
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
            if(e.submitter.id == 'likeAlbum') {
                fd.append('album_id', e.target.album_id.value)
            }
            fetch(e.target.action, {
                method:e.target.method,
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                body: fd
            })
            .then(response => response.json())
            .then(data => {
                if(data.liked == true){
                    document.querySelector('.wrapPlaylist').classList.add('liked');
                    document.querySelector('.wrap').classList.add('liked');
                } else {
                    document.querySelector('.wrapPlaylist').classList.remove('liked');
                    document.querySelector('.wrap').classList.remove('liked');
                }
            });
        })
    }
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
                    if(data.likedTitre == true){
                        e.submitter.parentElement.classList.add('liked');
                    } else {
                        e.submitter.parentElement.classList.remove('liked');
                    }
                });
            })
        });
    }
}
init();

swup.on('contentReplaced', init)

