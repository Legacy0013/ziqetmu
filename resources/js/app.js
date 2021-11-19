const { round, indexOf } = require('lodash');

require('./bootstrap');
require('alpinejs');

if(document.querySelector('.audio-player')) {
    let tracks = document.querySelectorAll('.track');
    const audioPlayer = document.querySelector('.audio-player');

    //récuperer une piste de l'album
    let currentSong = document.querySelector('.titre_name');
    let trackName = currentSong.innerText;

    //récuprérer l'id de l'album pour construire le lien de la piste
    let albumId = document.querySelector('#album_id').value;

    //create track trackName
    let audio = new Audio('../storage/albums/titres/' + albumId + '/' + trackName + '.mp3');

    audio.setAttribute('preload', 'metadata')

    audio.addEventListener(
        "loadeddata",
        () => {
            audioPlayer.querySelector(".time .length").innerText = getTimeCodeFromNum(audio.duration);
        audio.volume = .75;
        },
        false
    );

    //click on button to change track
    let trackIndex = Array.prototype.indexOf.call(tracks, trackName) + 1;

    //prev track
    let prev = audioPlayer.querySelector('.prev');

    if(trackIndex == 0) {
        prev.style.opacity = "0.5"
    } else {
        prev.style.opacity = "1"
    }


    prev.addEventListener("click", e => {
        if(trackIndex == 0) {
            prev.style.opacity = "0.5"
        } else {
            prev.style.opacity = "1"
        }
        if(shuffle.classList.contains('active')) {
            let tracksArray = Array.prototype.slice.call(tracks);
            tracksArray.sort(function() {
                return 0.5 - Math.random();
            })
            if(trackIndex == 0) {

                // let track = tracksArray[tracksArray.length - 1].innerText;
                // console.log('avant:' + trackIndex);
                // console.log(track);
                // audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                // currentSong.innerText = track;
                // playBtn.classList.remove("play");
                // audio.play();
                // trackIndex = tracksArray.length;
                // console.log('après:' + trackIndex);
            }
            else {
                let track = tracksArray[trackIndex-1].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex--;
                console.log('après:' + trackIndex);
            }
        } else {
            if(trackIndex == 0) {
                // let track = tracks[tracks.length - 1].innerText;
                // console.log('avant:' + trackIndex);
                // console.log(track);
                // audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                // currentSong.innerText = track;
                // prev.setAttribute('display', 'none')
                // playBtn.classList.remove("play");
                // playBtn.classList.add("pause");
                // audio.play();
                // trackIndex = tracks.length;
                // console.log('après:' + trackIndex);
            }
            else {
                let track = tracks[trackIndex -1].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex--;
                console.log('après:' + trackIndex);

            }
        }
        console.log(trackIndex);
    }, false);

    //next track
    const next = audioPlayer.querySelector('.next');
    next.addEventListener("click", e => {
        if(trackIndex == 0) {
            prev.style.opacity = "0.5"
        } else {
            prev.style.opacity = "1"
        }
        if(shuffle.classList.contains('active')) {
            let tracksArray = Array.prototype.slice.call(tracks);
            tracksArray.sort(function() {
                return 0.5 - Math.random();
            });
            if(trackIndex == tracks.length -1) {
                let track = tracks[0].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = 0;
                console.log('après:' + trackIndex);

            }
            else {
                let track = tracks[trackIndex+1].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex++;
                console.log('après:' + trackIndex);

            }
        } else {
            if(trackIndex == tracks.length -1) {
                let track = tracks[0].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex = 0;
                console.log('après:' + trackIndex);

            }
            else {
                let track = tracks[trackIndex + 1].innerText;
                console.log('avant:' + trackIndex);
                console.log(track);
                audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                currentSong.innerText = track;
                playBtn.classList.remove("play");
                playBtn.classList.add("pause");
                audio.play();
                trackIndex++;
                console.log('après:' + trackIndex);

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
    let showQueue = document.querySelector('.queue');
    let titreList = document.querySelector('.titres-list');
    showQueue.addEventListener('click', function(e) {
        titreList.classList.toggle('active')
        // hideQueue.classList.add('active')
    });

    audio.addEventListener("timeupdate", function(){
        if(trackIndex == 0) {
            prev.style.opacity = "0.5"
        } else {
            prev.style.opacity = "1"
        }
        if(this.currentTime == this.duration) {
            if(shuffle.classList.contains('active')) {
                let tracksArray = Array.prototype.slice.call(tracks);
                tracksArray.sort(function() {
                    return 0.5 - Math.random();
                })
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracksArray.length -1) {
                        let track = tracksArray[0].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracksArray[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
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
                        playBtn.classList.remove("pause");
                        playBtn.classList.add("play");
                        audio.pause();
                    } else {
                        let track = tracksArray[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex++;
                    }
                    console.log(trackIndex);
                }
            } else {
                if(loop.classList.contains('active')) {
                    if(trackIndex == tracks.length -1) {
                        let track = tracks[0].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
                        playBtn.classList.remove("play");
                        playBtn.classList.add("pause");
                        audio.play();
                        trackIndex = 0;
                    } else {
                        let track = tracks[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
                        currentSong.innerText = track;
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
                        playBtn.classList.remove("pause");
                        playBtn.classList.add("play");
                        audio.pause();
                    } else {
                        let track = tracks[trackIndex+1].innerText;
                        audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track + '.mp3');
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

    //show current track
    window.onload = function(){
        tracks[0].parentElement.style.display = 'none';
        let currentTrack = document.querySelector('.current-song');
        currentTrack.innerText = currentSong.innerText;
        let currentInnerText = document.querySelector('.titre_name');

        currentInnerText.addEventListener('DOMSubtreeModified', function() {
            currentTrack.innerText = currentSong.innerText;
            tracks.forEach(track => {
                if(trackIndex != tracks.length -1) {
                    if(track.innerText == currentTrack.innerText) {
                        track.parentElement.style.display = 'none';
                    }
                } else {
                    tracks[0].parentElement.style.display = 'none';
                    // track.parentElement.style.display = 'flex';
                }
            });
        }, false);
    };


    //hide already played tracks

}

