<style type="text/css">
	.btn-file {
	    position: relative;
	    overflow: hidden;
	}
	.btn-file input[type=file] {
	    position: absolute;
	    top: 0;
	    right: 0;
	    min-width: 100%;
	    min-height: 100%;
	    font-size: 100px;
	    text-align: right;
	    filter: alpha(opacity=0);
	    opacity: 0;
	    outline: none;
	    background: white;
	    cursor: inherit;
	    display: block;
	}
</style>
<div class="container-fluid">
<div class="edit-profile">
	<div class="row">
		<div class="col-xs-offset-1 col-sm-6">
			<div class="text-area">
				<span class="h3">Edit your profile</span>
			</div>
			<form role="form">
				<div class="form-group">
					<input type="text" name="email" class="form-control" value="<?php echo $user->email ?>" disabled>
				</div>
				<div class="form-group">
					<input type="text" name="name" class="form-control" placeholder="Full name" value="<?php echo $user->name !== '' ? $user->name : '' ?>" id="update-name-input">
				</div>
				<div class="form-group">
					<input type="text" name="phone" class="form-control" placeholder="Phone number" value="<?php echo $user->phone !== '' ? $user->phone : '' ?>" id="update-phone-input">
				</div>
				<div class="form-group">
					<select name="country" class="form-control" id="countries-select">
						<option value="">Country</option>
						<?php if (!empty($countries)): ?>
							<?php foreach ($countries as $country): ?>
								<option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
				<div class="form-group">
					<select name="state" class="form-control" id="states-select">
						
					</select>
				</div>
				<div class="form-group">
					<select name="city" class="form-control" id="cities-select">
						
					</select>
				</div>
				<div class="form-group">
					<input type="date" name="date-of-birth" class="form-control" placeholder="Birth date yyyy-mm-dd" id="update-dob-input" value="<?php echo $user->dob ?>">
				</div>
				<div class="form-group">
					<label class="radio-inline"><input type="radio" name="gender" id="male-gender" value="male" <?php echo $user->gender === "male" ? "checked" : "" ?>>Male</label>
					<label class="radio-inline"><input type="radio" name="gender" id="female-gender" value="female"  <?php echo $user->gender === "female" ? "checked" : "" ?>>Female</label>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="button" id="update-profile-button">Save</button>
				</div>
			</form>
		</div>
		
	</div>
</div>
</div>
  
<script>
	$(document).on('change', ':file', function() {
	    var input = $(this),
	        numFiles = input.get(0).files ? input.get(0).files.length : 1,
	        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	    input.trigger('fileselect', [numFiles, label]);
	});
	$(document).ready( function() {
	    $(':file').on('fileselect', function(event, numFiles, label) {
	        
	        console.log(label);
	    });
	});
</script>