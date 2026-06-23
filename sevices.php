<?php 
include 'config/koneksi.php'; include 'includes/header.php'; 
$query = mysqli_query($koneksi, "SELECT * FROM services ORDER BY id DESC");
?>
<div class="row">
    <div class="col-md-12 text-center mb-4"><h2 class="fw-extrabold text-dark">Spesifikasi Layanan Solusi</h2><hr class="w-25 mx-auto"></div>
    <?php if(mysqli_num_rows($query)==0): ?><div class="col-12 text-center"><p class="text-muted p-4 bg-white border rounded-4">Katalog spesifikasi penawaran kosong.</p></div><?php endif; ?>
    <?php while($row = mysqli_fetch_assoc($query)): ?>
        <div class="col-md-4 mb-4"><div class="card h-100 tech-card p-3 border-top border-primary border-4">
            <div class="card-body p-0">
                <h5 class="fw-bold text-dark mb-2">✦ <?= $row['nama_layanan']; ?></h5>
                <p class="text-secondary small lh-relaxed"><?= nl2br($row['deskripsi']); ?></p>
            </div>
        </div></div>
    <?php endwhile; ?>
</div>
<?php include 'includes/footer.php'; ?>