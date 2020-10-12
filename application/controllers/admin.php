<?php

class Admin extends CI_Controller{
	

	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		
	}

	public function index(){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/templates/footer');
	
		$data['list_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen LEFT JOIN tb_pegawai ON tb_detail_dokumen.NIP = tb_pegawai.NIP WHERE tanggal_berangkat >= CURRENT_DATE() and tanggal_pulang <= CURRENT_DATE() ")->result_object();

		$data['sum_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen WHERE tanggal_berangkat >= CURRENT_DATE and tanggal_pulang <= CURRENT_DATE ")->num_rows();
	
	
	}
	
}

?>
