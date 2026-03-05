<?php
$pageTitle = 'إدارة الصفحات';
include __DIR__ . '/includes/header.php';
if (!in_array($_SESSION['role'], ['super_admin', 'admin'], true)) {
    header('Location: index.php'); exit;
}
$pdo = getDB();
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && adminTableExists($pdo, 'pages')) {
    $action = $_POST['action'] ?? '';
    if ($action === 'save') {
        $id = (int)($_POST['id'] ?? 0);
        $data = [trim($_POST['slug']), trim($_POST['title_ar']), trim($_POST['title_en']), trim($_POST['content_ar']), trim($_POST['content_en']), $_POST['status'] ?? 'active'];
        if ($id > 0) {
            $stmt = $pdo->prepare("UPDATE pages SET slug=?, title_ar=?, title_en=?, content_ar=?, content_en=?, status=?, updated_at=NOW() WHERE id=?");
            $stmt->execute([...$data, $id]);
            $message = 'تم تحديث الصفحة.';
        } else {
            $stmt = $pdo->prepare("INSERT INTO pages (slug,title_ar,title_en,content_ar,content_en,status,created_at) VALUES (?,?,?,?,?,?,NOW())");
            $stmt->execute($data);
            $message = 'تمت إضافة الصفحة.';
        }
    }
    if ($action === 'delete') {
        $stmt = $pdo->prepare('DELETE FROM pages WHERE id = ?');
        $stmt->execute([(int)$_POST['id']]);
        $message = 'تم حذف الصفحة.';
    }
}
$pages = adminTableExists($pdo, 'pages') ? adminFetchAll($pdo, 'SELECT * FROM pages ORDER BY id DESC') : [];
$edit = ['id'=>0,'slug'=>'','title_ar'=>'','title_en'=>'','content_ar'=>'','content_en'=>'','status'=>'active'];
if (isset($_GET['edit'])) {
    foreach ($pages as $p) if ($p['id'] == (int)$_GET['edit']) $edit = $p;
}
?>
<div class="container-fluid">
<h1 class="h4 mb-3">إدارة الصفحات الثابتة</h1>
<?php if ($message): ?><div class="alert alert-success"><?php echo escape($message); ?></div><?php endif; ?>
<div class="row g-4">
<div class="col-lg-5">
<form method="post" class="card card-body">
<input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?php echo (int)$edit['id']; ?>">
<input class="form-control mb-2" name="slug" placeholder="slug" required value="<?php echo escape($edit['slug']); ?>">
<input class="form-control mb-2" name="title_ar" placeholder="العنوان عربي" required value="<?php echo escape($edit['title_ar']); ?>">
<input class="form-control mb-2" name="title_en" placeholder="العنوان English" required value="<?php echo escape($edit['title_en']); ?>">
<textarea class="form-control mb-2" name="content_ar" placeholder="المحتوى عربي"><?php echo escape($edit['content_ar']); ?></textarea>
<textarea class="form-control mb-2" name="content_en" placeholder="Content English"><?php echo escape($edit['content_en']); ?></textarea>
<select class="form-select mb-2" name="status"><option value="active" <?php echo $edit['status']==='active'?'selected':''; ?>>active</option><option value="inactive" <?php echo $edit['status']==='inactive'?'selected':''; ?>>inactive</option></select>
<button class="btn btn-primary">حفظ</button>
</form>
</div>
<div class="col-lg-7"><table class="table table-sm table-bordered"><tr><th>#</th><th>Slug</th><th>AR</th><th>EN</th><th></th></tr>
<?php foreach ($pages as $p): ?><tr><td><?php echo $p['id']; ?></td><td><?php echo escape($p['slug']); ?></td><td><?php echo escape($p['title_ar']); ?></td><td><?php echo escape($p['title_en']); ?></td><td><a class="btn btn-sm btn-outline-primary" href="?edit=<?php echo $p['id']; ?>">تعديل</a>
<form method="post" class="d-inline"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?php echo $p['id']; ?>"><button class="btn btn-sm btn-outline-danger">حذف</button></form></td></tr><?php endforeach; ?>
</table></div></div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
