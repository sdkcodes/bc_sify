<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function insertUser($user){
		$this->db->insert("user", $user);
		return $this->db->insert_id();
	}


	// public function insertUseruser($user){
	// 	$this->db->insert("user", $user);
	// 	return $this->db->affected_rows();
	// }

	public function updateUser($user_id, $user){
		$this->db->where("id", $user_id);
		$this->db->update("user", $user);
		return $this->db->affected_rows();
	}
	public function getUser($user_id){
		$this->db->where("id", $user_id);
		return $this->db->get("user")->row();
	}

	public function getUserByEmail($email){
		$this->db->where("email", $email);
		return $this->db->get("user")->row();
	}

	public function getUseruser($user_id){
		$this->db->where("id", $user_id);
		return $this->db->get("user")->row();
	}

	public function getUserByUsername($username){
		// $this->db->select("user.*");
		// $this->db->select("user.username");
		$this->db->where('username', $username);
		// $this->db->join("user", "user.id = user.id");
		return $this->db->get("user")->row();
	}

	public function checkEmail($email){
		$this->db->where("email", $email);
		if ($this->db->get("user")->num_rows() > 0){
			return TRUE;
		}
	}

	public function checkUsername($username){
		$this->db->where("username", $username);
		if ($this->db->get("user")->num_rows() > 0){
			return TRUE;
		}
	}
	public function userExists($identity, $password){

	}

	public function getUsers($start="", $limit=""){
		$this->db->limit($limit, $start);
		return $this->db->get("user")->result();
	}

	// public function aFollowsB($user_id, $follower_id){
	// 	$this->db->where("user_id", $user_id);
	// 	$this->db->where("follower_id", $follower_id);
	// 	return $this->db->count_all_results("follower");
	// }

	public function countLikesByUser($user_id){
		$this->db->where("user_id", $user_id);
		return $this->db->count_all_results("post_like");
	}

	public function getUserInterests($user_id){
		$this->db->where("user_id", $user_id);
		return $this->db->get("user_interest")->result();
	}

	public function getFilteredUsersList($age="", $interests="", $country="", $state="", $state="", $gender=""){
		
		if (is_array($interests)){
			$this->db->where_in("user_interest", $interests);
		}
		else{
			$this->db->where("user_interest", $interests);
		}
		$this->db->where("user.country", $country);
		$this->db->where("user.state", $state);
		$this->db->where("user.gender", $gender);
		
		return $this->db->get("user")->result();
	}
	public function countFilteredUsersList($age="",$country="",$gender="", $interests="",  $state=""){
		
		$this->db->select("YEAR(CURRENTDATE()) - YEAR(dob) AS age");
		$where = "age BETWEEN $upper AND $lower";
		if (is_array($age)){
			foreach ($age as $user_age){
				$this->db->or_where($where);
			}
		}
		else{
			$this->db->where($where);
		}
		
		$this->db->count_all_results("user");
		return $this->db->last_query();
	}

	public function getMatchedUsers($age_brackets="",$country="",$gender="", $interests="",  $state=""){
		// if (!is_null($age_brackets)){
		// 	if(is_array($age_brackets)){
		// 		foreach ($age_brackets as $age_bracket){
		// 			switch ($age_bracket) {
		// 				case '18 and 29':
		// 					$this->upper = 29;
		// 					$this->lower = 17
		// 					break;
		// 				case '30 and 40':
		// 					$this->upper = 40;
		// 					$this->lower = 30;
		// 					break;
		// 				case '41 and 60':
		// 					$this->upper = 60;
		// 					$this->lower = 41;
		// 				case '61 and 70':
		// 					$this->upper = 71;
		// 					$this->lower = 60;
		// 					break;
		// 				default:
		// 					$this->upper = 29;
		// 					$this->lower = 17;
		// 					break;
		// 			}
		// 		}
		// 	}
		// }
		if (!is_null($gender)){
			if (is_array($gender)){
				foreach ($gender as $value){
					$where = "(user.gender = '$value')";
					// $this->db->or_where("user.gender", $value);
					$this->db->or_where($where);
				}
			}
			else{
				$where = ("user.gender = '$value'");
				// $this->db->or_where("user.gender", $value);
				$this->db->or_where($where);
			}
		}
		if (!is_null($interests)){
			if (is_array($interests)){
				
				
				foreach ($interests as $interest){
					// $like = "(user.interests)";
					$this->db->or_like("user.interests", $interest);
				}
			}
			else{
				$this->db->like("user.interests", $interests);
			}
		}
		if (!is_null($country)){
			if (is_array($country)){
				
					$this->db->where_in("user.country", implode(",", $country));
				
			}
			else{
				$this->db->where("user.country", $country);
			}
		}
		if (!is_null($state)){
			if (is_array($state)){
				
					$this->db->where_in("user.state", implode(",", $state));
				
			}
			else{
				$this->db->where("user.state", $state);
			}
		}
		
		// return $this->db->count_all_results("user");
		$this->db->get("user");
		return $this->db->last_query();
		
	}

	public function getLikesByUser($user_id){
		$this->db->where("post_like.user_id", $user_id);
		$this->db->join("post", "post_like.post_id = post.id");
		$this->db->order_by("date", "DESC");
		return $this->db->get("post_like")->result();
	}
}