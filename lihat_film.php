<?php include 'assets/template/header.php' ?>

<?php include 'koneksi.php';
//MEnggunakan prepared statement untuk keamanan
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = $conn->prepare("SELECT * FROM film WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$film = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/img/logo_incinema.png">
    <title>Lihat Film - InCinema</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { 
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 40px;
            background-color: #444;
            color: white;
        }

        /* Logo */
        .logo img {
            height: 100px;
        }


        /* Navigasi */
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 20px;
            transition: color 0.3s ease;
            /* Menambahkan efek transisi halus */
        }

        /* Hover pada link biasa (warna kuning) */
        nav ul li a:hover {
            color: #f4bf3a;
            /* Mengubah warna teks menjadi kuning saat hover */
        }

        nav ul li.dropdown {
            position: relative;
        }

        nav ul li.dropdown .dropdown-content {
            display: none;
            position: absolute;
            background-color: #444;
            min-width: 160px;
            z-index: 1;
            max-height: 300px;
            /* Maksimum tinggi dropdown */
            overflow-y: auto;
            /* Menambahkan scrollbar jika item melebihi max-height */
            padding: 0 10px;
            /* Memberikan sedikit ruang di samping */
        }

        nav ul li.dropdown:hover .dropdown-content {
            display: block;
        }

        nav ul li.dropdown .dropdown-content a {
            color: #f4f4f4;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        /* Hover pada item dropdown */
        nav ul li.dropdown .dropdown-content a:hover {
            color: #f4bf3a;
        }


        /* Search dan Login */
        .search-login {
            display: flex;
            align-items: center;
            padding-inline: 5px;
        }

        .search-login input {
            padding: 5px;
            margin-right: 10px;
            border-radius: 5px;
            border: none;
            font-size: 18px;
        }

        .search-login nav ul li {
            margin: 0;
        }

        .search-login nav ul li .login-btn {
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            padding: 5px 10px;
        }

        .search-login nav ul li .login-btn:hover {
            background-color: #cc5200;
        }

        .search-login nav ul li .dropdown-content {
            display: none;
            position: absolute;
            background-color: #444;
            min-width: 50px;
            z-index: 1;
            overflow-y: auto;
            padding: 0 10px;
        }

        .search-login nav ul li:hover .dropdown-content {
            display: block;
        }

        .search-login nav ul li .dropdown-content a {
            color: #f4f4f4;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .search-login nav ul li .dropdown-content a:hover {
            color: #f4bf3a;
        }

        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            border-radius: 10px;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            padding: 10px;
            font-size: 30px;
            cursor: pointer;
            background: none;
            border: none;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            color: #333;
        }

        .movie {
            display: flex;
            gap: 20px;
        }

        .poster {
            position: relative;
            cursor: pointer;
        }

        .poster img {
            width: 300px;
            height: auto;
            border-radius: 10px;
        }

        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
            font-size: 24px;
        }

        .details {
            flex: 1;
        }

        .synopsis {
            margin-top: 20px;
            text-align: justify;
        }

        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 10px 10px;
            font-size: 10px;
            line-height: 1.5;
            border-radius: 5px;
            transition: all 0.2s ease-in-out;
            text-decoration: none;
            cursor: pointer;
        }

        .btn.buy-ticket {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
            margin-right: 15px;
            /* Jarak dari elemen di kanan */
        }

        .btn.buy-ticket:hover {
            background-color: #0056b3;
            /* Warna lebih gelap saat hover */
            border-color: #004085;
        }

        .buy-ticket {
            display: block;
            width: 100%;
            background: yellow;
            border: none;
            padding: 10px;
            margin-top: 10px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        video {
            width: 100%;
            border-radius: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        .screen {
            background: gray;
            color: white;
            padding: 10px;
            margin-bottom: 10px;
        }

        .seats {
            display: grid;
            grid-template-columns: repeat(8, 40px);
            gap: 10px;
            justify-content: center;
        }

        .seat {
            width: 40px;
            height: 40px;
            background: #ccc;
            text-align: center;
            line-height: 40px;
            cursor: pointer;
            border-radius: 5px;
        }

        .seat.selected {
            background: green;
            color: white;
        }

        .confirm-seat {
            margin-top: 20px;
            padding: 10px;
            background: yellow;
            border: none;
            cursor: pointer;
        }

        footer {
    background-color: #333;
    color: white;
    padding: 60px 0; /* Same padding as the header */
    position: relative;
    width: 100%;
    box-sizing: border-box; /* Ensure padding doesn't affect the width */
}

footer .footer-content {
    position: absolute; /* Position content relative to the footer */
    left: 20px; /* Align content to the left */
    bottom: 10px; /* Position at the bottom */
}

footer .footer-content p {
    margin: 5px 0;
    font-size: 15px;
}

footer .footer-content p:first-child {
    font-weight: bold;
}

    </style>

</head>

<body>
    <br>
    <div class="container">


        <button class="back-button" onclick="location.href='index.php'">
            &#8592;
        </button>
        <h2>NOW PLAYING</h2>

        <div class="movie">
            <div class="poster" onclick="showTrailer()">
                <img src="<?php echo $film['poster']; ?>" alt="Perayaan Mati Rasa">
                <div class="play-icon">▶</div>

            </div>

            <div class="details">

                <h1><?php echo $film['nama_film']; ?></h1>
                <p><strong>Genre:</strong> <?php echo $film['genre']; ?></p>
                <p><strong>Durasi:</strong> <?php echo $film['total_menit']; ?></p>
                <p><strong>Usia:</strong> <?php echo $film['usia']; ?></p>
                <p><strong>Dimensi:</strong> <?php echo $film['dimensi']; ?></p>
                <p><strong>Producer:</strong> <?php echo $film['Producer']; ?></p>
                <p><strong>Writer:</strong> <?php echo $film['Writer']; ?></p>
                <p><strong>Director:</strong> <?php echo $film['Director']; ?></p>
                <p><strong>Distributor:</strong> <?php echo $film['Distributor']; ?></p>
                <p><strong>Cast:</strong> <?php echo $film['Cast']; ?></p>
                <p><strong>Harga Ticket:</strong> <?php echo $film['harga']; ?></p>
                <a href="jadwal.php?id=<?php echo $film['id']; ?>" class="btn buy-ticket">Buy Ticket</a>
            </div>
        </div>
        <div class="synopsis">
            <h3>Deskripsi</h3>
            <p><?php echo $film['judul']; ?></p>
        </div>
    </div>
    <div id="trailerModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeTrailer()">&times;</span>
            <video id="trailerVideo" controls>
            <source src="<?php echo $film['trailer']; ?>" type="video/mp4">
            </video>
        </div>
    </div>


    <script>
        function showTrailer() {
    let modal = document.getElementById('trailerModal');
    let video = document.getElementById('trailerVideo');

    if (video) {
        video.play();  // Memastikan video diputar saat modal muncul
    }

    modal.style.display = "flex";
}

function closeTrailer() {
    let modal = document.getElementById('trailerModal');
    let video = document.getElementById('trailerVideo');

    if (video) {
        video.pause();  // Stop video saat modal ditutup
        video.currentTime = 0;
    }

    modal.style.display = "none";
}
document.addEventListener("DOMContentLoaded", function() {
    console.log("JS loaded"); 
});

    </script>
<br>
    <?php include 'assets/template/foooter.php'; ?>

</body>

</html>