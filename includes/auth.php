<?php
session_start();

// Start output buffering
ob_start();

// Check if user is logged in
function checkAuth() {
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header('Location: login.php');
        exit();
    }
}

// Check if user has specific role
function checkRole($requiredRole) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $requiredRole) {
        header('Location: index.php');
        exit();
    }
}

// Check if user has one of the allowed roles
function checkRoles($allowedRoles) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowedRoles)) {
        header('Location: index.php');
        exit();
    }
}

// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Get current user info
function getCurrentUser() {
    if (isset($_SESSION['user_id'])) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'role' => $_SESSION['role']
        ];
    }
    return null;
}

// Login user
function loginUser($userId, $username, $role) {
    $_SESSION['user_id'] = $userId;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['last_activity'] = time();
    
    // Regenerate session ID to prevent session fixation
    session_regenerate_id(true);
}

// Logout user
function logoutUser() {
    // Unset all session variables
    $_SESSION = array();
    
    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destroy the session
    session_destroy();
}

// Check if session is still valid (prevent session hijacking)
function validateSession() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) { // 1 hour
        logoutUser();
        return false;
    }
    
    $_SESSION['last_activity'] = time();
    return true;
}

// Check if user is logged in for frontend
function isFrontendLoggedIn() {
    return isset($_SESSION['frontend_user_id']);
}

// Protect against CSRF
function csrfProtect() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            die('CSRF token mismatch');
        }
    }
    
    // Generate token if it doesn't exist
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION['csrf_token'];
}