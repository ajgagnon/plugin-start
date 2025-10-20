#!/usr/bin/env php
<?php
/**
 * Plugin Template Creator
 *
 * This script transforms the Rank AI plugin into a new plugin by renaming and
 * re-namespacing all relevant parts.
 *
 * Usage: php create-plugin.php
 *
 * @package RankAI
 */

// phpcs:disable WordPress.WP.AlternativeFunctions -- This is a CLI script, not WordPress runtime code.
// phpcs:disable WordPress.Security.EscapeOutput -- This is CLI output, not web output.

/**
 * Plugin Template Creator Class.
 */
class PluginTemplateCreator {
	/**
	 * Original values to search for.
	 *
	 * @var array
	 */
	private $original = array(
		'slug'              => 'rank-ai',
		'slug_underscore'   => 'rank_ai',
		'constant_prefix'   => 'RANKAI',
		'namespace'         => 'RankAI',
		'namespace_core'    => 'RankAICore',
		'namespace_appcore' => 'RankAIAppCore',
		'namespace_vendors' => 'RankAIVendors',
		'class_name'        => 'RankAI',
		'package'           => 'rank-ai/rank-ai',
	);

	/**
	 * New values to replace with.
	 *
	 * @var array
	 */
	private $new = array();

	/**
	 * Base directory (plugin root).
	 *
	 * @var string
	 */
	private $base_dir;

	/**
	 * Dry run mode.
	 *
	 * @var bool
	 */
	private $dry_run = false;

	/**
	 * Files and directories to skip.
	 *
	 * @var array
	 */
	private $skip_paths = array(
		'vendor',
		'node_modules',
		'.git',
		'build',
		'create-plugin.php',
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->base_dir = __DIR__;
	}

	/**
	 * Run the script.
	 */
	public function run() {
		$this->print_header();

		// Collect user input
		if ( ! $this->collect_input() ) {
			return;
		}

		// Show confirmation
		if ( ! $this->confirm() ) {
			$this->output( "\nOperation cancelled.\n", 'info' );
			return;
		}

		// Process files
		$this->output( "\nProcessing PHP files...\n", 'success' );
		$this->process_files();

		// Process JavaScript files
		$this->output( "\nProcessing JavaScript files...\n", 'success' );
		$this->process_js_files();

		// Process JSON files
		$this->output( "\nProcessing JSON configuration files...\n", 'success' );
		$this->process_json_files();

		// Rename main plugin file
		$this->output( "\nRenaming main plugin file...\n", 'success' );
		$this->rename_main_file();

		// Final instructions
		$this->print_footer();
	}

	/**
	 * Print header.
	 */
	private function print_header() {
		$this->output( "\n╔══════════════════════════════════════════════════════════════╗\n", 'info' );
		$this->output( "║           Plugin Template Creator for Rank AI              ║\n", 'info' );
		$this->output( "╚══════════════════════════════════════════════════════════════╝\n\n", 'info' );
		$this->output( "This script will transform the Rank AI plugin into a new plugin\n", 'info' );
		$this->output( "by renaming and re-namespacing all relevant parts.\n\n", 'info' );
	}

	/**
	 * Collect user input.
	 *
	 * @return bool True if input collected successfully, false otherwise.
	 */
	private function collect_input() {
		// Plugin Slug
		$this->new['slug'] = $this->prompt( 'Plugin slug (e.g., my-plugin)' );
		if ( empty( $this->new['slug'] ) ) {
			$this->output( "Error: Plugin slug is required.\n", 'error' );
			return false;
		}

		// Plugin Name
		$default_name      = $this->slug_to_title( $this->new['slug'] );
		$this->new['name'] = $this->prompt( 'Plugin name (e.g., My Plugin)', $default_name );
		if ( empty( $this->new['name'] ) ) {
			$this->new['name'] = $default_name;
		}

		// Namespace
		$default_namespace      = $this->slug_to_namespace( $this->new['slug'] );
		$this->new['namespace'] = $this->prompt( 'PHP Namespace (e.g., MyPlugin)', $default_namespace );
		if ( empty( $this->new['namespace'] ) ) {
			$this->new['namespace'] = $default_namespace;
		}

		// Derive other values
		$this->new['slug_underscore']   = str_replace( '-', '_', $this->new['slug'] );
		$this->new['constant_prefix']   = strtoupper( str_replace( '-', '', $this->new['slug'] ) );
		$this->new['namespace_core']    = $this->new['namespace'] . 'Core';
		$this->new['namespace_appcore'] = $this->new['namespace'] . 'AppCore';
		$this->new['namespace_vendors'] = $this->new['namespace'] . 'Vendors';
		$this->new['class_name']        = $this->new['namespace'];

		// Package name
		$default_package      = 'vendor/' . $this->new['slug'];
		$this->new['package'] = $this->prompt( 'Composer package name (e.g., vendor/my-plugin)', $default_package );
		if ( empty( $this->new['package'] ) ) {
			$this->new['package'] = $default_package;
		}

		// Plugin URI
		$this->new['plugin_uri'] = $this->prompt( 'Plugin URI (optional)', '' );
		if ( empty( $this->new['plugin_uri'] ) ) {
			$this->new['plugin_uri'] = 'https://example.com/' . $this->new['slug'];
		}

		// Author
		$this->new['author'] = $this->prompt( 'Author name (optional)', 'Your Name' );

		// Author URI
		$this->new['author_uri'] = $this->prompt( 'Author URI (optional)', 'https://example.com' );

		// Description
		$this->new['description'] = $this->prompt(
			'Plugin description (optional)',
			$this->new['name'] . ' is a WordPress plugin.'
		);

		// Dry run
		$dry_run       = $this->prompt( 'Dry run? (y/n)', 'n' );
		$this->dry_run = strtolower( $dry_run ) === 'y';

		return true;
	}

	/**
	 * Show confirmation prompt.
	 *
	 * @return bool True if user confirms, false otherwise.
	 */
	private function confirm() {
		$this->output( "\n╔══════════════════════════════════════════════════════════════╗\n", 'info' );
		$this->output( "║                    Configuration Summary                    ║\n", 'info' );
		$this->output( "╚══════════════════════════════════════════════════════════════╝\n\n", 'info' );

		$this->output( 'Plugin Slug:         ' . $this->new['slug'] . "\n" );
		$this->output( 'Plugin Name:         ' . $this->new['name'] . "\n" );
		$this->output( 'Namespace:           ' . $this->new['namespace'] . "\n" );
		$this->output( 'Namespace Core:      ' . $this->new['namespace_core'] . "\n" );
		$this->output( 'Namespace App Core:  ' . $this->new['namespace_appcore'] . "\n" );
		$this->output( 'Namespace Vendors:   ' . $this->new['namespace_vendors'] . "\n" );
		$this->output( 'Constant Prefix:     ' . $this->new['constant_prefix'] . "\n" );
		$this->output( 'Package Name:        ' . $this->new['package'] . "\n" );
		$this->output( 'Plugin URI:          ' . $this->new['plugin_uri'] . "\n" );
		$this->output( 'Author:              ' . $this->new['author'] . "\n" );
		$this->output( 'Author URI:          ' . $this->new['author_uri'] . "\n" );
		$this->output( 'Description:         ' . $this->new['description'] . "\n" );
		$this->output( 'Mode:                ' . ( $this->dry_run ? 'DRY RUN (no changes will be made)' : 'LIVE (files will be modified)' ) . "\n", $this->dry_run ? 'info' : 'warning' );

		$this->output( "\n" );
		$confirm = $this->prompt( 'Proceed with these settings? (y/n)', 'y' );
		return strtolower( $confirm ) === 'y';
	}

	/**
	 * Process all PHP files.
	 */
	private function process_files() {
		$files = $this->get_php_files( $this->base_dir );
		$count = 0;

		foreach ( $files as $file ) {
			if ( $this->should_skip_path( $file ) ) {
				continue;
			}

			if ( $this->process_file( $file ) ) {
				++$count;
				$this->output( '  ✓ ' . $this->get_relative_path( $file ) . "\n", 'success' );
			}
		}

		$this->output( "\nProcessed $count PHP files.\n", 'success' );
	}

	/**
	 * Process a single file.
	 *
	 * @param string $file File path to process.
	 * @return bool True if file was modified, false otherwise.
	 */
	private function process_file( $file ) {
		$content          = file_get_contents( $file );
		$original_content = $content;

		// Replace namespaces (order matters - do more specific ones first).
		$content = str_replace( 'namespace ' . $this->original['namespace_appcore'], 'namespace ' . $this->new['namespace_appcore'], $content );
		$content = str_replace( 'namespace ' . $this->original['namespace_core'], 'namespace ' . $this->new['namespace_core'], $content );
		$content = str_replace( 'namespace ' . $this->original['namespace'] . '\\', 'namespace ' . $this->new['namespace'] . '\\', $content );
		$content = str_replace( 'namespace ' . $this->original['namespace'] . ';', 'namespace ' . $this->new['namespace'] . ';', $content );

		// Replace use statements.
		$content = str_replace( 'use ' . $this->original['namespace_appcore'] . '\\', 'use ' . $this->new['namespace_appcore'] . '\\', $content );
		$content = str_replace( 'use ' . $this->original['namespace_core'] . '\\', 'use ' . $this->new['namespace_core'] . '\\', $content );
		$content = str_replace( 'use ' . $this->original['namespace'] . '\\', 'use ' . $this->new['namespace'] . '\\', $content );

		// Replace constants.
		$content = preg_replace( '/\b' . $this->original['constant_prefix'] . '_/', $this->new['constant_prefix'] . '_', $content );

		// Replace text domain in translation functions.
		$content = str_replace( "'" . $this->original['slug'] . "'", "'" . $this->new['slug'] . "'", $content );
		$content = str_replace( '"' . $this->original['slug'] . '"', '"' . $this->new['slug'] . '"', $content );

		// Replace @package annotations.
		$content = str_replace( '@package ' . $this->original['namespace'], '@package ' . $this->new['namespace'], $content );
		$content = str_replace( '@package ' . $this->original['namespace_core'], '@package ' . $this->new['namespace_core'], $content );
		$content = str_replace( '@package ' . $this->original['namespace_appcore'], '@package ' . $this->new['namespace_appcore'], $content );

		// Replace class names (be careful with this).
		$content = preg_replace( '/\bclass ' . $this->original['class_name'] . '\b/', 'class ' . $this->new['class_name'], $content );
		$content = str_replace( '\\' . $this->original['class_name'] . '\\' . $this->original['class_name'], '\\' . $this->new['namespace'] . '\\' . $this->new['class_name'], $content );

		// Plugin header specific replacements (only in main plugin file).
		if ( basename( $file ) === $this->original['slug'] . '.php' ) {
			$content = preg_replace( '/\* Plugin Name:.*$/m', '* Plugin Name: ' . $this->new['name'], $content );
			$content = preg_replace( '/\* Plugin URI:.*$/m', '* Plugin URI: ' . $this->new['plugin_uri'], $content );
			$content = preg_replace( '/\* Description:.*$/m', '* Description: ' . $this->new['description'], $content );
			$content = preg_replace( '/\* Author:.*$/m', '* Author: ' . $this->new['author'], $content );
			$content = preg_replace( '/\* Author URI:.*$/m', '* Author URI: ' . $this->new['author_uri'], $content );
			$content = preg_replace( '/\* Text Domain:.*$/m', '* Text Domain: ' . $this->new['slug'], $content );
		}

		// Only write if content changed.
		if ( $content !== $original_content ) {
			if ( ! $this->dry_run ) {
				file_put_contents( $file, $content );
			}
			return true;
		}

		return false;
	}

	/**
	 * Process all JavaScript files.
	 */
	private function process_js_files() {
		$files = $this->get_js_files( $this->base_dir );
		$count = 0;

		foreach ( $files as $file ) {
			if ( $this->should_skip_path( $file ) ) {
				continue;
			}

			if ( $this->process_js_file( $file ) ) {
				++$count;
				$this->output( '  ✓ ' . $this->get_relative_path( $file ) . "\n", 'success' );
			}
		}

		$this->output( "\nProcessed $count JavaScript files.\n", 'success' );
	}

	/**
	 * Process a single JavaScript file.
	 *
	 * @param string $file File path to process.
	 * @return bool True if file was modified, false otherwise.
	 */
	private function process_js_file( $file ) {
		$content          = file_get_contents( $file );
		$original_content = $content;

		// Replace admin page slugs in selectors.
		$content = str_replace( '#toplevel_page_' . $this->original['slug'], '#toplevel_page_' . $this->new['slug'], $content );
		$content = str_replace( '"' . $this->original['slug'] . '"', '"' . $this->new['slug'] . '"', $content );
		$content = str_replace( "'" . $this->original['slug'] . "'", "'" . $this->new['slug'] . "'", $content );

		// Replace CSS class references.
		$content = str_replace( '.' . $this->original['slug'], '.' . $this->new['slug'], $content );
		$content = str_replace( '"' . $this->original['slug'] . '"', '"' . $this->new['slug'] . '"', $content );
		$content = str_replace( "'" . $this->original['slug'] . "'", "'" . $this->new['slug'] . "'", $content );

		// Only write if content changed.
		if ( $content !== $original_content ) {
			if ( ! $this->dry_run ) {
				file_put_contents( $file, $content );
			}
			return true;
		}

		return false;
	}

	/**
	 * Process JSON configuration files.
	 */
	private function process_json_files() {
		// Process composer.json.
		$this->process_composer_json();

		// Process package.json.
		$this->process_package_json();

		// Process components.json.
		$this->process_components_json();
	}

	/**
	 * Process composer.json.
	 */
	private function process_composer_json() {
		$file = $this->base_dir . '/composer.json';
		if ( ! file_exists( $file ) ) {
			return;
		}

		$json = json_decode( file_get_contents( $file ), true );

		// Update package name.
		$json['name'] = $this->new['package'];

		// Update keywords.
		if ( isset( $json['keywords'] ) ) {
			$json['keywords'] = array_map(
				function ( $keyword ) {
					if ( $keyword === $this->original['slug'] ) {
						return $this->new['slug'];
					}
					return $keyword;
				},
				$json['keywords']
			);
		}

		// Update autoload namespaces.
		if ( isset( $json['autoload']['psr-4'] ) ) {
			$new_autoload = array();
			foreach ( $json['autoload']['psr-4'] as $namespace => $path ) {
				$new_namespace                  = str_replace( $this->original['namespace_appcore'] . '\\', $this->new['namespace_appcore'] . '\\', $namespace );
				$new_namespace                  = str_replace( $this->original['namespace_core'] . '\\', $this->new['namespace_core'] . '\\', $new_namespace );
				$new_namespace                  = str_replace( $this->original['namespace'] . '\\', $this->new['namespace'] . '\\', $new_namespace );
				$new_autoload[ $new_namespace ] = $path;
			}
			$json['autoload']['psr-4'] = $new_autoload;
		}

		// Update autoload-dev namespaces.
		if ( isset( $json['autoload-dev']['psr-4'] ) ) {
			$new_autoload_dev = array();
			foreach ( $json['autoload-dev']['psr-4'] as $namespace => $path ) {
				$new_namespace                      = str_replace( $this->original['namespace'] . '\\', $this->new['namespace'] . '\\', $namespace );
				$new_autoload_dev[ $new_namespace ] = $path;
			}
			$json['autoload-dev']['psr-4'] = $new_autoload_dev;
		}

		// Update imposter namespace.
		if ( isset( $json['extra']['imposter']['namespace'] ) ) {
			$json['extra']['imposter']['namespace'] = $this->new['namespace_vendors'] . '\\';
		}

		if ( ! $this->dry_run ) {
			file_put_contents( $file, json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . "\n" );
		}

		$this->output( '  ✓ composer.json' . "\n", 'success' );
	}

	/**
	 * Process package.json.
	 */
	private function process_package_json() {
		$file = $this->base_dir . '/package.json';
		if ( ! file_exists( $file ) ) {
			return;
		}

		$json = json_decode( file_get_contents( $file ), true );

		// Update package name.
		$json['name'] = $this->new['slug'];

		if ( ! $this->dry_run ) {
			file_put_contents( $file, json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . "\n" );
		}

		$this->output( '  ✓ package.json' . "\n", 'success' );
	}

	/**
	 * Process components.json.
	 */
	private function process_components_json() {
		$file = $this->base_dir . '/components.json';
		if ( ! file_exists( $file ) ) {
			return;
		}

		$json = json_decode( file_get_contents( $file ), true );

		// Update important prefix.
		if ( isset( $json['tailwind']['important'] ) ) {
			$json['tailwind']['important'] = '.' . $this->new['slug'];
		}

		if ( ! $this->dry_run ) {
			file_put_contents( $file, json_encode( $json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES ) . "\n" );
		}

		$this->output( '  ✓ components.json' . "\n", 'success' );
	}

	/**
	 * Rename main plugin file.
	 */
	private function rename_main_file() {
		$old_file = $this->base_dir . '/' . $this->original['slug'] . '.php';
		$new_file = $this->base_dir . '/' . $this->new['slug'] . '.php';

		if ( file_exists( $old_file ) && $old_file !== $new_file ) {
			if ( ! $this->dry_run ) {
				// phpcs:ignore WordPress.WP.AlternativeFunctions.rename_rename -- CLI script, WP_Filesystem not available.
				rename( $old_file, $new_file );
			}
			$this->output( '  ✓ Renamed ' . $this->original['slug'] . '.php to ' . $this->new['slug'] . '.php' . "\n", 'success' );
		}
	}

	/**
	 * Print footer with instructions.
	 */
	private function print_footer() {
		$this->output( "\n╔═���════════════════════════════════════════════════════════════╗\n", 'success' );
		$this->output( "║                    Transformation Complete!                 ║\n", 'success' );
		$this->output( "╚══════════════════════════════════════════════════════════════╝\n\n", 'success' );

		if ( $this->dry_run ) {
			$this->output( "This was a DRY RUN. No files were actually modified.\n", 'info' );
			$this->output( "Run again without dry run mode to apply changes.\n\n", 'info' );
		} else {
			$this->output( "Next steps:\n\n", 'info' );
			$this->output( "1. Run: composer install\n" );
			$this->output( "2. Run: npm install\n" );
			$this->output( "3. Run: npm run build\n" );
			$this->output( "4. Review and update any hardcoded references to 'rank-ai'\n" );
			$this->output( "5. Test the plugin thoroughly\n" );
			$this->output( "6. Delete create-plugin.php (this file)\n\n" );
		}
	}

	/**
	 * Get all PHP files recursively.
	 *
	 * @param string $dir Directory to search.
	 * @return array Array of file paths.
	 */
	private function get_php_files( $dir ) {
		$files    = array();
		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $dir, RecursiveDirectoryIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ( $iterator as $file ) {
			if ( $file->isFile() && $file->getExtension() === 'php' ) {
				$files[] = $file->getPathname();
			}
		}

		return $files;
	}

	/**
	 * Get all JavaScript files recursively.
	 *
	 * @param string $dir Directory to search.
	 * @return array Array of file paths.
	 */
	private function get_js_files( $dir ) {
		$files    = array();
		$iterator = new RecursiveIteratorIterator(
			new RecursiveDirectoryIterator( $dir, RecursiveDirectoryIterator::SKIP_DOTS ),
			RecursiveIteratorIterator::SELF_FIRST
		);

		foreach ( $iterator as $file ) {
			if ( $file->isFile() && in_array( $file->getExtension(), array( 'js', 'jsx' ), true ) ) {
				$files[] = $file->getPathname();
			}
		}

		return $files;
	}

	/**
	 * Check if path should be skipped.
	 *
	 * @param string $path File path to check.
	 * @return bool True if path should be skipped, false otherwise.
	 */
	private function should_skip_path( $path ) {
		foreach ( $this->skip_paths as $skip ) {
			if ( strpos( $path, DIRECTORY_SEPARATOR . $skip . DIRECTORY_SEPARATOR ) !== false ||
				strpos( $path, DIRECTORY_SEPARATOR . $skip ) === strlen( $path ) - strlen( DIRECTORY_SEPARATOR . $skip ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Get relative path.
	 *
	 * @param string $file File path.
	 * @return string Relative path.
	 */
	private function get_relative_path( $file ) {
		return str_replace( $this->base_dir . DIRECTORY_SEPARATOR, '', $file );
	}

	/**
	 * Convert slug to title case.
	 *
	 * @param string $slug Plugin slug.
	 * @return string Title case string.
	 */
	private function slug_to_title( $slug ) {
		return ucwords( str_replace( array( '-', '_' ), ' ', $slug ) );
	}

	/**
	 * Convert slug to namespace.
	 *
	 * @param string $slug Plugin slug.
	 * @return string Namespace string.
	 */
	private function slug_to_namespace( $slug ) {
		return str_replace( array( '-', '_', ' ' ), '', ucwords( str_replace( array( '-', '_' ), ' ', $slug ) ) );
	}

	/**
	 * Prompt user for input.
	 *
	 * @param string $message Prompt message.
	 * @param string $fallback Default value if user provides no input.
	 * @return string User input or default value.
	 */
	private function prompt( $message, $fallback = '' ) {
		if ( $fallback ) {
			$this->output( "$message [$fallback]: ", 'info' );
		} else {
			$this->output( "$message: ", 'info' );
		}

		$input = trim( fgets( STDIN ) );
		return ( '' !== $input ) ? $input : $fallback;
	}

	/**
	 * Output message with color.
	 *
	 * @param string $message Message to output.
	 * @param string $type Output type (success, error, warning, info).
	 */
	private function output( $message, $type = '' ) {
		$colors = array(
			'success' => "\033[0;32m",
			'error'   => "\033[0;31m",
			'warning' => "\033[0;33m",
			'info'    => "\033[0;36m",
		);

		$reset = "\033[0m";

		if ( isset( $colors[ $type ] ) ) {
			echo $colors[ $type ] . $message . $reset;
		} else {
			echo $message;
		}
	}
}

// Run the script.
$creator = new PluginTemplateCreator();
$creator->run();
