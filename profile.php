<?php 
include 'config/koneksi.php'; include 'includes/header.php'; 
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM profile ORDER BY id DESC LIMIT 1"));
?>
<div class="row g-4">
    <div class="col-md-12 text-center mb-2">
        <h2 class="fw-extrabold text-dark">Profil Lembaga Organisasi</h2>
        <p class="text-muted small">Transparansi nilai fundamental pendirian agensi MindVibe Studio.</p>
    </div>
    <div class="col-md-12"><div class="card tech-card p-4">
        <h4 class="fw-bold text-dark mb-3" style="color:var(--tech-primary)!important;">Sejarah Singkat</h4>
        <p class="text-secondary lh-lg" style="text-align:justify;"><?= nl2br($data['sejarah'] ?? 'Data narasi sejarah belum dikonfigurasi admin.'); ?></p>
    </div></div>
    <div class="col-md-6"><div class="card tech-card p-4 h-100 border-start border-primary border-4">
        <h4 class="fw-bold text-dark mb-2">Visi Perusahaan</h4>
        <p class="text-secondary small"><?= nl2br($data['visi'] ?? 'Visi kosong.'); ?></p>
    </div></div>
    <div class="col-md-6"><div class="card tech-card p-4 h-100 border-start border-info border-4">
        <h4 class="fw-bold text-dark mb-2">Misi Operasional</h4>
        <p class="text-secondary small"><?= nl2br($data['misi'] ?? 'Misi kosong.'); ?></p>
    </div></div>
</div>
<?php include 'includes/footer.php'; ?>