<h1>Skapa konto</h1>
<form method="post" action="/registrera">
  <input type="hidden" name="_csrf" value="<?= e(App\Core\Csrf::token()) ?>">
  <label>Namn <input type="text" name="name" required></label>
  <label>E-post <input type="email" name="email" required></label>
  <label>Lösenord <input type="password" name="password" minlength="8" required></label>
  <button type="submit">Skapa konto</button>
</form>
