<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	include_once('Base_Controller.php');
class Hidden extends Base_Controller {
	
	
	public function index() {
		// $this->template->load($this->activeTemplate, 'welcome_message');
		// echo "welcome.php/ index";
		$this->template->load($this->activeTemplate,  'hidden/index' );
		
	}
	
	
	public function proxy(){
	myproxy();
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */