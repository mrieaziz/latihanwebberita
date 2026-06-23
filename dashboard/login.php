<?php
session_start(); include '../config/koneksi.php';
if(isset($_SESSION['login'])){ header("Location: index.php"); exit; }
if(isset($_POST['sign_in'])){
    $u = mysqli_real_escape_string($koneksi, $_POST['user']);
    $p = $_POST['pass'];
    $res = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$u'");
    if(mysqli_num_rows($res) === 1){
    $r = mysqli_fetch_assoc($res);
    // Pengecekan mencocokkan teks password secara langsung
    if($p === $r['password']){
        $_SESSION['login'] = true; 
        $_SESSION['username'] = $r['username'];
        header("Location: index.php"); 
        exit;
    }
}
    $fail = true;
}
?>
<!DOCTYPE html>
<html lang="id"><head><title>Console Sign In</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link href="../assets/css/style.css" rel="stylesheet"></head>
<body class="body-login-v2"><div class="p-3" style="width:100%; max-width:380px;">
    <div class="card border-0 shadow-sm rounded-4"><div class="card-body p-4">
        <h4 class="text-center fw-extrabold mb-4" style="color:var(--tech-dark);">Console Login</h4>
        <?php if(isset($fail)): ?><div class="alert alert-danger py-2 small text-center">Akses Kredensial Tidak Sah!</div><?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3"><label class="form-label small fw-semibold">User Otoritas</label><input type="text" name="user" class="form-control" required placeholder="admin"></div>
            <div class="mb-3"><label class="form-label small fw-semibold">Password</label><input type="password" name="pass" class="form-control" required placeholder="admin123"></div>
            <button type="submit" name="sign_in" class="btn btn-tech-primary w-100 fw-bold mt-2">Masuk Panel</button>
        </form>
    </div></div>
</div></body></html>