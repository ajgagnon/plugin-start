<?php

namespace AndreBase\Rest;

use AndreBase\Models\Model;
use AndreBaseCore\ServiceProviders\ServiceProviderInterface;

/**
 * Abstract Rest Service Provider interface
 */
abstract class RestServiceProvider extends \WP_REST_Controller implements ServiceProviderInterface {
	/**
	 * Plugin namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'andre-base';

	/**
	 * API Version
	 *
	 * @var string
	 */
	protected $version = '1';

	/**
	 * Endpoint.
	 *
	 * @var string
	 */
	protected $endpoint = '';

	/**
	 * Controller class
	 *
	 * @var string
	 */
	protected $controller = '';

	/**
	 * {@inheritDoc}
	 *
	 * @param  \Pimple\Container $container Service Container.
	 */
	public function register( $container ) {
		// nothing to register.
	}

	/**
	 * Bootstrap routes
	 *
	 * @param  \Pimple\Container $container Service Container.
	 *
	 * @return void
	 */
	public function bootstrap( $container ) {
		add_action( 'rest_api_init', [ $this, 'register_routes' ] );
	}

	/**
	 * Get our sample schema for a post.
	 *
	 * @return array The sample schema for a post
	 */
	public function get_public_item_schema() {
		if ( $this->schema ) {
			// Since WordPress 5.3, the schema can be cached in the $schema property.
			return $this->schema;
		}

		$this->schema = [
			// This tells the spec of JSON Schema we are using which is draft 4.
			'$schema'    => 'http://json-schema.org/draft-04/schema#',
			// The title property marks the identity of the resource.
			'title'      => $this->endpoint,
			'type'       => 'object',
			// In JSON Schema you can specify object properties in the properties attribute.
			'properties' => [
				'id' => [
					'description' => esc_html__( 'Unique identifier for the object.', 'surecart' ),
					'type'        => 'string',
					'context'     => [ 'view', 'edit', 'embed' ],
					'readonly'    => true,
				],
			],
		];

		return $this->schema;
	}

	/**
	 * Process the callback for the route.
	 *
	 * @param string $class_name Class name.
	 * @param string $method Class method.
	 * @return callback
	 */
	public function callback( $class_name, $method ) {
		return function ( $request ) use ( $class_name, $method ) {
			// get and call controller with request.
			$controller = \AndreBase\AndreBase::closure()->method( $class_name, $method );
			$model      = $controller( $request );

			if ( is_wp_error( $model ) ) {
				return $model;
			}

			return rest_ensure_response( $this->filter_response_by_context( is_a( $model, Model::class ) ? $model->toArray() : $model, $request['context'] ?? 'view' ) );
		};
	}

	/**
	 * Retrieves the query params for collections.
	 *
	 * @return array
	 */
	public function get_collection_params() {
		return [];
	}
}
