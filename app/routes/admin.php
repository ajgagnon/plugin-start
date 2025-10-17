<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

\RankAI\RankAI::route()
	->get()
	->where( 'admin', 'rank-ai' )
	->name( 'rank-ai.show' )
	->handle( 'DashboardController@index' );
