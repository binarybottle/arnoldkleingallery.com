<?php
/**
 * Security Helper Functions
 * 
 * This file provides input sanitization and validation functions
 * to protect against SQL injection and XSS attacks.
 */

/**
 * Sanitize integer input from GET/POST
 * @param mixed $value The value to sanitize
 * @return int The sanitized integer value or 0 if invalid
 */
function sanitize_int($value) {
    return isset($value) ? intval($value) : 0;
}

/**
 * Sanitize string input from GET/POST for database queries
 * @param mysqli $link Database connection
 * @param mixed $value The value to sanitize
 * @return string The sanitized string
 */
function sanitize_string($link, $value) {
    if (!isset($value)) {
        return '';
    }
    $value = trim($value);
    $value = stripslashes($value);
    return mysqli_real_escape_string($link, $value);
}

/**
 * Sanitize output for HTML display (prevent XSS)
 * @param mixed $value The value to sanitize
 * @return string The sanitized string
 */
function sanitize_output($value) {
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Validate and sanitize search input
 * @param string $value The search string to sanitize
 * @return string The sanitized search string
 */
function sanitize_search($value) {
    if (!isset($value)) {
        return '';
    }
    // Remove HTML tags
    $value = strip_tags($value);
    // Remove backslashes
    $value = stripslashes($value);
    // Trim whitespace
    $value = trim($value);
    // Convert special chars to HTML entities
    $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    return $value;
}
?>

