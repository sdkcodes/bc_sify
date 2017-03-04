<?php 

if (!function_exists("getCountries")){
	function getCountries($start="", $limit="", $order_by=""){
		$CI = get_instance();
		$CI->load->model("location_model");
		return $CI->location_model->getCountries();
	}
}