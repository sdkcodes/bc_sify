<div class="container-fluid">
	

<div class="row">
	<div class="col-xs-12 col-sm-5 col-sm-offset-3">
		
	</div>
</div>
<div class="login-screen" id="login-form">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			<div class="text-area">
				<center><span class="h3">Login to your account</span></center>
				<div id="login-error-area">
					
				</div>
			</div>
			<form class="form-horizontal" role="form">
				
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" id="login-email-input">
				</div>
				
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" id="login-password-input">
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-info btn-md btn-block" id="login-button">Login</button>
				</div>
			</form>
			<div class="no-account">
				<center><a href="#" id="no-account">Don't have an account?</a></center>
			</div>
		</div>
	</div>
	
</div>
<div class="signup-screen" >
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-sm-offset-4">
			<div class="text-area">
				<center><span class="h3">Sign up</span></center>
				<div id="signup-error-area">
					
				</div>
			</div>
			<form class="form-horizontal" role="form" id="signup-form">
				<div class="form-group">
					<input type="text" name="full-name" class="form-control" placeholder="Full name" value="<?php echo set_value('full-name') ?>" id="signup-name-input">
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email') ?>" id="signup-email-input">
					<div id="email-text-area" style="width:100%">
						
					</div>
				</div>
				<div class="form-group">
					<input type="text" name="phone" class="form-control" placeholder="Phone" value="<?php echo set_value('phone') ?>" id="signup-phone-input">
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" id="signup-password-input">
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-info btn-md btn-block" id="signup-button">Sign up</button>
				</div>
			</form>
			<div class="have-account">
				<center><a href="#" id="have-account">Already have an account?</a></center>
			</div>
		</div>
	</div>
	
</div>
</div>
<script>
	$(document).ready(function(){
		$(".signup-screen").hide();

	});
</script>