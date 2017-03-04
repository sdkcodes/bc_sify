<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-md-3">
			<div class="panel panel-info user-info">
				<div class="panel-body">
					<div class="name-section">
						<div class="row">
						<div class="col-xs-12">
								<a href="" data-toggle="modal" data-target="#profile-pic-modal">
								<img src="<?php echo base_url('uploads/profilepics/'.$user->image) ?>" class="thumbnail img-rounded" width=150 height=150 style="display: inline" id="profile-pic-display">
								</a>
						</div>

						</div> <!-- ./row -->
								<?php if (intval($this->session->userdata('user_id')) === intval($user->id)): ?>
									<div class="container">
										<form id="pic-upload-form" enctype="multipart/form-data" action="<?php echo site_url('user/ajaxuploadpic') ?>">
											<label class="btn btn-primary btn-file">
												<i class="fa fa-camera"></i>Upload photo<input type="file" name="userfile" id="userfile" style="display: none">
											</label>
											
										</form>
									</div>
								<?php endif; ?>
						
						<span class="h3"><a href="<?php echo site_url('user/view/'.$user->username) ?>"><?php echo $user->name ?></a></span>
						<br>
						<a href="<?php echo site_url('user/view/'.$user->username) ?>">@<?php echo $user->username ?></a>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-6 col-sm-6">
							<a href="<?php echo site_url('user/view/'.$user->username) ?>" class="btn btn-link">POSTS<br>
								<?php echo countUserPosts($user->id) ?>
							</a>
						</div>
						<div class="col-xs-6 col-sm-6">
							<a href="<?php echo site_url('user/likes/'.$user->id) ?>" class="btn btn-link view-likes">LIKES<br>
								<?php echo countUserLikes($user->id) ?>
							</a>
						</div>
						
					</div>
					
				</div>
			</div>
		</div>
<div class="modal fade " role="dialog" id="profile-pic-modal">
	<div class="modal-dialog">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      
	    </div>
	    <div class="modal-body">
	      	<img src="<?php echo base_url('uploads/profilepics/'.$user->image) ?>" class="img-rounded" style="width: 100%; height: auto;">
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	    </div>
	  </div>

	</div>
</div>
