const { round, indexOf } = require('lodash');

require('./bootstrap');
require('alpinejs');

if(document.querySelector('.audio-player')) {
    let tracks = document.querySelectorAll('.track');

    const audioPlayer = document.querySelector('.audio-player');

    //récuperer une piste de l'album
    let currentSong = document.querySelector('.titre_name');
    let trackName = currentSong.textContent;

    //récuprérer l'id de l'album pour construire le lien de la piste
    let url = window.location.href;
    let searchIndex = url.split('/');
    let index = searchIndex.length-1;
    let albumId = searchIndex.splice(index, 1, trackName);

    //create track trackName
    let audio = new Audio(
        '../storage/albums/titres/' + albumId + '/' + trackName + '.mp3'
    );

    audio.setAttribute('preload', 'metadata')

    audio.addEventListener(
        "loadeddata",
        () => {
            audioPlayer.querySelector(".time .length").textContent = getTimeCodeFromNum(
            audio.duration
        );
        audio.volume = .75;
        },
        false
    );

    //click on button to change track
    let trackIndex = Array.prototype.indexOf.call(tracks, trackName)+1;

    //prev track
    const prev = audioPlayer.querySelector('.prev');
    prev.addEventListener("click", e => {
        if(shuffle.classList.contains('active')) {
            let tracksArray = Array.prototype.slice.call(tracks);
            tracksArray.sort(function() {
                return 0.5 - Math.random();
            })
            // let trackIndexShuffle = Array.prototype.indexOf.call(tracks, trackName)+1;

            if(trackIndex == 0) {
                let track = tracksArray[tracksArray.length - 1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = tracksArray.length -1;
            }
            else {
                let track = tracksArray[trackIndex-1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex--;
            }
        } else {
            if(trackIndex == 0) {
                let track = tracks[tracks.length - 1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = tracks.length -1;
            }
            else {
                let track = tracks[trackIndex-1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex--;
            }
        }
    }, false);

    //next track
    const next = audioPlayer.querySelector('.next');
    next.addEventListener("click", e => {
        if(shuffle.classList.contains('active')) {
            let tracksArray = Array.prototype.slice.call(tracks);
            tracksArray.sort(function() {
                return 0.5 - Math.random();
            });
            if(trackIndex == tracks.length -1) {
                let track = tracks[0].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = 0;
            }
            else {
                let track = tracks[trackIndex+1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex++;
            }
        } else {
            if(trackIndex == tracks.length -1) {
                let track = tracks[0].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = 0;
            }
            else {
                let track = tracks[trackIndex+1].textContent;
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex++;
            }
        }
    }, false);

    //autoplay next track & loop
    let loop = document.querySelector('.loop');
    loop.addEventListener('click', function(e) {
        this.classList.toggle('active')
    });
    //shuffle random track
    let shuffle = document.querySelector('.shuffle');
    shuffle.addEventListener('click', function(e) {
        this.classList.toggle('active')
    });

    //in queue tracks
    let queue = document.querySelector('.queue');
    let titreList = document.querySelector('.titres-list');
    queue.addEventListener('click', function(e) {
        titreList.classList.toggle('active')
    });

    audio.addEventListener("timeupdate", function(){
        if(this.currentTime == this.duration) {
            if(shuffle.classList.contains('active')) {
                let tracksArray = Array.prototype.slice.call(tracks);
                tracksArray.sort(function() {
                    return 0.5 - Math.random();
                })
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracksArray.length -1) {
                        let track = tracksArray[0].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracksArray[trackIndex+1].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                } else {
                    if(trackIndex == tracksArray.length -1) {
                        let track = tracksArray[0].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("pause");
                        playBtn.classList.add("play");
                        audio.pause();
                    } else {
                        let track = tracksArray[trackIndex+1].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                }
            } else {
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracks.length -1) {
                        let track = tracks[0].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracks[trackIndex+1].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                } else {
                    if(trackIndex == tracks.length -1) {
                        let track = tracks[0].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("pause");
                        playBtn.classList.add("play");
                        audio.pause();
                    } else {
                        let track = tracks[trackIndex+1].textContent;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
                        currentSong.innerText = track;
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
        console.dir(audio)
    }, false);

    //check audio percentage and update time accordingly
    setInterval(() => {
        const progressBar = audioPlayer.querySelector(".progress");
        progressBar.style.width = audio.currentTime / audio.duration * 100 + "%";
        audioPlayer.querySelector(".time .current").textContent = getTimeCodeFromNum(
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
}

