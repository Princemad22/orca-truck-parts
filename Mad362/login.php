<?php
session_start();
if (isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    try {
        $pdo = getDB();
        $stmt = $pdo->prepare('SELECT id,username,password,role FROM users WHERE username=? OR email=? LIMIT 1');
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch();
        if (!$user && $username === 'root' && $password === 'root') {
            $_SESSION['user_id'] = 0; $_SESSION['username'] = 'root'; $_SESSION['role'] = 'super_admin'; $_SESSION['force_password_change'] = true;
            header('Location: index.php'); exit;
        }
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id']; $_SESSION['username'] = $user['username']; $_SESSION['role'] = $user['role'];
            header('Location: index.php'); exit;
        }
        $error = 'بيانات الدخول غير صحيحة';
    } catch (Exception $e) { $error = 'تعذر تسجيل الدخول'; }
}
?>
<!doctype html><html lang="ar" dir="rtl"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Mad362 Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"><link rel="stylesheet" href="css/admin.css"></head>
<body class="bg-light"><div class="container"><div class="row min-vh-100 align-items-center justify-content-center"><div class="col-md-4"><div class="card shadow"><div class="card-body"><h4 class="mb-3 text-center">دخول Mad362</h4><?php if($error):?><div class="alert alert-danger"><?php echo htmlspecialchars($error);?></div><?php endif;?><form method="post"><input class="form-control mb-2" name="username" placeholder="اسم المستخدم / البريد" required><input type="password" class="form-control mb-3" name="password" placeholder="كلمة المرور" required><button class="btn btn-primary w-100">دخول</button></form><small class="text-muted d-block mt-3">الحساب الأولي: root / root (ويُنصح تغييره فوراً).</small></div></div></div></div></div></body></html>
