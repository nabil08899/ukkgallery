<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date ('Y-m-d');
    $id_album = $_POST['id_album'];
    $id_user = $_SESSION['id_user'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = 'img/';
    $namafoto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$namafoto);

    $sql = mysqli_query($koneksi, "INSERT INTO gallery_foto VALUES('','$judulfoto','$deskripsifoto','$tanggalunggah','$namafoto','$id_album','$id_user')");

    echo "<script>
    alert ('Data berhasil disimpan!');
    location.href='buat.php';
    </script>";

}

if (isset($_POST['edit'])) {
    $id_foto = $_POST['id_foto'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date ('Y-m-d');
    $id_album = $_POST['id_album'];
    $id_user = $_SESSION['id_user'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = 'img/';
    $namafoto = rand().'-'.$foto;

    move_uploaded_file($tmp, $lokasi.$namafoto);

    if ($foto == null) {
        $sql = mysqli_query($koneksi, "UPDATE gallery_foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', id_album='$id_album' WHERE id_foto='$id_foto'");
    
    }else{
        $query = mysqli_query($koneksi, "SELECT * FROM gallery_foto WHERE id_foto='$id_foto'");
        $data = mysqli_fetch_array($query);
        if (is_file('img/'.$data['lokasifile'])) {
            unlink('img/'.$data['lokasifile']);
        }
        move_uploaded_file($tmp, $lokasi.$namafoto);
        $sql = mysqli_query($koneksi, "UPDATE gallery_foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', lokasifile='$namafoto', id_album='$id_album' WHERE id_foto='$id_foto'");
    }
    echo "<script>
    alert ('Data berhasil diperbarui!');
    location.href='buat.php';
    </script>";
}
if (isset($_POST['hapus'])) {
    $id_foto = $_POST['id_foto'];
    $query = mysqli_query($koneksi, "SELECT * FROM gallery_foto WHERE id_foto='$id_foto'");
    $data = mysqli_fetch_array($query);
    if (is_file('img/'.$data['lokasifile'])) {
        unlink('img/'.$data['lokasifile']);
    }

    $sql = mysqli_query($koneksi, "DELETE  FROM gallery_foto WHERE id_foto='$id_foto'");
    echo "<script>
    alert ('Data berhasil dihapus!');
    location.href='buat.php';
    </script>";
    
}
