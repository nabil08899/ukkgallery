<?php
// Tentukan direktori penyimpanan gambar
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Periksa apakah file yang diunggah adalah gambar
if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
  if ($check !== false) {
    echo "File adalah gambar - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File bukan gambar.";
    $uploadOk = 0;
  }
}

// Periksa apakah file sudah ada
if (file_exists($target_file)) {
  echo "Maaf, file sudah ada.";
  $uploadOk = 0;
}

// Periksa ukuran file (limit ke 500KB)
if ($_FILES["profile_image"]["size"] > 500000) {
  echo "Maaf, file terlalu besar.";
  $uploadOk = 0;
}

// Batasi tipe file gambar yang dapat diunggah
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Maaf, hanya file JPG, JPEG, & PNG yang diizinkan.";
  $uploadOk = 0;
}

// Cek apakah upload bisa dilakukan
if ($uploadOk == 0) {
  echo "Maaf, file tidak dapat diunggah.";
} else {
  if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
    // Arahkan kembali ke form.php dengan gambar baru yang sudah diunggah
    header("Location: form.php?image=" . basename($_FILES["profile_image"]["name"]));
  } else {
    echo "Maaf, terjadi kesalahan saat mengunggah file.";
  }
}
?>
