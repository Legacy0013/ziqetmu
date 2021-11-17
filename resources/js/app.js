require('./bootstrap');
require('alpinejs');


    // let src = document.querySelector('.player').src;
    let tracks = document.querySelectorAll('.track');
    console.log(tracks.length);
    const audioPlayer = document.querySelector('.audio-player');

    //récuperer une piste de l'album
    let currentSong = document.querySelector('.titre_name');
    let link = currentSong.textContent;
    //récuprérer l'id de l'album pour construire le lien de la piste
    let url = window.location.href;
    let searchIndex = url.split('/');
    let index = searchIndex.length-1;
    let albumId = searchIndex.splice(index, 1, link);

    //create track link
    let audio = new Audio(
        '../storage/albums/titres/' + albumId + '/' + link + '.mp3'
    );

    console.dir(audio);

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
    let newTrack = Array.prototype.indexOf.call(tracks, link)+1;
    console.log(newTrack);
    //prev track
    const prev = audioPlayer.querySelector('.prev');
    prev.addEventListener("click", e => {
        let track = tracks[newTrack].textContent;
        if(newTrack == 0) {
            track = tracks[tracks.length].textContent;
            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
            currentSong.innerText = track;
            playBtn.classList.remove("play");
            playBtn.classList.add("pause");
            audio.play();
            newTrack = tracks.length;
        }
        else {
            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
            currentSong.innerText = track;
            playBtn.classList.remove("play");
            playBtn.classList.add("pause");
            audio.play();
            newTrack--;
        }
    }, false);

    //next track
    const next = audioPlayer.querySelector('.next');
    next.addEventListener("click", e => {
        let track = tracks[newTrack].textContent;
        if(newTrack == tracks.length - 1) {
            track = tracks[0].textContent;
            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
            currentSong.innerText = track;
            playBtn.classList.remove("play");
            playBtn.classList.add("pause");
            audio.play();
            newTrack = 0;
        }
        else {
            audio.setAttribute('src', '../storage/albums/titres/' + albumId + '/' + track.replace('%20', ' ') + '.mp3');
            currentSong.innerText = track;
            playBtn.classList.remove("play");
            playBtn.classList.add("pause");
            audio.play();
            newTrack++;
        }
    }, false);

    //click on timeline to skip around
    const timeline = audioPlayer.querySelector(".timeline");
    timeline.addEventListener("click", e => {
        const timelineWidth = window.getComputedStyle(timeline).width;
        const timeToSeek = e.offsetX / parseInt(timelineWidth) * audio.duration;
        audio.currentTime = timeToSeek;
    }, false);

    //click volume slider to change volume
    const volumeSlider = audioPlayer.querySelector(".controls .volume-slider");
    volumeSlider.addEventListener('click', e => {
        const sliderWidth = window.getComputedStyle(volumeSlider).width;
        const newVolume = e.offsetX / parseInt(sliderWidth);
        audio.volume = newVolume;
        audioPlayer.querySelector(".controls .volume-percentage").style.width = newVolume * 100 + '%';
    }, false)

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

    audioPlayer.querySelector(".volume-button").addEventListener("click", () => {
        const volumeEl = audioPlayer.querySelector(".volume-container .volume");
        audio.muted = !audio.muted;
        if (audio.muted) {
            volumeEl.classList.remove("icono-volumeMedium");
            volumeEl.classList.add("icono-volumeMute");
        } else {
            volumeEl.classList.add("icono-volumeMedium");
            volumeEl.classList.remove("icono-volumeMute");
        }
    });

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
