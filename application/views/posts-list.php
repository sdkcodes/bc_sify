<div class="post-list">
<style>
	
	a:hover{
		text-decoration: none;
	}
	.post-body{
		color:black;
	}
</style>	
	<?php if (count($posts) > 0): ?>
		
			<div class="list-group-heading"><?php echo isset($section_title) ? $section_title : "" ?></div>
		<?php foreach ($posts as $post): ?>
			
				<div class="panel panel-default">
					<div class="panel-body">
						<?php if (isAComment($post->id)): ?>
							<center><span class="text-muted small"><a href="<?php echo site_url('post/view/'.$post->parent_id) ?>">In reply to <?php echo substr(getPostDetails($post->parent_id)->body, 0, 20) ?> ... </a></span></center>
							
						<?php endif; ?>
						<img src="<?php echo base_url('uploads/profilepics/'.getUser($post->user_id)->image) ?>" style="" class="img-rounded user-post-avatar">
						
						<span class="h4">
						<a href="<?php echo site_url('user/view/'. $post->username) ?>">
						<span class="user_name_link"><?php echo $post->screen_name ?> @<?php echo $post->username ?></span>
						</a>
						</span> <br>
						<a href="<?php echo site_url('post/view/' . $post->id) ?>"> 
						<div class="post-body <?php echo isAReply($post->id) ?>">
						
						<?php echo strlen($post->body) > 200 ? substr($post->body, 0, 200) . " ..." : $post->body  ?>
						
						</div>
						</a>
						
					</div>
					<div class="panel-footer">
						<div class="interactions-area">
						<span id="comment-area-post-<?php echo $post->id ?>">	
							<button class="btn btn-link has-tooltip" data-toggle="tooltip" data-placement="top" title="Comment"><i class="fa fa-reply" id=""></i></button>
						</span>
						<span class="text-muted small" id="comments-count-<?php echo $post->id ?>"><?php echo countCommentsForPost($post->id) > 0 ? countCommentsForPost($post->id) : "" ?>
							
						</span>
						<span id="like-area-post-<?php echo $post->id ?>">
						<?php echo (!userLikesPost($this->session->userdata("user_id"), $post->id) ? '<button class="btn btn-default btn-link do-like has-tooltip" data-post-id="' . $post->id . '" data-toggle="tooltip" title="Like" id="post"'.$post->id.'"><i class="fa fa-star-o"></i></button>' : '<button class="btn btn-default btn-link do-unlike" data-post-id="'. $post->id . '" data-toggle="tooltip" title="unLike" id="post"'.$post->id .'"><i class="fa fa-star"></i></button>'); 
						?>
						</span>
						<span class="text-muted small" id="likes-count-<?php echo $post->id ?>"><?php echo countLikesForPost($post->id) > 0 ? countLikesForPost($post->id) : "" ?>
							
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
						</div> <!-- ./comment-box -->
					</div>
				</div><!-- /panel panel-default -->
			
		<?php endforeach; ?>
		</ul>
	<?php else: ?>

	<?php endif; ?>
</div><!-- /.post-list -->