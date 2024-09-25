<?php
// Periksa apakah parameter 'id' ada di URL
if (!isset($_GET['id'])) {
    // Jika tidak ada, redirect ke halaman lain atau tampilkan pesan kesalahan
    die("Error: ID tidak ditemukan.");
}

$id = $_GET['id']; // Ambil id dari parameter URL

// Cek apakah ID valid dan ambil data foto
$details = mysqli_query($koneksi, "SELECT * FROM gallery_foto INNER JOIN user ON foto.id_user=user.id_user WHERE foto.id_foto='$id'");
$data = mysqli_fetch_array($details);

if (!$data) {
    // Jika foto tidak ditemukan, beri pesan kesalahan
    die("Error: Foto tidak ditemukan.");
}


$likes = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id'"));
// Hitung jumlah komentar pada foto tersebut
$jumlahKomentar = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE id_foto='$id'"));

$cek = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM likefoto WHERE id_foto='$id' AND id_user='" . @$_SESSION['id_user'] . "'"));


// Proses pengiriman komentar sebelum output HTML
if (isset($_POST['submit']) && $_POST['submit'] == 'Kirim') {
    $komentar = $_POST['komentar'];
    $id_foto = $_POST['id_foto'];
    $id_user = $_SESSION['id_user'];
    $tanggal = date('Y-m-d');

    $komen = mysqli_query($koneksi, "INSERT INTO komentarfoto VALUES('', '$id_foto', '$id_user', '$komentar', '$tanggal')");
    header("Location: ?url=detail&&id=$id_foto");
    exit; // Pastikan script berhenti setelah header redirect
}

?>


<style>
    .comments-container {
        max-height: 300px;
        /* Atur tinggi maksimal container komentar */
        overflow-y: auto;
        /* Aktifkan scroll jika komentar melebihi tinggi */
    }

    .sticky-comment-form {
        position: relative;
        bottom: 0;
        width: 100%;
    }
</style>


<div class="container my-5">
    <!-- Card Utama -->
    <div class="card shadow-lg border-0" style="border-radius: 15px;">
        <div class="row">
            <!-- Bagian Foto -->
            <div class="col-lg-6 col-md-12">
                <div class="card-body p-0">
                    <a href="img/<?= $data['lokasifile'] ?>" target="_blank">
                        <img src="img/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>" class="img-fluid w-100" style="border-radius: 15px 0 0 15px;">
                    </a>
                </div>
            </div>

            


                    <!-- Tampilan Jumlah Komentar -->
                    <p class="fw-bold"><?= $jumlahKomentar ?> Komentar</p>

                    <!-- Tampilan Semua Komentar -->
                    <div class="comments-container mt-4 flex-grow-1">
                        <?php
                        $id_user = @$_SESSION["id_user"];
                        $komen = mysqli_query($koneksi, "SELECT * FROM komentarfoto 
                                   INNER JOIN user ON komentarfoto.id_user=user.id_user 
                                   WHERE komentarfoto.id_foto='$id'");

                        foreach ($komen as $komens): ?>
                            <div class="border-bottom pb-2 mb-3">
                                <p class="mb-1 fw-semibold small"><?= $komens['Username'] ?>
                                    <span class="text-muted small"><?= $komens['tanggalkomentar'] ?></span>
                                </p>
                                <p class="mb-2 small"><?= $komens['IsiKomentar'] ?></p>

                                <?php if (isset($_SESSION['user_id']) && $komens['id_user'] == $_SESSION['id_user']): ?>
                                    <div class="d-flex align-items-center">
                                        <form action="?url=detail&&id=<?= $id ?>&&hapus_komen=<?= $komens['KomentarID'] ?>" method="post" class="mr-2">
                                            <button type="submit" name="hapus" class="btn btn-sm btn-outline-danger" style="border-radius: 50px;">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $komens['KomentarID'] ?>" style="border-radius: 50px;">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </button>
                                        <!-- Modal Edit Komentar -->
                                        <div class="modal fade" id="editModal<?= $komens['KomentarID'] ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Komentar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="?url=detail&&id=<?= $id ?>&&edit_komen=<?= $komens['KomentarID'] ?>" method="post" id="editForm<?= $komens['KomentarID'] ?>">
                                                            <div class="form-group">
                                                                <label for="editKomentar">Komentar:</label>
                                                                <textarea name="editKomentar" class="form-control form-control-sm" rows="3" required style="border-radius: 10px;"><?= $komens['IsiKomentar'] ?></textarea>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" style="border-radius: 50px;">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 50px;">Simpan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>


                    <?php
                    // Ambil data komentar
                    $komen_id = @$_GET["komentar_id"];
                    $submit = @$_POST['submit'];
                    $komentar = @$_POST['komentar'];
                    $foto_id = @$_POST['foto_id'];
                    $user_id = @$_SESSION['user_id'];
                    $tanggal = date('Y-m-d');
                    $dataKomentar = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM komentarfoto WHERE KomentarID='$komen_id' AND UserID='$user_id' AND FotoID='$foto_id'"));
                    if ($submit == 'Kirim') {
                        $komen = mysqli_query($conn, "INSERT INTO komentarfoto VALUES('', '$foto_id', '$user_id', '$komentar', '$tanggal')");
                        header("Location: ?url=detail&&id=$foto_id");
                    } elseif ($submit == 'Edit') {
                        // Proses edit komentar
                    }
                    ?>

                    <!-- Form Tambah Komentar -->
                    <div class="sticky-comment-form mt-4">
                        <form action="" method="post" class="mb-4">
                            <div class="form-group d-flex flex-column flex-md-row align-items-stretch">
                                <input type="hidden" name="foto_id" value="<?= $data['FotoID'] ?>">
                                <!-- Kolom komentar aktif jika user login -->
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <input type="text" class="form-control form-control-sm mb-2 mb-md-0 mr-md-2" name="komentar" required placeholder="Masukan Komentar" style="border-radius: 50px; padding: 10px;">
                                    <button type="submit" value="Kirim" name="submit" class="btn btn-sm btn-primary" style="border-radius: 50px;">
                                        <i class="fa-solid fa-paper-plane" style="padding: 10px;"></i>
                                    </button>
                                <?php else: ?>
                                    <!-- Kolom komentar tidak aktif jika user belum login -->
                                    <input type="text" class="form-control form-control-sm mb-2 mb-md-0 mr-md-2" placeholder="Masukan Komentar (login terlebih dahulu)" disabled style="border-radius: 50px; padding: 10px;">
                                    <a href="login.php" class="btn btn-sm btn-primary" style="border-radius: 50px;padding: 10px;">Login</a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Proses penghapusan komentar
if (isset($_GET['hapus_komen'])) {
    $komentar_id = $_GET['hapus_komen'];
    $cekKomentar = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE KomentarID='$komentar_id' AND UserID='" . $_SESSION['user_id'] . "'");
    if (mysqli_num_rows($cekKomentar) > 0) {
        $hapusKomentar = mysqli_query($conn, "DELETE FROM komentarfoto WHERE KomentarID='$komentar_id'");
    }
}

// Proses pengeditan komentar
if (isset($_GET['edit_komen']) && isset($_POST['editKomentar'])) {
    $komentar_id = $_GET['edit_komen'];
    $editKomentar = $_POST['editKomentar'];
    $cekKomentar = mysqli_query($conn, "SELECT * FROM komentarfoto WHERE KomentarID='$komentar_id' AND UserID='" . $_SESSION['user_id'] . "'");
    if (mysqli_num_rows($cekKomentar) > 0) {
        $updateKomentar = mysqli_query($conn, "UPDATE komentarfoto SET IsiKomentar='$editKomentar' WHERE KomentarID='$komentar_id'");
    }
}
?>