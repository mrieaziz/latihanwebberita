<?php
session_start(); if(!isset($_SESSION['login'])){ header("Location: login.php"); exit; }
include '../config/koneksi.php';
$c2 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM berita"));
$c3 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM services"));
$c4 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM portfolio"));
$c5 = mysqli_num_rows(mysqli_query($koneksi, "SELECT id FROM contact"));
?>
<!DOCTYPE html>
<html lang="id">
<head><title>Console Panel Deck</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container-fluid"><div class="row">
    <nav class="col-md-3 col-lg-2 admin-sidebar-v2 min-vh-100 p-3 sticky-top">
        <div class="my-3 ps-2"><h4 class="fw-extrabold text-dark mb-0">✦ Console</h4><small class="text-muted font-monospace">VER 2.0.26</small></div><hr>
        <ul class="nav flex-column gap-1 mt-4">
            <li><a class="admin-link_v2 admin-link-v2 active" href="index.php">📊 Operational Stats</a></li>
            <li><a class="admin-link-v2" href="profile_proses.php">🏢 Kelola Profile (A1)</a></li>
            <li><a class="admin-link-v2" href="berita_proses.php">📰 Kelola Berita (A2)</a></li>
            <li><a class="admin-link-v2" href="services_proses.php">⚙️ Kelola Services (A3)</a></li>
            <li><a class="admin-link-v2" href="portfolio_proses.php">💼 Kelola Portfolio (A4)</a></li>
            <li><a class="admin-link-v2" href="contact_proses.php">📥 Pesan Masuk (A5)</a></li>
            <li><hr></li>
            <li><a class="nav-link text-danger fw-bold ps-3" href="logout.php" onclick="return confirm('Keluar?')">🚪 Log Out</a></li>
        </ul>
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
        <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
            <div><h2 class="fw-extrabold mb-0" style="color:var(--tech-dark);">Control Deck</h2><p class="text-muted small mb-0">Status Operator Aktif: <strong><?= $_SESSION['username']; ?></strong>.</p></div>
            <a href="../index.php" target="_blank" class="btn btn-sm btn-tech-secondary">Tinjau Situs Depan</a>
        </div>
        <div class="row g-3 mb-4 text-center">
            <div class="col-6 col-lg-3"><div class="metric-card-v2 shadow-sm"><h6>Berita (A2)</h6><h2 class="fw-extrabold" style="color:var(--tech-primary);"><?= $c2; ?></h2></div></div>
            <div class="col-6 col-lg-3"><div class="metric-card-v2 shadow-sm"><h6>Services (A3)</h6><h2 class="fw-extrabold" style="color:#0ea5e9;"><?= $c3; ?></h2></div></div>
            <div class="col-6 col-lg-3"><div class="metric-card-v2 shadow-sm"><h6>Portfolio (A4)</h6><h2 class="fw-extrabold" style="color:#10b981;"><?= $c4; ?></h2></div></div>
            <div class="col-6 col-lg-3"><div class="metric-card-v2 shadow-sm"><h6>Inbox (A5)</h6><h2 class="fw-extrabold" style="color:#ef4444;"><?= $c5; ?></h2></div></div>
        </div>
        <div class="card border-0 shadow-sm p-4 bg-white rounded-4">
            <h5 class="fw-bold text-dark mb-3">Matrix Validasi Laporan Komponen</h5>
            <table class="table align-middle mb-0" style="font-size:0.85rem;">
                <thead class="table-light"><tr><th>Modul Kerja</th><th>Pelaksana</th><th>Status Kompatibilitas</th></tr></thead>
                <tbody>
                    <tr><td><strong>Profile Perusahaan</strong></td><td>Anggota 1</td><td><span class="badge bg-indigo-subtle text-primary" style="background-color:#eef2ff;">Secure Database Linked</span></td></tr>
                    <tr><td><strong>Information Center</strong></td><td>Anggota 2</td><td><span class="badge bg-indigo-subtle text-primary" style="background-color:#eef2ff;">CRUD Validated</span></td></tr>
                    <tr><td><strong>Technical Services</strong></td><td>Anggota 3</td><td><span class="badge bg-indigo-subtle text-primary" style="background-color:#eef2ff;">CRUD Validated</span></td></tr>
                    <tr><td><strong>Case Portfolio</strong></td><td>Anggota 4</td><td><span class="badge bg-indigo-subtle text-primary" style="background-color:#eef2ff;">CRUD Validated</span></td></tr>
                    <tr><td><strong>Inbox Integrasi Kontak</strong></td><td>Anggota 5</td><td><span class="badge bg-indigo-subtle text-primary" style="background-color:#eef2ff;">Data Inbound Enabled</span></td></tr>
                </tbody>
            </table>
        </div>
    </main>
</div></div></body></html>