<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_dashboard extends MY_Controller {
	private $any_error = array();

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Dashboard',
			'title_page2' 	=> 'Dashboard ERP',
			'title' 		=> ''
		);

		$this->open_page('dashboard/V_dashboard', $data);
	}

}
