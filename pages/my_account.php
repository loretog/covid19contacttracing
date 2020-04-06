<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php element( 'header' ); ?>

	<?php 
		$users = $DB->query( "SELECT * FROM admins WHERE id=" . $_SESSION[ AUTH_ID ] );		
		$user = $users->fetch_object();
	?>

	<div class="col-lg-4 col-md-6">
		<h3>My Account</h3>	 

		<form method="post">
			<input type="hidden" name="action" value="update_password">
			<input type="hidden" name="id" value="<?php echo $_SESSION[ AUTH_ID ] ?>">
		  <div class="form-group">
		    <label>Username</label>
		    <input type="text" class="form-control" name="username" disabled value="<?php echo $user->username ?>">    
		  </div>
		  <div class="form-group">
		    <label>Password</label>
		    <input type="password" class="form-control" name="data[password]">
		  </div>  
		  <div class="form-group">
		    <label>Confirm</label>
		    <input type="password" class="form-control" name="confirm_password">
		  </div>  
		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
	</div>	


<?php element( 'footer' ); ?>