<?php

class Manager extends CI_Controller{
	

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['roleIdm'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
	}

	public function index(){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/dashboard', $data);
		$this->load->view('manager/templates/footer');
    }
}

?>
