<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User extends My_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->template('user/home');
	}

	function ujian(){
		$this->template('user/ujian');
	}
	function result(){
		$this->template('user/results');
	}
}
