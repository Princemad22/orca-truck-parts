<?php
require_once 'db.php';
require_once 'language.php';

/**
 * Generate CSRF token
 */
function generateCSRFToken() {
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Validate CSRF token
 */
function validateCSRFToken($token) {
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Sanitize output to prevent XSS
 */
function escape($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Get current language
 */
function getCurrentLanguage() {
    return $_SESSION['language'] ?? DEFAULT_LANGUAGE;
}

/**
 * Set language
 */
function setLanguage($lang) {
    if (in_array($lang, ['ar', 'en'])) {
        $_SESSION['language'] = $lang;
        setcookie('language', $lang, time() + (86400 * 30), '/'); // 30 days
    }
}

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Check user role
 */
function hasRole($role) {
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

/**
 * Redirect to another page
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Upload file with validation
 */
function uploadFile($file, $uploadDir) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];

    // Get file extension
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validate file type
    if (!in_array($fileExtension, ALLOWED_IMAGE_TYPES)) {
        return false;
    }

    // Validate file size
    if ($fileSize > MAX_FILE_SIZE) {
        return false;
    }

    // Create unique filename
    $uniqueFileName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $fileExtension;
    $destination = $uploadDir . '/' . $uniqueFileName;

    if (move_uploaded_file($fileTmpName, $destination)) {
        return $uniqueFileName;
    }

    return false;
}



/**
 * Check whether a table exists in current database
 */
if (!function_exists('adminTableExists')) {
    function adminTableExists(PDO $pdo, string $table): bool {
        $quotedTable = $pdo->quote($table);
        $stmt = $pdo->query("SHOW TABLES LIKE {$quotedTable}");
        return (bool) $stmt->fetchColumn();
    }
}

/**
 * Fetch all rows helper for admin pages
 */
if (!function_exists('adminFetchAll')) {
    function adminFetchAll(PDO $pdo, string $query, array $params = []): array {
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
}

/**
 * Get settings from database
 */
function getSetting($key) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    
    return $result ? $result['setting_value'] : null;
}

/**
 * Format date according to locale
 */
function formatDate($date) {
    $timestamp = strtotime($date);
    $currentLang = getCurrentLanguage();
    
    if ($currentLang === 'ar') {
        return date('Y/m/d', $timestamp);
    } else {
        return date('M j, Y', $timestamp);
    }
}

/**
 * Pagination helper
 */
function paginate($totalItems, $currentPage, $itemsPerPage, $baseUrl) {
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    if ($totalPages <= 1) {
        return '';
    }
    
    $pagination = '<nav aria-label="Page navigation"><ul class="pagination">';
    
    // Previous button
    if ($currentPage > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="' . str_replace('{page}', $currentPage - 1, $baseUrl) . '">' . __('previous') . '</a></li>';
    }
    
    // Pages
    for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        $pagination .= '<li class="page-item ' . $activeClass . '"><a class="page-link" href="' . str_replace('{page}', $i, $baseUrl) . '">' . $i . '</a></li>';
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $pagination .= '<li class="page-item"><a class="page-link" href="' . str_replace('{page}', $currentPage + 1, $baseUrl) . '">' . __('next') . '</a></li>';
    }
    
    $pagination .= '</ul></nav>';
    
    return $pagination;
}