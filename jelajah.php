<?php
    session_start();
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
        /* Reset beberapa elemen dasar */
        body, h1, h2, p, input, button, select, textarea {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 20px;
            font-family: 'Segoe UI', sans-serif;
            font-weight: bold;
        }

        .balap {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 10px;
            background: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 5px;
            display: block;
            font-weight: bold;
        }

        .input-group input,
        .input-group textarea,
        .input-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
        }

        .ngaceng {
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

        .ngaceng:hover {
            background-color: #e3494d;
        }

        /* Styling untuk file input */
        .input-group input[type="file"] {
            border: none;
            background-color: #fff;
            padding: 10px;
            font-size: 1rem;
        }

        .input-group input[type="file"]::file-selector-button {
            background-color: #ff5e62;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .input-group input[type="file"]::file-selector-button:hover {
            background-color: #e3494d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .table-header {
            background-color: #f5f5f5;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .table-row {
            background-color: #fff;
        }

        .table-row:nth-child(even) {
            background-color: #f9f9f9;
        }

        .table-cell {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #f2f2f2;
            color: #555;
        }

        .table-cell img {
            max-width: 80px;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table-row:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        hr {
            border: none;
            height: 2px;
            background-color: #ddd;
            margin: 30px 0;
        }

        .back-button {
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

        .back-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
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

      <!-- Form pencarian -->
      <!-- <form class="d-flex mx-auto mt-3" role="search">
        <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
        <button class="btn btn-outline-success btn-animated" type="submit">Cari</button>
      </form> -->

      <!-- Tautan login/register atau logout -->
      <ul class="navbar-nav ms-auto">
        <?php if(isset($_SESSION['username'])): ?>
          <li class="nav-item">
            <a class="btn btn-outline-danger m-1 btn-animated" href="logout.php">Logout</a>
          </li>
        <?php else: ?>
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
<div class="container">
    <h1>Tambah Album</h1>
    <form class="balap" action="proses_album.php" method="POST">
        <div class="input-group">
            <label for="judul">Nama Album</label>
            <input type="text" name="namaalbum" required>
        </div>
        <div class="input-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" rows="3" required></textarea>
        </div>
        <button type="submit" class="ngaceng" name="tambah">Tambah</button>
    </form>

    <hr>

    <!-- Tabel data foto -->
    <h2>Daftar Album</h2>
    <table>
        <thead>
            <tr class="table-header">
                <th class="table-cell">No</th>
                <th class="table-cell">Nama Album</th>
                <th class="table-cell">Deskripsi</th>
                <th class="table-cell">Tanggal</th>
                <th class="table-cell">Aksi</th>
            </tr>
        </thead>
        <tbody>
<?php
$no = 1;
$id_user = $_SESSION['id_user'];
$sql = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
while ($data = mysqli_fetch_array($sql)) {
?>
<tr>   
    <td><?php echo $no++ ?></td>
    <td><?php echo $data['namaalbum'] ?></td>
    <td><?php echo $data['deskripsi'] ?></td>
    <td><?php echo $data['tanggaldibuat'] ?></td>
    <td>
        <!-- Tombol Edit -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_album'] ?>">
            Edit
        </button>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit<?php echo $data['id_album'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses_album.php" method="POST">
                            <input type="hidden" name="id_album" value="<?php echo $data['id_album'] ?>">
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- tombol tambah -->
        <!-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambah<?php echo $data['id_album'] ?>">
            tambah
        </button> -->

        <!-- Modal Edit -->
        <!-- <div class="modal fade" id="tambah<?php echo $data['id_album'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses_album.php" method="POST">
                            <input type="hidden" name="id_album" value="<?php echo $data['id_album'] ?>">
                            <label class="form-label">Nama Album</label>
                            <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- Tombol Hapus -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_album'] ?>">
            Delete
        </button>

        <!-- Modal Hapus -->
        <div class="modal fade" id="hapus<?php echo $data['id_album'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="proses_album.php" method="POST">
                            <input type="hidden" name="id_album" value="<?php echo $data['id_album'] ?>">
                            Apakah anda yakin ingin menghapus data <strong><?php echo $data['namaalbum'] ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
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

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
