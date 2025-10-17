<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

\RankAI\RankAI::route()
	->get()
	->where( 'admin', 'rank-ai' )
	->name( 'admin.dashboard' )
	->middleware( 'admin.page' )
	->handle( 'DashboardController@index' );
