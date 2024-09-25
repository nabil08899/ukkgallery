<?php
session_start();
include 'koneksi.php';
$id_foto = $_GET['id_foto'];
$id_user = $_SESSION['id_user'];

$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id_foto' AND id_user='$id_user'");

if (mysqli_num_rows($ceksuka) == 1) {
    while ($row = mysqli_fetch_array($ceksuka)) {
        $id_like = $row['id_like'];
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE id_like='$id_like'");
        echo "<script>
            location.href='index.php';
        </script>";
    }
} else {
    $tanggallike = date('Y-m-d');
    $query = mysqli_query($koneksi, "INSERT INTO likefoto VALUES('', '$id_foto', '$id_user', '$tanggallike')");
    echo "<script>
        location.href='index.php';
    </script>";
}
?>
