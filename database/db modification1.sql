-- KILO FLIGHT Schema Migration
-- Run this after the original schema has been created

USE kiloflight;

-- =========================
-- Team Members: add display_order
-- =========================
ALTER TABLE team_members
    ADD COLUMN display_order INT DEFAULT 0 AFTER bio;

-- =========================
-- Projects: add status + display_order
-- =========================
ALTER TABLE projects
    ADD COLUMN status VARCHAR(50) DEFAULT 'Ongoing' AFTER link,
    ADD COLUMN display_order INT DEFAULT 0 AFTER status;

-- =========================
-- Sponsors: add display_order
-- =========================
ALTER TABLE sponsors
    ADD COLUMN display_order INT DEFAULT 0 AFTER website;

-- =========================
-- Gallery Items: add display_order
-- =========================
ALTER TABLE gallery_items
    ADD COLUMN display_order INT DEFAULT 0 AFTER image;
