<?php
// Menyertakan autoloader Composer
require 'vendor/autoload.php'; // Pastikan pathnya sesuai dengan struktur project Anda
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
// Inisialisasi variabel untuk menyimpan input
$name = '';
$email = '';
$password = '';
if (isset($_POST['send_otp'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Simpan password di session
    $_SESSION['password'] = $password;
    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;
    $_SESSION['otp_sent_time'] = time(); // Store the time OTP was sent
    // Kirim email OTP
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
        $mail->Subject = 'OTP Verifikasi Akun';
        $mail->Body = "Hai $name, <br> Berikut adalah kode OTP Anda:
<b>$otp</b>.<br>Kode ini berlaku selama 15 menit.";
        $mail->send();
        $otp_sent = true; // Set flag untuk menampilkan SweetAlert
    } catch (Exception $e) {
        echo "Gagal mengirim email: {$mail->ErrorInfo}";
    }
}
if (isset($_POST['verify_otp'])) {
    $otp_input = $_POST['otp'];
    // Check if OTP is valid and not expired (15 minutes)
    if ($otp_input == $_SESSION['otp'] && (time() - $_SESSION['otp_sent_time'] <
        900)) {
        // OTP valid, simpan data pengguna ke database
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT); //Hash password
        // Koneksi ke database dan insert data pengguna
        $conn = new mysqli("localhost", "root", "", "db_bioskop");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Use prepared statement
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES
(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            $registration_success = true; // Set flag untuk menampilkan SweetAlert
            // Hapus session setelah verifikasi
            unset($_SESSION['otp']);
            unset($_SESSION['otp_sent_time']);
            unset($_SESSION['password']); // Hapus password dari session
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "OTP salah atau kadaluarsa.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>Register - InCinema</title>
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
            background: linear-gradient(135deg, #f4bf3a, #444);
            overflow: hidden;
        }
        .container {
            display: flex;
            width: 850px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .left {
            width: 40%;
            background: linear-gradient(135deg, #444,rgb(114, 114, 116));
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            text-align: center;
        }
        .left h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        .left p {
            margin-bottom: 20px;
            font-size: 16px;
        }
        .left button {
            background: #f4bf3a;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 18px;
            transition: 0.3s;
        }
        .left button:hover {
            background: black;
        }
        .right {
            width: 60%;
            padding: 50px;
            background: white;
        }
        .right h2 {
            margin-bottom: 25px;
            font-size: 26px;
        }
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }
        .register-btn {
            width: 100%;
            background: #f4bf3a;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .register-btn:hover {
            background: black;
        }
    </style>
   
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Welcome!</h2>
            <p>Already have an account?</p>
            <button onclick="window.location.href='login.php'">Login</button>
        </div>
        <div class="right">
            <h2>Register</h2>
            <form method="POST" action="register.php">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="send_otp" class="register-btn">Kirim OTP</button>
            </form>
            <?php if (isset($_SESSION['otp'])): ?>
                <br>
                <form method="POST" action="register.php">
                    <div class="input-group">
                        <input type="text" name="otp" placeholder="Masukan OTP" required>
                    </div>
                    <button type="submit" name="verify_otp" class="register-btn">Verifikasi OTP</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <script>
             // Menampilkan SweetAlert setelah mengirim OTP
             <?php if (isset($otp_sent) && $otp_sent): ?>
            Swal.fire({
                title: 'OTP Terkirim!',
                text: 'Kode OTP telah dikirim ke email Anda.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
        // // Menampilkan SweetAlert setelah pendaftaran berhasil
        <?php if (isset($registration_success) && $registration_success): ?>
            Swal.fire({
                title: 'Pendaftaran Berhasil!',
                text: 'Anda telah berhasil mendaftar. Silakan masuk.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                // // Mengarahkan pengguna ke register.php setelah menekan OK
                window.location.href = 'login.php'; // Ganti dengan path yang sesuai
            });
        <?php endif; ?>
    </script>
</body>
</html>
