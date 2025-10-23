<?php

namespace AndreBase\Front;

/**
 * Frontend service.
 */
class FrontService {
	/**
	 * Bootstrap the service.
	 */
	public function bootstrap() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		// Enqueue scripts.
		$dashboard_asset_file = include trailingslashit( \AndreBase\AndreBase::core()->assets()->getPath() ) . 'build/front.asset.php';
		wp_enqueue_script(
			'andre-base-admin',
			trailingslashit( \AndreBase\AndreBase::core()->assets()->getUrl() ) . 'build/front.js',
			$dashboard_asset_file['dependencies'],
			$dashboard_asset_file['version'],
			true
		);
	}
}
