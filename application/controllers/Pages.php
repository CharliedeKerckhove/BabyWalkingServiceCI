<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	function view($page = 'home', $status = 'pages/'){
        if(!file_exists(APPPATH.'views/' . $status . $page . '.php')){
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
    function login(){
        if(isset($_POST['email']) || isset($_POST['password'])){
            if(!$_POST['email'] || !$_POST['password']){
                $error = "Please enter an email and password";
                return;
            }
            else if($_POST['email'] === 'admin' && $_POST['password'] === 'password123'){
                $page = 'adminarea';
                $status = 'admin/';
                view($page, $status);
            }
            else{
                //No errors - lets get the users account
                $query = "SELECT * FROM carer WHERE Email = :email";
                $result = $DBH->prepare($query);
                $result->bindParam(':email', $_POST['email']);
                $result->execute();
        
                $row = $result->fetch(PDO::FETCH_ASSOC);
        
                if($row){
                        //User found - let’s check the password
                    if(password_verify($_POST['password'], $row['CarerPassword'])){
                        /*create session variables*/    
                        $_SESSION['loggedin'] = true;
                        $_SESSION['carerData'] = $row;
                        $page = 'carerarea';
                        $status = 'carer/';
                        view($page, $status);
                    }else{
                        $error = "Password does not match";
                        return;
                    }
                        
                }else{
                        $error = "Email not recognised";
                        return;
                }
        
            }
        }        
    }
}
