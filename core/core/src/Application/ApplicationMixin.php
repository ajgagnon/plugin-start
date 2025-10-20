<?php
/**
 * @package   SureCartCore
 * @author    SureCart <support@surecart.com>
 * @copyright 2017-2019 SureCart
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0
 * @link      https://surecart.com/
 */

namespace AndreBaseCore\Application;

use AndreBaseVendors\Pimple\Container;
use AndreBaseVendors\Psr\Http\Message\ResponseInterface;
use AndreBaseCore\Requests\RequestInterface;
use AndreBaseCore\Responses\RedirectResponse;
use AndreBaseCore\Routing\RouteBlueprint;
use AndreBaseCore\View\ViewInterface;

/**
 * Can be applied to your App class via a "@mixin" annotation for better IDE support.
 * This class is not meant to be used in any other capacity.
 *
 * @codeCoverageIgnore
 */
final class ApplicationMixin {
	/**
	 * Prevent class instantiation.
	 */
	private function __construct() {}

	// --- Methods --------------------------------------- //

	/**
	 * Get whether the application has been bootstrapped.
	 *
	 * @return boolean
	 */
	public static function isBootstrapped() {}

	/**
	 * Bootstrap the application.
	 *
	 * @param  array   $config
	 * @param  boolean $run
	 * @return void
	 */
	public static function bootstrap( $config = [], $run = true ) {}

	/**
	 * Get the IoC container instance.
	 *
	 * @codeCoverageIgnore
	 * @return Container
	 */
	public static function container() {}

	/**
	 * Set the IoC container instance.
	 *
	 * @codeCoverageIgnore
	 * @param  Container $container
	 * @return void
	 */
	public static function setContainer( $container ) {}

	/**
	 * Resolve a dependency from the IoC container.
	 *
	 * @param  string $key
	 * @return mixed|null
	 */
	public static function resolve( $key ) {}

	// --- Aliases --------------------------------------- //

	/**
	 * Get the Application instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\Application\Application
	 */
	public static function app() {}

	/**
	 * Get the ClosureFactory instance.
	 *
	 * @codeCoverageIgnore
	 * @return ClosureFactory
	 */
	public static function closure() {}

	/**
	 * Get the CSRF service instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\Csrf\Csrf
	 */
	public static function csrf() {}

	/**
	 * Get the Flash service instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\Flash\Flash
	 */
	public static function flash() {}

	/**
	 * Get the OldInput service instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\Input\OldInput
	 */
	public static function oldInput() {}

	/**
	 * Run a full middleware + handler pipeline independently of routes.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Kernels\HttpKernel::run()
	 * @param  RequestInterface $request
	 * @param  string[]         $middleware
	 * @param  string|\Closure  $handler
	 * @param  array            $arguments
	 * @return ResponseInterface
	 */
	public static function run( RequestInterface $request, $middleware, $handler, $arguments = [] ) {}

	/**
	 * Get the ResponseService instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\Responses\ResponseService
	 */
	public static function responses() {}

	/**
	 * Create a "blank" response.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Responses\ResponseService::response()
	 * @return ResponseInterface
	 */
	public static function response() {}

	/**
	 * Create a response with the specified string as its body.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Responses\ResponseService::output()
	 * @param  string $output
	 * @return ResponseInterface
	 */
	public static function output( $output ) {}

	/**
	 * Create a response with the specified data encoded as JSON as its body.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Responses\ResponseService::json()
	 * @param  mixed $data
	 * @return ResponseInterface
	 */
	public static function json( $data ) {}

	/**
	 * Create a redirect response.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Responses\ResponseService::redirect()
	 * @return RedirectResponse
	 */
	public static function redirect() {}

	/**
	 * Create a response with the specified error status code.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\Responses\ResponseService::error()
	 * @param  integer $status
	 * @return ResponseInterface
	 */
	public static function error( $status ) {}

	/**
	 * Get the ViewService instance.
	 *
	 * @codeCoverageIgnore
	 * @return \AndreBaseCore\View\ViewService
	 */
	public static function views() {}

	/**
	 * Create a view.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\View\ViewService::make()
	 * @param  string|string[] $views
	 * @return ViewInterface
	 */
	public static function view( $views ) {}

	/**
	 * Output child layout content.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\View\PhpViewEngine::getLayoutContent()
	 * @return void
	 */
	public static function layoutContent() {}

	/**
	 * Create a new route.
	 *
	 * @codeCoverageIgnore
	 * @return RouteBlueprint
	 */
	public static function route() {}

	/**
	 * Output the specified view.
	 *
	 * @codeCoverageIgnore
	 * @see    \AndreBaseCore\View\ViewService::make()
	 * @see    \AndreBaseCore\View\ViewInterface::toString()
	 * @param  string|string[]      $views
	 * @param  array<string, mixed> $context
	 * @return void
	 */
	public static function render( $views, $context = [] ) {}
}
