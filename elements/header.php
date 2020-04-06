<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<!DOCTYPE html> 
<html>
	<head>
		<title>CoVid19 Contact Tracing</title>
		<link rel="stylesheet" type="text/css" href="<?php echo SITE_URL ?>/assets/bootstrap-4.4.1/css/bootstrap.min.css">
	</head>

	<body>

		<div class="container-fluid">			
			<div class="row mb-2">
				<div class="col">
					<nav class="navbar navbar-expand-lg navbar-light bg-light">
					  <a class="navbar-brand" href="#">CoVid19 Contact Tracing</a>
					  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
					    <span class="navbar-toggler-icon"></span>
					  </button>
					  <div class="collapse navbar-collapse" id="navbarNavDropdown">
					    <ul class="navbar-nav">
					      <li class="nav-item active">
					        <a class="nav-link" href="<?php echo SITE_URL ?>/">Home <span class="sr-only">(current)</span></a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="<?php echo SITE_URL ?>/?page=persons">Persons</a>
					      </li>
					      <li class="nav-item">
					        <a class="nav-link" href="<?php echo SITE_URL ?>/?page=reports">Reports</a>
					      </li>
					      <?php if( isset( $_SESSION[ AUTH_ID ] ) ) : ?>
				      	<li class="nav-item">
						      <a class="nav-link" href="<?php echo SITE_URL ?>/?page=my_account">My Account</a>						      	
					      </li>
					      <li class="nav-item">
						      <a class="nav-link" href="<?php echo SITE_URL ?>/?action=logout">Logout</a>						      	
					      </li>
					      <?php else : ?>
				      	<li class="nav-item">					        
					      	<a class="nav-link" href="<?php echo SITE_URL ?>/?page=login">Login</a>
					      </li>
					      <?php endif; ?>
					    </ul>
					  </div>
					</nav>
				</div>
			</div>
			<?php 
				show_message();
			?>
			<div class="main-content row">								
				<!-- START OF CONTENT -->