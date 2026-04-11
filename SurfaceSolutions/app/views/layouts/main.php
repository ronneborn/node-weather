<!doctype html>
<html lang="sv">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title ?? 'SurfaceSolutions') ?></title>
<meta name="description" content="<?= e($description ?? 'Lokala tjänster i Västerås') ?>">
<link rel="canonical" href="<?= e(base_url(trim($_SERVER['REQUEST_URI'] ?? '/', '/'))) ?>">
<meta property="og:title" content="<?= e($title ?? 'SurfaceSolutions') ?>"><meta property="og:description" content="<?= e($description ?? '') ?>">
<link rel="stylesheet" href="/assets/css/style.css">
</head><body>
<header class="nav"><div class="container"><a href="/" class="logo">SurfaceSolutions</a><nav><a href="/tjanster">Tjänster</a><a href="/omraden">Områden</a><a href="/blogg">Blogg</a><a href="/kontakt" class="btn">Få offert</a></nav></div></header>
<main><?= $content ?></main>
<footer><div class="container"><p>SurfaceSolutions AB • Västerås • 021-12 34 56 • hej@surfacesolutions.se</p></div></footer>
<script src="/assets/js/app.js"></script>
</body></html>
