CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
);

CREATE TABLE plans (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(50) NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  max_websites INT NOT NULL,
  scans_per_month INT NOT NULL,
  allow_remove_branding TINYINT(1) NOT NULL DEFAULT 0,
  consent_log_enabled TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL
);

CREATE TABLE subscriptions (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  plan_id BIGINT UNSIGNED NOT NULL,
  status ENUM('active','canceled','past_due') NOT NULL DEFAULT 'active',
  starts_at DATETIME NOT NULL,
  ends_at DATETIME NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  INDEX idx_sub_user (user_id),
  CONSTRAINT fk_sub_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_sub_plan FOREIGN KEY (plan_id) REFERENCES plans(id)
);

CREATE TABLE websites (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NOT NULL,
  domain VARCHAR(255) NOT NULL,
  site_key VARCHAR(80) NOT NULL UNIQUE,
  status ENUM('active','paused','disabled') NOT NULL DEFAULT 'active',
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  INDEX idx_web_user (user_id),
  CONSTRAINT fk_web_user FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE banner_settings (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL UNIQUE,
  title VARCHAR(190) NOT NULL,
  body TEXT NOT NULL,
  accept_text VARCHAR(100) NOT NULL,
  deny_text VARCHAR(100) NOT NULL,
  preferences_text VARCHAR(100) NOT NULL,
  position VARCHAR(40) NOT NULL DEFAULT 'bottom',
  primary_color VARCHAR(20) NOT NULL DEFAULT '#1d4ed8',
  revision INT NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  CONSTRAINT fk_banner_website FOREIGN KEY (website_id) REFERENCES websites(id)
);

CREATE TABLE cookie_categories (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  slug VARCHAR(40) NOT NULL,
  label VARCHAR(120) NOT NULL,
  required TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  UNIQUE KEY uq_cat (website_id, slug),
  CONSTRAINT fk_cat_website FOREIGN KEY (website_id) REFERENCES websites(id)
);

CREATE TABLE scans (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  status ENUM('queued','running','completed','failed') NOT NULL DEFAULT 'queued',
  result_summary JSON NULL,
  error_message VARCHAR(255) NULL,
  started_at DATETIME NULL,
  completed_at DATETIME NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  INDEX idx_scan_web (website_id),
  CONSTRAINT fk_scan_website FOREIGN KEY (website_id) REFERENCES websites(id)
);

CREATE TABLE scripts (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  scan_id BIGINT UNSIGNED NULL,
  src TEXT NOT NULL,
  category VARCHAR(40) NOT NULL DEFAULT 'uncategorized',
  created_at DATETIME NOT NULL,
  INDEX idx_script_web (website_id),
  CONSTRAINT fk_script_website FOREIGN KEY (website_id) REFERENCES websites(id),
  CONSTRAINT fk_script_scan FOREIGN KEY (scan_id) REFERENCES scans(id)
);

CREATE TABLE detected_cookies (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  scan_id BIGINT UNSIGNED NULL,
  name VARCHAR(180) NOT NULL,
  domain VARCHAR(180) NULL,
  category VARCHAR(40) NOT NULL DEFAULT 'uncategorized',
  created_at DATETIME NOT NULL,
  INDEX idx_cookie_web (website_id),
  CONSTRAINT fk_cookie_website FOREIGN KEY (website_id) REFERENCES websites(id),
  CONSTRAINT fk_cookie_scan FOREIGN KEY (scan_id) REFERENCES scans(id)
);

CREATE TABLE consent_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  consent_uuid CHAR(36) NOT NULL,
  revision INT NOT NULL,
  necessary TINYINT(1) NOT NULL,
  statistics TINYINT(1) NOT NULL,
  marketing TINYINT(1) NOT NULL,
  functional TINYINT(1) NOT NULL,
  source VARCHAR(24) NOT NULL,
  ip_hash CHAR(64) NOT NULL,
  user_agent_hash CHAR(64) NOT NULL,
  page_url VARCHAR(512) NULL,
  language VARCHAR(12) NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_consent_web (website_id),
  INDEX idx_consent_uuid (consent_uuid),
  CONSTRAINT fk_consent_website FOREIGN KEY (website_id) REFERENCES websites(id)
);

CREATE TABLE policy_documents (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  website_id BIGINT UNSIGNED NOT NULL,
  type ENUM('cookie_policy','privacy_text') NOT NULL,
  content MEDIUMTEXT NOT NULL,
  version INT NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  CONSTRAINT fk_policy_website FOREIGN KEY (website_id) REFERENCES websites(id)
);

CREATE TABLE audit_logs (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT UNSIGNED NULL,
  website_id BIGINT UNSIGNED NULL,
  action VARCHAR(120) NOT NULL,
  metadata JSON NULL,
  created_at DATETIME NOT NULL,
  INDEX idx_audit_user (user_id),
  CONSTRAINT fk_audit_user FOREIGN KEY (user_id) REFERENCES users(id),
  CONSTRAINT fk_audit_website FOREIGN KEY (website_id) REFERENCES websites(id)
);
