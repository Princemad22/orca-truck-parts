<?php
$pageTitle='إدارة المنتجات'; include __DIR__.'/includes/header.php';
$pdo=getDB(); $msg='';
if ($_SERVER['REQUEST_METHOD']==='POST' && adminTableExists($pdo,'products')) {
 if(($_POST['action']??'')==='save'){
   $id=(int)($_POST['id']??0);
   $data=[(int)$_POST['category_id'],trim($_POST['name_ar']),trim($_POST['name_en']),trim($_POST['description_ar']),trim($_POST['description_en']),trim($_POST['part_number']),trim($_POST['oem_number']),trim($_POST['brand']),$_POST['availability']??'in_stock',$_POST['status']??'active'];
   if($id){$pdo->prepare('UPDATE products SET category_id=?,name_ar=?,name_en=?,description_ar=?,description_en=?,part_number=?,oem_number=?,brand=?,availability=?,status=?,updated_at=NOW() WHERE id=?')->execute([...$data,$id]);$msg='تم التحديث';}
   else {$pdo->prepare('INSERT INTO products (category_id,name_ar,name_en,description_ar,description_en,part_number,oem_number,brand,availability,status,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,NOW())')->execute($data);$msg='تمت الإضافة';}
 }
}
$cats=adminTableExists($pdo,'product_categories')?adminFetchAll($pdo,'SELECT id,name_ar FROM product_categories ORDER BY sort_order,id'):[];
$items=adminTableExists($pdo,'products')?adminFetchAll($pdo,'SELECT p.*,c.name_ar category_name FROM products p LEFT JOIN product_categories c ON c.id=p.category_id ORDER BY p.id DESC'):[];
$edit=['id'=>0,'category_id'=>$cats[0]['id']??0,'name_ar'=>'','name_en'=>'','description_ar'=>'','description_en'=>'','part_number'=>'','oem_number'=>'','brand'=>'','availability'=>'in_stock','status'=>'active']; if(isset($_GET['edit'])){foreach($items as $i) if($i['id']==(int)$_GET['edit']) $edit=$i;}
?>
<div class="container-fluid"><h1 class="h4">إدارة المنتجات</h1><?php if($msg):?><div class="alert alert-success"><?php echo $msg;?></div><?php endif;?><div class="row"><div class="col-lg-4"><form method="post" class="card card-body"><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?php echo $edit['id'];?>"><select name="category_id" class="form-select mb-2"><?php foreach($cats as $c):?><option value="<?php echo $c['id'];?>" <?php echo $edit['category_id']==$c['id']?'selected':'';?>><?php echo escape($c['name_ar']);?></option><?php endforeach;?></select>
<input class="form-control mb-2" name="name_ar" placeholder="الاسم عربي" required value="<?php echo escape($edit['name_ar']);?>"><input class="form-control mb-2" name="name_en" placeholder="Name EN" required value="<?php echo escape($edit['name_en']);?>"><input class="form-control mb-2" name="part_number" placeholder="Part #" value="<?php echo escape($edit['part_number']);?>"><input class="form-control mb-2" name="oem_number" placeholder="OEM #" value="<?php echo escape($edit['oem_number']);?>"><input class="form-control mb-2" name="brand" placeholder="Brand" value="<?php echo escape($edit['brand']);?>"><select name="availability" class="form-select mb-2"><option value="in_stock">in_stock</option><option value="out_of_stock" <?php echo $edit['availability']==='out_of_stock'?'selected':'';?>>out_of_stock</option><option value="on_order" <?php echo $edit['availability']==='on_order'?'selected':'';?>>on_order</option></select><button class="btn btn-primary">حفظ</button></form></div>
<div class="col-lg-8"><table class="table table-sm table-bordered"><tr><th>#</th><th>الاسم</th><th>الفئة</th><th>الحالة</th><th></th></tr><?php foreach($items as $i):?><tr><td><?php echo $i['id'];?></td><td><?php echo escape($i['name_ar']);?></td><td><?php echo escape($i['category_name']??'-');?></td><td><?php echo escape($i['status']);?></td><td><a class="btn btn-sm btn-outline-primary" href="?edit=<?php echo $i['id'];?>">تعديل</a></td></tr><?php endforeach;?></table></div></div></div>
<?php include __DIR__.'/includes/footer.php'; ?>
