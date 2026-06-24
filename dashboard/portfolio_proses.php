<?php
session_start(); 
if(!isset($_SESSION['login'])){ 
    header("Location: login.php"); 
    exit; 
}
include '../config/koneksi.php';

// Proses Insert Data
if(isset($_POST['insert_port'])){
    $p = mysqli_real_escape_string($koneksi, $_POST['proyek']);
    $k = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $d = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    mysqli_query($koneksi, "INSERT INTO portfolio (nama_proyek,kategori,deskripsi) VALUES ('$p','$k','$d')");
    header("Location: portfolio_proses.php"); 
    exit;
}

// Proses Delete Data
if(isset($_GET['delete'])){
    $id = $_GET['delete']; 
    mysqli_query($koneksi, "DELETE FROM portfolio WHERE id='$id'");
    header("Location: portfolio_proses.php"); 
    exit;
}

// Ambil Data
$res = mysqli_query($koneksi, "SELECT * FROM portfolio ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Log Hasil Karya Proyek</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="../assets/css/style.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }
        .header-gradient {
            background: linear-gradient(90deg, #4f46e5 0%, #6366f1 100%);
            color: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.2);
        }
        .custom-card {
            border: none;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .custom-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #4f46e5;
        }
        .form-control:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.15);
        }
        .btn-primary-custom {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            border: none;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.3);
            background: linear-gradient(135deg, #4338ca 0%, #3730a3 100%);
        }
        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e2e8f0;
        }
        .badge-category {
            background-color: #eeebff;
            color: #4f46e5;
            font-weight: 500;
            border: 1px solid #e0daff;
        }
        .btn-delete {
            background-color: #fee2e2;
            color: #ef4444;
            transition: all 0.2s;
        }
        .btn-delete:hover {
            background-color: #ef4444;
            color: white;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center header-gradient mb-5 gap-3">
                <div>
                    <h2 class="fw-bold m-0 d-flex align-items-center gap-2">
                        <i class="bi bi-journal-bookmark-fill"></i> Log Hasil Karya Proyek
                    </h2>
                    <p class="text-white-50 m-0 mt-1">Manajemen portofolio hasil pengerjaan proyek (Anggota 4)</p>
                </div>
                <div>
                    <a href="index.php" class="btn btn-light btn-sm px-4 py-2 rounded-3 fw-medium text-primary shadow-sm">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-5">
                    <div class="card custom-card p-4 sticky-top" style="top: 30px; z-index: 10;">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="p-2 bg-primary bg-opacity-10 text-primary rounded-3 d-inline-flex">
                                <i class="bi bi-plus-circle-fill"></i>
                            </span>
                            Tambah Portofolio
                        </h5>
                        
                        <form action="" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" name="proyek" class="form-control rounded-3" id="floatingProyek" placeholder="Masukkan judul proyek" required>
                                <label for="floatingProyek">Judul Karya Proyek</label>
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" name="kategori" class="form-control rounded-3" id="floatingKategori" placeholder="Contoh: Mobile App, UI/UX" required>
                                <label for="floatingKategori">Kluster Kategori</label>
                            </div>
                            
                            <div class="form-floating mb-4">
                                <textarea name="deskripsi" class="form-control rounded-3" id="floatingDeskripsi" placeholder="Gambahkan deskripsi..." style="height: 120px" required></textarea>
                                <label for="floatingDeskripsi">Uraian Kasus Proyek</label>
                            </div>
                            
                            <button type="submit" name="insert_port" class="btn btn-primary-custom text-white w-100 py-3 rounded-3 fw-semibold">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i>Arsipkan Portofolio
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card custom-card p-4 h-100">
                        <h5 class="fw-bold text-dark mb-4 d-flex align-items-center gap-2">
                            <span class="p-2 bg-secondary bg-opacity-10 text-secondary rounded-3 d-inline-flex">
                                <i class="bi bi-collection-fill"></i>
                            </span>
                            Daftar Karya Terdaftar
                        </h5>
                        
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-3">Detail Proyek</th>
                                        <th class="py-3">Kategori</th>
                                        <th class="py-3 text-end px-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="small">
                                    <?php if(mysqli_num_rows($res) > 0): ?>
                                        <?php while($r = mysqli_fetch_assoc($res)): ?>
                                        <tr>
                                            <td class="py-3 px-3">
                                                <div class="fw-bold text-dark mb-1" style="font-size: 0.95rem;"><?= htmlspecialchars($r['nama_proyek']); ?></div>
                                                <span class="text-muted d-block text-truncate" style="max-width: 260px; font-size: 0.85rem;">
                                                    <?= htmlspecialchars($r['deskripsi'] ?? '-'); ?>
                                                </span>
                                            </td>
                                            <td class="py-3">
                                                <span class="badge badge-category px-3 py-2 rounded-pill">
                                                    <i class="bi bi-tag-fill me-1" style="font-size: 0.75rem;"></i>
                                                    <?= htmlspecialchars($r['kategori']); ?>
                                                </span>
                                            </td>
                                            <td class="py-3 text-end px-3">
                                                <a href="portfolio_proses.php?delete=<?= $r['id']; ?>" class="btn btn-delete btn-sm p-2 rounded-3 border-0" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus Data">
                                                    <i class="bi bi-trash3-fill fs-6"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="text-center py-5 text-muted">
                                                <div class="py-4">
                                                    <i class="bi bi-folder2-open d-block text-secondary opacity-25 mb-3" style="font-size: 3.5rem;"></i>
                                                    <span class="fw-medium text-secondary">Belum ada data portofolio yang tersimpan.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>