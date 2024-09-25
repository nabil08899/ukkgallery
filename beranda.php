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
    <title>Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    
    <style>
        /* Gaya umum untuk halaman */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        /* Menggunakan flexbox untuk tata letak ala Pinterest */
        .grid-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 15px;
            padding: 20px;
        }

        /* Setiap item grid */
        .grid-item {
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            flex-basis: calc(33.333% - 20px);
            margin-bottom: 20px;
        }

        /* Mengatur ukuran gambar agar responsif */
        .grid-item img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 15px;
        }

        /* Efek hover untuk memperbesar gambar sedikit */
        .grid-item:hover {
            transform: scale(1.03);
        }

        /* Deskripsi di bawah gambar */
        .grid-item .description {
            padding: 10px;
            text-align: center;
        }

        .grid-item .description h3 {
            margin: 0;
            font-size: 1rem;
            color: #333;
        }

        .grid-item .description p {
            margin: 5px 0 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Mengatur animasi pada tombol/tautan */
        .nav-item a, .btn-animated {
            transition: transform 0.3s ease;
        }

        .nav-item a:active, .btn-animated:active {
            transform: scale(0.95);
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
      <!-- <form class="d-flex mx-auto" role="search">
        <input class="form-control me-2" type="search" placeholder="Cari" aria-label="Search">
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

<!-- Konten Galeri -->
<?php 
        $id_album = mysqli_query($koneksi, "SELECT * FROM album WHERE id_user='$id_user'");
        while($row = mysqli_fetch_array($id_album)){ ?>
        <a href="index.php?id_album= <?php echo $row['id_album'] ?>" class="btn btn-outline-primary"><?php echo $row['namaalbum'] ?></a>

        <?php } ?>

        <div class="row">
            <?php 
            if (isset($_GET['id_album'])) {
                $id_album = $_GET['id_album'];
                $query = mysqli_query($koneksi, "SELECT * FROM gallery_foto WHERE id_user='$id_user' AND id_album='$id_album'");
                while($data = mysqli_fetch_array($query)){ ?>
                <div class="col-md-3 mt-2">
                    <div class="card">
                        <img style="height: 12rem;" src="img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center"> 
                            <?php
                            $id_foto = $data['id_foto'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id_foto' AND id_user='$id_user'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="proses_like.php?id_foto=<?php echo $data['id_foto'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                            <?php }else{ ?>
                            <a href="proses_like.php?id_foto=<?php echo $data['id_foto'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id_foto'");
                            echo mysqli_num_rows($like). 'Suka';

                             ?>
                             
                            <a href=""><i class="fa-regular fa-comment"></i></a>komentar
                        </div>
                    </div>
                </div>

            
            <?php } }else{ 
            
            


            $query = mysqli_query($koneksi, "SELECT * FROM gallery_foto WHERE id_user='$id_user'");
            while ($data = mysqli_fetch_array($query)) { ?>
            
                <div class="col-md-3 mt-2">
                <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['id_foto'] ?>">

                    <div class="card mb-2">
                        <img style="height: 12rem;" src="img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center"> 
                            <?php
                            $id_foto = $data['id_foto'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id_foto' AND id_user='$id_user'");
                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                            <a href="proses_like.php?id_foto=<?php echo $data['id_foto'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                            <?php }else{ ?>
                            <a href="proses_like.php?id_foto=<?php echo $data['id_foto'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                            <?php }
                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id_foto'");
                            echo mysqli_num_rows($like). 'Suka';

                             ?>
                             
                            <a href=""><i class="fa-regular fa-comment"></i></a>komentar
                        </div>
                    </div>
                </div>

            <?php } } ?>

<footer class="d-flex justify-content-center border-top mt-3 bg-light">
    <p>&copy; UKK RPL 2024 | Moch Annabilmuchtar Saifullah</p>
</footer>

<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
