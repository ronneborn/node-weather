<!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Admin', ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
    <aside>
        <h2>Admin</h2>
        <a href="/admin">Översikt</a>
    </aside>
    <section>
        <?= $content ?>
    </section>
</div>
</body>
</html>
