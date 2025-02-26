<?php
session_start();
?>

<style>
#movieResults {
    position: absolute; /* Biar tampil di atas elemen lain */
    width: auto; /* Sejajar dengan input */
    background: white;
    border: 1px solid #ddd;
    border-top: none;
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 200px;
    overflow-y: auto;
    z-index: 9999; /* Pastikan ini cukup tinggi */
  
}

/* Hover effect */
#movieResults li:hover {
    background: #444;
}


/* Styling untuk setiap hasil pencarian */
#movieResults li {
    padding: 10px;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    color: #444;
}

/* Hover effect */
#movieResults li:hover {
    background: #f1f1f1;
}
</style>
<header>
    <div class="logo">
        <img src="assets/img/logo_incinema.png" alt="Logo">
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="upcoming.php">Upcoming</a></li>
            <li><a href="teater.php">Teater</a></li>
            <li class="dropdown">
                <a href="#">Usia &#9660;</a>
                <div class="dropdown-content">
                    <a href="usia.php?usia=13">13</a>
                    <a href="usia.php?usia=17">17</a>
                    <a href="usia.php?usia=SU">SU</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="#">Genre &#9660;</a>
                <div class="dropdown-content">
                    <a href="genre.php?genre=Action">Action</a>
                    <a href="genre.php?genre=Adventure">Adventure</a>
                    <a href="genre.php?genre=Animation">Animation</a>
                    <a href="genre.php?genre=Biography">Biography</a>
                    <a href="genre.php?genre=Cartoon">Cartoon</a>
                    <a href="genre.php?genre=Comedy">Comedy</a>
                    <a href="genre.php?genre=Crime">Crime</a>
                    <a href="genre.php?genre=Disaster">Disaster</a>
                    <a href="genre.php?genre=Documentary">Documentary</a>
                    <a href="genre.php?genre=Drama">Drama</a>
                    <a href="genre.php?genre=Epic">Epic</a>
                    <a href="genre.php?genre=Erotic">Erotic</a>
                    <a href="genre.php?genre=Experimental">Experimental</a>
                    <a href="genre.php?genre=Family">Family</a>
                    <a href="genre.php?genre=Fantasy">Fantasy</a>
                    <a href="genre.php?genre=Film-Noir">Film-Noir</a>
                    <a href="genre.php?genre=History">History</a>
                    <a href="genre.php?genre=Horror">Horror</a>
                    <a href="genre.php?genre=Martial Arts">Martial Arts</a>
                    <a href="genre.php?genre=Music">Music</a>
                    <a href="genre.php?genre=Musical">Musical</a>
                    <a href="genre.php?genre=Mystery">Mystery</a>
                    <a href="genre.php?genre=Political">Political</a>
                    <a href="genre.php?genre=Psychological">Psychological</a>
                    <a href="genre.php?genre=Romance">Romance</a>
                    <a href="genre.php?genre=Sci-Fi">Sci-Fi</a>
                    <a href="genre.php?genre=Sport">Sport</a>
                    <a href="genre.php?genre=Superhero">Superhero</a>
                    <a href="genre.php?genre=Survival">Survival</a>
                    <a href="genre.php?genre=Thriller">Thriller</a>
                    <a href="genre.php?genre=War">War</a>
                    <a href="genre.php?genre=Western">Western</a>

                </div>
            </li>
        </ul>
    </nav>

    <div class="search-login">
        <div class="relative w-64">
            <i class="fas fa-search absolute left-3 top-1/2 transform - translate-y-1/2 text-gray-500"></i>

            <input type="text" placeholder="Search..." id="searchMovie">

            <ul id="movieResults" class="absolute bg-white border border-gray-300 rounded-md w-full mt-1 shadow-md hidden overflow-y-auto max-h-52 z-50"></ul>
        </div>
        <nav>
            <ul>
                <li class="dropdown">
                    <?php if (isset($_SESSION['name'])): ?>
                        <button class="login-btn"><?php echo $_SESSION['name']; ?> &#9660;</button>
                        <div class="dropdown-content">
                            <a href="logout.php">Logout</a>
                            <a class="dropdown-item" href="riwayat.php?username=<?php echo $_SESSION['email']; ?>">Riwayat Transaksi</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="login-btn">Login/Register</a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</header>

<script>
    const searchInput = document.getElementById("searchMovie");
    const resultsList = document.getElementById("movieResults");

    searchInput.addEventListener("input", function() {
        const query = this.value.trim();
        resultsList.innerHTML = "";

        if (query.length > 0) {
            fetch(`get_movies.php?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsList.classList.toggle("hidden", data.length === 0);
                    resultsList.innerHTML = ""; // Hapus hasil lama
                    data.forEach(movie => {
                        const li = document.createElement("li");
                        li.textContent = movie.nama_film;
                        li.className = "p-2 hover:bg-blue-100 cursor-pointer transition - all duration - 200 ";
                        // Ketika diklik, redirect ke film.php?id=...
                        li.onclick = () => {
                            window.location.href = `lihat_film.php?id=${movie.id}`;
                        };
                        resultsList.appendChild(li);
                    });
                })
                .catch(error => console.error("Error fetching data:", error));
        } else {
            resultsList.classList.add("hidden");
        }
    });
    document.addEventListener("click", function(e) {
        if (!searchInput.contains(e.target) && !resultsList.contains(e.target)) {
            resultsList.classList.add("hidden");
        }
    });
</script>