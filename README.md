# Lokal Tjänstesajt (Etapp 1)

Detta är projektgrunden för en PHP-baserad MVC-struktur anpassad för **Nginx + front controller**.

## Vad som finns i Etapp 1

- Filstruktur för app, public, storage och database
- Front controller i `public/index.php`
- Kärnklasser: Router, Controller, Request, Response, Session, View, Database (PDO)
- Hjälpfunktioner: URL, slug, text, CSRF, SEO
- Grundlayout för frontend och admin
- Enkel autoload + bootstrap
- Exempel på Nginx-konfiguration med `try_files`

## Snabbstart

1. Kopiera `.env.example` till `.env` och uppdatera databasuppgifter.
2. Säkerställ att Nginx `root` pekar på `/public`.
3. Starta PHP-FPM och öppna webbplatsen.

> Inga `.htaccess`-regler används.
