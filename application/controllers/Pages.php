<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function view($page = 'home', $status = 'pages/'){
        if(!file_exists(APPPATH.'views/pages/' . $page . '.php')){
            show_404();
        }
        //log in status
        if ($status === 'pages/') {
            $this->load->view('includes/header');
            $this->load->view($status . $page);
            $this->load->view('includes/footer');
        } else if ($status === 'carer/') {
            $this->load->view('includes/carerheader');
            $this->load->view($status . $page);
            $this->load->view('includes/carerfooter');
        } else if ($status === 'admin/') {
            $this->load->view('includes/adminheader');
            $this->load->view($status . $page);
            $this->load->view('includes/adminfooter');
        } else {
            show_404();
        }
	}
}
