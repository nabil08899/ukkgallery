<?php
// Memasukkan file koneksi
include 'koneksi.php';

// Ambil keyword dari form pencarian
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($koneksi, $_GET['keyword']) : '';

if (!empty($keyword)) {
    // SQL untuk mencari data berdasarkan keyword di judul atau deskripsi foto
    $sql = "SELECT * FROM gallery_foto WHERE judulfoto LIKE '%$keyword%' OR deskripsifoto LIKE '%$keyword%'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Menampilkan hasil pencarian
        echo "<h2>Hasil Pencarian untuk '$keyword':</h2>";
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . $row['judulfoto'] . " - " . $row['deskripsifoto'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Tidak ada hasil yang ditemukan untuk '$keyword'.";
    }
} else {
    echo "<script>
    alert ('Silakan masukkan kata kunci untuk mencari.');
    location.href='index.php';
    </script>";
}

?>
