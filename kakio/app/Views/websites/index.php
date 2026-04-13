<h1>Mina webbplatser</h1>
<a href="/app/webbplatser/skapa">Ny webbplats</a>
<table>
<tr><th>Domän</th><th>Status</th><th>Åtgärd</th></tr>
<?php foreach (($websites ?? []) as $site): ?>
<tr>
<td><?= e($site['domain']) ?></td><td><?= e($site['status']) ?></td>
<td><a href="/app/webbplatser/<?= (int) $site['id'] ?>">Öppna</a></td>
</tr>
<?php endforeach; ?>
</table>
