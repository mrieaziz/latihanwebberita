<?php 
include 'config/koneksi.php'; include 'includes/header.php'; 
if(isset($_POST['kirim_inbox'])){
    $nama=mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email=mysqli_real_escape_string($koneksi, $_POST['email']);
    $pesan=mysqli_real_escape_string($koneksi, $_POST['pesan']);
    $tgl=date('Y-m-d H:i:s');
    mysqli_query($koneksi, "INSERT INTO contact (nama,email,pesan,tanggal) VALUES ('$nama','$email','$pesan','$tgl')");
    header("Location: contact.php?status=sukses"); exit;
}
?>
<div class="row justify-content-center"><div class="col-md-6">
    <div class="card tech-card border-0"><div class="card-header bg-white border-bottom p-4 fw-bold text-dark fs-5">Form Pengajuan Komunikasi</div>
    <div class="card-body bg-white p-4">
        <?php if(isset($_GET['status'])): ?><div class="alert alert-success py-2 small">Pesan Anda sukses diarsipkan ke database puskesmas panel!</div><?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3"><label class="form-label small fw-bold">Nama Lengkap</label><input type="text" name="nama" class="form-control" required placeholder="Masukkan nama Anda"></div>
            <div class="mb-3"><label class="form-label small fw-bold">Alamat Email Aktif</label><input type="email" name="email" class="form-control" required placeholder="name@company.com"></div>
            <div class="mb-3"><label class="form-label small fw-bold">Isi Pesan Deskripsi</label><textarea name="pesan" class="form-control" rows="4" required placeholder="Tulis rincian kebutuhan sistem Anda..."></textarea></div>
            <button type="submit" name="kirim_inbox" class="btn btn-tech-primary w-100">Kirim Pesan Integrasi</button>
        </form>
    </div></div>
</div></div>
<?php include 'includes/footer.php'; ?>