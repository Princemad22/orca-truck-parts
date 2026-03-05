<?php
$pageTitle = 'News';
include '../includes/header.php';

// Sample news data
$news = [
    [
        'id' => 1,
        'title_ar' => 'أعلنت ORCA عن شراكتها الجديدة مع شركة كاتربيلر',
        'title_en' => 'ORCA Announces New Partnership with Caterpillar',
        'summary_ar' => 'في خطوة استراتيجية، أعلنت ORCA Truck Parts عن شراكة جديدة مع شركة كاتربيلر العالمية...',
        'summary_en' => 'In a strategic move, ORCA Truck Parts announced a new partnership with global company Caterpillar...',
        'content_ar' => 'في خطوة استراتيجية، أعلنت ORCA Truck Parts عن شراكة جديدة مع شركة كاتربيلر العالمية لتوفير قطع غيار أصلية للشاحنات الثقيلة. هذه الشراكة ستمكن الشركة من توسيع نطاق منتجاتها وتقديم خدمات أفضل لعملائها.',
        'content_en' => 'In a strategic move, ORCA Truck Parts announced a new partnership with global company Caterpillar to provide genuine parts for heavy-duty trucks. This partnership will enable the company to expand its product range and offer better services to its customers.',
        'image' => 'news1.jpg',
        'author' => 'Admin',
        'published_at' => '2023-10-15',
        'category' => 'Partnerships'
    ],
    [
        'id' => 2,
        'title_ar' => 'أطلقت ORCA منتجات جديدة لموسم الصيانة',
        'title_en' => 'ORCA Launches New Products for Maintenance Season',
        'summary_ar' => 'أطلقت ORCA مجموعة جديدة من قطع الغيار المخصصة لموسم الصيانة...',
        'summary_en' => 'ORCA launches a new range of spare parts specially designed for maintenance season...',
        'content_ar' => 'أطلقت ORCA Truck Parts مجموعة جديدة من قطع الغيار المخصصة لموسم الصيانة، حيث تهدف هذه المنتجات إلى تحسين أداء الشاحنات وزيادة كفاءتها.',
        'content_en' => 'ORCA Truck Parts launches a new range of spare parts specially designed for maintenance season, aiming to enhance truck performance and efficiency.',
        'image' => 'news2.jpg',
        'author' => 'Admin',
        'published_at' => '2023-09-22',
        'category' => 'Products'
    ],
    [
        'id' => 3,
        'title_ar' => 'حصدت ORCA جائزة أفضل مورد لقطع الغيار',
        'title_en' => 'ORCA Wins Award for Best Spare Parts Supplier',
        'summary_ar' => 'حصدت شركة ORCA جائزة أفضل مورد لقطع غيار الشاحنات لعام 2023...',
        'summary_en' => 'ORCA Company wins the award for Best Truck Spare Parts Supplier of 2023...',
        'content_ar' => 'حصدت شركة ORCA جائزة أفضل مورد لقطع غيار الشاحنات لعام 2023 من قبل الجمعية السعودية للنقل. هذه الجائزة تعكس التزام الشركة بتقديم منتجات وخدمات عالية الجودة.',
        'content_en' => 'ORCA Company wins the award for Best Truck Spare Parts Supplier of 2023 from the Saudi Transportation Association. This award reflects the company\'s commitment to providing high-quality products and services.',
        'image' => 'news3.jpg',
        'author' => 'Admin',
        'published_at' => '2023-08-30',
        'category' => 'Awards'
    ]
];
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo __('news'); ?></li>
        </ol>
    </nav>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?php echo __('news'); ?></h1>
        <div class="d-flex">
            <select class="form-select me-2" id="categoryFilter">
                <option value="all"><?php echo __('all_categories'); ?></option>
                <option value="Partnerships"><?php echo __('partnerships'); ?></option>
                <option value="Products"><?php echo __('products'); ?></option>
                <option value="Awards"><?php echo __('awards'); ?></option>
            </select>
            <input type="text" class="form-control" placeholder="<?php echo __('search_news'); ?>" id="searchInput">
        </div>
    </div>
    
    <div class="row" id="newsContainer">
        <?php foreach ($news as $item): ?>
        <div class="col-lg-4 col-md-6 mb-4 news-item" data-category="<?php echo $item['category']; ?>">
            <div class="card h-100 news-card">
                <img src="<?php echo ASSETS_URL; ?>/images/<?php echo $item['image']; ?>" 
                     class="card-img-top" alt="<?php echo $item[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']; ?>">
                <div class="card-body d-flex flex-column">
                    <span class="badge bg-primary mb-2" style="width: fit-content;"><?php echo $item['category']; ?></span>
                    <h5 class="card-title"><?php echo $item[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']; ?></h5>
                    <p class="card-text flex-grow-1"><?php echo $item[getCurrentLanguage() === 'ar' ? 'summary_ar' : 'summary_en']; ?></p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="far fa-calendar me-1"></i>
                                <?php echo formatDate($item['published_at']); ?>
                            </small>
                            <a href="news-single.php?id=<?php echo $item['id']; ?>" class="btn btn-primary btn-sm"><?php echo __('read_more'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="row">
        <div class="col-12">
            <!-- Pagination would go here in a real implementation -->
            <nav aria-label="News pagination">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><?php echo __('previous'); ?></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><?php echo __('next'); ?></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
include '../includes/footer.php';
?>