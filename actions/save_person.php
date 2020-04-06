<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php

foreach ($_POST[ 'data' ] as $key => $value) {
	$_POST[ 'data' ][ $key ] = clean( $value );
}
$id = add_record( "persons", $_POST[ 'data' ] );
if( $id ) {
	if( isset( $_POST[ 'contacted_person_id' ] ) && !empty( $_POST[ 'contacted_person_id' ] ) ) {
		$contacted_person_id = $_POST[ 'contacted_person_id' ];
		add_record( "contact_traces", [ 'person_id' => $id, 'contacted_person_id' => $contacted_person_id, 'date_of_contact' => mktime() ] );
	}
	redirect( "persons" );
}