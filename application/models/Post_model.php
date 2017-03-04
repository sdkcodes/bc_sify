<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model{


	public function postsByUser($user_id, $start="", $limit="", $order_by="DESC"){
		$this->db->limit($limit, $start);
		$this->db->order_by("created_at", $order_by);
		$this->db->where("user_id", $user_id);
		return $this->db->get("post")->result();
	}

	public function insertPost($data){
		$this->db->insert("post", $data);
		return $this->db->affected_rows();
	}

	public function checkLike($user_id, $post_id){
		$this->db->where("user_id", $user_id);
		$this->db->where("post_id", $post_id);
		return $this->db->count_all_results("post_like");
	}

	public function getPostsComments($post_id, $limit=20, $start="", $order_by="DESC"){
		$this->db->where("parent_id", $post_id);
		$this->db->order_by("created_at", $order_by);
		$this->db->limit($limit, $start);
		return $this->db->get("post")->result();
	}
	public function getPostsForUser($user_id){
		$this->load->model("user_model");
		$user = $this->user_model->getUser($user_id);
		$this->db->where("target_country", $user->country);
		$this->db->like("target_gender", $user->gender);
		$this->db->like("tags", $user->interests);
		// $this->db
		return $this->db->get("post")->result();
	}

	public function countPostsByUser($user_id){
		$this->db->where("user_id", $user_id);
		return $this->db->count_all_results("post");
	}

	public function getPostById($post_id){
		$this->db->where("id", $post_id);
		return $this->db->get("post")->row();
	}
	public function countLikesForPost($post_id){
		$this->db->where("post_id", $post_id);
		return $this->db->count_all_results("post_like");
	}

	public function countCommentsForPost($post_id){
		$this->db->where("parent_id", $post_id);
		return $this->db->count_all_results("post");
	}

}