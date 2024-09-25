<?php
session_start();
$id_user = $_SESSION['id_user'];
include 'koneksi.php';
if ($_SESSION['status'] != 'login')
    echo "<script>
    alert ('Anda belum login!');
    location.href='login.php';
    </script>";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
     /* Nama class khusus untuk menghindari tabrakan dengan Bootstrap */
.custom-style body, .custom-style h1, .custom-style h2, .custom-style p, .custom-style input, .custom-style button, .custom-style select, .custom-style textarea {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.custom-style body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
}

.custom-style .container {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.custom-style h1, .custom-style h2 {
    text-align: center;
    color: #333;
    margin-bottom: 20px;
    font-family: 'Segoe UI', sans-serif;
    font-weight: bold;
}

.custom-style .balap {
    margin-bottom: 30px;
    padding: 20px;
    border-radius: 10px;
    background: #f9f9f9;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.custom-style .input-group {
    margin-bottom: 15px;
}

.custom-style .input-group label {
    font-size: 1.2rem;
    color: #444;
    margin-bottom: 5px;
    display: block;
    font-weight: bold;
}

.custom-style .input-group input,
.custom-style .input-group textarea,
.custom-style .input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

.custom-style textarea {
    resize: vertical;
}

.custom-style .ngaceng {
    width: 100%;
    padding: 12px;
    background-color: #ff5e62;
    color: white;
    font-size: 1.1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-style .ngaceng:hover {
    background-color: #e3494d;
}

.custom-style .input-group input[type="file"] {
    border: none;
    background-color: #fff;
    padding: 10px;
    font-size: 1rem;
}

.custom-style .input-group input[type="file"]::file-selector-button {
    background-color: #ff5e62;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-style .input-group input[type="file"]::file-selector-button:hover {
    background-color: #e3494d;
}

.custom-style table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.custom-style .table-header {
    background-color: #f5f5f5;
    text-align: center;
    font-size: 1rem;
    font-weight: 600;
    color: #333;
}

.custom-style .table-row {
    background-color: #fff;
}

.custom-style .table-row:nth-child(even) {
    background-color: #f9f9f9;
}

.custom-style .table-cell {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #f2f2f2;
    color: #555;
}

.custom-style .table-cell img {
    max-width: 80px;
    height: auto;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.custom-style .table-row:hover {
    background-color: #f1f1f1;
    transition: background-color 0.3s ease;
}

.custom-style hr {
    border: none;
    height: 2px;
    background-color: #ddd;
    margin: 30px 0;
}

.custom-style .back-button {
    display: inline-block;
    margin-top: 20px;
    padding: 12px;
    background-color: #3498db;
    color: white;
    font-size: 1.1rem;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.custom-style .back-button:hover {
    background-color: #2980b9;
}


    </style>
</head>
<body >
<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
  <div class="container-fluid">
  <a class="navbar-brand btn-animated" href="">Galeri Foto</a>
    <button class="navbar-toggler btn-animated" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Explore</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="beranda.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="jelajah.php">Album</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="buat.php">Foto</a>
        </li>
      </ul>

      <!-- <form class="d-flex mx-auto" role="search" method="GET" action="hasil_pencarian.php">
    <input class="form-control me-2" type="search" name="keyword" placeholder="Cari" aria-label="Search">
    <button class="btn btn-outline-success btn-animated" type="submit">Cari</button>
</form> -->


      <!-- Tautan login/register atau logout -->
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['username'])): ?>
          <!-- Tampilkan tombol logout jika sudah login -->
          <li class="nav-item">
            <a class="btn btn-outline-danger m-1 btn-animated" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
          <!-- Tampilkan tombol login dan mendaftar jika belum login -->
          <li class="nav-item">
            <a class="btn btn-outline-primary m-1 btn-animated" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-success m-1 btn-animated" href="register.php">Mendaftar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="custom-style">
<div class="container">
        <h1>Unggah Foto</h1>

        <form class="balap" action="proses_foto.php" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <label for="Nama Foto">Nama Foto</label>
                <input type="text" name="judulfoto" class="form-control" required>
            </div>
            <div class="input-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsifoto" required></textarea>
            </div>
            <div class="input-group">
                <label>Pilih Album</label>
                <select name="id_album" required>
                                <?php $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                    <option value="<?php echo $data_album['id_album'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                <?php } ?>
                            </select>
            </div>
            <div class="input-group">
                <label>Pilih Foto</label>
                <input type="file" class="form-control" name="lokasifile" required>
            </div>
            <button  class="ngaceng"type="submit" name="tambah">Unggah</button>

        </form>

        <hr>

        <h2>Galeri Foto</h2>
        <table id="galeri">
            <thead>
            <tr class="table-header">
             <th class="table-cell">No</th>
             <th class="table-cell">Foto</th>
             <th class="table-cell">Judul</th>
             <th class="table-cell">Deskripsi</th>
             <th class="table-cell">Tanggal Unggah</th>
             <th class="table-cell">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
                                $no = 1;
                                $id_user = $_SESSION['id_user'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM gallery_foto WHERE id_user='$id_user'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img src="img/<?php echo $data['lokasifile'] ?>" width="100"></td>
                                        <td><?php echo $data['judulfoto'] ?></td>
                                        <td><?php echo $data['deskripsifoto'] ?></td>
                                        <td><?php echo $data['tanggalunggah'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_foto'] ?>">
                                                Edit
                                            </button>

                                            <div class="modal fade" id="edit<?php echo $data['id_foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="proses_foto.php" method="POST">
                                                                <input type="hidden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                                                                <label class="form-label">Judul Foto</label>
                                                                <input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control" required>
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto']; ?>"</textarea>
                                                                <label class="form-label">Album</label>
                                                                <select class="form-control" name="albumid">
                                                                    <?php $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                                                                    while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                        <option <?php if($data_album['id_album'] == $data['id_album']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['id_album'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <label class="form-label">Foto</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                    <img src="img/<?php echo $data['lokasifile'] ?>" width="100">
                                                                    </div>
                                                                    <div class="col-md-8"></div>
                                                                    <label class="form-label">File</label>
                                                                <input type="file" class="form-control" name="lokasifile">
                                                                </div>
                                                                

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit" class="btn btn-primary"><i class="fa fa-pencil-square" aria-hidden="true"></i>Edit Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah<?php echo $data['id_foto'] ?>">
                                                Tambah
                                            </button> -->
                                            <!-- tambah -->
                                            <!-- <div class="modal fade" id="tambah<?php echo $data['id_foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="proses_foto.php" method="POST">
                                                                <input type="hidden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                                                                <label class="form-label">Judul Foto</label>
                                                                <input type="text" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" class="form-control" required>
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto']; ?>"</textarea>
                                                                <label class="form-label">Album</label>
                                                                <select class="form-control" name="albumid">
                                                                    <?php $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
                                                                    while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                        <option <?php if($data_album['id_album'] == $data['id_album']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['id_album'] ?>"><?php echo $data_album['namaalbum'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <label class="form-label">Foto</label>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                    <img src="img/<?php echo $data['lokasifile'] ?>" width="100">
                                                                    </div>
                                                                    <div class="col-md-8"></div>
                                                                    <label class="form-label">File</label>
                                                                <input type="file" class="form-control" name="lokasifile">
                                                                </div>
                                                                

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit" class="btn btn-primary">Tambah Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_foto'] ?>">
                                                delete
                                            </button>

                                            <div class="modal fade" id="hapus<?php echo $data['id_foto'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="proses_foto.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="id_foto" value="<?php echo $data['id_foto'] ?>">
                                                                Apakah anda yakin ingin menghapus data <strong> <?php echo $data['judulfoto'] ?> </strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                <?php } ?>
            </tbody>
        </table>
    </div>
    </div>
    
    <footer class="d-flex justify-content-center border-top mt-3 bg-light">
    <p>&copy; UKK RPL 2024 | Moch Annabilmuchtar Saifullah</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
