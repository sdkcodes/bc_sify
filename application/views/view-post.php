	
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo isset($section_title) ? $section_title : "" ?>
		</div>
		<div class="panel-body">

			<span class="h3">
			<a href="<?php echo site_url('user/view/'. $post->username) ?>">
			<span class="user_name_link"><?php echo $post->screen_name ?> @<?php echo $post->username ?></span>
			</a>
			</span> <br>
			<div class="post-body">
			
			<?php echo $post->body ?>
			
			</div>
		</div>
		<div class="panel-footer">
			<div class="interactions-area">
			<span id="comment-area-post-<?php echo $post->id ?>">	
				<button class="btn btn-link" data-toggle="tooltip" title="Comment"><i class="fa fa-reply"></i></button>
			</span>
			<span id="like-area-post-<?php echo $post->id ?>">

			<?php echo (!userLikesPost($this->session->userdata("user_id"), $post->id) ? '<button class="btn btn-default btn-link do-like" data-post-id="' . $post->id . '" data-toggle="tooltip" title="Like" id="post"'.$post->id.'"><i class="fa fa-star-o"></i></button>' : '<button class="btn btn-default btn-link do-unlike" data-post-id="'. $post->id . '" data-toggle="tooltip" title="unLike" id="post"'.$post->id .'"><i class="fa fa-star"></i></button>'); 
			?>
			</span>
			<span class="text-muted small" id="likes-count-<?php echo $post->id ?>"><?php echo countLikesForPost($post->id) ? countLikesForPost($post->id) > 0 : "" ?>
				
			</span>
			
			</div>
			<div class="comment-box">
				<form>
					<div class="form-group">
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-11" style="padding-right: 0">
									<textarea placeholder="Comment..." name="reply-to-post" id="reply-to-post-<?php echo $post->id ?>" data-post-id="<?php echo $post->id ?>" class="form-control" rows="1" onkeyup="textAreaAdjust(this)"></textarea>	
								</div>
								<div class="col-xs-1" style="padding-left: 0">
									<button class="btn btn-info comment-button" data-post-id="<?php echo $post->id ?>"><i class="fa fa-send"></i></button>	
								</div>	
							</div>	
						</div>
						
					</div>
				</form>
			</div>
		</div>
	</div>