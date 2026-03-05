<?php
session_start();

// Apply language from query parameter first
if (isset($_GET['lang'])) {
    $requestedLanguage = strtolower(trim((string) $_GET['lang']));
    if (in_array($requestedLanguage, ['ar', 'en'], true)) {
        $_SESSION['language'] = $requestedLanguage;
        setcookie('language', $requestedLanguage, time() + (86400 * 30), '/');
    }
}

// Initialize language
if (!isset($_SESSION['language'])) {
    if (isset($_COOKIE['language'])) {
        $_SESSION['language'] = $_COOKIE['language'];
    } else {
        $_SESSION['language'] = DEFAULT_LANGUAGE;
    }
}

/**
 * Get translation for a key
 */
function __($key) {
    $language = $_SESSION['language'] ?? DEFAULT_LANGUAGE;
    
    // Load language file
    $langFile = dirname(__FILE__) . '/../languages/' . $language . '.php';
    if (file_exists($langFile)) {
        $translations = include $langFile;
        return $translations[$key] ?? $key;
    }
    
    // Fallback to English if language file doesn't exist
    if ($language !== 'en') {
        $langFile = dirname(__FILE__) . '/../languages/en.php';
        if (file_exists($langFile)) {
            $translations = include $langFile;
            return $translations[$key] ?? $key;
        }
    }
    
    // Return the key itself if no translation found
    return $key;
}

/**
 * Get current language direction (ltr/rtl)
 */
function getLanguageDirection() {
    $language = $_SESSION['language'] ?? DEFAULT_LANGUAGE;
    return $language === 'ar' ? 'rtl' : 'ltr';
}

/**
 * Get current language name
 */
function getLanguageName() {
    $language = $_SESSION['language'] ?? DEFAULT_LANGUAGE;
    $names = [
        'en' => 'English',
        'ar' => 'العربية'
    ];
    
    return $names[$language] ?? 'English';
}