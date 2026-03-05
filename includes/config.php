<?php
// Database configuration
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'orca_truck_parts');

// Site configuration
define('SITE_URL', $_ENV['SITE_URL'] ?? 'http://localhost/orca-truck-parts');
define('ADMIN_URL', SITE_URL . '/admin');
define('ASSETS_URL', SITE_URL . '/assets');

// Language configuration
define('DEFAULT_LANGUAGE', 'en');

// Security
define('CSRF_TOKEN_NAME', 'csrf_token');
define('CSRF_TOKEN_TIMEOUT', 3600); // 1 hour

// File upload configuration
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);

// Pagination
define('ITEMS_PER_PAGE', 12);