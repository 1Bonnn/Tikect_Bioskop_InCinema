-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2025 pada 01.56
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bioskop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `name`, `password`, `created_at`) VALUES
(4, 'pagiber4k@gmail.com', 'Bonteng', '$2y$10$gEM18P70P9Zat9PKjjVTFeZXSngLLNrrF7wFPH205NBtftNiK0j86', '2025-02-14 06:04:38'),
(6, 'iqbalyasir234567@gmail.com', 'jibok', '$2y$10$QbE/N/6I9UTede.50tCITe0nQsoNqdVIKxC/wBA2niwLGSkdhP6Wi', '2025-02-14 06:13:16'),
(7, 'gangtasel@gmail.com', 'ibonnnn', '$2y$10$MzY7reO9lN8hHHOkzynlZ.wiSjTi7e5ES/UxVgHBcAzA5QK8XRrKi', '2025-02-14 08:54:13'),
(9, 'pagiber4k@gmail.com', 'Slebew', '$2y$10$EQGc6Oh0BDLLYrx0bpnOd.7f0ZrEeeiw7n9AoSnDjWbNY3GCBNCrG', '2025-02-17 04:30:41'),
(10, 'pagiber4k@gmail.com', 'jibok', '$2y$10$15lwFvbHQtZI4VLzOsNepuk1DFaTMY0FiBMuGNXegagy9594tN5PW', '2025-02-17 04:37:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun_mall`
--

CREATE TABLE `akun_mall` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(231) NOT NULL,
  `nama_mall` varchar(231) NOT NULL,
  `nik` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akun_mall`
--

INSERT INTO `akun_mall` (`id`, `email`, `password`, `nama_mall`, `nik`) VALUES
(1, 'iqbalyasir234567@gmail.com', '$2y$10$CI1ERaj1OkPm2EEqXJ/CpuH8M7aZhqs5JJysOcdU4dBQpE9rHhkO2', 'CIPUTRA CIBUBUR', '12334232'),
(2, 'gangtasel@gmail.com', '$2y$10$9o2jwWzU1PWbB33yQ9wlcexcN90u78Sa7W2V0pEubOi6dLD2V.Zqe', 'PLASA CIBUBUR', '165897'),
(3, 'pagiber4k@gmail.com', '$2y$10$kX08ooZ9RoCVPM2mh76HZOyO/5d7Br66hPnt0oCK8g5nq7Sp7cbgW', 'TSM CIBUBUR', '1781298'),
(4, 'iqbalyasir234567@gmail.com', '$2y$10$7ZR/TUg9kARmv9lMkUXWEe4hm/Dud63sDsujpRM06Se5nbZsU0/V2', 'MALL BTM', '8789376'),
(5, 'gangtasel@gmail.com', '$2y$10$GdN8KvSY2VFshRuwu5D3/.ft/Tf816WZ4pUP42VpY/5tcXOBQsfF.', 'METLAND CILEUNGSI', '678219'),
(6, 'pagiber4k@gmail.com', '$2y$10$FwIUmPKwyCBhvwDgsGGVDuga0TV8ei.Zi8y76CXeRt.84sj.c4ZoG', 'AEON MALL BSD CITY', '7658930'),
(7, 'iqbalyasir234567@gmail.com', '$2y$10$laN6K369RWxqsGzrwPQC1OBExRb6..76ALJhSmDDNB2WU9a1G7dOS', 'EPORIUM PLUIT MALL', '165897'),
(8, 'gangtasel@gmail.com', '$2y$10$pl4pvdDKCz5Wa7XHVrjfuOya8yXwzMuXoYyyTB80tcWfYpo7VsFxy', 'PLUIT AVENUE', '1781298'),
(9, '', '', 'BOGOR SQUARE', ''),
(10, '', '', 'PLAZA INDONESIA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `banner` varchar(231) NOT NULL,
  `trailer` varchar(231) NOT NULL,
  `nama_film` varchar(231) NOT NULL,
  `judul` longtext NOT NULL,
  `total_menit` varchar(231) NOT NULL,
  `usia` varchar(231) NOT NULL,
  `genre` varchar(231) NOT NULL,
  `dimensi` varchar(231) NOT NULL,
  `Producer` varchar(231) NOT NULL,
  `Director` varchar(231) NOT NULL,
  `Writer` varchar(231) NOT NULL,
  `Cast` varchar(231) NOT NULL,
  `Distributor` varchar(231) NOT NULL,
  `harga` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data untuk tabel `film`
--

INSERT INTO `film` (`id`, `poster`, `banner`, `trailer`, `nama_film`, `judul`, `total_menit`, `usia`, `genre`, `dimensi`, `Producer`, `Director`, `Writer`, `Cast`, `Distributor`, `harga`) VALUES
(7, 'uploads/poster/flayer2.jpg', 'uploads/banner/p2.jpg', 'uploads/trailer/mrsc.mp4', 'Mencuri Raden Saleh', 'Film ini menceritakan pencurian lukisan mengadung banyak arti', '120', '17', 'Action,Epic,History', '2D', 'iqbal', 'iqbal', 'handoko', 'iqbal,umay,rani,sinta', 'jokoanwar', '35000'),
(9, 'uploads/poster/flayer4.jpg', 'uploads/banner/Transpulmin.jpg', 'uploads/trailer/videoplayback.mp4', 'Agak Laen', 'Bene, Boris, Jegel, dan Oki merupakan empat sekawan yang telah berteman sejak lama. Namun, kondisi ekonomi mereka masih terpuruk meski sudah lama merantau. Keempat sahabat itu akhirnya melihat peluang baru saat pasar malam baru didirikan di dekat kediaman mereka. Bene, Boris, Jegel, dan Oki memutuskan membuat wahana rumah hantu di pasar malam tersebut. Mereka tidak hanya mengelola rumah hantu itu, tetapi juga menyiapkan konsep hingga menjadi hantu untuk menakut-nakuti pengunjung.', '130', 'SU', 'Comedy, Horror, ', '2D', 'Ernest Prakasa', 'Dika Andika', 'Muhadly Anco', 'bene,boris,indra,oki', 'Imajinari', '40000'),
(12, 'uploads/poster/flayer5.jpg', 'uploads/banner/1kakak7ponakan.png', 'uploads/trailer/ibon.mp4', '1 KAKAK 7 PONAKAN', 'film menceritakan kakak yang mengurus 7 ponakannya', '`130', '17', 'Drama, Family, Crime, ', '2D', 'iqbal', 'iqbal', 'iqbal', 'iqbal', 'panojbari', '35000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_film`
--

CREATE TABLE `jadwal_film` (
  `id` int(11) NOT NULL,
  `mall_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `studio` varchar(231) NOT NULL,
  `jam_tayang_1` time NOT NULL,
  `jam_tayang_2` time NOT NULL,
  `jam_tayang_3` time NOT NULL,
  `tanggal_tayang` date NOT NULL,
  `tanggal_akhir_tayang` date NOT NULL,
  `total_menit` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data untuk tabel `jadwal_film`
--

INSERT INTO `jadwal_film` (`id`, `mall_id`, `film_id`, `studio`, `jam_tayang_1`, `jam_tayang_2`, `jam_tayang_3`, `tanggal_tayang`, `tanggal_akhir_tayang`, `total_menit`) VALUES
(23, 1, 7, 'Studio 1', '09:00:00', '14:00:00', '20:00:00', '2025-02-18', '2025-02-28', '120'),
(25, 1, 9, 'Studio 2', '09:00:00', '14:00:00', '20:00:00', '2025-02-01', '2025-04-30', '130'),
(26, 1, 12, 'Studio 1', '10:00:00', '14:00:00', '20:00:00', '2025-03-01', '2025-04-03', '`130');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `mall_name` varchar(255) NOT NULL,
  `seat_number` varchar(10) NOT NULL,
  `status` enum('available','occupied') NOT NULL,
  `film_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `seats`
--

INSERT INTO `seats` (`id`, `mall_name`, `seat_number`, `status`, `film_name`) VALUES
(1, 'CIPUTRA CIBUBUR', 'A4', 'occupied', 'Mencuri Raden Saleh'),
(2, 'CIPUTRA CIBUBUR', 'A1', 'occupied', 'Mencuri Raden Saleh'),
(3, 'CIPUTRA CIBUBUR', 'A5', 'occupied', 'Mencuri Raden Saleh'),
(4, 'CIPUTRA CIBUBUR', 'A6', 'occupied', 'Mencuri Raden Saleh'),
(5, 'CIPUTRA CIBUBUR', 'A7', 'occupied', 'Mencuri Raden Saleh'),
(6, 'CIPUTRA CIBUBUR', 'C5', 'occupied', 'Mencuri Raden Saleh'),
(7, 'CIPUTRA CIBUBUR', 'C6', 'occupied', 'Mencuri Raden Saleh'),
(8, 'CIPUTRA CIBUBUR', 'A2', 'occupied', 'Mencuri Raden Saleh'),
(9, 'CIPUTRA CIBUBUR', 'A3', 'occupied', 'Mencuri Raden Saleh'),
(10, 'CIPUTRA CIBUBUR', 'A8', 'occupied', 'Mencuri Raden Saleh'),
(11, 'CIPUTRA CIBUBUR', 'A1', 'occupied', 'Agak Laen'),
(12, 'CIPUTRA CIBUBUR', 'A2', 'occupied', 'Agak Laen'),
(13, 'CIPUTRA CIBUBUR', 'A3', 'occupied', 'Agak Laen'),
(14, 'CIPUTRA CIBUBUR', 'A4', 'occupied', 'Agak Laen'),
(15, 'CIPUTRA CIBUBUR', 'A5', 'occupied', 'Agak Laen'),
(16, 'CIPUTRA CIBUBUR', 'A6', 'occupied', 'Agak Laen'),
(17, 'CIPUTRA CIBUBUR', 'A7', 'occupied', 'Agak Laen'),
(18, 'CIPUTRA CIBUBUR', 'A8', 'occupied', 'Agak Laen'),
(19, 'CIPUTRA CIBUBUR', 'A9', 'occupied', 'Agak Laen'),
(20, 'CIPUTRA CIBUBUR', 'A10', 'occupied', 'Agak Laen'),
(21, 'CIPUTRA CIBUBUR', 'B1', 'occupied', 'Agak Laen'),
(22, 'CIPUTRA CIBUBUR', 'B2', 'occupied', 'Agak Laen'),
(23, 'CIPUTRA CIBUBUR', 'B1', 'occupied', 'Mencuri Raden Saleh'),
(24, 'CIPUTRA CIBUBUR', 'B2', 'occupied', 'Mencuri Raden Saleh'),
(25, 'CIPUTRA CIBUBUR', 'D6', 'occupied', 'Mencuri Raden Saleh'),
(26, 'CIPUTRA CIBUBUR', 'D7', 'occupied', 'Mencuri Raden Saleh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `username` varchar(250) NOT NULL,
  `seat_number` varchar(250) NOT NULL,
  `nama_film` varchar(231) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `status`, `payment_type`, `amount`, `transaction_time`, `username`, `seat_number`, `nama_film`) VALUES
(1, 'TIX1740189624', 'settlement', 'qris', 80000, '2025-02-22 09:00:28', 'iqbalyasir234567@gmail.com', 'A5,A6', 'Agak Laen'),
(2, 'TIX1740189624', 'settlement', 'qris', 80000, '2025-02-22 09:00:28', 'iqbalyasir234567@gmail.com', 'A5,A6', 'Agak Laen'),
(3, 'TIX1740189712', 'settlement', 'qris', 80000, '2025-02-22 09:01:55', 'iqbalyasir234567@gmail.com', 'A7,A8', 'Agak Laen'),
(4, 'TIX1740189712', 'settlement', 'qris', 80000, '2025-02-22 09:01:55', 'iqbalyasir234567@gmail.com', 'A7,A8', 'Agak Laen'),
(5, 'TIX1740190017', 'settlement', 'qris', 80000, '2025-02-22 09:07:00', 'iqbalyasir234567@gmail.com', 'B1,B2', 'Agak Laen'),
(6, 'TIX1740190132', 'settlement', 'qris', 70000, '2025-02-22 09:08:56', 'iqbalyasir234567@gmail.com', 'B1,B2', 'Mencuri Raden Saleh'),
(7, 'TIX1740214491', 'settlement', 'qris', 70000, '2025-02-22 15:54:57', 'iqbalyasir234567@gmail.com', 'D6,D7', 'Mencuri Raden Saleh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `created_at`) VALUES
(1, 'pagiber4k@gmail.com', 'nikbol', '$2y$10$03wewtDAmKzmCJOuykphqumzu62jtdz03gUZjhQnIKlpNCTYn.QEa', '2025-02-12 04:20:47'),
(2, 'gangtasel@gmail.com', 'ibon', '$2y$10$Dmu6tv3kgvn6hZ95ZZ1UlurzbC7Ia1xnKORxJzjUTvRpUEx2Vd8Eq', '2025-02-12 12:32:25'),
(3, 'iqbalyasir234567@gmail.com', 'ibonnnn', '$2y$10$DbQgJzwCf24Jp.XliBI1gu.tXkpSO8MwiO5S/nQ7Ndi8gRRYxr9ke', '2025-02-13 01:29:41'),
(4, 'pagiber4k@gmail.com', 'pagiber4k', '$2y$10$LhRaZ/GFHKIXtlTv7VJPfekrgE0s2mDdSjHCfPk0DVKAOmESKqx.a', '2025-02-13 04:38:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akun_mall`
--
ALTER TABLE `akun_mall`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_film`
--
ALTER TABLE `jadwal_film`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `akun_mall`
--
ALTER TABLE `akun_mall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `jadwal_film`
--
ALTER TABLE `jadwal_film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
