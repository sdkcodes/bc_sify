<?php

if (! function_exists("setUserSession")){
	function setUserSession($user_id){
		$CI = get_instance();
		$CI->session->set_userdata("user_id", $user_id);
		$CI->session->set_userdata("logged_in", TRUE);
	}
}

if (! function_exists("isUserLoggedIn")){
	function isUserLoggedIn(){
		$CI = get_instance();
		if ($CI->session->has_userdata("user_id") AND $CI->session->userdata("logged_in") === TRUE){
			return TRUE;
		}
	}
}

if (!function_exists("getUser")){
	function getUser($user_id){
		$CI = get_instance();
		$CI->load->model("user_model");
		$user = $CI->user_model->getUser($user_id);
		return $user;
	}
}


if (! function_exists("userLikesPost")){
	function userLikesPost($user_id, $post_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		if ($CI->post_model->checkLike($user_id, $post_id)){
			return TRUE;
		}
	}
}

if (!function_exists("countUserLikes")){
	function countUserLikes($user_id){
		$CI = get_instance();
		$CI->load->model("user_model");
		return $CI->user_model->countLikesByUser($user_id);
	}
}

if (!function_exists("countUserPosts")){
	function countUserPosts($user_id){
		$CI = get_instance();
		$CI->load->model("post_model");
		return $CI->post_model->countPostsByUser($user_id);
	}
}