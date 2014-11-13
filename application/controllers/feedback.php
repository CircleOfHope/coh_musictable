<?php

class Feedback extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->library('session');
        $this->load->library('user_agent');
    }

    public function index()
    {
        $data['admin'] = $this->session->userdata('admin') == 'TRUE';
        $data['header'] = $this->load->view('templates/header_view', $data, true);
        $data['footer'] = $this->load->view('templates/footer_view', $data, true);
        $this->load->view('feedback_view', $data);
    }
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */
?>