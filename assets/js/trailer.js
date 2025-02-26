function showTrailer() {
    const modal = document.getElementById('trailerModal');
    const video = document.getElementById('trailerVideo');
    modal.style.display = 'flex';
    video.play();
    video.onended = function() {
        closeTrailer();
    };
}
function closeTrailer() {
    const modal = document.getElementById('trailerModal');
    const video = document.getElementById('trailerVideo');
    modal.style.display = 'none';
    video.pause();
    video.currentTime = 0;
}
