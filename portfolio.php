<?php 
include 'config/koneksi.php'; include 'includes/header.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");
?>
<div class="row">
    <div class="col-md-12 text-center mb-4"><h2 class="fw-extrabold text-dark">Studi Kasus Proyek Sukses</h2><hr class="w-25 mx-auto"></div>
    <?php if(mysqli_num_rows($query)==0): ?><div class="col-12 text-center"><p class="text-muted p-4 bg-white border rounded-4">Dokumentasi pelaporan karya belum terunggah.</p></div><?php endif; ?>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-6 mb-4"><div class="card p-4 tech-card h-100">
            <span class="badge bg-light text-primary align-self-start px-3 py-2 rounded mb-3" style="font-weight:600;"><?= $row['kategori']; ?></span>
            <h5 class="fw-bold text-dark mb-2"><?= $row['nama_proyek']; ?></h5>
            <p class="text-secondary small lh-base mt-2"><?= nl2br($row['deskripsi']); ?></p>
        </div></div>
    <?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>