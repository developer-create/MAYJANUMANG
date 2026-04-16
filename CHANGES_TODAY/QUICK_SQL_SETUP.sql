-- ============================================
-- QUICK SQL SETUP - Run these queries only
-- ============================================

-- Step 1: Check if project_comments table exists
SHOW TABLES LIKE 'project_comments';

-- Step 2: If table exists, verify structure
DESCRIBE `project_comments`;

-- Step 3: Create table if it doesn't exist
CREATE TABLE IF NOT EXISTS `project_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` varchar(50) NOT NULL,
  `project_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_comment_id` (`comment_id`),
  KEY `idx_project_id` (`project_id`),
  KEY `idx_created_by` (`created_by`),
  KEY `idx_is_deleted` (`is_deleted`),
  CONSTRAINT `fk_project_comments_project` FOREIGN KEY (`project_id`) REFERENCES `project_details` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Step 4: Add created_at column if missing
ALTER TABLE `project_comments` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by`;

-- Step 5: Create performance indexes
ALTER TABLE `project_comments` ADD INDEX `idx_project_id` (`project_id`);
ALTER TABLE `project_comments` ADD INDEX `idx_created_by` (`created_by`);
ALTER TABLE `project_comments` ADD INDEX `idx_is_deleted` (`is_deleted`);
ALTER TABLE `project_comments` ADD INDEX `idx_created_at` (`created_at`);

-- Step 6: Verify setup - Run this to check everything is working
SELECT 
    pd.id,
    pd.work_name,
    COALESCE(CONCAT(pc.comment, ' (', DATE_FORMAT(pc.created_at, '%d-%m-%Y %H:%i'), ')'), 'No comments') as last_comment
FROM `project_details` pd
LEFT JOIN (
    SELECT pc1.project_id, pc1.comment, pc1.created_at
    FROM `project_comments` pc1
    INNER JOIN (
        SELECT project_id, MAX(id) as max_id 
        FROM `project_comments`
        WHERE is_deleted = 0
        GROUP BY project_id
    ) pc2 ON pc1.project_id = pc2.project_id AND pc1.id = pc2.max_id
    WHERE pc1.is_deleted = 0
) pc ON pc.project_id = pd.id
WHERE pd.is_deleted = 0
ORDER BY pd.id DESC
LIMIT 20;

-- ============================================
-- That's it! Your database is ready.
-- ============================================
