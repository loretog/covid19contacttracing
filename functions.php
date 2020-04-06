<?php

if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' );

function element( $el ) {	
	include ROOT_DIR . "/elements/$el.php";
}

function set_message( $msg, $type = "success" ) {
	$_SESSION[ 'MESSAGE' ] = $msg; 
	$_SESSION[ 'MESSAGE_TYPE' ] = $type; 
}

function show_message() {		
	if( isset( $_SESSION[ 'MESSAGE' ] ) && !empty( $_SESSION[ 'MESSAGE' ] ) ) {
		echo "<div class='alert alert-" . $_SESSION[ 'MESSAGE_TYPE' ] . "'>" . $_SESSION[ 'MESSAGE' ] . "</div>";	
		unset( $_SESSION[ 'MESSAGE' ] );	
		unset( $_SESSION[ 'MESSAGE_TYPE' ] );
	}
}

function redirect( $page = "" ) {
	if( $page == "" ) {
		header( "Location: " . SITE_URL );
	} else {
		header( "Location: " . SITE_URL . "/?page=$page" );
	}
	exit;
}

function has_access( $user, $page ) {
	global $restricted_pages;	

	return isset( $restricted_pages[ $user ][ 'access' ][ $page ] );
}

function all_records( $name, $fields = "*" ) {
	global $DB;
	return $DB->query( "SELECT $fields FROM $name" );
}

function add_record( $name, $fields = [] ) {
	global $DB;

	if( ( isset( $name ) && isset( $fields ) ) && !empty( $name ) && !empty( $fields ) && is_array( $fields ) ) {
		$cols = implode( " , ", array_keys( $fields ) );
		$vals = "'" . implode( "' , '", array_values( $fields ) ) . "'";
		$sql = "INSERT INTO $name ( $cols ) VALUES( $vals )";
		$DB->query( $sql );
		return $DB->insert_id;
	} else {
		return false;
	}
}

// sample
// update_record( "persons", [ 'key' => 'id', 'val' => $_POST[ 'id' ] ], $_POST[ 'data' ] )
function update_record( $name, $id, $fields = [] ) {
	global $DB;

	if( ( isset( $name ) && isset( $fields ) ) && !empty( $name ) && !empty( $fields ) && is_array( $fields ) ) {

		$f = [];

		foreach ( $fields as $key => $value ) {
			$f[] = "$key='$value'";
		}
		$f = implode( ",", $f );	
		$sql = "UPDATE $name SET $f WHERE {$id['key']}={$id['val']}";
		return $DB->query( $sql );
	} else {
		return false;
	}
}

function clean( $string, $space = false ) {
	if( $space )
  	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

/* ADD YOUR CUSTOM FUNCTIONS IN custom_functions.php */
require 'custom_functions.php';