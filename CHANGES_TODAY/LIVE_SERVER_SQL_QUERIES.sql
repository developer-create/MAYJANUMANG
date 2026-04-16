-- ============================================
-- Live Server SQL Queries
-- Deployment Date: 2026-04-15
-- ============================================

-- ============================================
-- 1. Verify project_comments table exists
-- ============================================
-- Run this to check if table exists
SHOW TABLES LIKE 'project_comments';

-- ============================================
-- 2. Verify project_comments table structure
-- ============================================
-- Run this to verify all required columns exist
DESCRIBE `project_comments`;

-- Expected columns:
-- id, comment_id, project_id, comment, created_by, created_at, updated_at, is_deleted

-- ============================================
-- 3. Create project_comments table (if not exists)
-- ============================================
-- Run this only if table doesn't exist
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

-- ============================================
-- 4. Add created_at column (if missing)
-- ============================================
-- Run this only if created_at column doesn't exist
ALTER TABLE `project_comments` ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_by`;

-- ============================================
-- 5. Create indexes for better performance
-- ============================================
-- Run these to optimize queries
ALTER TABLE `project_comments` ADD INDEX `idx_project_id` (`project_id`);
ALTER TABLE `project_comments` ADD INDEX `idx_created_by` (`created_by`);
ALTER TABLE `project_comments` ADD INDEX `idx_is_deleted` (`is_deleted`);
ALTER TABLE `project_comments` ADD INDEX `idx_created_at` (`created_at`);

-- ============================================
-- 6. Verify project_details table
-- ============================================
-- Run this to check project_details table
DESCRIBE `project_details`;

-- ============================================
-- 7. Check existing comments
-- ============================================
-- Run this to see all comments with date/time
SELECT 
    pc.id,
    pc.project_id,
    pc.comment,
    pc.created_by,
    pc.created_at,
    pd.work_name,
    u.name as created_by_name
FROM `project_comments` pc
LEFT JOIN `project_details` pd ON pd.id = pc.project_id
LEFT JOIN `tbl_users` u ON u.userId = pc.created_by
WHERE pc.is_deleted = 0
ORDER BY pc.created_at DESC
LIMIT 10;

-- ============================================
-- 8. Check latest comment for each project
-- ============================================
-- Run this to verify latest comments are fetching correctly
SELECT 
    pd.id,
    pd.work_name,
    pc.comment,
    DATE_FORMAT(pc.created_at, '%d-%m-%Y %H:%i') as formatted_date,
    CONCAT(pc.comment, ' (', DATE_FORMAT(pc.created_at, '%d-%m-%Y %H:%i'), ')') as display_text
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
-- 9. Verify tbl_users table
-- ============================================
-- Run this to check users table
DESCRIBE `tbl_users`;

-- ============================================
-- 10. Check for any data integrity issues
-- ============================================
-- Run this to find orphaned comments
SELECT 
    pc.id,
    pc.project_id,
    pc.comment,
    pd.id as project_exists
FROM `project_comments` pc
LEFT JOIN `project_details` pd ON pd.id = pc.project_id
WHERE pd.id IS NULL AND pc.is_deleted = 0;

-- ============================================
-- 11. Check for missing user references
-- ============================================
-- Run this to find comments with invalid user references
SELECT 
    pc.id,
    pc.project_id,
    pc.created_by,
    u.userId as user_exists
FROM `project_comments` pc
LEFT JOIN `tbl_users` u ON u.userId = pc.created_by
WHERE u.userId IS NULL AND pc.is_deleted = 0;

-- ============================================
-- 12. Database Statistics
-- ============================================
-- Run this to get statistics
SELECT 
    'project_comments' as table_name,
    COUNT(*) as total_records,
    SUM(CASE WHEN is_deleted = 0 THEN 1 ELSE 0 END) as active_records,
    SUM(CASE WHEN is_deleted = 1 THEN 1 ELSE 0 END) as deleted_records
FROM `project_comments`
UNION ALL
SELECT 
    'project_details' as table_name,
    COUNT(*) as total_records,
    SUM(CASE WHEN is_deleted = 0 THEN 1 ELSE 0 END) as active_records,
    SUM(CASE WHEN is_deleted = 1 THEN 1 ELSE 0 END) as deleted_records
FROM `project_details`;

-- ============================================
-- EXECUTION ORDER FOR LIVE SERVER
-- ============================================
-- 1. First run query #1 to check if table exists
-- 2. If table doesn't exist, run query #3
-- 3. Run query #4 to add created_at column (if needed)
-- 4. Run query #5 to create indexes
-- 5. Run query #7 to verify existing comments
-- 6. Run query #8 to check latest comments display
-- 7. Run query #12 to get statistics

-- ============================================
-- IMPORTANT NOTES
-- ============================================
-- 1. Backup database before running any queries
-- 2. Test in staging environment first
-- 3. created_at column must exist for new feature to work
-- 4. Indexes improve query performance significantly
-- 5. All queries are safe and read-only except for ALTER TABLE
-- 6. If you get errors, check table and column names match your database

-- ============================================
