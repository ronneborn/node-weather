# Kakio V1

Kakio är en svensk SaaS för cookie-banner, samtyckeshantering, consent-loggar och enkel scanning.

## Systemkrav
- Ubuntu 22.04+
- Nginx
- PHP 8.3+
- MySQL 8+ / MariaDB 10.6+

## Installation
1. Klona projektet och gå till `kakio/`.
2. Kopiera `.env.example` till `.env` och fyll i databasuppgifter.
3. Skapa databas och kör SQL:
   ```bash
   mysql -u USER -p DATABASE < database/migrations/001_init.sql
   mysql -u USER -p DATABASE < database/seeders/001_plans.sql
   ```
4. Sätt rättigheter:
   ```bash
   chmod -R 775 storage
   ```

## Nginx-exempel
```nginx
server {
    listen 80;
    server_name kakio.se;
    root /var/www/kakio/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location /cmp/ {
        try_files $uri =404;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

## Cron för scanning
Kör scan-runner varje minut:
```bash
* * * * * /usr/bin/php /var/www/kakio/tasks/scan_runner.php >> /var/www/kakio/storage/logs/scan.log 2>&1
```

## Loader-script på extern sajt
Lägg in detta i `<head>` eller före `</body>`:
```html
<script defer src="https://kakio.se/cmp/loader.js" data-site-key="SITE_KEY"></script>
```

Manuell script-blockering i V1:
```html
<script type="text/plain" data-kakio-category="statistics" src="https://www.googletagmanager.com/gtag/js?id=G-XXXX"></script>
```

## Admin-login
- Skapa en användare i `users` med `role='admin'`.
- Logga in via `/logga-in` och öppna `/admin`.

## Lokal utveckling
```bash
php -S localhost:8080 -t public
```

## Struktur
Projektet använder MVC-liknande struktur utan tungt ramverk, PDO prepared statements, CSRF-skydd och middleware-baserad route-kontroll.
