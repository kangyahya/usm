<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller{
	function __construct(){
		parent::__construct();
		// if($this->session->userdata('status')!=="logged"){
		// 	redirect('login');
		// }
	}
	function template($content, $data=null){
		$data['header'] = $this->load->view('template/header',$data, TRUE);
		$data['content'] = $this->load->view($content, $data, TRUE);
		$data['sidebar'] = $this->load->view('template/sidebar', $data, TRUE);
		$this->load->view('template/index',$data);
	}
}