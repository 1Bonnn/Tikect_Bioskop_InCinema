<?php
require 'koneksi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$orderId = $_POST['order_id'];
$transactionStatus = $_POST['transaction_status'];
$paymentType = $_POST['payment_type'];
$grossAmount = $_POST['gross_amount'];
$transactionTime = $_POST['transaction_time'];
$username = $_POST['username'];
$seatNumbers = $_POST['seat_number'];
$email = $_POST['username'];
$nama_film = $_POST['film_name'];

// Simpan transaksi ke database
$query1 = "INSERT INTO transactions (order_id, status, payment_type, amount, transaction_time, username, seat_number, nama_film) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt1 = $conn->prepare($query1);
$stmt1->bind_param("ssssssss", $orderId, $transactionStatus, $paymentType, $grossAmount, $transactionTime, $username, $seatNumbers, $nama_film);

if (!$stmt1->execute()) {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan transaksi"]);
    exit;
}

// Update status kursi
$seatNumbersArray = explode(',', $seatNumbers);
$placeholders = implode(',', array_fill(0, count($seatNumbersArray), '?'));
$query2 = "UPDATE seats SET status = 'occupied' WHERE seat_number IN ($placeholders)";
$stmt2 = $conn->prepare($query2);
$stmt2->bind_param(str_repeat('s', count($seatNumbersArray)), ...$seatNumbersArray);
$stmt2->execute();

// Generate barcode
function generateBarcode($token) {
    $qrCode = new QrCode($token);
    $writer = new PngWriter();
    $directory = 'barcodes/';
    if (!is_dir($directory)) mkdir($directory, 0777, true);
    $filePath = $directory . $token . '.png';
    $result = $writer->write($qrCode);
    $result->saveToFile($filePath);
    return $filePath;
}

$barcodePath = generateBarcode($orderId);

// Kirim email
function sendEmailWithBarcode($email, $username, $seatNumbers, $orderId, $transactionTime, $paymentType, $grossAmount, $barcodePath, $nama_film) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'iqbalyasir234567@gmail.com';
        $mail->Password = 'ftcw ufpm dqty foeb';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        
        $mail->setFrom('iqbalyasir234567@gmail.com', 'InCinema');
        $mail->addAddress($email);
        $mail->addEmbeddedImage($barcodePath, 'barcode');
        
        $mail->isHTML(true);
        $mail->Subject = "E-Ticket InCinema Anda";
        $mail->Body = "
        <div style='font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4; text-align: center;'>
            <h2>CineTix - E-Ticket</h2>
            <p><strong>Nama Film:</strong> $nama_film</p>
            <p><strong>Nomor Kursi:</strong> $seatNumbers</p>
            <p><strong>Order ID:</strong> $orderId</p>
            <p><strong>Waktu Transaksi:</strong> $transactionTime</p>
            <p><strong>Metode Pembayaran:</strong> $paymentType</p>
            <p><strong>Total Bayar:</strong> Rp " . number_format($grossAmount, 0, ',', '.') . "</p>
            <p><img src='cid:barcode' style='width:200px; margin: 10px 0;'></p>
            <p>Harap tunjukkan e-ticket ini saat masuk ke bioskop.</p>
            <p style='font-size: 12px; color: gray;'>Terima kasih telah menggunakan InCinema 🎬🍿</p>
        </div>
        ";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

sendEmailWithBarcode($email, $username, $seatNumbers, $orderId, $transactionTime, $paymentType, $grossAmount, $barcodePath, $nama_film);

echo json_encode([
    "status" => "success",
    "message" => "Transaksi berhasil dan email telah dikirim ke $email"
]);
?>