<?php 
include 'config/koneksi.php'; include 'includes/header.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY tanggal DESC");
?>
<div class="row">
    <div class="col-md-12 text-center mb-4"><h2 class="fw-extrabold text-dark">Rilis Informasi & Berita</h2><hr class="w-25 mx-auto"></div>
    <?php if(mysqli_num_rows($query)==0): ?><div class="col-12 text-center"><p class="text-muted p-4 bg-white border rounded-4">Arsip siaran berita masih kosong.</p></div><?php endif; ?>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-4 mb-4"><div class="card h-100 tech-card p-2">
            <div class="card-body">
                <span class="text-primary small fw-bold">PRESS RELEASE</span>
                <h5 class="fw-bold text-dark my-2"><?= $row['judul']; ?></h5>
                <small class="text-muted d-block mb-3">📅 Released: <?= date('d M Y', strtotime($row['tanggal'])); ?></small>
                <p class="text-secondary small lh-base"><?= substr($row['isi_berita'], 0, 120); ?>...</p>
            </div>
            <div class="card-footer bg-transparent border-0 pb-3"><button class="btn btn-tech-secondary btn-sm w-100">Buka Artikel Lengkap</button></div>
        </div></div>
    <?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>