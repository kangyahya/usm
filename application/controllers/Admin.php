<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends My_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('mahasiswa_model');
		$this->load->model('soal_model');
		$this->load->library('datatables');
		if($this->session->userdata('level')!=="Administrator"){
			redirect('user');
		}
	}
	function index(){
		$data['total_camaba'] = $this->mahasiswa_model->total_rows();
		$data['total_prodi'] = $this->db->like('id_prodi','')->from('prodi')->count_all_results();
		$data['total_user'] = $this->db->like('level','')->from('user')->count_all_results();
		$this->template('admin/home',$data);
	}
	function mahasiswa($p=null, $q=null){
		if(empty($p)){
			$this->template('admin/mahasiswa');
		}elseif($p=="json"){
			header('Content-Type: application/json');
        	echo $this->mahasiswa_model->json();
		}elseif($p=="create"){
			//check apakah token sudah terdaftar
			$tok = $this->get_token(15);
			$check_token = $this->db->query("SELECT token FROM calon_mahasiswa where token=?",$tok);
			if($check_token->num_rows() > 0){
				$toke = $this->get_token(15);
			}else{
				$toke = $tok;
			}
			$data = array(
            'button' => 'Create',
            'prodi_data' => $this->db->get('prodi'),
            'action' => site_url('admin/mahasiswa/create_action'),
            'token'=> $toke,
		    'id_daftar' => set_value('id_daftar'),
		    'nama' => set_value('nama'),
		    'email' => set_value('email'),
		    'no_hp' => set_value('no_hp'),
		    'asal_sekolah' => set_value('asal_sekolah'),
		    'ttl' => set_value('ttl'),
		    'alamat' => set_value('alamat'),
		    'prodi_pilihan' => set_value('prodi_pilihan'),
		    'jk' => set_value('jk'),
		    'thn_lulus' => set_value('thn_lulus'),
		);
        $this->template('admin/mahasiswa_form', $data);
		}elseif($p=="create_action"){

			$this->_rules_mahasiswa();
			if ($this->form_validation->run() == FALSE) {
            	redirect('admin/mahasiswa/create');
        	} else{
        		$data = array(
					'nama' => $this->input->post('nama',TRUE),
					'email' => $this->input->post('email',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					'asal_sekolah' => $this->input->post('asal_sekolah',TRUE),
					'ttl' => $this->input->post('ttl',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
					'prodi_pilihan' => $this->input->post('prodi_pilihan',TRUE),
					'jk' => $this->input->post('jk',TRUE),
					'thn_lulus' => $this->input->post('thn_lulus',TRUE),
					'token' => $this->input->post('no_token', TRUE),
				);
				$password = $this->passwordGenerate(10);
				$user = [
					'username'=>$data['email'],
					'password'=>md5($password),
					'level'=> "Mahasiswa",
				];
				$cek = $this->db->get_where('user', ['username'=>$data['email']]);
				if($cek->num_rows() > 0 ){
					$this->session->set_flashdata('error', "email sudah terdaftar");
					redirect(site_url('admin/mahasiswa/create'));
				}else{
					$this->sendEmail($data['email'], $password, $data['token']);
			        if ($this->session->userdata('ok')=="success") {
			        	$this->db->insert('user', $user);
			            $this->mahasiswa_model->insert($data);
			            $this->session->set_flashdata('success', 'Data berhasil disimpan dengan informasi login sebagai berikut </br> username : '.$user['username'].'</br>password : <code>'.$password.'</code></br>silahkan catat');
			            redirect(site_url('admin/mahasiswa'));
			        }else{
			        	redirect(site_url('admin/mahasiswa/create'));
			        }
				}
				
		        
	            
        	}
		}elseif ($p=="update") {
			$q = $this->uri->segment(4);
			$row = $this->mahasiswa_model->get_by_id($q);
			if($row){
				$data = array(
                'button' => 'Update',
                'prodi_data' => $this->db->get('prodi'),
                'action' => site_url('admin/mahasiswa/update_action'),
				'id_daftar' => set_value('id_daftar', $row->id_daftar),
				'nama' => set_value('nama', $row->nama),
				'email' => set_value('email', $row->email),
				'no_hp' => set_value('no_hp', $row->no_hp),
				'asal_sekolah' => set_value('asal_sekolah', $row->asal_sekolah),
				'ttl' => set_value('ttl', $row->ttl),
				'alamat' => set_value('alamat', $row->alamat),
				'prodi_pilihan' => set_value('prodi_pilihan', $row->prodi_pilihan),
				'jk' => set_value('jk', $row->jk),
				'thn_lulus' => set_value('thn_lulus', $row->thn_lulus),
				'token' =>set_value('token', $row->token),
			    );
		        $this->template('admin/mahasiswa_form', $data);
			}else{
				$this->session->set_flashdata('message', 'Record Not Found');
            	redirect(site_url('admin/mahasiswa'));
			}
		}elseif($p=="update_action"){
			$this->_rules_mahasiswa();
			if ($this->form_validation->run() == FALSE) {
            	$this->update($this->input->post('id_daftar', TRUE));
        	}else{
        		$data = array(
					'nama' => $this->input->post('nama',TRUE),
					'email' => $this->input->post('email',TRUE),
					'no_hp' => $this->input->post('no_hp',TRUE),
					'asal_sekolah' => $this->input->post('asal_sekolah',TRUE),
					'ttl' => $this->input->post('ttl',TRUE),
					'alamat' => $this->input->post('alamat',TRUE),
					'prodi_pilihan' => $this->input->post('prodi_pilihan',TRUE),
					'jk' => $this->input->post('jk',TRUE),
					'thn_lulus' => $this->input->post('thn_lulus',TRUE),

			    );
			    $this->mahasiswa_model->update($this->input->post('id_daftar', TRUE), $data);
	            $this->session->set_flashdata('success', 'Update Record Success');
	            redirect(site_url('admin/mahasiswa'));
        	}
		}elseif($p=="delete"){
			$q = $this->uri->segment(4);
			$row = $this->mahasiswa_model->get_by_id($q);
			if($row){
				$this->mahasiswa_model->delete($q);
				$this->db->delete('user',['username'=>$row->email]);
	            $this->session->set_flashdata('success', 'Delete Record Success');
	            redirect(site_url('admin/mahasiswa'));
			}else{
				$this->session->set_flashdata('success', 'Record Not Found');
            	redirect(site_url('admin/mahasiswa'));
			}
		}
		
	}

	function soal($p=null, $q=null){
		if(empty($p)){
			$this->template('admin/soal');
		}elseif($p=="json"){
			header('Content-Type: application/json');
        	echo $this->soal_model->json();
		}elseif ($p=="create") {
			$data = array(
	            'button' => 'Create',
	            'prodi_data' => $this->db->get('prodi'),
	            'kategori_data' => $this->db->get('kategori'),
	            'action' => site_url('admin/soal/create_action'),
			    'id' => set_value('id'),
			    'id_prodi' => set_value('id_prodi'),
			    'id_fakultas' => set_value('id_fakultas'),
			    'id_kategori' => set_value('id_kategori'),
			    'soal' => set_value('soal'),
			    'opsi_a' => set_value('opsi_a'),
			    'opsi_b' => set_value('opsi_b'),
			    'opsi_c' => set_value('opsi_c'),
			    'opsi_d' => set_value('opsi_d'),
			    'opsi_e' => set_value('opsi_e'),
			    'jawaban' => set_value('jawaban'),
			    
			);
	        $this->template('admin/soal_form', $data);
		}elseif($p=="create_action"){
			$this->_rules_soal();
			if ($this->form_validation->run() == FALSE) {
            	redirect(site_url('admin/soal/create'));
        	}else{
        		$data = array(
					'id_prodi' => $this->input->post('id_prodi',TRUE),
					'id_fakultas' => $this->input->post('id_fakultas',TRUE),
					'id_kategori' => $this->input->post('id_kategori',TRUE),
					'soal' => $this->input->post('soal',TRUE),
					'opsi_a' => $this->input->post('opsi_a',TRUE),
					'opsi_b' => $this->input->post('opsi_b',TRUE),
					'opsi_c' => $this->input->post('opsi_c',TRUE),
					'opsi_d' => $this->input->post('opsi_d',TRUE),
					'opsi_e' => $this->input->post('opsi_e',TRUE),
					'jawaban' => $this->input->post('jawaban',TRUE),
				);

			    $this->soal_model->insert($data);
			    $this->session->set_flashdata('success', 'Create Record Success');
			    redirect(site_url('admin/soal'));
        	}
		}elseif($p=="update"){
			$q = $this->uri->segment(4);
			$row = $this->soal_model->get_by_id($q);
			if ($row) {
	            $data = array(
	                'button' => 'Update',
	                'prodi_data' => $this->db->get('prodi'),
	    	        'kategori_data' => $this->db->get('kategori'),
	                'action' => site_url('admin/soal/update_action'),
					'id' => set_value('id', $row->id),
					'id_prodi' => set_value('id_prodi', $row->id_prodi),
					'id_fakultas' => set_value('id_fakultas', $row->id_fakultas),
					'id_kategori' => set_value('id_kategori', $row->id_kategori),
					'soal' => set_value('soal', $row->soal),
					'opsi_a' => set_value('opsi_a', $row->opsi_a),
					'opsi_b' => set_value('opsi_b', $row->opsi_b),
					'opsi_c' => set_value('opsi_c', $row->opsi_c),
					'opsi_d' => set_value('opsi_d', $row->opsi_d),
					'opsi_e' => set_value('opsi_e', $row->opsi_e),
					'jawaban' => set_value('jawaban', $row->jawaban),
					'tgl_input' => date('Y-m-d H:i:s'),
				);
			    $this->template('admin/soal_form', $data);
		    }else{
		    	$this->session->set_flashdata('success', 'Record Not Found');
            	redirect(site_url('admin/soal'));
		    }
		}elseif($p=="update_action"){
			$this->_rules_soal();
	        if ($this->form_validation->run() == FALSE) {
	            $this->update($this->input->post('id', TRUE));
	        }else{
	        	$data = array(
					'id_prodi' => $this->input->post('id_prodi',TRUE),
					'id_fakultas' => $this->input->post('id_fakultas',TRUE),
					'id_kategori' => $this->input->post('id_kategori',TRUE),
					'soal' => $this->input->post('soal',TRUE),
					'opsi_a' => $this->input->post('opsi_a',TRUE),
					'opsi_b' => $this->input->post('opsi_b',TRUE),
					'opsi_c' => $this->input->post('opsi_c',TRUE),
					'opsi_d' => $this->input->post('opsi_d',TRUE),
					'opsi_e' => $this->input->post('opsi_e',TRUE),
					'jawaban' => $this->input->post('jawaban',TRUE),
					'tgl_input' => date('Y-m-d H:i:s'),
				);

			    $this->soal_model->update($this->input->post('id', TRUE), $data);
			    $this->session->set_flashdata('success', 'Update Record Success');
			    redirect(site_url('admin/soal'));
	        }
		}elseif($p=="delete"){
			$q = $this->uri->segment(4);
			$row = $this->soal_model->get_by_id($q);

	        if ($row) {
	            $this->soal_model->delete($q);
	            $this->session->set_flashdata('success', 'Delete Record Success');
	            redirect(site_url('admin/soal'));
	        } else {
	            $this->session->set_flashdata('success', 'Record Not Found');
	            redirect(site_url('admin/soal'));
	        }
		}
	}
	function prodi($p=null, $q=null){
		if(empty($p)){
			$this->template('admin/prodi');
		}elseif($p=="json"){
			header('Content-Type: application/json');
        	echo $this->mahasiswa_model->prodi_json();
		}elseif($p=="update"){
			$this->_rules_prodi();
			if ($this->form_validation->run() == FALSE) {
            	$this->update($this->input->post('id_prodi', TRUE));
        	}else{
				$data = [
					'nama_prodi' => $this->input->post('nama_prodi'),
					'jurusan' => $this->input->post('jurusan'),
				];
				$this->mahasiswa_model->update_prodi($this->input->post('id_prodi'),$data);
				$this->session->set_flashdata('success', 'Update Record Success');
				redirect(site_url('admin/prodi'));
			}
		}elseif($p=="create"){
			$this->_rules_prodi();
			if ($this->form_validation->run() == FALSE) {
            	redirect('admin/prodi');
        	}else{
				$data = [
					'id_prodi' => $this->input->post('id_prodi'),
					'nama_prodi' => $this->input->post('nama_prodi'),
					'jurusan' => $this->input->post('jurusan'),
				];
				$this->mahasiswa_model->insert_prodi($data);
				$this->session->set_flashdata('success', 'Input Record Success');
				redirect(site_url('admin/prodi'));
			}
		}
	}

	function cat_soal($p=null, $q=null){
		if(empty($p)){
			$this->template('admin/kategori');
		}elseif($p=="json"){
			header('Content-Type: application/json');
        	echo $this->mahasiswa_model->kategori_json();
		}elseif($p=="update"){
			$this->_rules_kategori();
			if ($this->form_validation->run() == FALSE) {
            	$this->update($this->input->post('id_kategori', TRUE));
        	}else{
				$data = [
					'nama_kategori' => $this->input->post('kategori'),
				];
				$this->mahasiswa_model->update_kategori($this->input->post('id_kategori'),$data);
				$this->session->set_flashdata('success', 'Update Record Success');
				redirect(site_url('admin/cat_soal'));
			}
		}elseif($p=="create"){
			$this->_rules_kategori();
			if ($this->form_validation->run() == FALSE) {
            	redirect('admin/cat_soal');
        	}else{
				$data = [
					'nama_kategori' => $this->input->post('kategori'),
				];
				$this->mahasiswa_model->insert_kategori($data);
				$this->session->set_flashdata('success', 'Input Record Success');
				redirect(site_url('admin/cat_soal'));
			}
		}elseif($p=="delete"){
			$this->mahasiswa_model->delete_kategori($this->input->post('id_kategori'));
			$this->session->set_flashdata('success', 'Delete Record Success');
				redirect(site_url('admin/cat_soal'));
		}
	}

	public function _rules_kategori(){
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('id_kategori', 'id_kategori', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function _rules_prodi(){
		$this->form_validation->set_rules('nama_prodi', 'nama prodi', 'trim|required');
		$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');
		$this->form_validation->set_rules('id_prodi', 'id_prodi', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
	public function _rules_mahasiswa() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
	$this->form_validation->set_rules('asal_sekolah', 'asal sekolah', 'trim|required');
	$this->form_validation->set_rules('ttl', 'ttl', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('prodi_pilihan', 'prodi pilihan', 'trim|required');
	$this->form_validation->set_rules('jk', 'jk', 'trim|required');
	$this->form_validation->set_rules('thn_lulus', 'thn lulus', 'trim|required');
	$this->form_validation->set_rules('no_token', 'no token', 'trim|required');

	$this->form_validation->set_rules('id_daftar', 'id_daftar', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    public function _rules_soal() 
    {
	$this->form_validation->set_rules('id_prodi', 'id prodi', 'trim|required');
	$this->form_validation->set_rules('id_fakultas', 'id fakultas', 'trim|required');
	$this->form_validation->set_rules('id_kategori', 'id kategori', 'trim|required');
	$this->form_validation->set_rules('soal', 'soal', 'trim|required');
	$this->form_validation->set_rules('opsi_a', 'opsi a', 'trim|required');
	$this->form_validation->set_rules('opsi_b', 'opsi b', 'trim|required');
	$this->form_validation->set_rules('opsi_c', 'opsi c', 'trim|required');
	$this->form_validation->set_rules('opsi_d', 'opsi d', 'trim|required');
	$this->form_validation->set_rules('opsi_e', 'opsi e', 'trim|required');
	$this->form_validation->set_rules('jawaban', 'jawaban', 'trim|required');
	

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }


    function sendEmail($email, $pass, $token){
        		
        		$config = [
		            'mailtype'  => 'html',
		            'charset'   => 'utf-8',
		            'protocol'  => 'smtp',
		            'smtp_host' => 'smtp.gmail.com',
		            'smtp_user' => 'bindaeyo26@gmail.com',  // ganti dengan email sendiri ganti pake email kamu dulu sementara
		            'smtp_pass'   => 'bobby151515',  // password email
		            'smtp_crypto' => 'ssl',
		            'smtp_port'   => 465,
		            'crlf'    => "\r\n",
		            'newline' => "\r\n"
		        ];

		        // Load library email dan konfigurasinya
		        $this->load->library('email', $config);

		        // Email dan nama pengirim
		        $this->email->from('no-reply@it-cirebon.com', 'Tim PMB UCIC');

		        // Email penerima
		        $this->email->to($email);

		        // Subject email
		        $this->email->subject('Akun Pendaftaran Mahasiswa Baru !');

		        // Isi email
		        $this->email->message("Anda telah berhasil mendaftarkan akun anda pada Sistem Kami menggunakan email :".$email." dengan password = <code>".$pass."</code></br> kode token = ".$token." klik <a href='".site_url()."' target='_blank'>Disini</a> untuk Login");
		        
		        if($this->email->send()){
		        	$this->session->unset_userdata('ok');
		        	$this->session->set_userdata('ok','success');
		        }else{
		        	$this->session->set_userdata('ok','failed');
		        }
    }

    function passwordGenerate($length){
    	$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
	    $string = '';
	    for ($i = 0; $i < $length; $i++) {
		  $pos = rand(0, strlen($karakter)-1);
		  $string .= $karakter{$pos};
		 }
	    return $string;
    }
    function coba(){
    	if(!empty($this->input->post('email_check'))){
				$email = $this->input->post('email');
				$result = $this->mahasiswa_model->get_by_email();
				if($result->num_rows() > 0){
					echo json_encode('taken');
				}else{
					echo json_encode('not_taken');
				}
			}
    }
    //taro disini aja
    function get_token($panjang)
	{

		// $token=array(range(0,9));
		// $karakter=array();
		// foreach($token as $key=>$val){
		// 	foreach($val as $k=>$v){
		// 		$karakter[] = $v;

		// 	}
		// }
		// $tokenn=null;
		// for($i=1; $i<$panjang; $i++){

		// 	$tokenn .= $karakter[rand($i,count($karakter)-1)];
		// }
		// return $tokenn;
	 $char = '1234567890';
	 $string = '';
	    for ($i = 0; $i < $panjang; $i++) {
		  $pos = rand(0, strlen($char)-1);
		  $string .= $char{$pos};
		 }
	    return $string;
	}


}