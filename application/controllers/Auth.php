<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model("user_model");
	}

	public function login(){
		$this->load->view("header", ["title" => "Login"]);
		$this->load->view("login_page");
		$this->load->view("footer");
	}

	public function logUserIn(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		if ($this->form_validation->run() === FALSE){
			$this->login();

		}
		else{
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			if (!$this->user_model->checkEmail($email)){
				doBootstrapAlert("Incorrect email / password", "danger");
				redirect(site_url("auth/login"));
			}
			else{
				$user = $this->user_model->getUserByEmail($email);
				if (password_verify($password, $user->password)){
					
					$this->session->set_userdata("user_id", $user->id);
					$this->session->set_userdata("username", $user->username);
					$this->session->set_userdata("name", $user->name);
					$this->session->set_userdata("logged_in", TRUE);
					
					redirect(site_url("user"));
				}
				else{
					doBootstrapAlert("Incorrect email / password", "danger");
					redirect(site_url("auth/login"));
				}
			}
		}
	}

	public function doLogin(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		if ($this->form_validation->run() === FALSE){
			$jsonResponse = array("status" => "form_error", "email_error" => form_error("email"), 
				"password_error" => form_error("password"));
			echo json_encode($jsonResponse);
		}
		else{
			echo json_encode($this->input->post());
		}
	}

	public function signup(){
		$this->load->view("header", ["title" => "Signup"]);
		$this->load->view("signup_page");
		$this->load->view("footer");
	}

	public function register(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("username", "Username", "trim|required");
		$this->form_validation->set_rules("full-name", "Full name", "trim|required|alpha_numeric_spaces");
		$this->form_validation->set_rules("phone", "Phone", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		if ($this->form_validation->run() === FALSE){
			$this->signup();
		}
		else{
			$data["email"] = $this->input->post("email");
			if ($this->user_model->checkEmail($data["email"])){
				doBootstrapAlert("Email already exists!", "warning");
				$this->signup();
				return;
				redirect(site_url("auth/signup"));
			}
			$data["password"] = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
			// $auth_data["id"] = $this->rand_gen->generate(10, "alpha-numeric" );
			$data["username"] = $this->input->post("username");
			
			$data["name"] = $this->input->post("full-name");
			$data['phone'] = $this->input->post("phone");
			$user_id = $this->user_model->insertUser($data);
			$this->session->set_userdata("user_id", $user_id);
			$this->session->set_userdata("username", $data['username']);
			$this->session->set_userdata("name", $data['name']);
			$this->session->set_userdata("logged_in", TRUE);
			
			// setUserSession();
			redirect(site_url("user"));
		}
	}
	public function doSignup(){
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		$this->form_validation->set_rules("name", "Full name", "trim|required|alpha_numeric_spaces");
		$this->form_validation->set_rules("phone", "Phone", "trim|required");
		$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
		if ($this->form_validation->run() === FALSE){
			$jsonResponse = array("status" => "form_error", "email_error" => form_error("email"),
				"password_error" => form_error("password"), "name_error" => form_error("name"), "phone_error" => form_error("phone"));
			echo json_encode($jsonResponse);
		}
		else{
			$auth_data["email"] = $this->input->post("email");
			if ($this->user_model->checkEmail($auth_data["email"])){
				echo json_encode(array("status" => "form_error", "email_error" => form_error("email")));
				return;
			}
			$auth_data["password"] = $this->input->post("password");
		}
	}

	public function checkEmail(){
		$email = $this->input->post_get("email");
		if ($this->user_model->checkEmail($email) === TRUE){
			echo json_encode(["message" => "That email already exists!"]);
		}
		else{
			echo json_encode(["message" => "Email is available"]);
		}
	}

	public function promptLogin(){
		doBootstrapAlert("Please log in to continue", "danger");
		redirect(site_url("auth/login"));
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('auth/login'));
	}
}