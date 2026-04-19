<?php

$flashMessage = flash();
?>
<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Employee Management'); ?></title>
    <link rel="stylesheet" href="public/assets/css/styles.css">
</head>
<body>
<div class="container">
    <div class="topbar">
        <a class="btn btn-primary" href="index.php?action=create">+ İşçi Əlave Et</a>
    </div>

    <?php if ($flashMessage !== null): ?>
        <div class="alert alert-<?= e($flashMessage['type']); ?>">
            <?= e($flashMessage['message']); ?>
        </div>
    <?php endif; ?>
