CREATE TABLE users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(30) NOT NULL DEFAULT 'admin',
  status VARCHAR(20) NOT NULL DEFAULT 'active',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE pages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(190) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  h1 VARCHAR(190) DEFAULT NULL,
  content MEDIUMTEXT,
  featured_image VARCHAR(255) DEFAULT NULL,
  meta_title VARCHAR(190) DEFAULT NULL,
  meta_description VARCHAR(255) DEFAULT NULL,
  canonical_url VARCHAR(255) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'published',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_pages_status (status)
);
CREATE TABLE services (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  slug VARCHAR(160) NOT NULL UNIQUE,
  short_description VARCHAR(255) DEFAULT NULL,
  content MEDIUMTEXT,
  featured_image VARCHAR(255) DEFAULT NULL,
  meta_title VARCHAR(190) DEFAULT NULL,
  meta_description VARCHAR(255) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'active',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_services_status (status)
);
CREATE TABLE locations (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  slug VARCHAR(140) NOT NULL UNIQUE,
  intro TEXT,
  content MEDIUMTEXT,
  meta_title VARCHAR(190) DEFAULT NULL,
  meta_description VARCHAR(255) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'active',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_locations_status (status)
);
CREATE TABLE service_location_pages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  service_id INT UNSIGNED NOT NULL,
  location_id INT UNSIGNED NOT NULL,
  service_slug VARCHAR(160) NOT NULL,
  location_slug VARCHAR(140) NOT NULL,
  title VARCHAR(190) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  h1 VARCHAR(190) DEFAULT NULL,
  intro TEXT,
  content MEDIUMTEXT,
  featured_image VARCHAR(255) DEFAULT NULL,
  meta_title VARCHAR(190) DEFAULT NULL,
  meta_description VARCHAR(255) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'published',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_slp_service_location (service_id, location_id),
  INDEX idx_slp_status (status)
);
CREATE TABLE blog_categories (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  slug VARCHAR(140) NOT NULL UNIQUE,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE blog_posts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  category_id INT UNSIGNED DEFAULT NULL,
  title VARCHAR(190) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  excerpt TEXT,
  content MEDIUMTEXT,
  featured_image VARCHAR(255) DEFAULT NULL,
  meta_title VARCHAR(190) DEFAULT NULL,
  meta_description VARCHAR(255) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'draft',
  published_at DATETIME DEFAULT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_blog_status (status),
  INDEX idx_blog_published (published_at)
);
CREATE TABLE faqs (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  page_type VARCHAR(30) DEFAULT NULL,
  page_id INT UNSIGNED DEFAULT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  status VARCHAR(20) NOT NULL DEFAULT 'active',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_faq_page (page_type, page_id)
);
CREATE TABLE contact_submissions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(60) DEFAULT NULL,
  message TEXT NOT NULL,
  service_slug VARCHAR(160) DEFAULT NULL,
  location_slug VARCHAR(140) DEFAULT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'new',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_leads_status (status)
);
CREATE TABLE media (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  file_name VARCHAR(255) NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  mime_type VARCHAR(100) DEFAULT NULL,
  alt_text VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE redirects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  old_path VARCHAR(255) NOT NULL UNIQUE,
  new_path VARCHAR(255) NOT NULL,
  status_code SMALLINT NOT NULL DEFAULT 301,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(120) NOT NULL UNIQUE,
  `value` TEXT,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);
CREATE TABLE page_views (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  page_type VARCHAR(40) NOT NULL,
  page_id INT UNSIGNED DEFAULT NULL,
  slug VARCHAR(190) NOT NULL,
  visited_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ip_hash CHAR(64) NOT NULL,
  user_agent_hash CHAR(64) NOT NULL,
  referrer VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX idx_views_date (visited_at),
  INDEX idx_views_slug (slug)
);
