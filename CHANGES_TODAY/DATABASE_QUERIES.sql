-- ============================================
-- DATABASE CHANGES - March 31, 2026
-- ============================================

-- TASK 4: Add Reject Status to Jansunwai Table
-- ============================================
ALTER TABLE `jansunwai` MODIFY COLUMN `work_status` ENUM('Approval','Complete','Incomplete','In Progress','Reject') DEFAULT 'Approval';

-- TASK 2: Create SMS Queue Table for Background Processing
-- ============================================
CREATE TABLE IF NOT EXISTS `sms_queue` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT NOT NULL,
  `phone_number` VARCHAR(20) NOT NULL,
  `message` TEXT NOT NULL,
  `template_id` INT,
  `status` ENUM('pending', 'sent', 'failed') DEFAULT 'pending',
  `attempts` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `sent_at` TIMESTAMP NULL,
  `error_message` TEXT,
  INDEX `idx_status` (`status`),
  INDEX `idx_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- TASK 8: Add Google Calendar Sync Field to Events Table (if not exists)
-- ============================================
-- Check if column exists first, if not add it
ALTER TABLE `events` ADD COLUMN `google_event_id` VARCHAR(255) NULL AFTER `remark`;

-- TASK 8: Add Press Field to Events Table (if not exists)
-- ============================================
ALTER TABLE `events` ADD COLUMN `press` VARCHAR(255) DEFAULT 'NA' AFTER `attended`;

-- TASK 8: Add Event Details Field to Events Table (if not exists)
-- ============================================
ALTER TABLE `events` ADD COLUMN `event_detail` VARCHAR(255) DEFAULT 'NA' AFTER `event_type`;

-- ============================================
-- VERIFICATION QUERIES (Run these to check)
-- ============================================

-- Check jansunwai table structure
-- DESCRIBE jansunwai;

-- Check events table structure
-- DESCRIBE events;

-- Check sms_queue table exists
-- DESCRIBE sms_queue;

-- Check work_status enum values
-- SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='jansunwai' AND COLUMN_NAME='work_status';
