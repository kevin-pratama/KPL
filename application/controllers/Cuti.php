<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Cuti extends CI_Controller {	
	
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
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data['data']	= $this->db_model->list_cuti()->result_object();				
		$data['page']	= "page_cuti";							
		
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_cuti',$data);
		$this->load->view('admin/templates/footer');
			
	}
	
	public function update(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
		$id_cuti		= $this->input->post('id_cuti');
		$NIP 		    = $this->input->post('NIP');
        $tglmulaicuti   = $this->input->post('tglmulaicuti');
        $tglakhircuti   = $this->input->post('tglakhircuti');
		$no_surat       = $this->input->post('no_surat');
		$tgl_surat		= $this->input->post('tgl_surat');
        
		$data = array(

			'id_cuti'			=> $id_cuti,
            'NIP'  				=> $NIP,
            'tglmulaicuti'  	=> $tglmulaicuti,
            'tglakhircuti'  	=> $tglakhircuti,
			'no_surat'          => $no_surat,
			'tgl_surat'			=> $tgl_surat
            );

		
		$this->db->where('id_cuti', $id_cuti);
      	$this->db->update('tb_cuti', $data);
		
		header('location:'.base_url().'cuti');
		
		ob_flush();		
	}
	
	public function edit_cuti($id_cuti){
		//echo $id_doc;

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$data = $this->db->query("select * from tb_cuti where id_cuti=".$id_cuti)->result_array();
		$data['roleId']	= $this->db->query("select * from tb_cuti")->result_object();
		
		$data['id_cuti']		= $data[0]['id_cuti'];
		$data['NIP'] 		    = $data[0]['NIP'];
        $data['tglmulaicuti']   = $data[0]['tglmulaicuti'];
        $data['tglakhircuti']   = $data[0]['tglakhircuti'];
		$data['no_surat']       = $data[0]['no_surat'];
		$data['tgl_surat']		= $data[0]['tgl_surat'];		
		$data['page']	= "page_cuti";
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_cuti_edit',$data);
		$this->load->view('admin/templates/footer');		
	}
	
	public function delete_cuti($id_cuti){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->db->delete('tb_cuti', array('id_cuti' => $id_cuti));
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_cuti',$data);
		$this->load->view('admin/templates/footer');
		header('location:'.base_url().'cuti');
	}
	
	public function submit(){
		ob_start();
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$NIP 		    = $this->input->post('NIP');
        $tglmulaicuti   = $this->input->post('tglmulaicuti');
        $tglakhircuti   = $this->input->post('tglakhircuti');
		$no_surat       = $this->input->post('no_surat');
		$tgl_surat		= $this->input->post('tgl_surat');
		$data = array(
            'NIP'  				=> $NIP,
            'tglmulaicuti' 		=> $tglmulaicuti,
            'tglakhircuti' 		=> $tglakhircuti,
			'no_surat'          => $no_surat,
			'tgl_surat'			=> $tgl_surat
         );    		 		 
	
		 print_r($data);
		 
		 $cek = $this->db_model->insert_cuti($data);	 
		 
		 if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{
			  //echo '<script>alert("Sukses");</script>';			  
			  redirect('Cuti');		
		 }
		 
		ob_flush(); 
		
	}
	
}

