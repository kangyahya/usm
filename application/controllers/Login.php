<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
		$this->load->model('mahasiswa_model');
	}
	public function index(){
		$status = $this->session->userdata('status');
		$level = $this->session->userdata('level');
		if($status == "logged"){
			if($level=="Administrator"){
				redirect('admin');
			}else{
				redirect('user');
			}
		}else{
			$this->load->view('login');
			
		}
	}
	public function cek_login(){
			$user = $this->input->post('username');
			$pass = $this->input->post('password');
			$log = $this->m_login->logging($user, $pass);
			if($log){
				foreach($log as $l){
					if($l['level']=="Mahasiswa"){
						$row = $this->mahasiswa_model->get_by_email($l['username'])->row();
						$session_data = [
							'username' => $row->nama,
							'level' => $l['level'],
							'status' => "logged",
							'msg'=>'success',
							'email' => $l['username'],
							'no_hp' => $row->no_hp,
							'asal_sekolah' => $row->asal_sekolah,
							'ttl' => $row->ttl,
							'alamat' => $row->alamat,
							'prodi_pilihan' => $row->prodi_pilihan,
							'jk' => $row->jk,
							'thn_lulus'=> $row->thn_lulus
						];
					}else{
						$session_data = [
							'username' => $l['username'],
							'level' => $l['level'],
							'status' => "logged",
							'msg'=>'success',
							'b'=>$pass
						];	
					}

					$this->session->set_userdata($session_data);
				}
				echo json_encode($session_data);
			}else{
				$session_data=[
					'msg' => 'error'
				];
				echo json_encode($session_data);
			}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}