<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php

foreach ($_POST[ 'data' ] as $key => $value) {
	$_POST[ 'data' ][ $key ] = clean( $value );
}
$_POST[ 'id' ] = clean( $_POST[ 'id' ] );

if( update_record( "persons", [ 'key' => 'id', 'val' => clean( $_POST[ 'id' ] ) ], $_POST[ 'data' ] ) ) {
	redirect( "persons" );
}