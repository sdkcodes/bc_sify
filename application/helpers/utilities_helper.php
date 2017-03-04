<?php 

if (!function_exists('doBootstrapAlert')){
	function doBootstrapAlert($message, $alertType){
		// $this->session->set_flashdata('message', $message);
		// $this->session->set_flashdata("alert-type", $alertType);
		$_SESSION['message'] = $message;
		$_SESSION['alert-type'] = $alertType;
	}
}

if (!function_exists('echoBootstrapAlert')){
	function echoBootstrapAlert(){
		//if ($this->session->flashdata('message')){
		if (isset($_SESSION['message'])){
			echo "<div class='alert alert-" . $_SESSION['alert-type'] . "'>";

			//echo $this->session->flashdata('message');
			echo "<a href=# class=close data-dismiss=alert>&times; </a>";
			echo $_SESSION['message'];
			echo "</div>";
			
			unset($_SESSION['message']);
			unset($_SESSION['alert-type']);
		}
		
	}
}	

?>