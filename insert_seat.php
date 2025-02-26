<?php
require 'koneksi.php';

$seat_numbers = explode(",", $_POST['seat_number'] ?? "");
$mall_name = $_POST['mall_name'] ?? null;
$film_name = $_POST['film_name'] ?? null;

if(empty($seat_numbers) || !$mall_name || !$film_name) {
    echo json_encode(["error" => "Data tidak lengkap"]);
    exit;
}

$success = true;
foreach ($seat_numbers as $seat_number) {
    $stmtCheck = $conn->prepare("SELECT id FROM seats WHERE seat_number = ? AND mall_name = ? AND film_name = ?");
    $stmtCheck->bind_param("sss", $seat_number, $mall_name, $film_name);

    if (!$stmtCheck->execute()) {
        $success = false;
        break;
    }
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        $success = false;
        break;
    }

    $stmtInsert = $conn->prepare("INSERT INTO seats (seat_number, mall_name, film_name, status)VALUES (?, ?, ?, 'occupied')");
    $stmtInsert->bind_param("sss", $seat_number, $mall_name, $film_name);

    if(!$stmtInsert->execute()) {
        $success = false;
        break;
    }
}

echo json_encode(["success" => $success]);
