<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>Jadwal Film - InCinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
</head>

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
                    <li class="mb-4 mt-6 border-t border-gray-400 pt-2">
                        <a href="index.php" class="hover:text-gray-300 flex items-center">
                            <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 ml-64">
            <header class="bg-white p-4 rounded shadow mb-6 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Jadwal Film</h2>
                
            </header>

            <!-- Tabel Jadwal Film -->
            <section class="bg-white p-6 rounded shadow overflow-x-auto">
                <h3 class="text-lg font-semibold mb-4">Daftar Jadwal Film</h3>
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
                    <i class="fas fa-film mr-2"></i>Tambah Jadwal Film
                </button>
                <br>
                <br>
                <?php
                include '../koneksi.php'; // Menghubungkan ke database
                // Query untuk mengambil data film, nama mall, dan poster
                $sql = "SELECT
jadwal_film.id,
akun_mall.nama_mall,
film.nama_film,
film.poster,
jadwal_film.total_menit,
jadwal_film.tanggal_tayang,
jadwal_film.tanggal_akhir_tayang ,
jadwal_film.jam_tayang_1,
jadwal_film.jam_tayang_2,
jadwal_film.jam_tayang_3,
jadwal_film.studio
FROM jadwal_film
JOIN akun_mall ON jadwal_film.mall_id = akun_mall.id
JOIN film ON jadwal_film.film_id = film.id
ORDER BY akun_mall.nama_mall ASC, jadwal_film.id ASC";
                $result = $conn->query($sql);
                // Array untuk menyimpan data film berdasarkan mall
                $filmsByMall = [];
                // Memasukkan data film ke dalam array berdasarkan mall
                while ($row = $result->fetch_assoc()) {
                    $filmsByMall[$row['nama_mall']][] = $row;
                }
                ?>
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-blue-800 text-white">
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Mall</th>
                            <th class="border border-gray-300 px-4 py-2">Poster</th>
                            <th class="border border-gray-300 px-4 py-2">Film</th>
                            <th class="border border-gray-300 px-4 py-2">Total Menit</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal Tayang</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal Akhir Tayang</th>
                            <th class="border border-gray-300 px-4 py-2">Jam Tayang 1</th>
                            <th class="border border-gray-300 px-4 py-2">Jam Tayang 2</th>
                            <th class="border border-gray-300 px-4 py-2">Jam Tayang 3</th>
                            <th class="border border-gray-300 px-4 py-2">Studio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($filmsByMall as $mallName => $films) {
                            foreach ($films as $film) {
                                // Debugging: Menampilkan data film
                                // Konversi tanggal ke format DateTime
                                $expired_date = new DateTime($film['tanggal_akhir_tayang']);
                                $current_date = new DateTime();
                                // Debugging: Menampilkan tanggal akhir tayang & tanggal sekarang
                                // Cek apakah sudah kadaluarsa
                                $is_expired = $expired_date < $current_date;
                                echo "<tr " . ($is_expired ? "style='background-color: red
!important;'" : "") . ">
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$no}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['nama_mall']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " ><img src='../{$film['poster']}' alt='Poster'
width='100'></td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['nama_film']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['total_menit']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['tanggal_tayang']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['tanggal_akhir_tayang']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['jam_tayang_1']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['jam_tayang_2']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['jam_tayang_3']}</td>
<td " . ($is_expired ? "style='background-color: red
!important;'" : "") . " >{$film['studio']}</td>
</tr>";
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch mall data
            $.ajax({
                url: 'api.php?endpoint=mall',
                method: 'GET',
                success: function(data) {
                    data.forEach(function(mall) {
                        $('#namaMall').append(`<option
value="${mall.id}">${mall.nama_mall}</option>`);
                    });
                },
            });
            // Fetch film data
            $.ajax({
                url: 'api.php?endpoint=film',
                method: 'GET',
                success: function(data) {
                    data.forEach(function(film) {
                        $('#namaFilm').append(`<option
value="${film.id}">${film.nama_film}</option>`);
                    });
                },
            });
            // Handle film selection
            $('#namaFilm').change(function() {
                const filmId = $(this).val();
                if (filmId) {
                    $.ajax({
                        url: `api.php?endpoint=film_detail&id=${filmId}`,
                        method: 'GET',
                        success: function(film) {
                            $('#posterFilm').attr('src', `../${film.poster}`).show();
                            $('#totalMenit').val(film.total_menit);
                        },
                        error: function() {
                            $('#posterFilm').hide().attr('src', '');
                            $('#totalMenit').val('');
                        },
                    });
                } else {
                    $('#posterFilm').hide().attr('src', '');
                    $('#totalMenit').val('');
                }
            });
            // Handle form submission
            $('#formTambahJadwal').submit(function(e) {
                e.preventDefault();
                // Get form data
                const formData = $(this).serialize();
                // Send data to server
                $.ajax({
                    url: 'api.php?endpoint=tambah_jadwal',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Show SweetAlert2 on success
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Jadwal Film berhasil disimpan!',
                                icon: 'success',
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Redirect to jadwal.php
                                    window.location.href = 'jadwal_film.php';
                                }
                            });
                        } else {
                            // Show SweetAlert2 on failure
                            // Show SweetAlert2 on failure
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal menyimpan jadwal film.',
                                icon: 'error',
                                confirmButtonText: 'OK',
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Terjadi kesalahan!',
                            text: 'Tidak dapat menyimpan jadwal film.',
                            icon: 'error',
                            confirmButtonText: 'OK',
                        });
                    },
                });
            });
        });
    </script>
    <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal Film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" arialabel="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahJadwal">
                    <!-- Nama Mall -->
                    <div class="mb-3">
                        <label for="namaMall" class="form-label">Nama Mall</label>
                        <select class="form-select" id="namaMall" name="namaMall"
                            required>
                            <option value="">Pilih Mall</option>
                        </select>
                    </div>
                    <!-- Nama Film -->
                    <div class="mb-3">
                        <label for="namaFilm" class="form-label">Nama Film</label>
                        <select class="form-select" id="namaFilm" name="namaFilm"
                            required>
                            <option value="">Pilih Film</option>
                        </select>
                    </div>
                    <!-- Poster -->
                    <div class="mb-3">
                        <label for="posterFilm" class="form-label">Poster</label>
                        <img id="posterFilm" src="" alt="Poster Film" class="imgthumbnail" style="display: none; max-height: 200px;">
                    </div>
                    <!-- Total Menit -->
                    <div class="mb-3">
                        <label for="totalMenit" class="form-label">Total Menit</label>
                        <input type="text" class="form-control" id="totalMenit"
                            name="totalMenit" readonly>
                    </div>
                    <!-- Tanggal Tayang -->
                    <div class="mb-3">
                        <label for="tanggalTayang" class="form-label">Tanggal
                            Tayang</label>
                        <input type="date" class="form-control" id="tanggalTayang"
                            name="tanggalTayang" required>
                    </div>
                    <!-- Tanggal Akhir Tayang -->
                    <div class="mb-3">
                        <label for="tanggalAkhirTayang" class="form-label">Tanggal Akhir
                            Tayang</label>
                        <input type="date" class="form-control" id="tanggalAkhirTayang"
                            name="tanggalAkhirTayang" required>
                    </div>
                    <!-- Jam Tayang 1 -->
                    <div class="mb-3">
                        <label for="jamTayang1" class="form-label">Jam Tayang 1</label>
                        <input type="time" class="form-control" id="jamTayang1"
                            name="jamTayang1" required>
                    </div>
                    <!-- Jam Tayang 2 -->
                    <div class="mb-3">
                        <label for="jamTayang2" class="form-label">Jam Tayang 2</label>
                        <input type="time" class="form-control" id="jamTayang2"
                            name="jamTayang2">
                    </div>
                    <!-- Jam Tayang 3 -->
                    <div class="mb-3">
                        <label for="jamTayang3" class="form-label">Jam Tayang 3</label>
                        <input type="time" class="form-control" id="jamTayang3"
                            name="jamTayang3">
                    </div>
                    <!-- Pilih Studio -->
                    <div class="mb-3">
                        <label for="studio" class="form-label">Pilih Studio</label>
                        <select class="form-select" id="studio" name="studio" required>
                            <option value="">Pilih Studio</option>
                            <option value="Studio 1">Studio 1</option>
                            <option value="Studio 2">Studio 2</option>
                            <option value="Studio 3">Studio 3</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"
                        id="submitBtn">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>