<?php

$pageTitle = $title;
require __DIR__ . '/../layouts/header.php';

$formValues = [
    'first_name' => old('first_name', $employee['first_name'] ?? ''),
    'last_name' => old('last_name', $employee['last_name'] ?? ''),
    'email' => old('email', $employee['email'] ?? ''),
    'phone' => old('phone', $employee['phone'] ?? ''),
    'position' => old('position', $employee['position'] ?? ''),
    'salary' => old('salary', $employee['salary'] ?? ''),
];
?>

<div class="card form-card">
    <div class="form-heading">
        <h2><?= e($title); ?></h2>
        <a class="btn btn-light" href="index.php">Geri Qayit</a>
    </div>

    <form method="POST" action="<?= e($formAction); ?>" class="employee-form">
        <div class="form-group">
            <label for="first_name">Ad</label>
            <input id="first_name" type="text" name="first_name" value="<?= e($formValues['first_name']); ?>">
            <?php if (isset($errors['first_name'])): ?>
                <small class="error-text"><?= e($errors['first_name']); ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="last_name">Soyad</label>
            <input id="last_name" type="text" name="last_name" value="<?= e($formValues['last_name']); ?>">
            <?php if (isset($errors['last_name'])): ?>
                <small class="error-text"><?= e($errors['last_name']); ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="<?= e($formValues['email']); ?>">
            <?php if (isset($errors['email'])): ?>
                <small class="error-text"><?= e($errors['email']); ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone">Telefon</label>
            <input id="phone" type="text" name="phone" value="<?= e($formValues['phone']); ?>">
            <?php if (isset($errors['phone'])): ?>
                <small class="error-text"><?= e($errors['phone']); ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="position">Vezife</label>
            <input id="position" type="text" name="position" value="<?= e($formValues['position']); ?>">
            <?php if (isset($errors['position'])): ?>
                <small class="error-text"><?= e($errors['position']); ?></small>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="salary">Maas</label>
            <input id="salary" type="text" name="salary" value="<?= e($formValues['salary']); ?>">
            <?php if (isset($errors['salary'])): ?>
                <small class="error-text"><?= e($errors['salary']); ?></small>
            <?php endif; ?>
        </div>

        <button class="btn btn-primary" type="submit">Yadda Saxla</button>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
