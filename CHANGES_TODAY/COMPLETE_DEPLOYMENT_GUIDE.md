# Complete Live Server Deployment Guide

## 📋 Overview

यह guide आपको step-by-step बताता है कि कैसे live server पर update करें।

**Deployment Date:** 2026-04-15  
**Total Files:** 60  
**Commit Hash:** fd4fcb19fa695fb3465fc1effcd769c819aa0c9b

---

## 🎯 What's New?

### Feature: Latest Comment with Date/Time
- Project Summary listing में "Current Progress" column में latest comment दिखता है
- Comment के साथ date और time भी दिखता है
- Format: `"comment text (DD-MM-YYYY HH:MM)"`

### Removed Columns
- "Word Amount (Cost)" - हटाया गया
- "Word Amount (Estimate)" - हटाया गया

---

## 📦 Files in CHANGES_TODAY Folder

```
CHANGES_TODAY/
├── application/          (सभी updated PHP files)
├── assets/              (JavaScript files)
├── db/                  (Database files)
├── setup_us_code.php    (Setup script)
├── README.md            (विस्तृत जानकारी)
├── DEPLOYMENT_SUMMARY.txt
├── LIVE_SERVER_CHECKLIST.md
├── QUICK_SQL_SETUP.sql  ⭐ (सबसे जरूरी)
├── LIVE_SERVER_SQL_QUERIES.sql
├── SQL_EXECUTION_GUIDE.md
└── COMPLETE_DEPLOYMENT_GUIDE.md (यह file)
```

---

## 🚀 Deployment Steps

### Step 1: Database Setup (5 minutes)

**File:** `QUICK_SQL_SETUP.sql`

1. Live server पर phpMyAdmin खोलें
2. अपना database select करें
3. SQL tab खोलें
4. `QUICK_SQL_SETUP.sql` की सभी queries को copy करें
5. phpMyAdmin में paste करें
6. "Go" button पर click करें

**Expected Result:**
```
✓ project_comments table created/verified
✓ created_at column added/verified
✓ Indexes created
✓ Verification query successful
```

### Step 2: File Upload (10 minutes)

1. FTP/SFTP से live server से connect करें
2. CHANGES_TODAY folder की सभी files को upload करें
3. Directory structure maintain करें:
   ```
   CHANGES_TODAY/application/models/ProjectSummary_model.php
   → Live Server: /application/models/ProjectSummary_model.php
   ```

**Key Files to Verify:**
- ✓ application/models/ProjectSummary_model.php
- ✓ application/views/project_summary/list.php
- ✓ सभी अन्य files

### Step 3: Cache Clear (2 minutes)

1. Live server पर application cache clear करें
2. Browser cache clear करें
3. Web server restart करें (अगर जरूरी हो)

### Step 4: Testing (10 minutes)

**Test Checklist:**

- [ ] Project Summary page खुलता है
- [ ] Latest comment दिख रहा है
- [ ] Date/time format सही है (DD-MM-YYYY HH:MM)
- [ ] "Word Amount" columns नहीं दिख रहे
- [ ] Comment modal काम कर रहा है
- [ ] नया comment add हो सकता है
- [ ] Excel export काम कर रहा है
- [ ] Filters काम कर रहे हैं
- [ ] कोई error नहीं है

---

## 📝 SQL Queries Explained

### Query 1: Check Table
```sql
SHOW TABLES LIKE 'project_comments';
```
**क्या करता है:** Check करता है कि table exist करता है

### Query 2: Verify Structure
```sql
DESCRIBE `project_comments`;
```
**क्या करता है:** Table के columns को देखता है

### Query 3: Create Table
```sql
CREATE TABLE IF NOT EXISTS `project_comments` (...)
```
**क्या करता है:** अगर table नहीं है तो create करता है

### Query 4: Add Column
```sql
ALTER TABLE `project_comments` ADD COLUMN `created_at` ...
```
**क्या करता है:** अगर created_at column नहीं है तो add करता है
**⭐ Important:** यह column नया feature के लिए जरूरी है

### Query 5: Create Indexes
```sql
ALTER TABLE `project_comments` ADD INDEX `idx_project_id` ...
```
**क्या करता है:** Database performance को improve करता है

### Query 6: Verification
```sql
SELECT ... (latest comments with date/time)
```
**क्या करता है:** Check करता है कि सब कुछ सही काम कर रहा है

---

## ⚠️ Important Notes

1. **Backup लें पहले**
   - किसी भी query को run करने से पहले database का backup लें
   - सभी files का backup लें

2. **Test करें पहले**
   - Staging environment में पहले test करें
   - Live server पर सीधे update न करें

3. **created_at Column जरूरी है**
   - यह column नया feature के लिए essential है
   - अगर यह column नहीं है तो feature काम नहीं करेगा

4. **File Permissions**
   - PHP files: 644
   - Directories: 755

5. **Database Connectivity**
   - Check करें कि database connection सही है
   - Check करें कि सभी tables exist करते हैं

---

## 🔄 Rollback Procedure (अगर कुछ गलत हो)

### Option 1: Restore from Backup
```bash
# Database restore करें
mysql -u username -p database_name < backup.sql

# Files restore करें
# FTP से पुरानी files upload करें
```

### Option 2: Revert Code Changes
```bash
git revert fd4fcb19fa695fb3465fc1effcd769c819aa0c9b
```

### Option 3: Manual Rollback
1. पुरानी files को फिर से upload करें
2. Database को restore करें
3. Cache clear करें

---

## 📊 Database Schema

### project_comments Table

```sql
CREATE TABLE `project_comments` (
  `id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `comment_id` varchar(50) UNIQUE,
  `project_id` int(11) FOREIGN KEY,
  `comment` text,
  `created_by` int(11),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,  ⭐ Important
  `updated_at` timestamp,
  `is_deleted` tinyint(1) DEFAULT 0
);
```

### Indexes
```sql
idx_project_id    - project_id पर
idx_created_by    - created_by पर
idx_is_deleted    - is_deleted पर
idx_created_at    - created_at पर (performance के लिए)
```

---

## 🧪 Testing Queries

### Check Latest Comments
```sql
SELECT 
    pd.work_name,
    pc.comment,
    DATE_FORMAT(pc.created_at, '%d-%m-%Y %H:%i') as date_time
FROM project_details pd
LEFT JOIN project_comments pc ON pd.id = pc.project_id
WHERE pc.is_deleted = 0
ORDER BY pc.created_at DESC
LIMIT 10;
```

### Check Comment Count
```sql
SELECT 
    COUNT(*) as total_comments,
    SUM(CASE WHEN is_deleted = 0 THEN 1 ELSE 0 END) as active_comments
FROM project_comments;
```

### Check for Issues
```sql
-- Orphaned comments (project deleted but comment exists)
SELECT * FROM project_comments pc
LEFT JOIN project_details pd ON pd.id = pc.project_id
WHERE pd.id IS NULL AND pc.is_deleted = 0;

-- Invalid user references
SELECT * FROM project_comments pc
LEFT JOIN tbl_users u ON u.userId = pc.created_by
WHERE u.userId IS NULL AND pc.is_deleted = 0;
```

---

## 📞 Support & Troubleshooting

### Common Issues

**Issue 1: Comments नहीं दिख रहे**
- Check करें कि project_comments table में data है
- Check करें कि created_at column exist करता है
- Browser cache clear करें

**Issue 2: Date/time format गलत है**
- Check करें कि database में created_at timestamp है
- Check करें कि PHP में date format सही है
- Browser console में error check करें

**Issue 3: Page slow है**
- Indexes create करें (Query 5)
- Database query optimize करें
- Large datasets के लिए pagination check करें

**Issue 4: SQL Error आ रहा है**
- Table name check करें (case-sensitive हो सकता है)
- Column names check करें
- Database user permissions check करें

---

## ✅ Final Checklist

### Pre-Deployment
- [ ] Database backup लिया
- [ ] Files backup लिया
- [ ] Staging में test किया
- [ ] Team को notify किया

### Deployment
- [ ] SQL queries run कीं
- [ ] Files upload कीं
- [ ] Directory structure verify किया
- [ ] File permissions set कीं
- [ ] Cache clear किया

### Post-Deployment
- [ ] Project Summary page खुलता है
- [ ] Latest comment दिख रहा है
- [ ] Date/time format सही है
- [ ] कोई error नहीं है
- [ ] Performance acceptable है
- [ ] सभी features काम कर रहे हैं

### Sign-Off
- [ ] Testing complete
- [ ] No critical issues
- [ ] Deployment successful
- [ ] Team approval

---

## 📚 Additional Resources

- **README.md** - Files की detailed list
- **DEPLOYMENT_SUMMARY.txt** - Deployment overview
- **LIVE_SERVER_CHECKLIST.md** - Testing checklist
- **SQL_EXECUTION_GUIDE.md** - SQL queries की detailed guide
- **QUICK_SQL_SETUP.sql** - सबसे जरूरी SQL queries

---

## 🎉 You're Ready!

अब आप live server पर update करने के लिए तैयार हैं।

**Steps:**
1. SQL queries run करें
2. Files upload करें
3. Cache clear करें
4. Testing करें
5. Done! ✓

---

**Questions?** सभी documentation files में detailed information है।

**Last Updated:** 2026-04-15  
**Status:** Ready for Deployment
