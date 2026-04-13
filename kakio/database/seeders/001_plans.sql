INSERT INTO plans (id, slug, name, max_websites, scans_per_month, allow_remove_branding, consent_log_enabled, created_at, updated_at) VALUES
(1, 'free', 'Free', 1, 3, 0, 1, NOW(), NOW()),
(2, 'start', 'Start', 5, 20, 0, 1, NOW(), NOW()),
(3, 'pro', 'Pro', 20, 100, 1, 1, NOW(), NOW()),
(4, 'agency', 'Agency', 100, 1000, 1, 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE name=VALUES(name), max_websites=VALUES(max_websites), scans_per_month=VALUES(scans_per_month);
