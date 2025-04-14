<?php
require 'vendor/autoload.php'; // Pastikan path benar
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$alert_message = "";
$alert_type = "";
if (isset($_POST['send_otp'])) {
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    $conn = new mysqli("localhost", "root", "", "db_bioskop");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_sent_time'] = time();
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'iqbalyasir234567@gmail.com';
            $mail->Password = 'ftcw ufpm dqty foeb'; // Gunakan App Password jika 2FA aktif
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Untuk port 465
            $mail->Port = 465; // Port untuk SSL
            $mail->setFrom('iqbalyasir234567@gmail.com', 'incinema');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'OTP Reset Password';
            $mail->Body = "Kode OTP Anda: <b>$otp</b>. Berlaku selama 15
menit.";
            $mail->send();
            $alert_message = "Kode OTP telah dikirim ke email Anda.";
            $alert_type = "success";
        } catch (Exception $e) {
            $alert_message = "Gagal mengirim email: {$mail->ErrorInfo}";
            $alert_type = "error";
        }
    } else {
        $alert_message = "Email tidak ditemukan.";
        $alert_type = "error";
    }
}
if (isset($_POST['verify_otp'])) {
    $otp_input = $_POST['otp'];
    if ($otp_input == $_SESSION['otp'] && (time() - $_SESSION['otp_sent_time']
        < 900)) {
        $_SESSION['otp_verified'] = true;
    } else {
        $alert_message = "OTP salah atau kadaluarsa.";
        $alert_type = "error";
    }
}
if (isset($_POST['reset_password']) && isset($_SESSION['otp_verified'])) {
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $email = $_SESSION['email'];
    $conn = new mysqli("localhost", "root", "", "db_bioskop");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute()) {
        $alert_message = "Password berhasil direset.";
        $alert_type = "success";
        session_destroy();
    } else {
        $alert_message = "Gagal mereset password.";
        $alert_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>Reset Password - InCinema</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(120deg, #1e1e2f, #3c3c5f);
            overflow: hidden;
        }

        .container {
            display: flex;
            width: 900px;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .left {
            width: 40%;
            background: linear-gradient(135deg, #1e1e2f, #3c3c5f);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }

        .left h2 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 15px;
            margin-bottom: 25px;
        }

        .left button {
            background-color: #f4bf3a;
            color: #1e1e2f;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .left button:hover {
            background-color: #fff;
            color: #1e1e2f;
        }

        .right {
            width: 60%;
            padding: 50px;
            background: #f9f9f9;
        }

        .right h2 {
            font-size: 26px;
            color: #1e1e2f;
            margin-bottom: 30px;
        }

        .mb-3 {
            margin-bottom: 25px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fff;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #f4bf3a;
            outline: none;
        }

        .btn {
            width: 100%;
            background-color: #f4bf3a;
            color: #1e1e2f;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #1e1e2f;
            color: #fff;
        }

        .btn-success {
            background-color: #28a745 !important;
            color: white;
        }

        .btn-primary {
            background-color: #007bff !important;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            color: white;
        }

        .btn-danger:hover {
            background-color: #b52a38 !important;
        }

        .mt-3 {
            margin-top: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h2>Welcome!</h2>
            <p>Sudah punya akun?</p>
            <button onclick="window.location.href='login.php'">Login</button>
        </div>
        <div class="right">
            <h2>Reset Password</h2>
            <?php if (!isset($_SESSION['otp']) && !isset($_SESSION['otp_verified'])): ?>
                <form method="POST" id="emailForm">
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukan Email Anda" required>
                    </div>
                    <button type="submit" name="send_otp" class="btn btn-primary">Kirim OTP</button>
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['otp']) && !isset($_SESSION['otp_verified'])): ?>
                <form method="POST" class="mt-3" id="otpForm">
                    <div class="mb-3">
                        <label class="form-label">Masukkan OTP:</label>
                        <input type="text" class="form-control" name="otp" required>
                    </div>
                    <button type="submit" name="verify_otp" class="btn btn-success">Verifikasi OTP</button>
                </form>
            <?php endif; ?>

            <?php if (isset($_SESSION['otp_verified'])): ?>
                <form method="POST" class="mt-3" id="passwordForm">
                    <div class="mb-3">
                        <label class="form-label">Password Baru:</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>
                    <button type="submit" name="reset_password" class="btn btn-danger">Reset Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if (!empty($alert_message)): ?>
            Swal.fire({
                title: "<?= $alert_type == 'success' ? 'Berhasil' : 'Gagal' ?>",
                text: "<?= $alert_message ?>",
                icon: "<?= $alert_type ?>",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = 'forget.php';
            });
        <?php endif; ?>
    </script>
</body>

</html>
