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
        <div class="slider-container">
            <?php
            include 'koneksi.php'; // Menghubungkan ke database

            // Query untuk mengambil film yang akan tayang dalam waktu dekat
            $sql = "SELECT * FROM film ORDER BY id ASC";
            $result = $conn->query($sql);

            // Memulai output HTML
            ?>
            <div class="slider">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="slide">
                        <img src="<?php echo $row['banner']; ?>" alt="Iklan Film 1">
                    </div>
                <?php endwhile; ?>
            </div>


            <!-- Foto Poster Film di bawah Slider -->
            <br>

            <h1 class="h1-style">Sedang Tayang</h1>
            <p class="uhuy">Film-film yang Sedang Tayang!</p>

            <div class="poster-container">
                <?php
                include 'koneksi.php'; // Menghubungkan ke database 
                // Mengecek apakah koneksi berhasil 
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                // Query untuk mengambil 10 film teratas berdasarkan jumlah transaksi berdasarkan nama_film 
                $sql = " 
                    SELECT f.id, f.nama_film, f.poster, f.usia, COUNT(t.id) AS jumlah_transaksi 
                    FROM film f LEFT JOIN transactions t ON f.nama_film = t.nama_film 
                    GROUP BY f.id, f.nama_film, f.poster, f.usia 
                    ORDER BY jumlah_transaksi DESC LIMIT 10 
                    ";
                                $result = $conn->query($sql);
                if (!$result) { // Jika query gagal, tampilkan error 
                    die("Query failed: " . $conn->error);
                } // Mengecek apakah ada hasil dari query 
                if ($result->num_rows == 0) {
                    echo "Tidak ada data yang ditemukan.";
                } else
                    // Memulai output HTML 
                ?>
                <?php
                    $rank = 1;
                    while ($row = $result->fetch_assoc()): ?>
                            <div class="poster">
                        <img src="<?php echo $row['poster']; ?>" alt="Poster Film 1">
                        <a href="lihat_film.php?id=<?php echo $row['id']; ?>" class="film-button">Lihat Film</a>

                    </div>
                <?php endwhile ?>
            </div>
        </div>
        <!-- Footer Section -->
        <?php include 'assets/template/foooter.php' ?>

    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/button.js"></script>
</body>

</html>