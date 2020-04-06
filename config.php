<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

define( 'DBHOST', 'localhost' );
define( 'DBUSER', 'root' );
define( 'DBPASS', '' );
define( 'DBNAME', 'covid19contacttracing' );

/* 
NOTE:
ONLY SET THESE IF YOU WANT TO ALLOW AUTHENTICATION 
IF NOT THEN JUST COMMENT THEM OUT 
*/

define( 'AUTH_ID', 'userid' );
define( 'AUTH_NAME', 'username' );
define( 'AUTH_TYPE', 'usertype' );

define( 'LOGIN_REDIRECT', 'login' ); // login.php

/*
	TO USE:
		To add restricted pages, just uncomment the variable $restricted_pages,
		each array elements are page names found in your pages folder.
		When added, these pages will not be accessible unless the SESSION AUTH_ID
		is assigned with a value.
*/
$restricted_pages[ 'admin' ][ 'access' ] 	= [ "default", "reports", "persons", "add_person", "contacted", "login", "my_account", "edit_person" ];
$restricted_pages[ 'admin' ][ 'actions' ] 	= [ "add_person", "validate_user", "save_person", "update_person", "logout", "update_password" ];
$restricted_pages[ 'user' ][ 'access' ] 	= [ "default", "reports", "login" ];
$restricted_pages[ 'user' ][ 'actions' ] 	= [ "validate_user", "logout" ];

$restricted_pages[ 'default_usertype' ] 			= "user";
$restricted_pages[ 'default_admintype' ] 			= "admin";
$restricted_pages[ 'login_page' ] 						= "login";
