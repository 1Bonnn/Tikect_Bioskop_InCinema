document.querySelector(".left button").addEventListener("click", function() {
    document.querySelector(".container").classList.add("active");

    // Menghapus efek setelah animasi selesai
    setTimeout(() => {
        document.querySelector(".container").classList.remove("active");
    }, 500);
});
