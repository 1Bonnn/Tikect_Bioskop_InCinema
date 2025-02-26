<?php
require 'vendor/autoload.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-d_RhpuuSD2DhmjdtSt0tsu5z';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$mallName = $_POST['mall_name'];
$showtime = $_POST['showtime'];
$ticketCount = $_POST['ticket_count'];
$totalPrice = $_POST['total_price'];
$username = $_POST['username'];

$orderId = "TIX" . time();

$transaction = [
    'transaction_details' => [
        'order_id' => $orderId,
        'gross_amount' => $totalPrice,
    ],
    'customer_details' => [
        'first_name' => "Customer",
        'email' => $username,
    ]
    ];
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);

    echo json_encode(['snap_token' => $snapToken, 'order_id' => $orderId]);

