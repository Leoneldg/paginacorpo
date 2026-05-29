<?php

function getDatabaseConnection(): PDO
{
    $host = '127.0.0.1';
    $dbname = 'dbcorpo';
    $username = 'adminti';
    $password = 'Corpo2026*';
    $charset = 'utf8mb4';

    $dsn = "mysql:host={$host};dbname={$dbname};charset={$charset}";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    return $pdo;
}

function getSettings(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT `key`, `value` FROM `settings`');
    $rows = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    return $rows ?: [];
}

function getNewsItems(PDO $pdo): array
{
    $stmt = $pdo->query('SELECT `id`, `title`, `description`, `image_url`, `order_index` FROM `news_items` ORDER BY `order_index` ASC');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function saveSetting(PDO $pdo, string $key, string $value): void
{
    $stmt = $pdo->prepare('INSERT INTO `settings` (`key`, `value`) VALUES (:key, :value) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`)');
    $stmt->execute([':key' => $key, ':value' => $value]);
}

function saveNewsItem(PDO $pdo, int $order, string $title, string $description, string $imageUrl): void
{
    $stmt = $pdo->prepare('INSERT INTO `news_items` (`title`, `description`, `image_url`, `order_index`) VALUES (:title, :description, :image_url, :order_index) ON DUPLICATE KEY UPDATE `title` = VALUES(`title`), `description` = VALUES(`description`), `image_url` = VALUES(`image_url`)');
    $stmt->execute([
        ':title' => $title,
        ':description' => $description,
        ':image_url' => $imageUrl,
        ':order_index' => $order,
    ]);
}
