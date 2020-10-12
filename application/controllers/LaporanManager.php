<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';
include "assets/vendor/mpdf/mpdf/mpdf.php";
//include "vendor/PHPMailer/PHPMailer/PHPMailer";
//include "vendor/PHPMailer/PHPMailer/Exception";

class LaporanManager extends CI_Controller {
	public $id_doc = 0;	
	
	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['roleIdm'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		$this->load->model('db_model');
	
	}
	
	public function index()
	{				
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
		$this->load->helper('text');		
		
		$data['data']	= $this->db_model->list_dok_svr()->result_object();		
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$data['pegawai']= $this->db->query("select * from tb_pegawai")->result_object();

		$data['verifikasi'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat='' ")->num_rows();
		$data['selesai_ver'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat>'' ")->num_rows();

		
		$data['page']	= "page_laporan_utama";	
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/page_laporan_utama',$data);
		$this->load->view('manager/templates/footer');	
		
	}
	

	public function add_laporan(){
	$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
	$data['hsldinas']= $this->db->query("select * from tb_dokumen")->result_object();
		
  
	 $data['page']	= "add_laporan";		
	 $this->load->view('manager/templates/header', $data);
	 $this->load->view('manager/templates/sidebar', $data);
	 $this->load->view('manager/home', $data);
	 $this->load->view('manager/templates/footer');
 	}
	
	public function view_dokumen($id_doc){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=".$id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
		$this->db->where('id_doc', $id_doc);
		$data['pegawaidl'] 		    = $this->db->get()->result_object();
	
		
		$data['id_doc'] 			= $data[0]['id_doc'];	
		$data['nosurat'] 			= $data[0]['nosurat'];
		$data['dasar'] 				= $data[0]['dasar'];
		$data['menimbang'] 			= $data[0]['menimbang'];
		$data['keperluandl'] 		= $data[0]['keperluandl'];
		$data['tujuandl'] 			= $data[0]['tujuandl'];
		$tanggalttd			 		= $data[0]['tanggalttd'];
		$data['tanggalttd'] 		= $this->Tglindo($tanggalttd);
		
		$data['pjttd'] 				= $data[0]['pjttd'];
		$tanggal_berangkat			= ($data[0]['tanggal_berangkat']);
		$data['tanggal_berangkat']	= $this->Tglindo($tanggal_berangkat);
		$tanggal_pulang				= $data[0]['tanggal_pulang'];
		$data['tanggal_pulang']		= $this->Tglindo($tanggal_pulang);
		$data['created_date']		= $data[0]['created_date'];
		$data['hsldinas']			= $data[0]['hsldinas'];
		$data['page']				= "page_laporan";
		
		
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/page_laporan_view',$data);
		$this->load->view('manager/templates/footer');
	}


	public function cetak_laporan($id_doc){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=".$id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
		$this->db->where('id_doc', $id_doc);
		$data['pegawai'] = $this->db->get()->result_array();
		
		$data['id_doc'] 			= $data[0]['id_doc'];	
		$data['nosurat'] 			= $data[0]['nosurat'];
		$data['dasar'] 				= $data[0]['dasar'];
		$data['id_trader']			= $data[0]['id_trader'];
		$data['menimbang'] 			= $data[0]['menimbang'];
		$data['keperluandl'] 		= $data[0]['keperluandl'];
		$data['tujuandl'] 			= $data[0]['tujuandl'];
		$tanggalttd			 		= $data[0]['tanggalttd'];
		$data['hsldinas']			= $data[0]['hsldinas'];
		$data['tanggalttd'] 		= $this->Tglindo($tanggalttd); 
		
		$data['pjttd'] 				= $data[0]['pjttd'];
		$data['pj'] 				= $data[0]['pj'];
		
		$tanggal_berangkat			= ($data[0]['tanggal_berangkat']);
		$data['tanggal_berangkat']	= $this->Tglindo($tanggal_berangkat);
		$tanggal_pulang				= $data[0]['tanggal_pulang'];
		$data['tanggal_pulang']		= $this->Tglindo($tanggal_pulang);
		$data['page']				= "page_laporan_utama";
		$hsldinas					= $this->input->post('hsldinas');

		
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/page_laporan_cetak',$data);
		$this->load->view('manager/templates/footer');
	}


	public function filterdate(){
		

		ob_start();
		$data['pegawai']= $this->db->query("select * from tb_pegawai")->result_object();
		
		$tanggal_berangkat	 = $this->input->post('tanggal_berangkat');
		$tanggal_berangkat   = date('Y-m-d',strtotime($tanggal_berangkat));
        $tanggal_pulang   	 = $this->input->post('tanggal_pulang');
        $tanggal_pulang      = date('Y-m-d',strtotime($tanggal_pulang));
        
      	$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
		$this->db->WHERE("tanggal_pulang >= '$tanggal_berangkat' AND tanggal_berangkat <= '$tanggal_pulang' ");
		$data['data']=$this->db->get()->result_object();
  		
			
		$data['page']				= "page_laporan";
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/page_laporan',$data);
		$this->load->view('manager/templates/footer');
		
		 
	
		
	}	
		public function filterpegawai(){
		

		ob_start();
		$data['pegawai']= $this->db->query("select * from tb_pegawai")->result_object();
		
		$NIP	 = $this->input->post('NIP');
	
	
      	$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->where("NIP = '$NIP'");

		$data['data'] =$this->db->get()->result_object();
  		
			
  		$data['page']	= "page_laporan";
		$this->load->view('manager/templates/header', $data);
		$this->load->view('manager/templates/sidebar', $data);
		$this->load->view('manager/page_laporan',$data);
		$this->load->view('manager/templates/footer');
		 
	
		
	}
	
	public  function Tglindo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = $this->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	

	public function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Mar";
						break;
					case 4:
						return "Apr";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Jun";
						break;
					case 7:
						return "Jul";
						break;
					case 8:
						return "Agu";
						break;
					case 9:
						return "Sep";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
				}
			} 
	
		public function update($id_doc){
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emailm')])->row_array();
		ob_start();
				// edit ediit elemen update
						
				$nosurat			= $this->input->post('nosurat');
				$menimbang			= $this->input->post('menimbang');
				$dasar 				= $this->input->post('dasar');
				$kelas				= $this->input->post('kelas');
				$pegawai			= $this->input->post('pegawai');
				$tujuandl			= $this->input->post('tujuandl');
				$keperluandl		= $this->input->post('keperluandl');
				$tanggalttd			= $this->input->post('tanggalttd');
				$pj					= $this->input->post('pj');		
				$pjttd				= $this->input->post('pjttd');
				$tanggal_berangkat	= $this->input->post('tanggal_berangkat');
				$tanggal_pulang   	= $this->input->post('tanggal_pulang');
				$hsldinas			= $this->input->post('hsldinas');

				$this->db->set("hsldinas", $hsldinas);
				$this->db->where("id_doc", $id_doc);
				$this->db->update("tb_dokumen");
				
				   
					redirect('laporanManager'.$id_doc);
					
		}
	
}
