<?php
// 1. AKTIFKAN PELACAK ERROR TERDEPAN
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. KONTROL SESSION
session_start(); 
if(!isset($_SESSION['login'])){ 
    header("Location: login.php"); 
    exit; 
}

// 3. KONEKSI DATABASE
include '../config/koneksi.php'; 

$status_msg = "";
$status_type = "";

// 4. PROSES TAMBAH BERITA
if(isset($_POST['insert_news'])){
    $judul = $_POST['judul'];
    $isi   = $_POST['isi'];
    $tgl   = date('Y-m-d');
    
    $stmt = mysqli_prepare($koneksi, "INSERT INTO berita (judul, isi_berita, tanggal) VALUES (?, ?, ?)");
    if($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $judul, $isi, $tgl);
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION['msg'] = "Informasi baru berhasil dipublikasikan!";
            $_SESSION['msg_type'] = "success";
        } else {
            $_SESSION['msg'] = "Gagal memproses data.";
            $_SESSION['msg_type'] = "danger";
        }
        mysqli_stmt_close($stmt);
    }
    header("Location: berita_proses.php"); 
    exit;
}

// 5. PROSES HAPUS BERITA
if(isset($_GET['delete'])){
    $id = $_GET['delete']; 
    
    $stmt = mysqli_prepare($koneksi, "DELETE FROM berita WHERE id = ?");
    if($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if(mysqli_stmt_execute($stmt)) {
            $_SESSION['msg'] = "Arsip berita berhasil dibersihkan.";
            $_SESSION['msg_type'] = "info";
        } else {
            $_SESSION['msg'] = "Gagal menghapus arsip.";
            $_SESSION['msg_type'] = "danger";
        }
        mysqli_stmt_close($stmt);
    }
    header("Location: berita_proses.php"); 
    exit;
}

// Mengambil pesan session jika ada
if(isset($_SESSION['msg'])) {
    $status_msg = $_SESSION['msg'];
    $status_type = $_SESSION['msg_type'];
    unset($_SESSION['msg']);
    unset($_SESSION['msg_type']);
}

// 6. AMBIL DATA UNTUK GRID PANEL
$res = mysqli_query($koneksi, "SELECT * FROM berita ORDER BY id DESC");
$total_data = ($res) ? mysqli_num_rows($res) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MindVibe Studio - Control Center</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --mv-indigo: #4338ca;
            --mv-indigo-light: #f5f3ff;
            --mv-border: #e2e8f0;
        }
        body {
            background-color: #fafafa;
            color: #1e293b;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .workspace-card {
            border: 1px solid var(--mv-border);
            border-radius: 20px;
            background-color: #ffffff;
        }
        .form-input-neon:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(129, 140, 248, 0.15);
        }
        .data-item {
            border: 1px solid var(--mv-border);
            border-radius: 14px;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        .data-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.03);
            border-color: #cbd5e1;
        }
        .badge-date {
            background-color: var(--mv-indigo-light);
            color: var(--mv-indigo);
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="border-bottom bg-white sticky-top">
    <div class="container-fluid px-4 py-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-dark text-white rounded-3 px-2 py-1 small fw-bold">MV</div>
            <h5 class="fw-bold mb-0 text-dark">MindVibe <span class="text-muted fw-normal fs-6">/ Control Panel</span></h5>
        </div>
        <a href="index.php" class="btn btn-light btn-sm border rounded-3 px-3 fw-medium">
            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Landing Page
        </a>
    </div>
</div>

<div class="container-fluid px-4 py-5">
    
    <?php if($status_msg != ""): ?>
        <div class="alert alert-white border shadow-sm rounded-4 d-flex align-items-center justify-content-between p-3 mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle-fill text-primary me-3 fs-5" style="color: var(--mv-indigo) !important;"></i>
                <span class="small fw-medium text-secondary"><?= $status_msg; ?></span>
            </div>
            <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        
        <div class="col-lg-6">
            <div class="workspace-card p-4 p-md-5">
                <div class="mb-4">
                    <span class="badge bg-dark rounded-pill px-3 py-1 mb-2">Anggota 2 Workspace</span>
                    <h3 class="fw-bold text-dark">Publikasikan Artikel Baru</h3>
                    <p class="text-muted small">Isi formulir di bawah ini untuk membuat siaran informasi baru secara real-time.</p>
                </div>
                
                <form action="" method="POST">
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-secondary">Judul Konten Informasi</label>
                        <input type="text" name="judul" class="form-control form-input-neon rounded-3 py-2" placeholder="Tuliskan judul berita..." required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-secondary">Isi Deskripsi Pengumuman</label>
                        <textarea name="isi" class="form-control form-input-neon rounded-3" rows="7" placeholder="Ketik draf artikel disini..." required></textarea>
                    </div>
                    
                    <button type="submit" name="insert_news" class="btn text-white w-100 py-2 rounded-3 fw-semibold shadow-sm" style="background-color: var(--mv-indigo)">
                        <i class="bi bi-check-all fs-5 me-1 align-middle"></i> Sahkan & Distribusikan Berita
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="workspace-card p-4 bg-light-subtle h-100">
                <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                    <div>
                        <h5 class="fw-bold text-dark mb-1">Daftar Rilis Aktif</h5>
                        <p class="text-muted small mb-0">Memantau data siaran langsung dari database server.</p>
                    </div>
                    <span class="badge bg-secondary rounded-pill px-3 py-1 small"><?= $total_data; ?> Arsip</span>
                </div>

                <div class="d-flex flex-column gap-3 overflow-y-auto" style="max-height: 520px;">
                    <?php if($res && mysqli_num_rows($res) > 0): ?>
                        <?php while($r=mysqli_fetch_assoc($res)): ?>
                        <div class="data-item p-4">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                <h6 class="fw-bold text-dark mb-0 lh-base"><?= htmlspecialchars($r['judul']); ?></h6>
                                <span class="badge badge-date rounded-3 px-2 py-1 small text-nowrap">
                                    <?= date('d M Y', strtotime($r['tanggal'])); ?>
                                </span>
                            </div>
                            
                            <p class="text-secondary small mb-3 text-wrap">
                                <?= nl2br(htmlspecialchars($r['isi_berita'])); ?>
                            </p>
                            
                            <div class="d-flex justify-content-end border-top pt-2">
                                <a href="berita_proses.php?delete=<?= $r['id']; ?>" class="btn btn-sm btn-link link-danger text-decoration-none fw-medium p-0" onclick="return confirm('Apakah Anda yakin data rilis ini ingin dihapus selamanya?')">
                                    <i class="bi bi-trash-fill me-1"></i> Singkirkan Berita
                                </a>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="text-center py-5 bg-white border border-dashed rounded-4">
                            <div class="text-muted mb-2">
                                <i class="bi bi-window-x" style="font-size: 2.5rem; opacity: 0.4;"></i>
                            </div>
                            <h6 class="fw-semibold text-secondary mb-1">Gudang Arsip Kosong</h6>
                            <p class="text-muted small mb-0">Gunakan form di sebelah kiri untuk mengisi berita pertama Anda.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>