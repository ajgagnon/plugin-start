<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart
 */

namespace AndreBaseCore\Application;

use AndreBaseVendors\Pimple\Container;
use AndreBaseCore\Controllers\ControllersServiceProvider;
use AndreBaseCore\Csrf\CsrfServiceProvider;
use AndreBaseCore\Exceptions\ConfigurationException;
use AndreBaseCore\Exceptions\ExceptionsServiceProvider;
use AndreBaseCore\Flash\FlashServiceProvider;
use AndreBaseCore\Input\OldInputServiceProvider;
use AndreBaseCore\Kernels\KernelsServiceProvider;
use AndreBaseCore\Middleware\MiddlewareServiceProvider;
use AndreBaseCore\Requests\RequestsServiceProvider;
use AndreBaseCore\Responses\ResponsesServiceProvider;
use AndreBaseCore\Routing\RoutingServiceProvider;
use AndreBaseCore\ServiceProviders\ServiceProviderInterface;
use AndreBaseCore\Support\Arr;
use AndreBaseCore\View\ViewServiceProvider;

/**
 * Load service providers.
 */
trait LoadsServiceProvidersTrait {
	/**
	 * Array of default service providers.
	 *
	 * @var string[]
	 */
	protected $service_providers = [
		ApplicationServiceProvider::class,
		KernelsServiceProvider::class,
		ExceptionsServiceProvider::class,
		RequestsServiceProvider::class,
		ResponsesServiceProvider::class,
		RoutingServiceProvider::class,
		ViewServiceProvider::class,
		ControllersServiceProvider::class,
		MiddlewareServiceProvider::class,
		CsrfServiceProvider::class,
		FlashServiceProvider::class,
		OldInputServiceProvider::class,
	];

	/**
	 * Register and bootstrap all service providers.
	 *
	 * @codeCoverageIgnore
	 * @param  Container $container
	 * @return void
	 */
	protected function loadServiceProviders( Container $container ) {
		$container[ ANDREBASE_SERVICE_PROVIDERS_KEY ] = array_merge(
			$this->service_providers,
			Arr::get( $container[ ANDREBASE_CONFIG_KEY ], 'providers', [] )
		);

		$service_providers = array_map(
			function ( $service_provider ) use ( $container ) {
				if ( ! is_subclass_of( $service_provider, ServiceProviderInterface::class ) ) {
					throw new ConfigurationException(
						'The following class does not implement ' .
						ServiceProviderInterface::class . ': ' . $service_provider
					);
				}

				// Provide container access to the service provider instance
				// so bootstrap hooks can be unhooked e.g.:
				// remove_action( 'some_action', [\App::resolve( SomeServiceProvider::class ), 'methodAddedToAction'] );
				$container[ $service_provider ] = new $service_provider();

				return $container[ $service_provider ];
			},
			$container[ ANDREBASE_SERVICE_PROVIDERS_KEY ]
		);

		$this->registerServiceProviders( $service_providers, $container );
		$this->bootstrapServiceProviders( $service_providers, $container );
	}

	/**
	 * Register all service providers.
	 *
	 * @param  ServiceProviderInterface[] $service_providers
	 * @param  Container                  $container
	 * @return void
	 */
	protected function registerServiceProviders( $service_providers, Container $container ) {
		foreach ( $service_providers as $provider ) {
			$provider->register( $container );
		}
	}

	/**
	 * Bootstrap all service providers.
	 *
	 * @param  ServiceProviderInterface[] $service_providers
	 * @param  Container                  $container
	 * @return void
	 */
	protected function bootstrapServiceProviders( $service_providers, Container $container ) {
		foreach ( $service_providers as $provider ) {
			$provider->bootstrap( $container );
		}
	}
}
