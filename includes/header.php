<?php
require_once 'config.php';
require_once 'language.php';
require_once 'functions.php';
require_once 'auth.php';

// Start output buffering
ob_start();

// Set content type and character encoding
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>" dir="<?php echo getLanguageDirection(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? escape($pageTitle) . ' - ' : ''; ?>ORCA Truck Parts</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/style.css">
    <?php if(getCurrentLanguage() === 'ar'): ?>
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/css/rtl.css">
    <?php endif; ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo ASSETS_URL; ?>/images/favicon.ico">
</head>
<body class="light-mode">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <img src="<?php echo ASSETS_URL; ?>/images/logo.png" alt="ORCA Truck Parts Logo" height="40">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="<?php echo __('toggle_navigation'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITE_URL; ?>"><?php echo __('home'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php"><?php echo __('about'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php"><?php echo __('products'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="news.php"><?php echo __('news'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php"><?php echo __('contact'); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="suppliers.php"><?php echo __('suppliers'); ?></a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i> <?php echo getLanguageName(); ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                            <li><a class="dropdown-item <?php echo getCurrentLanguage() === 'en' ? 'active' : ''; ?>" 
                                   href="?lang=en">English</a></li>
                            <li><a class="dropdown-item <?php echo getCurrentLanguage() === 'ar' ? 'active' : ''; ?>" 
                                   href="?lang=ar">العربية</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" id="themeToggle" title="<?php echo __('light_mode'); ?>" style="cursor: not-allowed; opacity: 0.5;">
                            <i class="fas fa-sun"></i>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">
                            <i class="fas fa-search"></i> <?php echo __('search'); ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>