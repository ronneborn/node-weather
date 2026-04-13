<h1>Admin</h1>
<ul>
  <li>Användare: <?= (int) ($stats['users'] ?? 0) ?></li>
  <li>Webbplatser: <?= (int) ($stats['websites'] ?? 0) ?></li>
  <li>Aktiva abonnemang: <?= (int) ($stats['subscriptions'] ?? 0) ?></li>
</ul>
