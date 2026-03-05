<?php
$pageTitle = 'Product Detail';
include '../includes/header.php';

// Sample product data (in a real application, this would come from the database)
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$product = [
    'id' => $productId,
    'name_ar' => 'فلتر زيت عالي الجودة',
    'name_en' => 'High-Quality Oil Filter',
    'description_ar' => 'فلتر زيت مصمم خصيصًا لشاحنات ORCA مع كفاءة عالية. هذا الفلتر مصنوع من مواد عالية الجودة ويضمن حماية المحرك من الشوائب والملوثات.',
    'description_en' => 'Oil filter designed specifically for ORCA trucks with high efficiency. This filter is made from high-quality materials and ensures engine protection from impurities and pollutants.',
    'long_description_ar' => 'فلتر الزيت عالي الجودة من ORCA هو الخيار الأمثل لضمان أداء محرك مثالي. تم تصنيع هذا الفلتر باستخدام أحدث التقنيات لتقديم كفاءة فائقة في تنقية زيت المحرك من الشوائب. يساعد في تقليل التآكل وزيادة عمر المحرك.',
    'long_description_en' => 'The high-quality oil filter from ORCA is the optimal choice for ensuring ideal engine performance. This filter is manufactured using the latest technology to provide superior efficiency in purifying engine oil from impurities. It helps reduce wear and increase engine life.',
    'price' => 45.99,
    'image' => 'product1.jpg',
    'availability' => 'in_stock',
    'part_number' => 'OF-2023-001',
    'oem_number' => 'OEM-456789',
    'brand' => 'ORCA Filters',
    'category_id' => 2,
    'additional_images' => [
        'product1-1.jpg',
        'product1-2.jpg',
        'product1-3.jpg'
    ]
];

$categoryNames = [
    1 => ['ar' => 'فلاتر الهواء', 'en' => 'Air Filters'],
    2 => ['ar' => 'فلاتر الزيت', 'en' => 'Oil Filters'],
    3 => ['ar' => 'الإطارات', 'en' => 'Tires'],
    4 => ['ar' => 'البطاريات', 'en' => 'Batteries'],
    5 => ['ar' => 'أجزاء المحرك', 'en' => 'Engine Parts'],
    6 => ['ar' => 'نظام الفرامل', 'en' => 'Brake System']
];

$categoryName = $categoryNames[$product['category_id']][getCurrentLanguage()];
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item"><a href="products.php"><?php echo __('products'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></li>
        </ol>
    </nav>
    
    <div class="row">
        <div class="col-lg-6">
            <div class="product-gallery">
                <div class="main-image mb-3">
                    <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $product['image']; ?>" 
                         class="img-fluid rounded shadow" alt="<?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>">
                </div>
                
                <?php if (!empty($product['additional_images'])): ?>
                <div class="thumbnail-images d-flex flex-wrap gap-2">
                    <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $product['image']; ?>" 
                         class="img-thumbnail cursor-pointer" alt="Main image" style="width: 80px; height: 80px; object-fit: cover;">
                    <?php foreach ($product['additional_images'] as $img): ?>
                    <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $img; ?>" 
                         class="img-thumbnail cursor-pointer" alt="Additional image" style="width: 80px; height: 80px; object-fit: cover;">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="col-lg-6">
            <h1><?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></h1>
            
            <div class="product-meta mb-3">
                <p class="text-muted"><?php echo __('category'); ?>: <span class="fw-bold"><?php echo $categoryName; ?></span></p>
                <p class="text-muted"><?php echo __('part_number'); ?>: <span class="fw-bold"><?php echo $product['part_number']; ?></span></p>
                <p class="text-muted"><?php echo __('oem_number'); ?>: <span class="fw-bold"><?php echo $product['oem_number']; ?></span></p>
                <p class="text-muted"><?php echo __('brand'); ?>: <span class="fw-bold"><?php echo $product['brand']; ?></span></p>
            </div>
            
            <div class="price-section mb-4">
                <h3 class="text-success fw-bold">$<?php echo number_format($product['price'], 2); ?></h3>
                <span class="availability badge bg-<?php echo $product['availability'] === 'in_stock' ? 'success' : ($product['availability'] === 'out_of_stock' ? 'danger' : 'warning'); ?>">
                    <?php echo __($product['availability']); ?>
                </span>
            </div>
            
            <div class="product-actions mb-4">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary btn-lg">
                        <i class="fas fa-shopping-cart me-2"></i><?php echo __('add_to_cart'); ?>
                    </button>
                    <button class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-heart me-2"></i><?php echo __('add_to_wishlist'); ?>
                    </button>
                </div>
            </div>
            
            <div class="product-details">
                <h4><?php echo __('product_details'); ?></h4>
                <p><?php echo $product[getCurrentLanguage() === 'ar' ? 'description_ar' : 'description_en']; ?></p>
                
                <h5><?php echo __('more_information'); ?></h5>
                <p><?php echo $product[getCurrentLanguage() === 'ar' ? 'long_description_ar' : 'long_description_en']; ?></p>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <h3><?php echo __('related_products'); ?></h3>
            <div class="row">
                <!-- Related products would go here in a real implementation -->
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo ASSETS_URL; ?>/images/product2.jpg" class="card-img-top" alt="Related Product">
                        <div class="card-body">
                            <h5 class="card-title">Related Product 1</h5>
                            <p class="card-text">$59.99</p>
                            <a href="#" class="btn btn-primary"><?php echo __('view_details'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo ASSETS_URL; ?>/images/product3.jpg" class="card-img-top" alt="Related Product">
                        <div class="card-body">
                            <h5 class="card-title">Related Product 2</h5>
                            <p class="card-text">$89.99</p>
                            <a href="#" class="btn btn-primary"><?php echo __('view_details'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo ASSETS_URL; ?>/images/product4.jpg" class="card-img-top" alt="Related Product">
                        <div class="card-body">
                            <h5 class="card-title">Related Product 3</h5>
                            <p class="card-text">$32.50</p>
                            <a href="#" class="btn btn-primary"><?php echo __('view_details'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <img src="<?php echo ASSETS_URL; ?>/images/product5.jpg" class="card-img-top" alt="Related Product">
                        <div class="card-body">
                            <h5 class="card-title">Related Product 4</h5>
                            <p class="card-text">$150.00</p>
                            <a href="#" class="btn btn-primary"><?php echo __('view_details'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>