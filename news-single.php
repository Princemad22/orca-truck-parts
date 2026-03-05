<?php
$pageTitle = 'News Detail';
include 'includes/header.php';

// Sample news data (in a real application, this would come from the database)
$newsId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$newsItem = [
    'id' => $newsId,
    'title_ar' => 'أعلنت ORCA عن شراكتها الجديدة مع شركة كاتربيلر',
    'title_en' => 'ORCA Announces New Partnership with Caterpillar',
    'content_ar' => 'في خطوة استراتيجية، أعلنت ORCA Truck Parts عن شراكة جديدة مع شركة كاتربيلر العالمية لتوفير قطع غيار أصلية للشاحنات الثقيلة. هذه الشراكة ستمكن الشركة من توسيع نطاق منتجاتها وتقديم خدمات أفضل لعملائها. وستشمل الشراكة توريد قطع غيار أصلية لجميع طرازات الشاحنات التي تعمل في السوق السعودي. وستساهم هذه الخطوة في تعزيز مكانة ORCA كواحدة من أبرز شركات توريد قطع الغيار في المنطقة. وأكد المدير التنفيذي للشركة أن هذه الشراكة ستفتح آفاقاً جديدة للنمو وستمكن الشركة من تقديم منتجات وخدمات ذات جودة عالية لعملائها الكرام.',
    'content_en' => 'In a strategic move, ORCA Truck Parts announced a new partnership with global company Caterpillar to provide genuine parts for heavy-duty trucks. This partnership will enable the company to expand its product range and offer better services to its customers. The partnership will include supplying genuine parts for all truck models operating in the Saudi market. This step will contribute to strengthening ORCA\'s position as one of the leading spare parts supply companies in the region. The CEO confirmed that this partnership will open new horizons for growth and enable the company to provide high-quality products and services to their valued customers.',
    'image' => 'news1.jpg',
    'author' => 'Admin',
    'published_at' => '2023-10-15',
    'category' => 'Partnerships'
];
?>

<div class="container my-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a></li>
            <li class="breadcrumb-item"><a href="news.php"><?php echo __('news'); ?></a></li>
            <li class="breadcrumb-item active"><?php echo $newsItem[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']; ?></li>
        </ol>
    </nav>
    
    <article class="news-article">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="text-center mb-4">
                    <span class="badge bg-primary mb-3"><?php echo $newsItem['category']; ?></span>
                    <h1 class="display-5 fw-bold"><?php echo $newsItem[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']; ?></h1>
                    <div class="d-flex justify-content-center align-items-center text-muted">
                        <span class="me-3"><i class="far fa-user me-1"></i> <?php echo $newsItem['author']; ?></span>
                        <span><i class="far fa-calendar me-1"></i> <?php echo formatDate($newsItem['published_at']); ?></span>
                    </div>
                </div>
                
                <div class="text-center mb-4">
                    <img src="https://picsum.photos/1200/600?random=<?php echo $newsItem['id'] + 400; ?>" 
                         class="img-fluid rounded shadow" alt="<?php echo $newsItem[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']; ?>">
                </div>
                
                <div class="news-content fs-5">
                    <p><?php echo $newsItem[getCurrentLanguage() === 'ar' ? 'content_ar' : 'content_en']; ?></p>
                </div>
                
                <div class="mt-5">
                    <h4><?php echo __('share_article'); ?></h4>
                    <div class="social-share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(SITE_URL . $_SERVER['REQUEST_URI']); ?>" 
                           target="_blank" class="btn btn-outline-primary me-2">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(SITE_URL . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($newsItem[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']); ?>" 
                           target="_blank" class="btn btn-outline-info me-2">
                            <i class="fab fa-twitter"></i> Twitter
                        </a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(SITE_URL . $_SERVER['REQUEST_URI']); ?>&title=<?php echo urlencode($newsItem[getCurrentLanguage() === 'ar' ? 'title_ar' : 'title_en']); ?>" 
                           target="_blank" class="btn btn-outline-primary">
                            <i class="fab fa-linkedin-in"></i> LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </article>
    
    <div class="row mt-5">
        <div class="col-12">
            <h3><?php echo __('related_articles'); ?></h3>
            <div class="row">
                <!-- Related articles would go here in a real implementation -->
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/420/260?random=501" class="card-img-top" alt="Related Article">
                        <div class="card-body">
                            <h5 class="card-title">New Product Launch</h5>
                            <p class="card-text">ORCA launches a new range of spare parts specially designed for...</p>
                            <a href="#" class="btn btn-primary"><?php echo __('read_more'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/420/260?random=502" class="card-img-top" alt="Related Article">
                        <div class="card-body">
                            <h5 class="card-title">Award Recognition</h5>
                            <p class="card-text">ORCA Company wins the award for Best Truck Spare Parts Supplier of...</p>
                            <a href="#" class="btn btn-primary"><?php echo __('read_more'); ?></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://picsum.photos/420/260?random=503" class="card-img-top" alt="Related Article">
                        <div class="card-body">
                            <h5 class="card-title">Partnership Announcement</h5>
                            <p class="card-text">ORCA announces a new partnership with global company Caterpillar to...</p>
                            <a href="#" class="btn btn-primary"><?php echo __('read_more'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>