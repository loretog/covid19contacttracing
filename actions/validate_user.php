<?php 

	$username = clean( $_POST[ 'username' ] );
	$password = md5( clean( $_POST[ 'password' ] ) );
	$admins = $DB->query( "SELECT * FROM admins WHERE username = '$username' AND password = '$password' LIMIT 1" );
	if( $admins && $admins->num_rows ) {
		$admin = $admins->fetch_object();
		$_SESSION[ AUTH_ID ] = $admin->id;
		$_SESSION[ AUTH_NAME ] = $admin->username;
		$_SESSION[ AUTH_TYPE ] = $admin->usertype;
		redirect();
	} else {
		set_message( "Invalid login", "danger" );
	}