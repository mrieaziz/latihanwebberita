<?php
session_start(); if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include '../config/koneksi.php';
if(isset($_POST['save_prof'])){
    $sej = mysqli_real_escape_string($koneksi, $_POST['sejarah']);
    $vis = mysqli_real_escape_string($koneksi, $_POST['visi']);
    $mis = mysqli_real_escape_string($koneksi, $_POST['misi']);
    mysqli_query($koneksi, "DELETE FROM profile");
    mysqli_query($koneksi, "INSERT INTO profile (sejarah,visi,misi) VALUES ('$sej','$vis','$mis')");
    header("Location: profile_proses.php?status=success"); exit;
}
$d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM profile ORDER BY id DESC LIMIT 1"));
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body><div class="container-fluid"><div class="row">
    <main class="p-5 bg-light min-vh-100 col-md-10 ms-auto">
        <h3 class="fw-extrabold text-dark">Kelola Dokumen Profil (Anggota 1)</h3><hr>
        <a href="index.php" class="btn btn-sm btn-tech-secondary mb-3">&larr; Dashboard</a>
        <?php if(isset($_GET['status'])): ?><div class="alert alert-success py-2 small">Profil institusi berhasil dikonfigurasi ulang!</div><?php endif; ?>
        <form action="" method="POST" class="card p-4 shadow-sm border-0 rounded-4 bg-white">
            <div class="mb-3"><label class="form-label small fw-bold text-dark">Data Sejarah</label><textarea name="sejarah" class="form-control" rows="4" required><?= $d['sejarah'] ?? ''; ?></textarea></div>
            <div class="mb-3"><label class="form-label small fw-bold text-dark">Visi Utama</label><textarea name="visi" class="form-control" rows="2" required><?= $d['visi'] ?? ''; ?></textarea></div>
            <div class="mb-3"><label class="form-label small fw-bold text-dark">Misi Operasional</label><textarea name="misi" class="form-control" rows="3" required><?= $d['misi'] ?? ''; ?></textarea></div>
            <button type="submit" name="save_prof" class="btn btn-tech-primary px-4">Simpan Profil Baru</button>
        </form>
    </main>
</div></div></body></html>