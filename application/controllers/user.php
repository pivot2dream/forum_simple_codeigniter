<?php

class User extends CI_Controller {
    public $data = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->user_model->check_role();
    }
    
    public function join()
    {
        // event register button
        if ($this->input->post('btn-reg')) 
        {
            $this->user_model->register();
            if ($this->user_model->error_count != 0) {
                $this->data['error']    = $this->user_model->error;
            } else {
                $this->session->set_userdata('tmp_success', 1);
                redirect('user/join');
            }
        }
        
        $tmp_success = $this->session->userdata('tmp_success');
        if ($tmp_success != NULL) {
            // new user created
            $this->session->unset_userdata('tmp_success');
            $this->data['tmp_success'] = 1;
        }
        
        // event login button
        if ($this->input->post('btn-login'))
        {
            $this->load->model('user_model');
            $this->user_model->check_login();
            if ($this->user_model->error_count != 0) {
                $this->data['error_login']    = $this->user_model->error;
            } else {
                redirect('user');
            }
        }
        
        $this->data['title']   = 'User Join or Login :: '.CIBB_TITLE;
        $this->load->view('header', $this->data);
        $this->load->view('user/join');
        $this->load->view('footer');
    }
    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user/join');
    }
    
    public function index()
    {
        $this->data['title']   = 'User Index :: '.CIBB_TITLE;
        $this->load->view('header', $this->data);
        $this->load->view('user/index');
        $this->load->view('footer');
    }
}