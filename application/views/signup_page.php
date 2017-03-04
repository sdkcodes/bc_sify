<div class="container">
<div class="signup-screen" >
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-4 col-sm-offset-4">
			<div class="text-area">
				<center><span class="h3">Sign up</span></center>
				<div id="signup-error-area">
					
				</div>
				<?php echoBootstrapAlert() ?>
				<?php echo validation_errors() ?>
			</div>
			<form class="form-horizontal" role="form" id="signup-form" method="post" action="<?php echo site_url('auth/register') ?>">
				<div class="form-group">
					<input type="text" name="full-name" class="form-control" placeholder="Full name" value="<?php echo set_value('full-name') ?>" id="signup-name-input">
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" id="signup-email-input">
					<div id="email-text-area" style="width:100%">
						
					</div>
				</div>
				<div class="form-group">
					<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>" id="signup-username-input">
					<div id="username-text-area" style="width:100%">
						
					</div>
				</div>
				<div class="form-group">
					<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone') ?>" id="signup-phone-input">
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" id="signup-password-input">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-info btn-md btn-block" id="signup-button">Sign up</button>
				</div>
			</form>
			<div class="have-account">
				<center><a href="<?php echo site_url("auth/login") ?>">Already have an account?</a></center>
			</div>
		</div>
	</div>
	
</div>
</div>