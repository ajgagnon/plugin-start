<?php

namespace AndreBase\Middleware;

use Closure;
use AndreBaseCore\Requests\RequestInterface;

/**
 * Middleware for handling model archiving.
 */
class AdminPageMiddleware {

	/**
	 * Handle admin page middleware.
	 *
	 * @param RequestInterface $request Request.
	 * @param Closure          $next Next.
	 * @return function
	 */
	public function handle( RequestInterface $request, Closure $next ) {
		// Enqueue JavaScript.
		$dashboard_asset_file = include trailingslashit( \AndreBase\AndreBase::core()->assets()->getPath() ) . 'build/admin.asset.php';
		wp_enqueue_script(
			'andre-base-admin',
			trailingslashit( \AndreBase\AndreBase::core()->assets()->getUrl() ) . 'build/admin.js',
			$dashboard_asset_file['dependencies'],
			$dashboard_asset_file['version'],
			true
		);

		// Enqueue CSS.
		wp_enqueue_style(
			'andre-base-admin-style',
			trailingslashit( \AndreBase\AndreBase::core()->assets()->getUrl() ) . 'build/admin.css',
			array(),
			$dashboard_asset_file['version']
		);

		return $next( $request );
	}
}
