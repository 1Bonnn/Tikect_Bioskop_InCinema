<!DOCTYPE html>

<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">
        <link rel="icon" href="assets/img/logo_incinema.png">
        <title>Tambah</title>
    </head>
    <body>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_film = $_POST['nama_film'];
    $judul = $_POST['judul'];
    $usia = $_POST['usia'];
    $genre = $_POST['genre'];
    $menit = $_POST['menit'];
    $dimensi = $_POST['dimensi'];
    $producer = $_POST['producer'];
    $director = $_POST['director'];
    $writer = $_POST['writer'];
    $cast = $_POST['cast'];
    $distributor = $_POST['distributor'];
    $harga = $_POST['harga'];

    $target_dir_poster = "uploads/poster/";

    $target_file_poster = $target_dir_poster .

    basename($_FILES["poster"]["name"]);
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file_poster, PATHINFO_EXTENSION));
    
    //cek file gambar
    $check = getimagesize($_FILES["poster"]["tmp_name"]);
    if($check === false){
        echo "File yang di upload bukan gambar.";
        $uploadOk = 0;
    }

    //cek ukuran file
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) { 
        echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan."; 
        $uploadOk = 0; 
    } 

    if ($uploadOk == 0) {
        echo "Maaf, file poster tidak dapat di upload.";
    } else {
        if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file_poster)){

        //mengupload banner
        $target_dir_banner = "uploads/banner/";

        $target_file_banner = $target_dir_banner . 
        basename($_FILES["banner"]["name"]);
        $uploadOkBanner = 1;
        $imageFileTypeBanner = strtolower(pathinfo($target_file_banner, PATHINFO_EXTENSION));

        //cek file gambar
        $checkBanner = getimagesize($_FILES["banner"]["tmp_name"]);
        if ($checkBanner === false){
            echo "File yang diupload sebagai banner bukan gambar.";
            $uploadOkBanner = 0;
        }

        //cek ukuran
        if ($_FILES["banner"]["size"]> 5000000) {
            echo "Maaf, ukuran file banner terlalu besar.";
            $uploadOkBanner = 0;
        }

        //cek format file
        if(!in_array($imageFileTypeBanner, ['jpg','png','jpeg','gif'])){
            echo "Maaf, hanya file jpg,png,jpeg & gif yang di perbolehkan untuk banner.";
            $uploadOkBanner = 0;
        }

        //cek apakah salh
        if ($uploadOkBanner == 0){
            echo "Maaf, file banner tidak dapat di Upload.";
        } else {
            //jika lulus bisa upload
            if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file_banner)){
                
                //upload trailer
        $target_dir_trailer = "uploads/trailer/";

        $target_file_trailer = $target_dir_trailer . 
        basename($_FILES["trailer"]["name"]);
        $uploadOkTrailer = 1;
        $videoFileType = strtolower(pathinfo($target_file_trailer, PATHINFO_EXTENSION));

        //cek format file
        if(!in_array($videoFileType, ['mp4','avi','mov','wmv'])){
            echo "Maaf, hanya file mp4,avi,mov & wmv yang di perbolehkan.";
            $uploadOkTrailer = 0;
        }

        if ($_FILES["trailer"]["size"]> 50000000) {
            echo "Maaf, ukuran file banner terlalu besar.";
            $uploadOkTrailer = 0;
        }

        //cek apakah salh
        if ($uploadOkBanner == 0){
            echo "Maaf, file banner tidak dapat di Upload.";
        } else {
            //jika lulus bisa upload
            if (move_uploaded_file($_FILES["trailer"]["tmp_name"], $target_file_trailer)){
             
                
                $stmt = $conn->prepare("INSERT INTO film (poster,trailer,banner,nama_film,judul, total_menit, usia, genre,
                dimensi, Producer, Director,Writer, Cast, Distributor, harga) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?)");
                $stmt->bind_param("sssssssssssssss", $target_file_poster, $target_file_trailer, $target_file_banner, $nama_film, $judul, $menit, $usia, $genre, $dimensi,
                $producer, $director, $writer, $cast, $distributor, $harga);

                if ($stmt->execute()) { 
                    echo "<script>  Swal.fire({ 
title: 'Berhasil!', 
text: 'Data Film Berhasil Di Tambahkan !!', 
icon: 'success', 
timer: 3000, // 3 detik 
showConfirmButton: false 
}).then(() => { 
window.location.href = 'admin/data_film.php';  
});</script>"; 
                } else { 
                    echo "Error: " . $stmt->error; 
                } 

                $stmt->close();
            }else{
                echo "Maaf, Terjadi Kesalahan Saat Mengupload File Trailer.";
            }
        }
    } else {
        echo "Maaf, Terjadi Kesalahan Saat Mengupload File Banner.";
    }
}
        } else {
            echo "Maaf, Terjadi Kesalahan Saat Mengupload File Poster.";
        }
    }
}

$conn -> close();
?>