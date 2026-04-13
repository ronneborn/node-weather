<h1>Hej <?= e($user['name'] ?? '') ?></h1>
<p>Antal webbplatser: <?= count($websites ?? []) ?></p>
<a href="/app/webbplatser/skapa">Lägg till webbplats</a>
