<!DOCTYPE html>
<html>
<head>
	<title><?php echo (!is_null($title) ? $title : "" ) ?></title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
	<script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js') ?>"></script>
	
	<script>
		base_url = "<?php echo base_url() ?>";
		site_url = "<?php echo site_url() ?>";
	</script>
	<style>
		a.btn-link  {
			text-decoration: none;
		}
	</style>
</head>
<body>

	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	    	<span class="icon-bar"></span>
	    </button>
	      <a class="navbar-brand" href="<?php echo site_url() ?>">ANNOUNSIFY</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	    	    <ul class="nav navbar-nav">
	    	      <li class="active"><a href="<?php echo site_url() ?>" id="home">Home</a></li>
	    	      <?php if (isUserLoggedIn()): ?>
	    		      <li><a href="#">Notifications</a></li>
	    		      <li><a href="#" id="settings">Settings</a></li>
    		      	  <li><a href="<?php echo site_url('user/editprofile') ?>" id="editprofile">Edit profile</a></li>
    		      	  <li class="pull-right"><a href="<?php echo site_url('auth/logout') ?>">Logout</a></li>
	    		  <?php else: ?>
	    		  	<li><a href="<?php echo site_url('auth/login') ?>">Login</a></li>
	    		  	<li><a href="<?php echo site_url('auth/signup') ?>">Signup</a></li>
	    	      <?php endif; ?>
	    	    </ul>
	    	    
	    </div>
	    
	  </div>
	</nav>
<div style="padding-top: 70px">
	
</div>