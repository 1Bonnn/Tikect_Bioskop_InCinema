<?php
require 'koneksi.php';
$seatNumber = $_POST['seat_number'];

$query = "UPDATE seats SET status ='occupied' WHERE seat_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $seatNumber);
$stmt->execute();

echo json_encode(["status" => "success"]);
?>