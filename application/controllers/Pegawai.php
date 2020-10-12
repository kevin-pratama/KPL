<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Pegawai extends CI_Controller {	
	
	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		$this->load->helper(array('url','html'));
		$this->load->model('db_model');
	}
     
	public function index()
	{
		$data['data']	= $this->db_model->list_pegawai()->result_object();				
		$data['page']	= "page_pegawai";							
		
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_pegawai',$data);
		$this->load->view('admin/templates/footer');
		
		
	}
	
	public function update(){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		ob_start();
		
		$NIP 		= $this->input->post('NIP');
		$Namapeg 	= $this->input->post('Namapeg');
		$Golongan   = $this->input->post('Golongan');
		$Jabatan    = $this->input->post('Jabatan');
		$email      = $this->input->post('email');
		$noduk		= $this->input->post('noduk');
		$data = array(

            'NIP'  				=> $NIP,
            'Namapeg'			=> $Namapeg,
			'Golongan'			=> $Golongan,
			'Jabatan'			=> $Jabatan,
			'email'				=> $email,
			'no_duk'			=> $noduk,
            );

		
		$this->db->where('NIP', $NIP);
		$this->db->update('tb_pegawai', $data);
		  
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_pegawai_edit',$data);
		$this->load->view('admin/templates/footer');
		  
		header('location:'.base_url().'pegawai');
		
		ob_flush();		
	}
	
	public function edit_pegawai($NIP){
		//echo $id_doc;

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select * from tb_pegawai where NIP=".$NIP)->result_array();
		$data['NIP']	 		= $data[0]['NIP'];
		$data['Namapeg'] 		= $data[0]['Namapeg'];
		$data['Golongan']	 	= $data[0]['Golongan'];
		$data['Jabatan']	 	= $data[0]['Jabatan'];
		$data['email']	 		= $data[0]['email'];
		$data['noduk']			= $data[0]['no_duk'];

		
		$data['page']	= "page_pegawai";
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_pegawai_edit',$data);
		$this->load->view('admin/templates/footer');
				
	}
	
	public function delete_pegawai($nip){

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->db->delete('tb_pegawai', array('NIP' => $nip));
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_pegawai_edit',$data);
		$this->load->view('admin/templates/footer');

		header('location:'.base_url().'pegawai');
	}
	
	public function submit(){
		ob_start();
		$nip			= $this->input->post('nip');
		$namapeg		= $this->input->post('namapeg');
		$jabatan		= $this->input->post('jabatan');
		$golongan		= $this->input->post('golongan');
		$email			= $this->input->post('email');
		$NoDuk			= $this->input->post('noduk');
		$data = array(
            'NIP'		=> $nip,
            'Namapeg'   => $namapeg,
            'Jabatan'	=> $jabatan,
            'Golongan' 	=> $golongan,
			'Email'		=> $email,
			'no_duk'	=> $NoDuk,
         );    		 		 
	
		 print_r($data);
		 
		 $cek = $this->db_model->insert_pegawai($data);	 
		 
		 if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{
			  //echo '<script>alert("Sukses");</script>';			  
			  redirect('Pegawai');		
		 }
		 
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_pegawai_edit',$data);
		$this->load->view('admin/templates/footer');
		ob_flush(); 
		
	}
	
}

