<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';
include "assets/vendor/mpdf/mpdf/mpdf.php";
//include "vendor/PHPMailer/PHPMailer/PHPMailer";
//include "vendor/PHPMailer/PHPMailer/Exception";

class Sppd extends CI_Controller {
	public $id_doc = 0;	
	
	function __construct(){
		parent::__construct();
		if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		$this->load->model('db_model');
		//$this->load->library('ciqrcode');
		//$this->load->library('email');

	
	}
	
	public function index()
	{				
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		$this->load->helper('text');		
		
		$data['data']	= $this->db_model->list_dok()->result_object();	
		$data['data']	= $this->db->query("select * from tb_dokumen order by id_doc DESC")->result_object();	
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$data['pegawai']= $this->db->query("select * from tb_pegawai")->result_object();
		$data['verifikasi'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat='' ")->num_rows();
		$data['selesai_ver'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat>'' ")->num_rows();
		$data['list_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen LEFT JOIN tb_pegawai ON tb_detail_dokumen.NIP = tb_pegawai.NIP WHERE tanggal_berangkat >= CURRENT_DATE() and tanggal_pulang <= CURRENT_DATE() ")->result_object();

		$data['sum_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen WHERE tanggal_berangkat >= CURRENT_DATE and tanggal_pulang <= CURRENT_DATE ")->num_rows();
		
		

		
		$data['page']	= "page_sppd_master";		
		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_sppd_master',$data);
		$this->load->view('admin/templates/footer');
	}
	
	
	
	public function cetak_sppd($id_doc){
		//echo $id_doc;
		
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
		
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
		$data['dasardua'] 			= $data[0]['dasardua'];
		
		$data['menimbang'] 			= $data[0]['menimbang'];
		$data['keperluandl'] 		= $data[0]['keperluandl'];
		$data['tujuandl'] 			= $data[0]['tujuandl'];
		$tanggalttd			 		= $data[0]['tanggalttd'];
		$data['tanggalttd'] 		= $this->Tglindo($tanggalttd);
		
		$data['pjttd'] 				= $data[0]['pjttd'];
		$data['pj'] 				= $data[0]['pj'];
		
		$tanggal_berangkat			= ($data[0]['tanggal_berangkat']);
		$data['tanggal_berangkat']	= $this->Tglindo($tanggal_berangkat);
		$tanggal_pulang				= $data[0]['tanggal_pulang'];
		$data['tanggal_pulang']		= $this->Tglindo($tanggal_pulang);
		$data['page']				= "page_dokumen";
		$data['trader'] = $this->db->query(" SELECT tb_dokumen.id_doc,tb_dokumen.id_trader,tb_r_trader.nm_trader FROM tb_dokumen
											INNER JOIN tb_r_trader ON tb_dokumen.id_trader = tb_r_trader.id_trader where id_doc=".$id_doc)->result_array();
	

		$this->load->view('admin/page_sppd',$data);

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
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
	public function getrovbulan($bln){
				switch ($bln){
					case 1: 
						return "I";
						break;
					case 2:
						return "II";
						break;
					case 3:
						return "III";
						break;
					case 4:
						return "IV";
						break;
					case 5:
						return "V";
						break;
					case 6:
						return "VI";
						break;
					case 7:
						return "VII";
						break;
					case 8:
						return "VIII";
						break;
					case 9:
						return "IX";
						break;
					case 10:
						return "X";
						break;
					case 11:
						return "XI";
						break;
					case 12:
						return "XII";
						break;
				}
			} 

 
 
	public function phpmailer(){
		
	$mail = $this->phpmailerlib->load();
	try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.kkp.go.id';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'agus.widjanarko';                 // SMTP username
		    $mail->Password = 'agusta';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		    //Recipients
		    $mail->setFrom('agus.widjanarko@kkp.go.id', 'Surat Tugas Online BKIPM Semarang');
		    $mail->addAddress('', 'RICIPIENTNAME');     // Add a recipient
		    //$mail->addAddress('RECEIPIENTEMAIL02');               // Name is optional
		    //$mail->addReplyTo('RECEIPIENTEMAIL03', 'Ganesha');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Here is the subject';
		    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
	}
	public function qrcode(){
		$this->load->library('ciqrcode');
		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= ''; //string, the default is application/cache/
		$config['errorlog']		= ''; //string, the default is application/logs/
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= ''; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
		
	}
	
}
