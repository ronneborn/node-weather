<h1>Logga in</h1>
<form method="post" action="/logga-in">
  <input type="hidden" name="_csrf" value="<?= e(App\Core\Csrf::token()) ?>">
  <label>E-post <input type="email" name="email" required></label>
  <label>Lösenord <input type="password" name="password" required></label>
  <button type="submit">Logga in</button>
</form>
