<?php
session_start(); if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include '../config/koneksi.php';
if(isset($_POST['insert_svc'])){
    $n = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $d = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    mysqli_query($koneksi, "INSERT INTO services (nama_layanan,deskripsi) VALUES ('$n','$d')");
    header("Location: services_proses.php"); exit;
}
if(isset($_GET['delete'])){
    $id = $_GET['delete']; mysqli_query($koneksi, "DELETE FROM services WHERE id='$id'");
    header("Location: services_proses.php"); exit;
}
$res = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body><div class="container-fluid"><div class="row">
    <main class="p-5 bg-light min-vh-100 col-md-10 ms-auto">
        <h3 class="fw-extrabold text-dark">Katalog Jasa Agensi (Anggota 3)</h3><hr>
        <a href="index.php" class="btn btn-sm btn-tech-secondary mb-3">&larr; Kembali</a>
        <form action="" method="POST" class="card p-4 mb-4 border-0 rounded-4 shadow-sm">
            <div class="mb-3"><label class="form-label small fw-bold">Nama Kluster Layanan</label><input type="text" name="nama" class="form-control" required></div>
            <div class="mb-3"><label class="form-label small fw-bold">Deskripsi Teknis Jasa</label><textarea name="deskripsi" class="form-control" rows="3" required></textarea></div>
            <button type="submit" name="insert_svc" class="btn btn-tech-primary">Simpan Kluster Jasa</button>
        </form>
        <table class="table bg-white border align-middle">
            <thead class="table-light"><tr><th>Nama Layanan</th><th>Deskripsi Fungsi</th><th>Opsi</th></tr></thead>
            <tbody>
                <?php while($r=mysqli_fetch_assoc($res)): ?>
                <tr><td><strong><?= $r['nama_layanan']; ?></strong></td><td class="small text-muted"><?= $r['deskripsi']; ?></td><td><a href="services_proses.php?delete=<?= $r['id']; ?>" class="btn btn-danger btn-sm rounded-3" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div></div></body></html>