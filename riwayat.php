<?php 

include 'koneksi.php';

$username = isset($_GET['username']) ? $_GET['username'] : ''; // Query untuk mengambil data transaksi berdasarkan username 
$sql = "SELECT * FROM transactions WHERE username = ?"; 
$stmt = $conn->prepare($sql); 
$stmt->bind_param("s", $username); // Pastikan tipe parameter sesuai dengan jenis data (string untuk username) 
$stmt->execute(); 
$result = $stmt->get_result(); 

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
<?php include 'assets/template/header.php'?>
<body>
    <br>
    <h1>Riwayat Transaksi</h1>
    <br>
 <div class="table table-responsive">
    <table id="transactionTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Email</th>
                <th>Nama Film</th>
                <th>Nomer Kursi</th>
                <th>Tanggal Pembayaran</th>
                <th>Jenis Pembayaran</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody> <?php $no = 1; // Nomor urut untuk tabel 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr> <td>{$no}</td> 
            <td>{$row['order_id']}</td> 
            <td>{$row['username']}</td> 
            <td>{$row['nama_film']}</td> 
            <td>{$row['seat_number']}</td> 
            <td>{$row['transaction_time']}</td> 
            <td>{$row['payment_type']}</td>
            <td>Rp.{$row['amount']}</td> <td>"; // Menggunakan if untuk mengecek status 
            if ($row['status'] == 'settlement') { 
                echo 'Selesai'; 
            } elseif ($row['status'] == 'pending') { 
                    echo 'Menunggu Pembayaran'; 
                } else { 
                        echo $row['status']; // Jika status selain 'settlement' atau 'Pending' 
                        } echo "</td> </tr>"; $no++; } ?> 
                        </tbody> 
                    </table> 
                </div>
                <br>
                <?php include 'assets/template/foooter.php'?>
                </body>
</html>
