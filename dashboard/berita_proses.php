<?php
session_start(); if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include '../config/koneksi.php';
if(isset($_POST['insert_news'])){
    $j = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $i = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $t = date('Y-m-d');
    mysqli_query($koneksi, "INSERT INTO berita (judul,isi_berita,tanggal) VALUES ('$j','$i','$t')");
    header("Location: berita_proses.php"); exit;
}
if(isset($_GET['delete'])){
    $id = $_GET['delete']; mysqli_query($koneksi, "DELETE FROM berita WHERE id='$id'");
    header("Location: berita_proses.php"); exit;
}
$res = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body><div class="container-fluid"><div class="row">
    <main class="p-5 bg-light min-vh-100 col-md-10 ms-auto">
        <h3 class="fw-extrabold text-dark">Manajemen Informasi Berita (Anggota 2)</h3><hr>
        <a href="index.php" class="btn btn-sm btn-tech-secondary mb-3">&larr; Kembali</a>
        <form action="" method="POST" class="card p-4 mb-4 border-0 rounded-4 shadow-sm">
            <div class="mb-3"><label class="form-label small fw-bold">Judul Rilis</label><input type="text" name="judul" class="form-control" required></div>
            <div class="mb-3"><label class="form-label small fw-bold">Isi Artikel Konten</label><textarea name="isi" class="form-control" rows="3" required></textarea></div>
            <button type="submit" name="insert_news" class="btn btn-tech-primary">Terbitkan Informasi</button>
        </form>
        <table class="table bg-white border align-middle">
            <thead class="table-light"><tr><th>Judul Siaran</th><th>Tanggal Rilis</th><th>Opsi</th></tr></thead>
            <tbody>
                <?php while($r=mysqli_fetch_assoc($res)): ?>
                <tr><td><strong><?= $r['judul']; ?></strong></td><td><?= $r['tanggal']; ?></td><td><a href="berita_proses.php?delete=<?= $r['id']; ?>" class="btn btn-danger btn-sm rounded-3" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div></div></body></html>