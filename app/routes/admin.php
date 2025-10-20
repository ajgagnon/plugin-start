<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

\AndreBase\AndreBase::route()
	->get()
	->where( 'admin', 'andre-base' )
	->name( 'admin.dashboard' )
	->middleware( 'admin.page' )
	->handle( 'DashboardController@index' );

\AndreBase\AndreBase::route()
	->get()
	->where( 'admin', 'andre-base-settings' )
	->name( 'admin.settings' )
	->middleware( 'admin.page' )
	->handle( 'DashboardController@index' );
