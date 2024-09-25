<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    echo "<script>
    alert('Anda belum login!');
    location.href='login.php';
    </script>";
    exit;
}

if (isset($_POST['tambah'])) {
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');
    $id_user = $_SESSION['id_user']; // Pastikan id_user sudah ada di sesi

    // Sesuaikan query INSERT dengan jumlah kolom di tabel
    $sql = mysqli_query($koneksi, "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, id_user) VALUES ('$namaalbum', '$deskripsi', '$tanggal', '$id_user')");

    if ($sql) {
        echo "<script>
        alert('Data berhasil disimpan!');
        location.href='jelajah.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal disimpan!');
        location.href='jelajah.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    $id_album = $_POST['id_album'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');
    $id_user = $_SESSION['id_user']; // Pastikan id_user sudah ada di sesi

    $sql = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggaldibuat='$tanggal' WHERE id_album='$id_album'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil diperbarui!');
        location.href='jelajah.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal diperbarui!');
        location.href='jelajah.php';
        </script>";
    }
}

if (isset($_POST['hapus'])) {
    $id_album = $_POST['id_album'];

    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE id_album='$id_album'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil dihapus!');
        location.href='jelajah.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal dihapus!');
        location.href='jelajah.php';
        </script>";
    }
}
?>
