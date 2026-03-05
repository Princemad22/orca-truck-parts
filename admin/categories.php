<?php
$pageTitle = 'إدارة الفئات'; include __DIR__ . '/includes/header.php';
$pdo=getDB(); $msg='';
if ($_SERVER['REQUEST_METHOD']==='POST' && adminTableExists($pdo,'product_categories')) {
 if (($_POST['action']??'')==='save') {
  $id=(int)($_POST['id']??0); $data=[trim($_POST['name_ar']),trim($_POST['name_en']),trim($_POST['description_ar']),trim($_POST['description_en']), (int)($_POST['sort_order']??0), $_POST['status']??'active'];
  if($id){$pdo->prepare('UPDATE product_categories SET name_ar=?,name_en=?,description_ar=?,description_en=?,sort_order=?,status=? WHERE id=?')->execute([...$data,$id]);$msg='تم التحديث';}
  else {$pdo->prepare('INSERT INTO product_categories (name_ar,name_en,description_ar,description_en,sort_order,status) VALUES (?,?,?,?,?,?)')->execute($data);$msg='تمت الإضافة';}
 }
}
$items=adminTableExists($pdo,'product_categories')?adminFetchAll($pdo,'SELECT * FROM product_categories ORDER BY sort_order,id DESC'):[];
$edit=['id'=>0,'name_ar'=>'','name_en'=>'','description_ar'=>'','description_en'=>'','sort_order'=>0,'status'=>'active']; if(isset($_GET['edit'])){foreach($items as $i) if($i['id']==(int)$_GET['edit']) $edit=$i;}
?>
<div class="container-fluid"><h1 class="h4">إدارة فئات المنتجات</h1><?php if($msg):?><div class="alert alert-success"><?php echo $msg;?></div><?php endif;?>
<div class="row"><div class="col-lg-4"><form method="post" class="card card-body"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?php echo $edit['id'];?>">
<input class="form-control mb-2" name="name_ar" placeholder="الاسم عربي" required value="<?php echo escape($edit['name_ar']);?>"><input class="form-control mb-2" name="name_en" placeholder="Name EN" required value="<?php echo escape($edit['name_en']);?>">
<textarea class="form-control mb-2" name="description_ar" placeholder="وصف عربي"><?php echo escape($edit['description_ar']);?></textarea><textarea class="form-control mb-2" name="description_en" placeholder="Description EN"><?php echo escape($edit['description_en']);?></textarea>
<input type="number" class="form-control mb-2" name="sort_order" value="<?php echo (int)$edit['sort_order'];?>"><select name="status" class="form-select mb-2"><option value="active">active</option><option value="inactive" <?php echo $edit['status']==='inactive'?'selected':'';?>>inactive</option></select><button class="btn btn-primary">حفظ</button></form></div>
<div class="col-lg-8"><table class="table table-bordered table-sm"><tr><th>#</th><th>AR</th><th>EN</th><th>status</th><th></th></tr><?php foreach($items as $i):?><tr><td><?php echo $i['id'];?></td><td><?php echo escape($i['name_ar']);?></td><td><?php echo escape($i['name_en']);?></td><td><?php echo $i['status'];?></td><td><a class="btn btn-sm btn-outline-primary" href="?edit=<?php echo $i['id'];?>">تعديل</a></td></tr><?php endforeach;?></table></div></div></div>
<?php include __DIR__.'/includes/footer.php'; ?>
