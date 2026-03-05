<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/../../includes/config.php';
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';
require_once __DIR__ . '/../../includes/auth.php';

function adminTableExists(PDO $pdo, string $table): bool {
    $quotedTable = $pdo->quote($table);
    $stmt = $pdo->query("SHOW TABLES LIKE {$quotedTable}");
    return (bool) $stmt->fetchColumn();
}

function adminFetchAll(PDO $pdo, string $query, array $params = []): array {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
}
