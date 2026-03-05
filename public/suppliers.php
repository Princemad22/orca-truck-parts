<?php
$pageTitle = 'Suppliers';
include '../includes/header.php';

// Sample suppliers data
$suppliers = [
    [
        'id' => 1,
        'name_ar' => 'شركة فيات لقطع الغيار',
        'name_en' => 'Fiat Spare Parts Co.',
        'description_ar' => 'شركة رائدة في إنتاج قطع غيار الشاحنات عالية الجودة',
        'description_en' => 'Leading company in producing high-quality truck spare parts',
        'logo' => 'fiat-logo.png',
        'website' => 'https://www.fiat.com',
        'country' => 'Italy',
        'since' => '2010'
    ],
    [
        'id' => 2,
        'name_ar' => 'شركة مرسيدس للتجهيزات',
        'name_en' => 'Mercedes-Benz Equipment',
        'description_ar' => 'توفير قطع الغيار الأصلية لشاحنات مرسيدس',
        'description_en' => 'Providing genuine spare parts for Mercedes-Benz trucks',
        'logo' => 'mercedes-logo.png',
        'website' => 'https://www.mercedes-benz.com',
        'country' => 'Germany',
        'since' => '2008'
    ],
    [
        'id' => 3,
        'name_ar' => 'شركة كاتربيلر العالمية',
        'name_en' => 'Caterpillar Global',
        'description_ar' => 'شركة متخصصة في قطع غيار المعدات الثقيلة والشاحنات',
        'description_en' => 'Specialized company in heavy equipment and truck spare parts',
        'logo' => 'caterpillar-logo.png',
        'website' => 'https://www.caterpillar.com',
        'country' => 'USA',
        'since' => '2005'
    ],
    [
        'id' => 4,
        'name_ar' => 'شركة فولفو لقطع الشاحنات',
        'name_en' => 'Volvo Truck Parts',
        'description_ar' => 'أفضل قطع غيار لشاحنات فولفو بجودة مضمونة',
        'description_en' => 'Best spare parts for Volvo trucks with guaranteed quality',
        'logo' => 'volvo-logo.png',
        'website' => 'https://www.volvo.com',
        'country' => 'Sweden',
        'since' => '2012'
    ],
    [
        'id' => 5,
        'name_ar' => 'شركة سكانيا للتجهيزات',
        'name_en' => 'Scania Equipment',
        'description_ar' => 'تقديم حلول شاملة لصيانة وقطع غيار شاحنات سكانيا',
        'description_en' => 'Comprehensive solutions for Scania truck maintenance and spare parts',
        'logo' => 'scania-logo.png',
        'website' => 'https://www.scania.com',
        'country' => 'Sweden',
        'since' => '2015'
    ],
    [
        'id' => 6,
        'name_ar' => 'شركة هينو لقطع الغيار',
        'name_en' => 'Hino Spare Parts',
        'description_ar' => 'متخصصون في قطع غيار شاحنات هينو اليابانية',
        'description_en' => 'Specialists in Japanese Hino truck spare parts',
        'logo' => 'hino-logo.png',
        'website' => 'https://www.hino.com',
        'country' => 'Japan',
        'since' => '2018'
    ]
];
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo __('suppliers'); ?></li>
        </ol>
    </nav>
    
    <div class="text-center mb-5">
        <h1><?php echo __('our_suppliers'); ?></h1>
        <p class="lead"><?php echo __('trusted_partners_desc'); ?></p>
    </div>
    
    <div class="row" id="suppliersContainer">
        <?php foreach ($suppliers as $supplier): ?>
        <div class="col-lg-4 col-md-6 mb-4 supplier-item">
            <div class="card h-100 supplier-card">
                <div class="card-body text-center">
                    <div class="supplier-logo mb-3">
                        <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $supplier['logo']; ?>" 
                             alt="<?php echo $supplier[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?>" 
                             class="img-fluid" style="max-height: 80px;">
                    </div>
                    <h5 class="card-title"><?php echo $supplier[getCurrentLanguage() === 'ar' ? 'name_ar' : 'name_en']; ?></h5>
                    <p class="card-text"><?php echo $supplier[getCurrentLanguage() === 'ar' ? 'description_ar' : 'description_en']; ?></p>
                    <div class="supplier-info mb-3">
                        <p class="mb-1"><i class="fas fa-flag me-2"></i> <?php echo $supplier['country']; ?></p>
                        <p class="mb-1"><i class="fas fa-calendar-alt me-2"></i> <?php echo __('partner_since'); ?>: <?php echo $supplier['since']; ?></p>
                    </div>
                    <a href="<?php echo $supplier['website']; ?>" target="_blank" class="btn btn-outline-primary">
                        <i class="fas fa-external-link-alt me-2"></i><?php echo __('visit_website'); ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h4><?php echo __('become_partner_title'); ?></h4>
                    <p class="mb-4"><?php echo __('become_partner_desc'); ?></p>
                    <a href="contact.php" class="btn btn-primary"><?php echo __('contact_us'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>