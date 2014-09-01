<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Job extends CI_Controller{  
     
    function __construct() {  
        
		parent::__construct();  

    }  
     
    function get_job(){
		header("Access-Control-Allow-Origin: *");
		$this->load->model('job_model');
		$this->job_model->getjob();
		
		
    }   

     
}  
?> 