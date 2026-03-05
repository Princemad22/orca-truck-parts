<?php
$pageTitle = 'Home';
include 'includes/header.php';

// Sample data for demonstration
$featuredProducts = [
    [
        'id' => 1,
        'name_ar' => 'فلتر زيت عالي الجودة',
        'name_en' => 'High-Quality Oil Filter',
        'description_ar' => 'فلتر زيت مصمم خصيصًا لشاحنات ORCA مع كفاءة عالية',
        'description_en' => 'Oil filter designed specifically for ORCA trucks with high efficiency',
        'price' => 45.99,
        'image' => 'product1.jpg',
        'availability' => 'in_stock'
    ],
    [
        'id' => 2,
        'name_ar' => 'بطارية شاحنة قوية',
        'name_en' => 'Powerful Truck Battery',
        'description_ar' => 'بطارية بقوة 12 فولت مثالية لجميع أنواع الشاحنات',
        'description_en' => '12V powerful battery ideal for all types of trucks',
        'price' => 199.99,
        'image' => 'product2.jpg',
        'availability' => 'in_stock'
    ],
    [
        'id' => 3,
        'name_ar' => 'إطارات شاحنة مقاومة',
        'name_en' => 'Durable Truck Tires',
        'description_ar' => 'إطارات مصممة لتحمل الأوزان الثقيلة والظروف القاسية',
        'description_en' => 'Tires designed to withstand heavy loads and harsh conditions',
        'price' => 349.99,
        'image' => 'product3.jpg',
        'availability' => 'in_stock'
    ]
];

$testimonials = [
    [
        'id' => 1,
        'client_name_ar' => 'أحمد محمد',
        'client_name_en' => 'Ahmed Mohamed',
        'company_ar' => 'شركة النقل الوطنية',
        'company_en' => 'National Transport Co.',
        'content_ar' => 'أفضل قطع غيار للشاحنات في السوق. جودة عالية وخدمة ممتازة.',
        'content_en' => 'Best truck parts in the market. High quality and excellent service.',
        'country' => 'SA'
    ],
    [
        'id' => 2,
        'client_name_ar' => 'سارة عبدالله',
        'client_name_en' => 'Sarah Abdullah',
        'company_ar' => 'شركة اللؤلؤة للنقل',
        'company_en' => 'Pearl Transport Company',
        'content_ar' => 'توصيل سريع وقطع غيار أصلية. نوصي بها بشدة.',
        'content_en' => 'Fast delivery and genuine parts. Highly recommended.',
        'country' => 'SA'
    ]
];

$partners = [
    [
        'id' => 1,
        'name_ar' => 'شركة فيات',
        'name_en' => 'Fiat Company',
        'logo' => 'fiat-logo.png',
        'website' => 'https://www.fiat.com'
    ],
    [
        'id' => 2,
        'name_ar' => 'شركة مرسيدس',
        'name_en' => 'Mercedes-Benz',
        'logo' => 'mercedes-logo.png',
        'website' => 'https://www.mercedes-benz.com'
    ],
    [
        'id' => 3,
        'name_ar' => 'شركة كاتربيلر',
        'name_en' => 'Caterpillar Inc.',
        'logo' => 'caterpillar-logo.png',
        'website' => 'https://www.caterpillar.com'
    ]
];
?>

<div class="hero-section text-center">
    <div class="container">
        <h1 class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('welcome_to'); ?> <span class="en-text">ORCA Truck Parts</span></h1>
        <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('hero_description'); ?></p>
        <a href="products.php" class="btn btn-light btn-lg"><?php echo __('view_our_products'); ?></a>
    </div>
</div>

<div class="container my-5">
    <!-- Featured Products Section -->
    <section class="featured-products mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('featured_products'); ?></h2>
            <a href="products.php" class="btn btn-outline-primary"><?php echo __('view_all'); ?></a>
        </div>
        
        <div class="row">
            <?php foreach ($featuredProducts as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 product-card">
                    <div class="product-image">
                        <img src="https://picsum.photos/300/200?random=<?php echo $product['id']; ?>" 
                             class="card-img-top" alt="<?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title product-title <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo $product[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></h5>
                        <p class="card-text product-description <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo $product[getCurrentLanguage() === 'ar' ? 'description_ar' : 'description_en']; ?></p>
                        <div class="mt-auto product-meta">
                            <span class="price fw-bold text-success en-text">$<?php echo $product['price']; ?></span>
                            <span class="availability badge bg-<?php echo $product['availability'] === 'in_stock' ? 'success' : 'danger'; ?>">
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
    </section>
    
    <!-- About Section -->
    <section class="about-us mb-5">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <h2 class="text-primary <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('who_we_are'); ?></h2>
                <p class="<?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('about_company_text'); ?></p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <?php echo __('quality_assurance'); ?></li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <?php echo __('fast_delivery'); ?></li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <?php echo __('genuine_parts'); ?></li>
                    <li class="list-group-item"><i class="fas fa-check-circle text-success me-2"></i> <?php echo __('expert_support'); ?></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h2 class="text-primary <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('why_choose_us'); ?></h2>
                <div class="accordion" id="whyChooseUsAccordion">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                <?php echo __('reliable_quality'); ?>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#whyChooseUsAccordion">
                            <div class="accordion-body">
                                <?php echo __('reliable_quality_desc'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                <?php echo __('competitive_pricing'); ?>
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#whyChooseUsAccordion">
                            <div class="accordion-body">
                                <?php echo __('competitive_pricing_desc'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                <?php echo __('excellent_service'); ?>
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#whyChooseUsAccordion">
                            <div class="accordion-body">
                                <?php echo __('excellent_service_desc'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Testimonials Section -->
    <section class="testimonials mb-5">
        <h2 class="text-primary text-center mb-4 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('what_clients_say'); ?></h2>
        <div class="row">
            <?php foreach ($testimonials as $testimonial): ?>
            <div class="col-md-6 mb-4">
                <div class="card testimonial-card">
                    <div class="card-body text-center">
                        <div class="testimonial-content">
                            <p>"<?php echo $testimonial[getCurrentLanguage() === 'ar' ? 'content_ar' : 'content_en']; ?>"</p>
                        </div>
                        <div class="testimonial-author">
                            <h5 class="mb-1 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo $testimonial[getCurrentLanguage() === 'ar' ? 'client_name_ar' : 'client_name_en']; ?></h5>
                            <small class="text-muted <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo $testimonial[getCurrentLanguage() === 'ar' ? 'company_ar' : 'company_en']; ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <!-- Partners Section -->
    <section class="partners mb-5">
        <h2 class="text-primary text-center mb-4 <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo __('our_partners'); ?></h2>
        <div class="row">
            <?php foreach ($partners as $partner): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 text-center partner-card">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <img src="https://picsum.photos/150/80?random=<?php echo $partner['id']; ?>" 
                             alt="<?php echo $partner[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>" 
                             class="img-fluid mb-3" style="max-height: 80px;">
                        <h5 class="card-title <?php echo getCurrentLanguage() === 'ar' ? 'arabic' : ''; ?>"><?php echo $partner[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></h5>
                        <a href="<?php echo $partner['website']; ?>" target="_blank" class="btn btn-outline-primary"><?php echo __('visit_website'); ?></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php
include 'includes/footer.php';
?>