let currentIndex = 0;
const slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function moveToNextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides; // Loop ke slide pertama setelah yang terakhir
    updateSlidePosition();
}

function updateSlidePosition() {
    const newTransformValue = -currentIndex * 100; // Pindahkan slider berdasarkan index
    document.querySelector('.slider').style.transform = `translateX(${newTransformValue}%)`;
}

// Pindah ke slide berikutnya setiap 3 detik
setInterval(moveToNextSlide, 3000);

