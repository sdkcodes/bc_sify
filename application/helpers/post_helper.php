<?php 

if (! function_exists('getPostDetails')){
	function getPostDetails($post_id){
		$CI = get_instance();
		$CI->load->model('post_model');
		$post = $CI->post_model->getPostById($post_id);
		return $post;
	}
}

if (!function_exists("countLikesForPost")){
	function countLikesForPost($post_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		return $CI->post_model->countLikesForPost($post_id);
	}
}

if (!function_exists("countCommentsForPost")){
	function countCommentsForPost($post_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		return $CI->post_model->countCommentsForPost($post_id);
	}
}

if (!function_exists("isAReply")){
	function isAReply($post_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		$post = $CI->post_model->getPostById($post_id);
		if ($post->parent_id !== NULL AND intval($post->id) > 0){
			return "is-a-reply";
		}
		else{
			return "not-a-reply";
		}
	}
}

if (!function_exists("isAComment")){
	function isAComment($post_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		$post = $CI->post_model->getPostById($post_id);
		if ($post->parent_id !== NULL AND intval($post->id) > 0){
			return TRUE;
		}
		
	}
}