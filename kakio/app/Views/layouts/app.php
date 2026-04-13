<!doctype html>
<html lang="sv">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= e($title ?? 'Kakio') ?></title>
  <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body>
<header class="topbar">
  <a href="/" class="logo">Kakio</a>
  <nav>
    <a href="/funktioner">Funktioner</a>
    <a href="/priser">Priser</a>
    <a href="/kontakt">Kontakt</a>
    <a href="/app">App</a>
  </nav>
</header>
<main class="container"><?= $content ?></main>
</body>
</html>
