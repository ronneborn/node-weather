# SurfaceSolutions.se

Produktionsredo lokal tjänstesajt i ren PHP 8.2 + MySQL/MariaDB + Nginx.

## Serverkrav
- PHP 8.2+ med PDO MySQL, mbstring, fileinfo
- MySQL 8+ eller MariaDB 10.6+
- Nginx + PHP-FPM

## Installation
1. Placera mappen på servern, t.ex. `/var/www/SurfaceSolutions`.
2. Skapa databas `surfacesolutions`.
3. Importera schema och seed:
   ```bash
   mysql -u root -p surfacesolutions < database/schema.sql
   mysql -u root -p surfacesolutions < database/seed.sql
   ```
4. Sätt miljövariabler i Nginx/PHP-FPM (APP_URL, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD).
5. Säkerställ skriv-rättigheter till:
   - `public/uploads`
   - `storage/cache`
   - `storage/logs`
6. Aktivera `nginx-surfacesolutions.conf` och ladda om Nginx.

## Körning
- Front controller: `public/index.php`
- Routing via Nginx `try_files`.

## Admin-login (seed)
- URL: `/admin/login`
- E-post: `admin@surfacesolutions.se`
- Lösenord: `Admin123!`

> Byt lösenord direkt efter första inloggning.

## Lokal SEO-generator
I admin under **Lokala sidor**:
1. Ange `service_id`, `service_slug`, `location_id`, `location_slug`.
2. Klicka **Generera**.
3. Systemet skapar slug, H1, meta-title, meta-beskrivning och grundtext.

## Lägga till nya tjänster och orter
- `/admin/services` för tjänster.
- `/admin/locations` för orter.
- Kombinera dem via `/admin/service-location-pages`.

## Deployment-checklista
- [ ] DB importerad
- [ ] Miljövariabler satta
- [ ] Nginx root pekar på `/public`
- [ ] HTTPS aktiverat
- [ ] Backup av databas schemalagd
