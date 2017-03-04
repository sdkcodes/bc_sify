// function submitPost(){
// 	$("#submit-post-button").on("click", function(){
		
// 		var post_content = $("#post-body").val();
// 		var url = site_url+'/post/newPost';
// 		$.post(url, {body:post_content}, function (data){
			
// 			$("#post-body").val('');

// 		});
// 	});
// }


function likePost(post_id){
	var post_data = {post_id:post_id};
	var url = site_url+'/post/likepost';

	$.post(url, post_data, function(data){
		data = JSON.parse(data);
		if (data.status === "success"){
			
			// $("#post"+post_id).html('<button class="btn btn-default btn-link do-unlike" data-post-id="'+ post_id + '" data-toggle="tooltip" title="unLike"><i class="fa fa-star"></i></button>');
			$("#like-area-post-"+post_id).html('<button class="btn btn-default btn-link do-unlike" data-post-id="'+ post_id + '" data-toggle="tooltip" title="unLike"><i class="fa fa-star"></i></button>');
			countPostLikes(post_id);
		}

	});
}

function countPostLikes(post_id){
	var url = site_url+'/post/countPostLikes/'+post_id;
	$.get(url, function(data){
		data = JSON.parse(data);
		$("#likes-count-"+post_id).html(data.likes_count);
		console.log(data.likes_count);
	});
}
function unlikePost(post_id){
	var post_data = {post_id:post_id};
	var url = site_url+'/post/unlikepost';

	$.post(url, post_data, function(data){
		data = JSON.parse(data);
		if (data.status === "success"){
			
			$("#like-area-post-"+post_id).html('<button class="btn btn-default btn-link do-like" data-post-id="'+ post_id + '" data-toggle="tooltip" title="like"><i class="fa fa-star-o"></i></button>');
			countPostLikes(post_id);
		}

	});
}

function postComment(post_id){
	console.log(post_id);

	var url = site_url+'/post/comment';
	var comment_body = $("#reply-to-post-"+post_id).val();
	var post_data = {body:comment_body, post_id:post_id};
	$.post(url, post_data, function(data){
		data = JSON.parse(data);
		$("#reply-to-post-"+post_id).val("");
	});
}
function loadPosts(){
	var url = site_url+'/post/postsbyuser';
	$.post(url, function(data){
		$(".post-area").html(data);
	});
}
function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}
$(document).ready(function(){
	// submitPost();
	//loadPosts();
	$(this).on("click", ".do-like", function(event){
		likePost($(this).data("post-id"));
	});
	$(this).on("click", ".do-unlike", function(event){
		unlikePost($(this).data("post-id"));
	});

	$(".view-likes").click(function(event){
		// event.preventDefault();
		var url = $(this).attr("href");
		
		$.post(url, function(data){

			data = JSON.parse(data);
			console.log(data.length);
			console.log(data);
		})
	});
	$(this).on("click", ".comment-button", function(e){
		e.preventDefault();
		postComment($(this).data("post-id"));
	});

	
	$(this).on("click", "view-likes", function(event){

	});
});