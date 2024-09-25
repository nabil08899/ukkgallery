<!DOCTYPE html>
<html>
<head>
  <title>Profil Pengguna</title>
  <style>
    .profile-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 20px;
    }

    .profile-image {
      position: relative;
      width: 150px;
      height: 150px;
      border-radius: 50%;
      overflow: hidden;
      margin-bottom: 20px;
    }

    .profile-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .change-image {
      position: absolute;
      bottom: 10px;
      right: 10px;
      padding: 5px 10px;
      background-color: #f0f0f0;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }

    .profile-info {
      width: 100%;
    }

    .profile-info label {
      display: block;
      margin-bottom: 5px;
    }

    .profile-info input,
    .profile-info textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .profile-info button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: all 0.3s ease-in-out;
    }

    .profile-info button:hover {
      background-color: #0069d9;
    }

    .profile-info button:active {
      transform: scale(0.95);
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <div class="profile-image">
      <!-- Gambar profil yang akan diubah -->
      <?php
        $imagePath = 'uploads/default.png'; // Default image path
        if (isset($_GET['image'])) {
          $imagePath = 'uploads/' . $_GET['image']; // Tampilkan gambar yang diunggah
        }
      ?>
      <img id="profile-image" src="<?php echo $imagePath; ?>" alt="Foto Profil">
      <label for="image-upload" class="change-image">Ganti</label>
      <input type="file" id="image-upload" accept="image/*" style="display: none;" onchange="document.getElementById('upload-form').submit();">
    </div>
    
    <!-- Form untuk upload gambar -->
    <form id="upload-form" action="upload .php" method="POST" enctype="multipart/form-data">
      <input type="file" name="profile_image" id="profile_image" accept="image/*" style="display: none;">
      <button type="submit" style="display:none;">Unggah</button>
    </form>

    <div class="profile-info">
      <label for="first-name">Nama depan</label>
      <input type="text" id="first-name" value="Annabil">
      
      <label for="last-name">Nama belakang</label>
      <input type="text" id="last-name" value="Muchtar Saifulah 15">
      
      <label for="about">Tentang</label>
      <textarea id="about" rows="5">Ceritakan kisah Anda</textarea>
      
      <label for="website">Situs web</label>
      <input type="url" id="website" placeholder="Tambahkan tautan untuk mendorong lalu lintas ke situs Anda">
      
      <label for="username">Nama pengguna</label>
      <input type="text" id="username" value="amuchtarsaifulah15">
      
      <button type="reset">Atur ulang</button>
      <button type="submit">Simpan</button>
    </div>
  </div>

  <script>
    const imageUpload = document.getElementById('image-upload');
    const profileImage = document.getElementById('profile_image');

    imageUpload.addEventListener('click', function() {
      profileImage.click(); // Klik input file saat label diklik
    });
  </script>
</body>
</html>
