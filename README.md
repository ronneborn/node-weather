# currecy-converter.com (Next.js 14 + Prisma)

Production-ready v1 currency conversion platform with live rates, historical charts, programmatic SEO pages, integrated blog CMS, and secure admin panel.

## Features
- Instant conversion with swap, quick amounts, copy result, and last-updated/source labels.
- Dynamic pair pages (`/[from]-to-[to]`) and amount pages (`/[amount]-[from]-to-[to]`).
- Historical chart pages and period stats.
- Integrated blog (posts/categories/tags) stored in PostgreSQL.
- Admin dashboard with post/category/tag/FAQ/pair-content/settings management.
- Technical SEO: metadata, robots, sitemap, RSS, indexable pages.
- Rate provider abstraction with Frankfurter default + fallback scaffolding.

## Tech Stack
Next.js 14 App Router, TypeScript, Tailwind CSS, Prisma ORM, PostgreSQL, NextAuth, Zod, Recharts.

## Local Setup
```bash
cp .env.example .env
npm install
npm run prisma:generate
npm run prisma:migrate
npm run seed
npm run dev
```

## Production (Ubuntu VPS)
```bash
npm ci
npm run prisma:generate
npm run prisma:deploy
npm run seed
npm run build
pm2 start ecosystem.config.js
pm2 save
```

## Nginx
- Copy `nginx.conf.example` into `/etc/nginx/sites-available/currecy-converter.com`
- Enable site and reload nginx.

## Auth
- Seed script creates admin user from `ADMIN_EMAIL` and `ADMIN_PASSWORD`.
- Login at `/admin/login`.

## Notes
- All third-party rate calls are server-side.
- Cached rates stored in `RateCache` table.
- Upload endpoint scaffold is present and should be connected to S3/local object storage for production uploads.
