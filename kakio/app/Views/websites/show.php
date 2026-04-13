<h1><?= e($site['domain'] ?? '') ?></h1>
<p>Site key: <code><?= e($site['site_key'] ?? '') ?></code></p>
<pre>&lt;script defer src="<?= e(app_url('cmp/loader.js')) ?>" data-site-key="<?= e($site['site_key'] ?? '') ?>"&gt;&lt;/script&gt;</pre>

<h2>Banner</h2>
<form method="post" action="/app/webbplatser/<?= (int)$site['id'] ?>/banner">
  <input type="hidden" name="_csrf" value="<?= e(App\Core\Csrf::token()) ?>">
  <input type="text" name="title" value="<?= e($banner['title'] ?? '') ?>" placeholder="Rubrik">
  <textarea name="body" placeholder="Brödtext"><?= e($banner['body'] ?? '') ?></textarea>
  <button type="submit">Spara banner</button>
</form>

<h2>Scans</h2>
<form method="post" action="/app/webbplatser/<?= (int)$site['id'] ?>/scans">
  <input type="hidden" name="_csrf" value="<?= e(App\Core\Csrf::token()) ?>">
  <button type="submit">Starta scan</button>
</form>

<h2>Consent-logg</h2>
<table><tr><th>Datum</th><th>Statistik</th><th>Marketing</th><th>Functional</th></tr>
<?php foreach (($consents ?? []) as $row): ?>
<tr><td><?= e($row['created_at']) ?></td><td><?= (int)$row['statistics'] ?></td><td><?= (int)$row['marketing'] ?></td><td><?= (int)$row['functional'] ?></td></tr>
<?php endforeach; ?></table>
