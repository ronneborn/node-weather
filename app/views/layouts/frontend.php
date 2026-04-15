<!doctype html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title ?? 'Lokal Tjänstesajt', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<header>
    <nav>
        <a href="/">Start</a>
        <a href="/admin">Admin</a>
    </nav>
</header>
<main>
    <?= $content ?>
</main>
<footer>
    <small>&copy; <?= date('Y') ?> Lokal Tjänstesajt</small>
</footer>
</body>
</html>
