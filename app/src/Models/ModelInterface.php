<?php

namespace AndreBase\Models;

interface ModelInterface {
	/**
	 * Model constructor
	 *
	 * @param array $attributes Optional attributes.
	 */
	public function __construct( $attributes = [] );
}
