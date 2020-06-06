<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

    /**
     * Kirim email dengan SMTP Gmail.
     *
     */
    public function index()
    {
      // Konfigurasi email
       $config = [
                    'mailtype'  => 'html',
                    'charset'   => 'utf-8',
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_user' => 'bindaeyo26@gmail.com',  
                    'smtp_pass'   => 'bindaeyo26@gmail.com',  
                    'smtp_crypto' => 'bobby151515',
                    'smtp_port'   => 465,
                    'crlf'    => "\r\n",
                    'newline' => "\r\n"
                ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('no-reply@it-cirebon.com', 'Tim PMB UCIC');

        // Email penerima
        $this->email->to('miawati.muda@gmail.com'); // email tujuan

        // Subject email
        $this->email->subject('Informasi Login !');

        // Isi email
        $this->email->message("Anda telah berhasil mendaftarkan akun anda pada Sistem menggunakan email faridatrie3@gmail.com dengan password = ".$this->passwordGenerate(10)."</br> klik <a href='".site_url()."' target='_blank'>Disini</a> untuk Login");

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
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
}