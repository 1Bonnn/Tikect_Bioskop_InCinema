<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/admin logo.png">
    <title>Data Film - Admin InCinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
<main class="ml-64 p-6 w-full">
    <header class="bg-white p-4 rounded shadow mb-6 flex justify-between items-center">
        <h2 class="text-xl font-semibold">Data Film</h2>
    </header>

            <!-- Modal -->
            <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-full md:w-1/2 max-h-[80vh] overflow-y-auto">
        <h3 class="text-lg font-semibold mb-4">Tambah Film</h3>
        <form action="../proses_input.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="block">Upload Poster</label>
        <input type="file" class="w-full border p-2 rounded" id="poster" name="poster" accept="image/*" required>
    </div>

    <div class="mb-3">
        <label class="block">Nama Film</label>
        <input type="text" class="w-full border p-2 rounded" id="nama_film" name="nama_film" required>
    </div>

    <div class="mb-3">
        <label class="block">Genre</label>
        <div class="flex">
            <select id="genreSelect" class="form-select w-full border p-2 rounded">
                <option value="" disabled selected>Pilih Genre</option>
                <option value="Action">Action</option>
                <option value="Adventure">Adventure</option>
                <option value="Animation">Animation</option>
                <option value="Biography">Biography</option>
                <option value="Comedy">Comedy</option>
                <option value="Crime">Crime</option>
                <option value="Disaster">Disaster</option>
                <option value="Documentary">Documentary</option>
                <option value="Drama">Drama</option>
                <option value="Epic">Epic</option>
                <option value="Erotic">Erotic</option>
                <option value="Experimental">Experimental</option>
                <option value="Family">Family</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Film-Noir">Film-Noir</option>
                <option value="History">History</option>
                <option value="Horror">Horror</option>
                <option value="Martial Arts">Martial Arts</option>
                <option value="Music">Music</option>
                <option value="Musical">Musical</option>
                <option value="Mystery">Mystery</option>
                <option value="Political">Political</option>
                <option value="Psychological">Psychological</option>
                <option value="Romance">Romance</option>
                <option value="Sci-Fi">Sci-Fi</option>
                <option value="Sport">Sport</option>
                <option value="Superhero">Superhero</option>
                <option value="Survival">Survival</option>
                <option value="Thriller">Thriller</option>
                <option value="War">War</option>
                <option value="Western">Western</option>
            </select>
            <button type="button" id="addGenreBtn" class="bg-blue-600 text-white px-2 py-1 rounded ml-2">Tambah</button>
        </div>
        <div id="selectedGenres" class="mt-2"></div>
        <input type="hidden" id="genreInput" name="genre">
    </div>

    <div class="mb-3">
        <label class="block">Upload Banner</label>
        <input type="file" class="w-full border p-2 rounded" id="banner" name="banner" accept="image/*" required>
    </div>

    <div class="mb-3">
        <label class="block">Total Menit</label>
        <input type="text" class="w-full border p-2 rounded" id="menit" name="menit" required>
    </div>

    <div class="mb-3">
        <label class="block">Usia</label>
        <select class="w-full border p-2 rounded" id="usia" name="usia" required>
            <option value="" disabled selected>Pilih Usia</option>
            <option value="13">13</option>
            <option value="17">17</option>
            <option value="SU">SU</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="block">Upload Trailer</label>
        <input type="file" class="w-full border p-2 rounded" id="trailer" name="trailer" accept="video/*">
    </div>

    <div class="mb-3">
        <label class="block">Deskripsi</label>
        <input type="text" class="w-full border p-2 rounded" id="judul" name="judul" required>
    </div>

    <div class="mb-3">
        <label class="block">Berapa Dimensi</label>
        <select class="w-full border p-2 rounded" id="dimensi" name="dimensi" required>
            <option value="" disabled selected>Pilih Dimensi</option>
            <option value="2D">2D</option>
            <option value="3D">3D</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="block">Producer</label>
        <input type="text" class="w-full border p-2 rounded" id="producer" name="producer" required>
    </div>

    <div class="mb-3">
        <label class="block">Director</label>
        <input type="text" class="w-full border p-2 rounded" id="director" name="director" required>
    </div>

    <div class="mb-3">
        <label class="block">Writer</label>
        <input type="text" class="w-full border p-2 rounded" id="writer" name="writer" required>
    </div>

    <div class="mb-3">
        <label class="block">Cast</label>
        <input type="text" class="w-full border p-2 rounded" id="cast" name="cast" required>
    </div>

    <div class="mb-3">
        <label class="block">Distributor</label>
        <input type="text" class="w-full border p-2 rounded" id="distributor" name="distributor" required>
    </div>

    <div class="mb-3">
        <label class="block">Harga Per Tiket</label>
        <input type="number" class="w-full border p-2 rounded" id="harga" name="harga" required>
    </div>

    <div class="flex justify-end">
        <button type="button" id="closeModal" class="bg-red-600 text-white px-4 py-2 rounded mr-2">Batal</button>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</form>

    </div>
</div>

            <!-- Tabel Data Film -->
            <div class="bg-white p-6 rounded shadow overflow-x-auto">
            <h3 class="text-lg font-semibold mb-4">Daftar Data Film</h3>
            <button id="openModal" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah Film</button>
            <br>
            <br>
    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-blue-800 text-white">
                <th class="border p-2">NO</th>
                <th class="border p-5">Poster</th>
                <th class="border p-2">Nama Film</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Genre</th>
                <th class="border p-2">Total Menit</th>
                <th class="border p-2">Usia</th>
                <th class="border p-2">Dimensi</th>
                <th class="border p-2">Producer</th>
                <th class="border p-2">Director</th>
                <th class="border p-2">Writer</th>
                <th class="border p-2">Cast</th>
                <th class="border p-2">Distributor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Koneksi ke database
            include '../koneksi.php';

            // Query untuk mengambil data film
            $sql = "SELECT * FROM film";
            $result = $conn->query($sql);
            $no = 1; // Nomor urut

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td class='border border-gray-300 px-2 py-1 text-center'>{$no}</td>
                            <td class='border border-gray-300 px-4 py-2'><img src='../" . $row['poster'] . "' alt='Poster' class='w-20 h-auto'></td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['nama_film']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['judul']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['genre']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['total_menit']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['usia']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['dimensi']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['Producer']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['Director']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['Writer']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['Cast']}</td>
                            <td class='border border-gray-300 px-4 py-2'>{$row['Distributor']}</td>
                          </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='13' class='border border-gray-300 px-4 py-2 text-center'>Tidak ada data</td></tr>";
            }

            // Tutup koneksi
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

        </main>

    </div>

    <script>
        // Modal control
        const modal = document.getElementById('modal');
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        
        openModalButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        // Genre handling
        const addGenreBtn = document.getElementById('addGenreBtn');
        const genreSelect = document.getElementById('genreSelect');
        const selectedGenres = document.getElementById('selectedGenres');
        const genreInput = document.getElementById('genreInput');

        addGenreBtn.addEventListener('click', () => {
            const selectedGenre = genreSelect.value;
            if (selectedGenre && !Array.from(selectedGenres.children).find(g => g.textContent === selectedGenre)) {
                const genreSpan = document.createElement('span');
                genreSpan.textContent = selectedGenre;
                genreSpan.classList.add('bg-blue-500', 'text-white', 'p-1', 'rounded', 'mr-2', 'mb-2');
                selectedGenres.appendChild(genreSpan);
                genreInput.value += selectedGenre + ', ';
            }
        });
    </script>
</body>

</html>
