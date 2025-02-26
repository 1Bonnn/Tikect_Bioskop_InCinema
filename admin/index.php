<?php
session_start();
//koneksi database
$conn = new mysqli("localhost", "root", "", "db_bioskop");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Query untuk mendapatkan data pengguna berdasarkan email
    $stmt = $conn->prepare("SELECT name, password FROM admin WHERE email =
?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($name, $hashed_password);
        $stmt->fetch();
        // Verifikasi password
        if (password_verify($password, $hashed_password)) {
            // Login berhasil, simpan informasi pengguna di session
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name; // Simpan nama pengguna di session
            header("Location: dashboard.php"); // Ganti dengan halaman yang sesuai setelah login
            exit();
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Email tidak terdaftar.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>Login Admin - InCinema</title>
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
            background: linear-gradient(135deg, rgb(7, 11, 241),rgb(80, 81, 136));
            overflow: hidden;
            position: relative;
        }
        .container {
            display: flex;
            width: 850px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 5px 20px white;
            position: relative;
            z-index: 2;
        }
        
        .left {
            width: 40%;
            background: blue;
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
        
        .right {
            width: 60%;
            padding: 50px;
            position: relative;
            z-index: 2;
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
            padding-left: 45px;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .login-btn {
            width: 100%;
            background: blue;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-btn:hover {
            background: gray;
        }
        .forgot-password {
            text-align: right;
            font-size: 14px;
            color: blue;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Welcome Back!</h2>
            <p>Satu langkah lagi menuju kesuksesan, login sekarang!</p>
        </div>
        <div class="right">
            <h2>Login Admin</h2>
            <form method="POST" action="index.php">
                <div class="input-group">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <i class="fa fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="forgot-password">
                    <a href="index.php">Forgot Password?</a>
                </div>
                <button type="submit" name="login" class="login-btn">Sign In</button>
                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script src="assets/js/login.js"></script>
</body>
</html>
