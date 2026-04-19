<?php

$pageTitle = 'Employee Siyahisi';
require __DIR__ . '/../layouts/header.php';

$employees = $result['data'];
$totalPages = $result['pages'];
$currentPage = $result['current_page'];
?>

<div class="card">
    <form method="GET" action="index.php" class="search-form">
        <input type="hidden" name="action" value="list">
        <input type="text" name="search" value="<?= e($search); ?>" placeholder="Ad, soyad ve ya email uzre axtar">
        <button class="btn btn-secondary" type="submit">Axtar</button>
        <?php if ($search !== ''): ?>
            <a class="btn btn-light" href="index.php">Temizle</a>
        <?php endif; ?>
    </form>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Vəzifə</th>
                    <th>Maaş</th>
                    <th>Fəaliyyətlər</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($employees === []): ?>
                    <tr>
                        <td colspan="6" class="empty-state">Məlumat tapılmadı.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?= e($employee['first_name'] . ' ' . $employee['last_name']); ?></td>
                            <td><?= e($employee['email']); ?></td>
                            <td><?= e($employee['phone']); ?></td>
                            <td><?= e($employee['position']); ?></td>
                            <td><?= e(number_format((float) $employee['salary'], 2)); ?></td>
                            <td class="actions">
                                <a class="btn btn-small btn-secondary"
                                    href="index.php?action=edit&id=<?= (int) $employee['id']; ?>">Redaktə et</a>
                                <form method="POST" action="index.php?action=delete&id=<?= (int) $employee['id']; ?>"
                                    onsubmit="return confirm('Seçilmiş əməkdaş silinsin?');">
                                    <button class="btn btn-small btn-danger" type="submit">Sil</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div class="pagination">
            <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                <a class="<?= $page === $currentPage ? 'active' : ''; ?>"
                    href="index.php?page=<?= $page; ?>&search=<?= urlencode($search); ?>">
                   <?= $page; ?>
                </a>
          <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>