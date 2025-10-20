# Plugin Template Creator

This document explains how to use the `create-plugin.php` script to transform the Rank AI plugin into a new plugin.

## Overview

The `create-plugin.php` script automates the process of converting this plugin into a template for creating new WordPress plugins. It handles:

- **PHP Namespaces**: Renames all PHP namespaces throughout the codebase
- **Constants**: Updates all plugin-specific constants
- **Text Domains**: Changes WordPress translation text domains
- **File Names**: Renames the main plugin file
- **Package Names**: Updates composer.json and package.json
- **JavaScript**: Updates admin page slugs and CSS class references
- **Configuration Files**: Modifies JSON configuration files

## Prerequisites

- PHP 7.4 or higher
- Composer installed
- Command-line access
- The plugin should be in a clean state (consider committing changes to git first)

## Usage

### Basic Usage

1. Navigate to the plugin directory:
   ```bash
   cd /path/to/rank-ai
   ```

2. Run the script using Composer (recommended):
   ```bash
   composer run create-plugin
   ```

   Or run it directly with PHP:
   ```bash
   php create-plugin.php
   ```

3. Follow the interactive prompts to provide:
   - **Plugin slug** (e.g., `my-awesome-plugin`)
   - **Plugin name** (e.g., `My Awesome Plugin`)
   - **PHP Namespace** (e.g., `MyAwesomePlugin`)
   - **Composer package name** (e.g., `vendor/my-awesome-plugin`)
   - **Plugin URI** (optional)
   - **Author name** (optional)
   - **Author URI** (optional)
   - **Description** (optional)

### Dry Run Mode

To preview changes without modifying files:

```bash
composer run create-plugin
# When prompted "Dry run? (y/n)", enter: y
```

This will show you what would be changed without actually modifying any files.

### List Available Scripts

To see all available Composer scripts including create-plugin:

```bash
composer run --list
```

## What Gets Transformed

### 1. PHP Files

The script processes all PHP files and updates:

- **Namespaces**:
  - `RankAI\` → `YourNamespace\`
  - `RankAICore\` → `YourNamespaceCore\`
  - `RankAIAppCore\` → `YourNamespaceAppCore\`
  - `RankAIVendors\` → `YourNamespaceVendors\`

- **Constants**:
  - `RANKAI_*` → `YOURPREFIX_*`
  - Example: `RANKAI_PLUGIN_FILE` → `MYAWESOMEPLUGIN_PLUGIN_FILE`

- **Text Domains**:
  - `'rank-ai'` → `'your-slug'`
  - Used in translation functions like `__()`, `_e()`, `_x()`

- **Class Names**:
  - `class RankAI` → `class YourNamespace`

- **@package Annotations**:
  - `@package RankAI` → `@package YourNamespace`

- **Plugin Headers** (in main plugin file):
  - Plugin Name
  - Plugin URI
  - Description
  - Author
  - Author URI
  - Text Domain

### 2. JavaScript Files

Updates in `.js` and `.jsx` files:

- Admin page selectors: `#toplevel_page_rank-ai` → `#toplevel_page_your-slug`
- CSS class references: `.rank-ai` → `.your-slug`
- String literals with the plugin slug

### 3. Configuration Files

#### composer.json
- Package name: `rank-ai/rank-ai` → `vendor/your-plugin`
- PSR-4 autoload namespaces
- Imposter vendor namespace

#### package.json
- Package name: `rank-ai` → `your-slug`

#### components.json
- Tailwind important prefix: `.rank-ai` → `.your-slug`

### 4. File Renaming

- Main plugin file: `rank-ai.php` → `your-slug.php`

## Example

### Input
```
Plugin slug: content-manager
Plugin name: Content Manager
PHP Namespace: ContentManager
Composer package: acme/content-manager
Plugin URI: https://example.com/content-manager
Author: ACME Corp
Author URI: https://example.com
Description: A powerful content management plugin for WordPress.
```

### Transformations

#### Before (PHP):
```php
namespace RankAI\Controllers\Admin;

class DashboardController {
    public function __construct() {
        $this->plugin_dir = RANKAI_PLUGIN_DIR;
    }
}
```

#### After (PHP):
```php
namespace ContentManager\Controllers\Admin;

class DashboardController {
    public function __construct() {
        $this->plugin_dir = CONTENTMANAGER_PLUGIN_DIR;
    }
}
```

#### Before (JavaScript):
```javascript
const menuItems = document.querySelectorAll("#toplevel_page_rank-ai a");
```

#### After (JavaScript):
```javascript
const menuItems = document.querySelectorAll("#toplevel_page_content-manager a");
```

## Post-Transformation Steps

After running the script successfully, follow these steps:

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Build Assets**:
   ```bash
   npm run build
   ```

3. **Review Changes**:
   - Check for any hardcoded references that might have been missed
   - Search for remaining instances of `rank-ai`, `RankAI`, or `RANKAI`
   - Review the main plugin file header

4. **Update Additional Files** (if needed):
   - README files
   - Documentation
   - License information
   - Screenshots

5. **Test Thoroughly**:
   - Activate the plugin
   - Test all features
   - Check admin pages
   - Verify assets load correctly
   - Test on a clean WordPress installation

6. **Clean Up**:
   - Delete `create-plugin.php`
   - Delete `PLUGIN-TEMPLATE.md` (this file)
   - Remove the `create-plugin` script from `composer.json`
   - Update git repository

## Files and Directories Skipped

The script automatically skips these directories:

- `vendor/` - Composer dependencies
- `node_modules/` - npm dependencies
- `.git/` - Git repository
- `build/` - Compiled assets
- `create-plugin.php` - The script itself

## Troubleshooting

### Issue: "Error: Plugin slug is required"
**Solution**: You must provide a plugin slug. This cannot be empty.

### Issue: Script completes but plugin doesn't activate
**Solution**:
- Run `composer install` to regenerate autoloader
- Check for PHP errors in WordPress debug log
- Verify namespaces are consistent throughout

### Issue: Assets not loading
**Solution**:
- Run `npm install && npm run build`
- Check that asset paths use the new plugin slug
- Clear browser cache

### Issue: Admin pages show blank
**Solution**:
- Check JavaScript console for errors
- Verify admin page slugs were updated correctly
- Ensure React components built successfully

### Issue: Some references still show "rank-ai"
**Solution**:
The script handles most cases, but you may need to manually update:
- Comments and documentation
- URLs in code comments
- Special string formats
- Database option names (if any)

## Advanced Usage

### Modifying Skip Paths

Edit the `$skip_paths` array in `create-plugin.php`:

```php
private $skip_paths = [
    'vendor',
    'node_modules',
    '.git',
    'build',
    'create-plugin.php',
    'custom-dir', // Add your own
];
```

### Custom Replacements

To add custom replacements, modify the `process_file()` or `process_js_file()` methods:

```php
// Add after existing replacements
$content = str_replace( 'custom-old-value', 'custom-new-value', $content );
```

## Best Practices

1. **Use Version Control**: Always commit your changes before running the script
2. **Test with Dry Run**: Run in dry-run mode first to preview changes
3. **Follow WordPress Conventions**: Use lowercase with hyphens for plugin slugs
4. **Namespace Standards**: Use PascalCase for PHP namespaces
5. **Backup First**: Keep a backup of the original plugin
6. **Documentation**: Update all documentation after transformation

## Limitations

The script handles most common cases, but manual review is required for:

- Database table names or prefixes
- Custom REST API endpoints
- External API references
- Hardcoded URLs
- Special string formats
- Assets embedded in build files

## Support

If you encounter issues:

1. Check the error message carefully
2. Review the troubleshooting section
3. Run in dry-run mode to see what would change
4. Check the generated files for consistency
5. Verify all dependencies are installed

## License

This script is part of the Rank AI plugin and inherits its license (GPL-2.0-only).
