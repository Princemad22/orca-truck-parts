<?php
$pageTitle = 'Products';
include 'includes/header.php';

// Sample product categories
$categories = [
    ['id' => 1, 'name_ar' => 'فلاتر الهواء', 'name_en' => 'Air Filters', 'count' => 12],
    ['id' => 2, 'name_ar' => 'فلاتر الزيت', 'name_en' => 'Oil Filters', 'count' => 8],
    ['id' => 3, 'name_ar' => 'الإطارات', 'name_en' => 'Tires', 'count' => 15],
    ['id' => 4, 'name_ar' => 'البطاريات', 'name_en' => 'Batteries', 'count' => 6],
    ['id' => 5, 'name_ar' => 'أجزاء المحرك', 'name_en' => 'Engine Parts', 'count' => 20],
    ['id' => 6, 'name_ar' => 'نظام الفرامل', 'name_en' => 'Brake System', 'count' => 10]
];

// Sample products
$products = [
    [
        'id' => 1,
        'name_ar' => 'فلتر زيت عالي الجودة',
        'name_en' => 'High-Quality Oil Filter',
        'description_ar' => 'فلتر زيت مصمم خصيصًا لشاحنات ORCA مع كفاءة عالية',
        'description_en' => 'Oil filter designed specifically for ORCA trucks with high efficiency',
        'price' => 45.99,
        'image' => 'product1.jpg',
        'availability' => 'in_stock',
        'category_id' => 2
    ],
    [
        'id' => 2,
        'name_ar' => 'بطارية شاحنة قوية',
        'name_en' => 'Powerful Truck Battery',
        'description_ar' => 'بطارية بقوة 12 فولت مثالية لجميع أنواع الشاحنات',
        'description_en' => '12V powerful battery ideal for all types of trucks',
        'price' => 199.99,
        'image' => 'product2.jpg',
        'availability' => 'in_stock',
        'category_id' => 4
    ],
    [
        'id' => 3,
        'name_ar' => 'إطارات شاحنة مقاومة',
        'name_en' => 'Durable Truck Tires',
        'description_ar' => 'إطارات مصممة لتحمل الأوزان الثقيلة والظروف القاسية',
        'description_en' => 'Tires designed to withstand heavy loads and harsh conditions',
        'price' => 349.99,
        'image' => 'product3.jpg',
        'availability' => 'in_stock',
        'category_id' => 3
    ],
    [
        'id' => 4,
        'name_ar' => 'مرشح هواء عالي الأداء',
        'name_en' => 'High-Performance Air Filter',
        'description_ar' => 'مرشح هواء مطور لتحسين كفاءة المحرك',
        'description_en' => 'Advanced air filter to improve engine efficiency',
        'price' => 32.50,
        'image' => 'product4.jpg',
        'availability' => 'in_stock',
        'category_id' => 1
    ],
    [
        'id' => 5,
        'name_ar' => 'محرك ديزل قوي',
        'name_en' => 'Powerful Diesel Engine',
        'description_ar' => 'محرك ديزل فائق القوة للاستخدام الصناعي',
        'description_en' => 'Super powerful diesel engine for industrial use',
        'price' => 12500.00,
        'image' => 'product5.jpg',
        'availability' => 'on_order',
        'category_id' => 5
    ],
    [
        'id' => 6,
        'name_ar' => 'نظام فرامل متطور',
        'name_en' => 'Advanced Brake System',
        'description_ar' => 'نظام فرامل متكامل لضمان السلامة القصوى',
        'description_en' => 'Complete brake system for maximum safety',
        'price' => 899.99,
        'image' => 'product6.jpg',
        'availability' => 'in_stock',
        'category_id' => 6
    ]
];

// Get selected category from URL
$selectedCategory = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$filteredProducts = $selectedCategory ? array_filter($products, function($product) use ($selectedCategory) {
    return $product['category_id'] === $selectedCategory;
}) : $products;
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo __('products'); ?></li>
        </ol>
    </nav>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?php echo __('products'); ?></h1>
        <div class="d-flex">
            <select class="form-select me-2" id="sortSelect">
                <option value="default"><?php echo __('sort_by'); ?></option>
                <option value="price_low"><?php echo __('price_low_to_high'); ?></option>
                <option value="price_high"><?php echo __('price_high_to_low'); ?></option>
                <option value="name_asc"><?php echo __('name_a_to_z'); ?></option>
                <option value="name_desc"><?php echo __('name_z_to_a'); ?></option>
            </select>
            <input type="text" class="form-control" placeholder="<?php echo __('search_products'); ?>" id="searchInput">
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><?php echo __('filter_by_category'); ?></h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="products.php" class="<?php echo $selectedCategory === 0 ? 'fw-bold' : ''; ?>"><?php echo __('all_categories'); ?></a>
                            <span class="badge bg-primary rounded-pill"><?php echo count($products); ?></span>
                        </li>
                        <?php foreach ($categories as $category): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="products.php?category=<?php echo $category['id']; ?>" 
                               class="<?php echo $selectedCategory === $category['id'] ? 'fw-bold' : ''; ?>">
                                <?php echo $category[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>
                            </a>
                            <span class="badge bg-secondary rounded-pill"><?php echo $category['count']; ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="row" id="productsContainer">
                <?php foreach ($filteredProducts as $product): ?>
                <div class="col-md-6 col-lg-4 mb-4 product-item" data-category="<?php echo $product['category_id']; ?>">
                    <div class="card h-100 product-card">
                        <div class="product-image">
                            <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $product['image']; ?>" 
                                 class="card-img-top" alt="<?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title product-title"><?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></h5>
                            <p class="card-text product-description"><?php echo $product[getCurrentLanguage() === 'ar' ? 'description_ar' : 'description_en']; ?></p>
                            <div class="mt-auto product-meta">
                                <span class="price fw-bold text-success">$<?php echo number_format($product['price'], 2); ?></span>
                                <span class="availability badge bg-<?php echo $product['availability'] === 'in_stock' ? 'success' : ($product['availability'] === 'out_of_stock' ? 'danger' : 'warning'); ?>">
                                    <?php echo __($product['availability']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary w-100"><?php echo __('view_details'); ?></a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (empty($filteredProducts)): ?>
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4><?php echo __('no_products_found'); ?></h4>
                <p><?php echo __('no_products_found_desc'); ?></p>
                <a href="products.php" class="btn btn-primary"><?php echo __('view_all_products'); ?></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>