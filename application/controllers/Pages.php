<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page = 'home'){
        if(!file_exists(APPPATH.'views/pages/' . $page . '.php')){
            show_404();
        }
        
		$this->load->view('includes/header');
		$this->load->view('pages/' . $page);
		$this->load->view('includes/footer');
	}
}
