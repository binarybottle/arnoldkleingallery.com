# PHP Modernization - Quick Start Guide

## What Was Fixed

Your PHP website wasn't working because of **deprecated PHP short tags** and a **missing database connection file**. Modern PHP versions (7.4+) have `short_open_tag` disabled by default, which broke all the `<?` tags.

## Files Changed

### ✅ Fixed (24 files)
All PHP short tags (`<?`) have been converted to full tags (`<?php`) in:
- `index.php`
- `artist.php`, `artists.php`, `artists_browse.php`, `artists_misc.php`, `artists_sold.php`
- `artwork.php`, `art.php`, `art_browse.php`
- `book.php`, `books_listing.php`
- `search.php`, `browse.php`, `sold.php`
- `shared/ui/` files (header, display components)
- Plus 10 more files throughout the codebase

### ✨ Created
- `/db/arnoldkleingallery_db.php` - Database connection (YOU MUST EDIT THIS)
- `/shared/lib/security_helpers.php` - Security functions
- `README_PHP_FIXES.md` - Detailed documentation
- `check_php_syntax.sh` - Syntax checker script

## ⚠️ REQUIRED: Update Database Credentials

Edit this file: `/db/arnoldkleingallery_db.php`

```php
$db_host = 'localhost';              // ← Change to your MySQL host
$db_user = 'your_database_user';     // ← Change to your MySQL username  
$db_pass = 'your_database_password'; // ← Change to your MySQL password
$db_name = 'arnoldkleingallery';     // ← Change if your DB has a different name
```

## Quick Test

1. **Update the database credentials** (see above)
2. Upload files to your web server
3. Visit your website homepage
4. If you see "Connection failed:", check your database credentials
5. If pages load, test:
   - Home page
   - Click "Artists"
   - Search for something
   - Click on an artwork

## Requirements

- PHP 7.4 or higher (PHP 8.0+ recommended)
- MySQL 5.6+ or MariaDB
- mysqli PHP extension (usually included)

## What If It Still Doesn't Work?

### Check PHP Version
```bash
php -v
```
Should show 7.4 or higher.

### Check Error Logs
Look for errors in:
- Your website's `error_log` file
- Server error logs (ask your hosting provider)

### Common Issues

1. **"Call to undefined function sanitize_int()"**
   - The database file includes security_helpers.php automatically
   - Make sure the `/shared/lib/security_helpers.php` file exists

2. **"Connection failed"**
   - Check database credentials in `/db/arnoldkleingallery_db.php`
   - Verify MySQL is running
   - Check database name is correct

3. **Blank pages**
   - Enable error display in PHP (or check logs)
   - Verify file permissions (files: 644, folders: 755)

## Next Steps

Once the site is working:
1. ✅ Verify all pages load correctly
2. ✅ Test search functionality
3. ✅ Test artist and artwork pages
4. ✅ Check that images display properly
5. 🔒 Consider enabling HTTPS if not already
6. 💾 Set up regular backups

## Security Notes

Basic SQL injection protection has been added, but for maximum security:
- Use HTTPS (SSL certificate)
- Keep PHP and MySQL updated
- Regular backups
- Consider using prepared statements for all queries (advanced)

---

**Need Help?**
- See `README_PHP_FIXES.md` for detailed information
- Check your hosting provider's documentation
- Verify PHP version and extensions

**Everything working?** Great! Your website should now be compatible with modern PHP versions.

