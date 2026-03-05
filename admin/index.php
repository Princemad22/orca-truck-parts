<?php
$pageTitle = 'Dashboard';
include 'includes/header.php';

// Fetch some statistics
try {
    $pdo = getDB();
    
    // Count total products
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 'active'");
    $totalProducts = $stmt->fetch()['count'];
    
    // Count total categories
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM product_categories WHERE status = 'active'");
    $totalCategories = $stmt->fetch()['count'];
    
    // Count total news
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM posts WHERE status = 'published'");
    $totalNews = $stmt->fetch()['count'];
    
    // Count unread contacts
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM contacts WHERE status = 'unread'");
    $unreadContacts = $stmt->fetch()['count'];
} catch (Exception $e) {
    // If tables don't exist yet, set defaults
    $totalProducts = 0;
    $totalCategories = 0;
    $totalNews = 0;
    $unreadContacts = 0;
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo __('dashboard'); ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo __('share'); ?></button>
                <button type="button" class="btn btn-sm btn-outline-secondary"><?php echo __('print'); ?></button>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo __('total_products'); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalProducts; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-boxes fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><?php echo __('total_categories'); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalCategories; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><?php echo __('total_news'); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalNews; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-newspaper fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><?php echo __('unread_messages'); ?></div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $unreadContacts; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><?php echo __('recent_activity'); ?></h5>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo __('dashboard_welcome_message'); ?></p>
                    <p class="card-text"><?php echo __('dashboard_instructions'); ?></p>
                    <ul>
                        <li><?php echo __('manage_products_desc'); ?></li>
                        <li><?php echo __('manage_categories_desc'); ?></li>
                        <li><?php echo __('manage_news_desc'); ?></li>
                        <li><?php echo __('manage_pages_desc'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>