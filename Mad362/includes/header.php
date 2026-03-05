<?php
require_once __DIR__ . '/admin_bootstrap.php';
$pageTitle = $pageTitle ?? 'Mad362';
$currentPage = basename($_SERVER['PHP_SELF']);
$navItems = [
    'index.php' => ['لوحة التحكم', 'fa-gauge'],
    'pages.php' => ['الصفحات', 'fa-file-lines'],
    'categories.php' => ['الفئات', 'fa-tags'],
    'products.php' => ['المنتجات', 'fa-boxes-stacked'],
    'news.php' => ['الأخبار', 'fa-newspaper'],
    'testimonials.php' => ['آراء العملاء', 'fa-comments'],
    'partners.php' => ['الشركاء', 'fa-handshake'],
    'contacts.php' => ['الرسائل', 'fa-envelope'],
    'users.php' => ['المستخدمون', 'fa-users'],
    'settings.php' => ['الإعدادات', 'fa-gear'],
];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo escape($pageTitle); ?> - Mad362</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="wrapper">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse show">
        <div class="position-sticky pt-3">
            <h6 class="px-3">Mad362</h6>
            <ul class="nav flex-column">
                <?php foreach ($navItems as $file => [$label, $icon]): ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage === $file ? 'active' : ''; ?>" href="<?php echo $file; ?>">
                            <i class="fas <?php echo $icon; ?> ms-2"></i><?php echo $label; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>

    <div class="main-panel col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <nav class="navbar navbar-expand navbar-light bg-light mb-4 mt-2 rounded">
            <div class="container-fluid">
                <span class="navbar-text">مرحباً <?php echo escape($_SESSION['username']); ?></span>
                <a class="btn btn-outline-danger btn-sm" href="logout.php">تسجيل الخروج</a>
            </div>
        </nav>
        <div class="content">
