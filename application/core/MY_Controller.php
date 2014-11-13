<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $title = 'Music Table';
	public $styles = array('');

	public function __construct()
	{
		parent::__construct();
	}
   
	function _output($content)
	{
		// Load the base template with output content available as $content
		$data['content'] = &$content;
		echo($this->load->view('master_view', $data, true));
	}
   
}
?>