document.addEventListener('DOMContentLoaded', () => {
    let videos = document.querySelectorAll('#mainVideo video');
    let index = 0;

    function playNextVideo() {
        if (index < videos.length) {
            videos[index].addEventListener('ended', playNextVideo);
            videos[index].play();
            index++;
        }
    }

    playNextVideo();
});
