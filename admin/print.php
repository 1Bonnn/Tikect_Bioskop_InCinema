<?php
include "../koneksi.php";
if (!isset($_GET['order_id'])) {
    echo "Order ID tidak ditemukan.";
    exit;
}
$order_id = $conn->real_escape_string($_GET['order_id']);
$sql = "SELECT * FROM transactions WHERE order_id = '$order_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan untuk Order ID: $order_id";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .ticket {
            border: 1px solid #ccc;
            padding: 20px;
            max-width: 400px;
        }

        .ticket h2 {
            margin-top: 0;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div style="font-family: 'Arial', sans-serif; max-width: 300px; margin: 15px
auto; background-color: #fff; border: 1px solid #ccc; border-radius: 6px;
overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.06);">
        <!-- Header -->
        <div style="background-color: #2c3e50; color: #fff; padding: 10px 16px;
text-align: center;">
            <h2 style="margin: 0; font-size: 18px;">🎟️ CineTix Ticket</h2>
            <p style="margin: 2px 0; font-size: 12px;">Tunjukkan e-ticket ini saat
                masuk ke bioskop</p>
        </div>
        <!-- Dashed Divider -->
        <div style="border-top: 1px dashed #ccc;"></div>
        <!-- Ticket Content -->
        <div style="padding: 10px 16px; font-size: 13px; line-height: 1.4;">
            <!-- Film & Seat - Side by Side -->
            <div style="display: flex; justify-content: space-between; marginbottom: 8px;">
                <div style="width: 70%;"><strong>Nama Film:</strong><br><?=
                                                                        htmlspecialchars($data['nama_film']) ?></div>
                <div style="width: 28%; text-align:
right;"><strong>Kursi:</strong><br><?= htmlspecialchars($data['seat_number'])
                                    ?></div>
            </div>
            <div style="display: flex; justify-content: space-between; marginbottom: 8px;">
                <div style="width: 70%;"><strong>Order ID:</strong><br><?=
                                                                        htmlspecialchars($data['order_id']) ?></div>
                <div style="width: 28%; text-align:
right;"><strong>Total:</strong><br>
                    <span style="font-size: 14px; font-weight: bold;">Rp <?=
                                                                            number_format($data['amount'], 0, ',', '.') ?></span>
                </div>
            </div>
            <p style="margin: 6px 0;"><strong>Status:</strong><br>
                <?php
                if ($data['status'] == 'settlement') {
                    echo '<span style="background-color: green; color: white;
padding: 2px 8px; border-radius: 3px; font-size: 12px;">Selesai</span>';
                } elseif ($data['status'] == 'pending') {
                    echo '<span style="background-color: orange; color: black;
padding: 2px 8px; border-radius: 3px; font-size: 12px;">Menunggu</span>';
                } else {
                    echo '<span style="background-color: red; color: white;
padding: 2px 8px; border-radius: 3px; font-size: 12px;">' .
                        htmlspecialchars($data['status']) . '</span>';
                }
                ?>
            </p>
        </div>
    </div>
    <button onclick="window.location.href='index.php'">Kembali</button>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>