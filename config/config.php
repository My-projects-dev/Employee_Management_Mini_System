<?php

declare(strict_types=1);

session_start();

define('BASE_URL', '/');

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path = 'index.php'): void
{
    header('Location: ' . $path);
    exit;
}

function redirect_with_message(string $type, string $message, string $path = 'index.php'): void
{
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
    ];

    redirect($path);
}

function old(string $key, string $default = ''): string
{
    return $_SESSION['old'][$key] ?? $default;
}

function set_old(array $data): void
{
    $_SESSION['old'] = $data;
}

function clear_old(): void
{
    unset($_SESSION['old']);
}

function flash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}
