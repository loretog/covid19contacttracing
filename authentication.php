<?php	
	if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );
	
	$page = isset( $_GET[ 'page' ] ) && !empty( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : 'default';	

	if( isset( $restricted_pages ) && !empty( $restricted_pages ) ) {		
		if( isset( $page ) && !empty( $page ) ) {			

			$user_type = $restricted_pages[ 'default_usertype' ];
			if( isset( $_SESSION[ AUTH_TYPE ] ) ) {
				$user_type = $_SESSION[ AUTH_TYPE ];
			}
			/*var_dump(in_array( $page, $restricted_pages[ $user_type ][ 'access' ] ));
			echo $page;
			var_dump($_SESSION);
			exit;*/
			if( !in_array( $page, $restricted_pages[ $user_type ][ 'access' ] ) ) {
				set_message( "You have no access to page: $page", "danger" );
				redirect( "login" );			
			}
			/*if( $restricted_pages[ 'login_page' ] != $page && empty( $restricted_pages[ $user_type ][ 'access' ][ $page ] ) && ( !isset( $restricted_pages[ $user_type ][ 'access' ][ $page ] ) || $restricted_pages[ $user_type ][ 'access' ][ $page ] == 0 ) ) {
					set_message( "You have no access to page: $page", "danger" );
					if( ! isset( $_SESSION[ AUTH_ID ] ) ) {
						header( "Location: " . SITE_URL . "/?page=login" );
						exit;
					} else {
						header( "Location: " . SITE_URL );
						exit;
					}							
			}*/
		}
	}