<?php
session_start();
include 'koneksi.php';

$id_foto = $_POST['id_foto'];
$id_user = $_SESSION['id_user'];
$isikomentar = $_POST['isikomentar'];
$tanggalkoemtar = date('Y-m-d');

$query = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('','$id_foto','$id_user','$isikomentar','$tanggalkoemtar')");

echo "<script>
location.href='index.php';
</script>";

?>