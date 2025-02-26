<?php
session_start();

include '../koneksi.php'; // Pastikan file config.php berisi koneksi ke database

// Ambil jumlah film dari database
$queryFilm = "SELECT COUNT(*) AS total_film FROM film";
$resultFilm = mysqli_query($conn, $queryFilm);
$rowFilm = mysqli_fetch_assoc($resultFilm);
$totalFilm = $rowFilm['total_film'];

// Ambil jumlah pengguna dari database
$queryUser = "SELECT COUNT(*) AS total_user FROM users";
$resultUser = mysqli_query($conn, $queryUser);
$rowUser = mysqli_fetch_assoc($resultUser);
$totalUser = $rowUser['total_user'];

// Ambil jumlah transaksi dari database
$queryTransaksi = "SELECT COUNT(*) AS total_transaksi FROM transactions";
$resultTransaksi = mysqli_query($conn, $queryTransaksi);
$rowTransaksi = mysqli_fetch_assoc($resultTransaksi);
$totalTransaksi = $rowTransaksi['total_transaksi'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>Admin Dashboard - InCinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-blue-900 text-white p-6 h-screen">
            <h1 class="text-2xl font-bold mb-6">Admin InCinema</h1>
            <nav>
                <ul>
                    <li class="mb-4 border-b border-gray-400 pb-2">
                        <a href="dashboard.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_admin.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-user"></i> Akun Admin
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="akun_mall.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-store"></i> Akun Mall
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="jadwal_film.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-calendar-alt"></i> Jadwal Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="data_film.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-film"></i> Data Film
                        </a>
                    </li>
                    <li class="mb-4">
                        <a href="history_pembelian.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-history"></i> History Pembelian
                        </a>
                    </li>
                    <li class="mb-4 mt-6 border-t border-gray-400 pt-2">
                        <a href="index.php" class="flex items-center gap-2 hover:text-gray-300">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Header dengan Tanggal & Profil -->
            <div class="flex justify-between items-center mb-4">
                <div class="text-left text-gray-600 text-2xl font-semibold" id="tanggal"></div>
                <div class="relative">
                    <?php if(isset($_SESSION['name'])): ?>
                        <button id="profileButton" class="flex items-center bg-white p-2 rounded shadow">
                            <span class="font-semibold fas fa-user mr-2">Admin</span>
                            <?php echo $_SESSION['name']; ?><i class="fas fa-caret-down ml-2"></i>
                        </button>
                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-md rounded">
                            <a href="#" class="block px-4 py-2 hover:bg-gray-200"><?php echo $_SESSION['name']; ?></a>
                            <a href="index.php" class="block px-4 py-2 text-red-600 hover:bg-gray-200">Keluar</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <header class="bg-white p-4 rounded shadow mb-6">
                <h2 class="text-xl font-semibold">Dashboard</h2>
            </header>

            <!-- Statistik dalam Bentuk Card -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Jumlah Film -->
                <div class="bg-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-600">Total Film</h3>
                        <p class="text-3xl font-bold text-blue-600"><?php echo $totalFilm; ?></p>
                    </div>
                    <i class="fas fa-film text-blue-600 text-4xl"></i>
                </div>

                <!-- Jumlah Pengguna -->
                <div class="bg-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-600">Total Pengguna</h3>
                        <p class="text-3xl font-bold text-green-600"><?php echo $totalUser; ?></p>
                    </div>
                    <i class="fas fa-users text-green-600 text-4xl"></i>
                </div>

                <!-- Total Transaksi -->
                <div class="bg-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-600">Total Transaksi</h3>
                        <p class="text-3xl font-bold text-red-600"><?php echo $totalTransaksi; ?></p>
                    </div>
                    <i class="fas fa-shopping-cart text-red-600 text-4xl"></i>
                </div>
            </section>
        </main>
    </div>

    <script>
        function updateTanggal() {
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const today = new Date().toLocaleDateString('id-ID', options);
            document.getElementById('tanggal').textContent = today;
        }
        updateTanggal();

    document.addEventListener("DOMContentLoaded", function () {
        const profileButton = document.getElementById("profileButton");
        const dropdownMenu = document.getElementById("dropdownMenu");

        profileButton.addEventListener("click", function (event) {
            dropdownMenu.classList.toggle("hidden");
            event.stopPropagation(); // Mencegah event klik menyebar ke document
        });

        document.addEventListener("click", function (event) {
            if (!profileButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    });

    </script>
</body>

</html>
