<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>Akun Mall - InCinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        #manual-input {
            margin-top: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 250px;
            font-size: 16px;
        }

        button {
            padding: 10px 15px;
            font-size: 16px;
            margin-left: 5px;
        }
    </style>

<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-6 h-screen fixed left-0 top-0 flex-shrink-0 overflow-y-auto">
            <h1 class="text-2xl font-bold mb-6">Admin InCinema</h1>
            <nav>
                <ul>
                    <li class="mb-4 border-b border-gray-400 pb-2">
                        <a href="dashboard.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_admin.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-user mr-2"></i> Akun Admin
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_mall.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-store mr-2"></i> Akun Mall
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="jadwal_film.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i> Jadwal Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="data_film.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-film mr-2"></i> Data Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="history_pembelian.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-history mr-2"></i> History Pembelian
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="scan.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-history mr-2"></i> Scan Ticket
                        </a>
                    </li>
                    <li class="mb-4 mt-6 border-t border-gray-400 pt-2">
                        <a href="index.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
<main class="flex-1 p-6 ml-64">
    <script src="https://unpkg.com/html5-qrcode"></script>
    <h2 style="text-align: center;">Scan Ticket</h2>
    <!-- QR Reader -->
    <div id="reader" style="width: 100%; max-width: 500px; margin: 0
auto;"></div>
    <!-- Manual Input -->
    <div id="manual-input">
        <p>Atau masukkan Order ID secara manual:</p>
        <input type="text" id="manualOrderId" placeholder="Masukkan Order ID">
        <button onclick="goToPrint()">Cari Tiket</button>
    </div>
    </main>
    <script>
        // Start QR scan on page load
        window.onload = function() {
            const html5QrCode = new Html5Qrcode("reader");
            const qrCodeSuccessCallback = (decodedText, decodedResult) => {
                html5QrCode.stop().then(() => {
                    window.location.href =
                        `print.php?order_id=${encodeURIComponent(decodedText)}`;
                }).catch(err => console.log("Stop failed", err));
            };
            const config = {
                fps: 10,
                qrbox: 250
            };
            html5QrCode.start({
                    facingMode: "environment"
                },
                config,
                qrCodeSuccessCallback
            ).catch(err => {
                console.error("Camera start error", err);
            });
        };
        // Manual input function
        function goToPrint() {
            const orderId = document.getElementById("manualOrderId").value.trim();
            if (orderId !== "") {
                window.location.href =
                    `print.php?order_id=${encodeURIComponent(orderId)}`;
            } else {
                alert("Masukkan Order ID terlebih dahulu.");
            }
        }
        // Trigger enter key in input
        document.getElementById("manualOrderId").addEventListener("keydown",
            function(e) {
                if (e.key === "Enter") {
                    goToPrint();
                }
            });
    </script>
</body>

</html>