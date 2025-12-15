#!/bin/bash
# PHP Syntax Check Script
# This script checks all PHP files for syntax errors

echo "Checking PHP files for syntax errors..."
echo "========================================"

error_count=0
file_count=0

# Find all PHP files and check syntax
while IFS= read -r file; do
    file_count=$((file_count + 1))
    # Check if php command exists
    if command -v php &> /dev/null; then
        output=$(php -l "$file" 2>&1)
        if [ $? -ne 0 ]; then
            echo "❌ ERROR in $file:"
            echo "$output"
            error_count=$((error_count + 1))
        else
            echo "✓ $file"
        fi
    else
        echo "⚠ PHP not found in PATH, skipping syntax check"
        echo "Files found: $file_count"
        exit 0
    fi
done < <(find . -name "*.php" -not -path "./celebration/*" -not -path "./docs/*" -type f)

echo ""
echo "========================================"
echo "Files checked: $file_count"
echo "Errors found: $error_count"

if [ $error_count -eq 0 ]; then
    echo "✅ All PHP files have valid syntax!"
    exit 0
else
    echo "❌ Found $error_count file(s) with syntax errors"
    exit 1
fi

