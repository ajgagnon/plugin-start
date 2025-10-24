<?php

namespace AndreBase\Database;

use AndreBaseCore\ServiceProviders\ServiceProviderInterface;
use AndreBase\Database\Tables\Events;
use AndreBase\Database\Table;

/**
 * Register plugin options.
 */
class MigrationsServiceProvider implements ServiceProviderInterface {
	/**
	 * Register all dependencies in the IoC container.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function register( $container ) {
		$container['andre.tables.events'] = fn() => new Events( new Table() );
	}

	/**
	 * Bootstrap any services if needed.
	 *
	 * @param \Pimple\Container $container Service container.
	 * @return void
	 */
	public function bootstrap( $container ) {
		$container['andre.tables.events']->install();
	}
}
