<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

$password = clean( $_POST[ 'data' ][ 'password' ] );
$confirm_password = clean( $_POST[ 'confirm_password' ] );

if( $password == $confirm_password ) {
	$password = md5( $password );
	$id = clean( $_POST[ 'id' ] );
	$DB->query( "UPDATE admins SET password='$password' WHERE id=$id" );
	set_message( "Password successfully updated.", "success" );
	redirect( "my_account" );
} else {	
	set_message( "Password should match. Please check again.", "warning" );
	redirect( "my_account" );
}