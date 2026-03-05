<?php
$pageTitle = 'لوحة التحكم';
include __DIR__ . '/includes/header.php';
$stats = [
    'المنتجات' => ['table' => 'products', 'condition' => "status = 'active'", 'icon' => 'fa-boxes-stacked', 'color' => 'primary'],
    'الفئات' => ['table' => 'product_categories', 'condition' => "status = 'active'", 'icon' => 'fa-tags', 'color' => 'success'],
    'الأخبار' => ['table' => 'posts', 'condition' => "status = 'published'", 'icon' => 'fa-newspaper', 'color' => 'info'],
    'الرسائل غير المقروءة' => ['table' => 'contacts', 'condition' => "status = 'unread'", 'icon' => 'fa-envelope', 'color' => 'warning'],
];
$pdo = getDB();
$counts = [];
foreach ($stats as $key => $meta) {
    if (!adminTableExists($pdo, $meta['table'])) {
        $counts[$key] = 0;
        continue;
    }
    $counts[$key] = (int)$pdo->query("SELECT COUNT(*) FROM {$meta['table']} WHERE {$meta['condition']}")->fetchColumn();
}
?>
<div class="container-fluid">
    <h1 class="h3 mb-4">لوحة تحكم Mad362</h1>
    <div class="row">
        <?php foreach ($stats as $title => $meta): ?>
        <div class="col-md-6 col-xl-3 mb-3">
            <div class="card border-left-<?php echo $meta['color']; ?> h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-muted small"><?php echo $title; ?></div>
                        <div class="h4 mb-0"><?php echo $counts[$title]; ?></div>
                    </div>
                    <i class="fas <?php echo $meta['icon']; ?> fa-2x text-secondary"></i>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="alert alert-info">تمت إعادة هيكلة لوحة التحكم وإضافة كل صفحات الإدارة الأساسية (صفحات/فئات/منتجات/أخبار/شركاء/رسائل/مستخدمين/إعدادات).</div>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
