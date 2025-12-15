# Arnold Klein Gallery Website - PHP Modernization

## Overview
This website has been updated to work with modern PHP versions (PHP 7.4+). The following major issues have been fixed:

## Changes Made

### 1. PHP Short Tags Fixed
- Replaced all short PHP tags (`<?`) with full tags (`<?php`)
- This resolves compatibility issues with modern PHP configurations where `short_open_tag` is disabled by default
- **Files Fixed:** 24 PHP files throughout the codebase

### 2. Database Connection Created
- Created missing database connection file: `/db/arnoldkleingallery_db.php`
- Uses mysqli extension (MySQL Improved) which is the modern standard
- Includes proper character set configuration (UTF-8)

### 3. Security Improvements
- Created security helper library: `/shared/lib/security_helpers.php`
- Added input sanitization functions to prevent SQL injection
- Key functions:
  - `sanitize_int()` - Sanitizes integer inputs
  - `sanitize_string()` - Escapes strings for database queries
  - `sanitize_output()` - Prevents XSS attacks in output
  - `sanitize_search()` - Sanitizes search input
- Updated critical files to use sanitization:
  - `artist.php`
  - `artwork.php`
  - `search.php`
  - `artists_browse.php`
  - `book.php`

### 4. Code Quality
- No deprecated `mysql_*` functions found (already using `mysqli_*`)
- No deprecated `ereg` or `split` functions in PHP code
- Modern error handling in place

## Required Setup Steps

### Database Configuration

**IMPORTANT:** You must update the database credentials in `/db/arnoldkleingallery_db.php`:

```php
$db_host = 'localhost';        // Your MySQL host
$db_user = 'your_database_user';  // Your MySQL username
$db_pass = 'your_database_password';  // Your MySQL password
$db_name = 'arnoldkleingallery';  // Your database name
```

### Server Requirements

- **PHP Version:** 7.4 or higher (recommended: PHP 8.0+)
- **PHP Extensions Required:**
  - mysqli (MySQL Improved)
  - Standard extensions (usually enabled by default)
  
- **MySQL/MariaDB:** 5.6 or higher

### Apache/Nginx Configuration

#### Apache .htaccess (if needed)
If you need URL rewriting or additional configuration, create a `.htaccess` file:

```apache
# Enable error reporting (disable in production)
php_flag display_errors on
php_value error_reporting E_ALL

# Set default charset
AddDefaultCharset UTF-8

# Enable mod_rewrite if needed
# RewriteEngine On
```

#### PHP Configuration Recommendations

In your `php.ini` or `.user.ini`:

```ini
; Display errors (disable in production)
display_errors = On
error_reporting = E_ALL

; Session settings
session.cookie_httponly = 1
session.cookie_secure = 1  ; if using HTTPS

; File upload limits (adjust as needed)
upload_max_filesize = 10M
post_max_size = 10M

; Character encoding
default_charset = "UTF-8"
```

## Testing the Website

1. **Test Database Connection:**
   - Navigate to any page of the website
   - If you see "Connection failed:" error, update database credentials
   
2. **Test Main Pages:**
   - Home page: `index.php`
   - Artists listing: `artists.php`
   - Search functionality: Use the search box in the header
   - Individual artwork: Click on any artwork thumbnail
   
3. **Check for Errors:**
   - Monitor your PHP error log for any issues
   - Common log locations:
     - `/var/log/apache2/error.log`
     - `/var/log/nginx/error.log`
     - Or check `error_log` in the website directory

## Known Issues / Notes

1. **Database Schema:** The code assumes specific database tables exist:
   - `art` - Artwork information
   - `artists` - Artist information
   - `books` - Book listings
   - `nations` - Country/nation data
   
2. **Image Paths:** Images are referenced with absolute URLs to `https://arnoldkleingallery.com`
   - Update these if hosting on a different domain
   - Search for `https://arnoldkleingallery.com` in the codebase

3. **Legacy Files:** The `celebration/` directory contains archived HTML files that don't need updating

4. **CSS Files:** Located in `/shared/ui/css/` - no changes needed

## Security Best Practices

While basic SQL injection protection has been added, consider these additional security measures:

1. **Use Prepared Statements:** For even better security, convert queries to use prepared statements
2. **HTTPS:** Always use HTTPS in production
3. **Regular Updates:** Keep PHP and MySQL updated
4. **File Permissions:** 
   - Files: 644 (rw-r--r--)
   - Directories: 755 (rwxr-xr-x)
   - Database config: 600 (rw-------) for extra security
5. **Backup:** Regular database and file backups

## File Structure

```
arnoldkleingallery.com/
├── db/
│   └── arnoldkleingallery_db.php  (Database connection - UPDATE CREDENTIALS HERE)
├── shared/
│   ├── lib/
│   │   └── security_helpers.php   (Security functions)
│   └── ui/                        (UI components and CSS)
├── images/                        (Artwork images)
├── thumbs/                        (Thumbnail images)
├── index.php                      (Home page)
├── artists.php                    (Artists listing)
├── artist.php                     (Individual artist page)
├── artwork.php                    (Individual artwork page)
├── search.php                     (Search functionality)
└── ... (other pages)
```

## Support

For issues or questions:
- Check PHP error logs first
- Verify database connection credentials
- Ensure all required PHP extensions are enabled
- Test on PHP 7.4 or higher

## Migration Checklist

- [ ] Update database credentials in `/db/arnoldkleingallery_db.php`
- [ ] Verify PHP version is 7.4+
- [ ] Test database connection
- [ ] Test main pages (home, artists, search)
- [ ] Check image paths and update domain if needed
- [ ] Review and update file permissions
- [ ] Enable HTTPS if not already enabled
- [ ] Set up regular backups
- [ ] Review error logs
- [ ] Test in production environment

---

*Last Updated: December 2025*
*PHP Compatibility: 7.4 - 8.x*

