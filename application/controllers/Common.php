<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
include_once('Protected_Controller.php');
class Common extends Protected_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Student_Model', 'student');
        $this->load->model('Studentfee_Model', 'studentfee');
        $this->load->model('Guardian_Model', 'guardian');
       $this->load->model('Class_Model', 'class');
       $this->load->model('Item_Model', 'item');
    }

    public function index($data =array()) {
    	
    	
       
    }

   
 
}
