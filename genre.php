<?php
include 'koneksi.php';

$genre = isset($_GET['genre']) ? $_GET['genre'] :'';

if (!empty($genre)) {
    $sql = "SELECT * FROM film WHERE genre LIKE '%$genre%' ORDER BY id ASC";
}else {
    $sql = "SELECT * FROM film ORDER BY id ASC";
}

$result = $conn -> query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>InCinema</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Container utama untuk header dan slider -->
    <div class="main-container">
        <!-- Header -->
        <?php include 'assets/template/header.php' ?>

        <!-- Slider Iklan -->
        
            <!-- Foto Poster Film di bawah Slider -->
            <br>

            <h1 class="h1-style">Sedang Tayang</h1>
            <p class="uhuy">Film-film yang Sedang Tayang!</p>
            <div class="poster-container">
                <?php
                include 'koneksi.php'; // Menghubungkan ke database

                // Query untuk mengambil film yang akan tayang dalam waktu dekat
                
                // Memulai output HTML
                ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="poster">
                        <img src="<?php echo $row['poster']; ?>" alt="Poster Film 1">
                        <a href="lihat_film.php?id=<?php echo $row['id']; ?>" class="film-button">Lihat Film</a>

                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <!-- Footer Section -->
        <?php include 'assets/template/foooter.php' ?>

    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/button.js"></script>
</body>

</html>