<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-AllowMethods, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// Include koneksi database
require_once '../koneksi.php';

// Periksa rute API
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['endpoint'])) {
        switch ($_GET['endpoint']) {
            case 'mall':
                fetchMall($conn);
                break;
            case 'film':
                fetchFilms($conn);
                break;
            case 'film_detail':
                if (isset($_GET['id'])) {
                    fetchFilmDetail($conn, $_GET['id']);
                } else {
                    echo json_encode(['error' => 'Film ID not provided']);
                }
                break;
            default:
                echo json_encode(['error' => 'Invalid endpoint']);
        }
    } else {
        echo json_encode(['error' => 'No endpoint specified']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['endpoint']) && $_GET['endpoint'] === 'tambah_jadwal') {
        tambahJadwal($conn);
    } else {
        echo json_encode(['error' => 'Invalid endpoint']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

// Fetch data mall
function fetchMall($conn) {
    $query = "SELECT id, nama_mall FROM akun_mall";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        error_log("Error fetching malls: " . mysqli_error($conn));
        echo json_encode(['error' => 'Database error']);
        return;
    }
    $malls = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($malls);
}

// Fetch data films
function fetchFilms($conn) {
    $query = "SELECT id, nama_film FROM film";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        error_log("Error fetching films: " . mysqli_error($conn));
        echo json_encode(['error' => 'Database error']);
        return;
    }
    $films = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($films);
}

// Fetch film detail by ID
function fetchFilmDetail($conn, $id) {
    $query = "SELECT nama_film, poster, total_menit FROM film WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Error preparing statement: " . mysqli_error($conn));
        echo json_encode(['error' => 'Database error']);
        return;
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $film = mysqli_fetch_assoc($result);
    if ($film) {
        echo json_encode($film);
    } else {
        echo json_encode(['error' => 'Film not found']);
    }
}

// Insert new schedule (tambah_jadwal)
function tambahJadwal($conn) {
    // Get POST data
    $mallId = $_POST['namaMall'] ?? '';
    $filmId = $_POST['namaFilm'] ?? '';
    $tanggalTayang = $_POST['tanggalTayang'] ?? '';
    $tanggalAkhirTayang = $_POST['tanggalAkhirTayang'] ?? '';
    $totalMenit = $_POST['totalMenit'] ?? '';
    $jam1 = $_POST['jamTayang1'] ?? '';
    $jam2 = $_POST['jamTayang2'] ?? '';
    $jam3 = $_POST['jamTayang3'] ?? '';
    $studio = $_POST['studio'] ?? '';
    
    // Validate required fields
    if (empty($mallId) || empty($filmId) || empty($tanggalTayang) || empty($tanggalAkhirTayang) || empty($totalMenit) || empty($jam1) || empty($jam2) || empty($jam3) || empty($studio)) {
        echo json_encode(['error' => 'All fields are required']);
        return;
    }
    
    // Prepare SQL query to insert new schedule
    $query = "INSERT INTO jadwal_film (mall_id, film_id, studio, jam_tayang_1, jam_tayang_2, jam_tayang_3, tanggal_tayang, tanggal_akhir_tayang, total_menit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Error preparing statement: " . mysqli_error($conn));
        echo json_encode(['error' => 'Database error']);
        return;
    }
    mysqli_stmt_bind_param($stmt, "iisssssss", $mallId, $filmId, $studio, $jam1, $jam2, $jam3, $tanggalTayang, $tanggalAkhirTayang, $totalMenit);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        error_log("Error inserting data: " . mysqli_error($conn));
        echo json_encode(['error' => 'Failed to insert data']);
    }
}
