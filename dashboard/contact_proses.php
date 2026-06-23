<?php
session_start(); if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include '../config/koneksi.php';
if(isset($_GET['delete'])){
    $id = $_GET['delete']; mysqli_query($koneksi, "DELETE FROM contact WHERE id='$id'");
    header("Location: contact_proses.php"); exit;
}
$res = mysqli_query($koneksi, "SELECT * FROM contact ORDER BY tanggal DESC");
?>
<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body><div class="container-fluid"><div class="row">
    <main class="p-5 bg-light min-vh-100 col-md-10 ms-auto">
        <h3 class="fw-extrabold text-dark">Arsip Pesan Komunikasi Masuk (Anggota 5)</h3><hr>
        <a href="index.php" class="btn btn-sm btn-tech-secondary mb-3">&larr; Kembali Dashboard</a>
        <table class="table bg-white border align-middle shadow-sm">
            <thead class="table-light"><tr><th>Nama</th><th>Email Pengirim</th><th>Isi Deskripsi Pesan</th><th>Opsi</th></tr></thead>
            <tbody>
                <?php if(mysqli_num_rows($res)==0): ?><tr><td colspan="4" class="text-center text-muted py-3">Belum ada data pesan inbound masuk.</td></tr><?php endif; ?>
                <?php while($r=mysqli_fetch_assoc($res)): ?>
                <tr><td><strong><?= $r['nama']; ?></strong></td><td><code><?= $r['email']; ?></code></td><td class="small text-secondary"><?= $r['pesan']; ?></td><td><a href="contact_proses.php?delete=<?= $r['id']; ?>" class="btn btn-danger btn-sm rounded-3" onclick="return confirm('Hapus?')">Hapus</a></td></tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</div></div></body></html>