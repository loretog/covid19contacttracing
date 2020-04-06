<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php element( 'header' ); ?>

	<?php 
		$persons = $DB->query( "SELECT COUNT(*) AS t FROM persons" );
		$recovered = $DB->query( "SELECT COUNT(*) AS t FROM persons WHERE status = 'rcvrd'" );
		$pums = $DB->query( "SELECT COUNT(*) AS t FROM persons WHERE status = 'pum'" );
		$puis = $DB->query( "SELECT COUNT(*) AS t FROM persons WHERE status = 'pui'" );
	?>

	<div class="col">
		<h3>Reports</h3>
	  <table class="table table-bordered table-hovered">	  	
	  	<tr>
	  		<td>Total Recovered</td>
	  		<td>
	  			<?php 
	  				if( $recovered && $recovered->num_rows ) {
	  					$recover = $recovered->fetch_object();
	  					echo $recover->t;
	  				}
	  			?>	
	  		</td>
	  	</tr>
	  	<tr>
	  		<td>Total PUMs</td>
	  		<td>
	  			<?php 
	  				if( $pums && $pums->num_rows ) {
	  					$pum = $pums->fetch_object();
	  					echo $pum->t;
	  				}
	  			?>	
	  		</td>
	  	</tr>
	  	<tr>
	  		<td>Total PUIs</td>
	  		<td>
	  			<?php 
	  				if( $puis && $puis->num_rows ) {
	  					$pui = $puis->fetch_object();
	  					echo $pui->t;
	  				}
	  			?>
	  		</td>
	  	</tr>
	  	<tr>
	  		<td><strong>Total Persons</strong></td>
	  		<td>
	  			<?php 
	  				if( $persons && $persons->num_rows ) {
	  					$person = $persons->fetch_object();
	  					echo $person->t;
	  				}
	  			?>	  				
  			</td>
	  	</tr>
	  </table>

	</div>	


<?php element( 'footer' ); ?>