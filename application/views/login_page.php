<div class="container">
<div class="login-screen" id="login-form">
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-5 col-sm-offset-4">
			<div class="text-area">
				<center><span class="h3">Login to your account</span></center>
				<div id="login-error-area">
					
				</div>
				<?php echoBootstrapAlert() ?>
				<?php echo validation_errors() ?>
			</div>
			<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('auth/logUserIn') ?>">
				
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" id="login-email-input" autofocus>
				</div>
				
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" id="login-password-input">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-md btn-block">Login</button>
				</div>
			</form>
			<div class="no-account">
				<center><a href="<?php echo site_url('auth/signup') ?>">Don't have an account?</a></center>
			</div>
		</div>
	</div>
	
</div>
</div>