<?php

namespace AndreBase\Admin;

use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Register plugin options.
 */
class AdminServiceProvider implements ServiceProviderInterface {
	/**
	 * Register all dependencies in the IoC container.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function register( $container ) {
		$container['admin.menus'] = fn() => new AdminMenuPageService();
	}

	/**
	 * Bootstrap any services if needed.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function bootstrap( $container ) {
		$container['admin.menus']->bootstrap();
	}
}
