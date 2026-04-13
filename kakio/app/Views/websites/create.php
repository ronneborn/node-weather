<h1>Ny webbplats</h1>
<form method="post" action="/app/webbplatser/skapa">
  <input type="hidden" name="_csrf" value="<?= e(App\Core\Csrf::token()) ?>">
  <label>Domän <input type="text" name="domain" placeholder="example.se" required></label>
  <button type="submit">Skapa</button>
</form>
