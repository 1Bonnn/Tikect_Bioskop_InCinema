<?php
include 'koneksi.php';

$query = "SELECT * FROM akun_mall"; // Sesuaikan dengan nama tabel kamu
$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>InCinema - Teater</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Container utama untuk header dan slider -->
    <div class="main-container">
        <!-- Header -->
        <?php include 'assets/template/header.php'?>
        
        <h1 class="h1-style">Daftar Mall</h1>
        <p class="uhuy">Kami hadir di Mall-mall kesayangan anda</p>
        
        <!-- Container untuk tabel -->
        <div class="table-container">
        <table>
    <tr>
        <th>No</th>
        <th>Nama Mall</th>
    </tr>
    <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama_mall']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Data tidak ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

            <br>
        </div>

        <!-- Footer Section -->
        <?php include 'assets/template/foooter.php'?>
    </div>

    <script src="assets/js/script.js"></script>
    <script src="assets/js/button.js"></script>
</body>
</html>
