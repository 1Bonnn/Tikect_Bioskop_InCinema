<?php
include 'koneksi.php';

$tanggal_hari_ini = date ('Y-m-d');

$sql = "SELECT f.id, f.nama_film, f.banner, f.usia, f.poster, MIN(j.tanggal_tayang) AS tanggal_tayang 
FROM film f
INNER JOIN jadwal_film j ON f.id = j.film_id
WHERE j.tanggal_tayang > ?
GROUP BY f.id, f.nama_film, f.banner, f.usia, f.poster
ORDER BY tanggal_tayang ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $tanggal_hari_ini);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>InCinema - Coming Soon</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Container utama untuk header dan slider -->
    <div class="main-container">
        <!-- Header -->
        <?php include 'assets/template/header.php' ?>

        <!-- Coming Soon Section -->
        <div class="coming-soon-container">
                <h1 class="h1-style">Coming Soon</h1>
                <p class="uhuy">Film-film yang akan datang segera hadir di layar bioskop!</p>
                
                <div class="poster-container">
                <?php
                include 'koneksi.php'; // Menghubungkan ke database

                // Query untuk mengambil film yang akan tayang dalam waktu dekat
                
                // Memulai output HTML
                ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                            <div class="poster">
                            <img src="<?php echo $row['poster']; ?>" alt="Poster Film">
                        <a href="lihat_film.php?id=<?php echo $row['id']; ?>" class="film-button">Lihat Film</a>

                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <!-- Footer Section -->
        <?php include 'assets/template/foooter.php' ?>

    </div>

    <!-- JavaScript untuk modal -->
    <script src="assets/js/button.js"></script>
</body>
</html>
