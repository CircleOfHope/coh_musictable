<?php

class Table extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('html');
    $this->load->add_package_path(APPPATH.'third_party/datamapper');
    $this->load->library('datamapper');
    //$this->load->model('Song');
    $song = new Tag();
  }

  public function index($SearchString = ''){
    $data = array();
    //$this->load->view('songs/table_view',$data);
    echo "TEST";
   }
}

?>
