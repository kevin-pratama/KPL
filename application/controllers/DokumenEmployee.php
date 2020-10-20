<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'assets/vendor/autoload.php';
include "assets/vendor/mpdf/mpdf/mpdf.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class DokumenEmployee extends CI_Controller
{
	public $id_doc = 0;

	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->userdata['roleIde'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
		$this->load->model('db_model');
		$this->load->model('user_model');

		//$this->load->library('ciqrcode');
		//$this->load->library('email');
		$this->load->helper('array');
	}

	public function index()
	{
		//$this->check_login();
		$this->load->helper('text');

		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaile')])->row_array();
		$data['datas']	= $this->db_model->list_dok_ppc()->result_object();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$data['pegawai'] = $this->db->query("select * from tb_pegawai")->result_object();
		$data['no_ppk'] = $this->db->query("select * from v_upload_ops")->result_object();
		$data['tr_trader'] = $this->db->query("select * from tb_r_trader")->result_object();
		$data['verifikasi'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat='' ")->num_rows();
		$data['selesai_ver'] = $this->db->query("SELECT * FROM tb_dokumen  WHERE nosurat>'' ")->num_rows();

		$data['list_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen LEFT JOIN tb_pegawai ON tb_detail_dokumen.NIP = tb_pegawai.NIP WHERE tanggal_berangkat >= CURRENT_DATE() and tanggal_pulang <= CURRENT_DATE() ")->result_object();

		$data['sum_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen WHERE tanggal_berangkat >= CURRENT_DATE and tanggal_pulang <= CURRENT_DATE ")->num_rows();

		$nosurat = $this->db->query("SELECT SUBSTRING_INDEX(nosurat,'/',1) as nosurat FROM `tb_dokumen` WHERE MONTH(created_date) = MONTH(CURRENT_DATE()) ORDER BY nosurat DESC LIMIT 1");

		if($nosurat->num_rows() == 0){
			$nosurat = 1;
		}else{
			$nosurat = $nosurat->unbuffered_row()->nosurat + 1;
		}
		$bulan  = $this->getrovbulan(date('m'));
		$tahun  = date('Y');
		$data['nosurat'] = $nosurat . "/ST/17.0/KP.440/" . $bulan . '/' . $tahun;

		$data['page']	= "page_dokumen";
		$this->load->view('employee/templates/header', $data);
		$this->load->view('employee/templates/sidebar', $data);
		$this->load->view('employee/page_dokumen', $data);
		$this->load->view('employee/templates/footer');
	}

	//***public function check_login(){
        //if(!$this->session->userdata("login")) redirect(base_url("employee"));
    //}
	public function cari(){
        $no_ppk=$_GET['no_ppk'];
        $cari =$this->user_model->cari($no_ppk)->result();
        echo json_encode($cari);
    } 
	public function cetak_dokumen($id_doc)
	{
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaile')])->row_array();
		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=" . $id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP', 'left');
		$this->db->where('id_doc', $id_doc);
		$data['pegawai'] = $this->db->get()->result_array();

		$data['id_doc'] 			= $data[0]['id_doc'];
		$data['nosurat'] 			= $data[0]['nosurat'];
		$data['dasar'] 				= $data[0]['dasar'];
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

		$this->load->view('employee/page_surattugas', $data);
	}
	public function kirim_surat($id_doc)
	{
		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=" . $id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP', 'left');
		$this->db->where('id_doc', $id_doc);
		$pegawai = $this->db->get()->result_object();

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
		$tanggal_pulang				= ($data[0]['tanggal_pulang']);
		$data['tanggal_pulang']		= $this->Tglindo($tanggal_pulang);
		$data['page']				= "page_dokumen";
		
		// $fields['email'] = "mahendrafajar17@gmail.com";
		// $fields['subject'] = "Subjek";
		// $fields['name'] = "Mahendra Fajar";
		// $fields['message'] = "Halo";

		// try {
		// 	$mail = new PHPMailer(true); 
		// 	$mail->SMTPDebug = 1;                               // Enable verbose debug output
		// 	$mail->isSMTP();                                    // Set mailer to use SMTP
		// 	$mail->Host = 'mail.kkp.go.id'; // Specify main and backup SMTP servers
		// 	$mail->SMTPAuth = true;                             // Enable SMTP authentication
		// 	$mail->Username = 'bkipmsemarang';           // SMTP username
		// 	$mail->Password = 'Kkp12345';                       // SMTP password
		// 	$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
		// 	$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
		// 	$mail->From = 'bkipmsemarang@kkp.go.id';
		// 	$mail->FromName = 'Testing kirim email';
		// 	$mail->addAddress($fields['email'], $fields['name']);     // Add a recipient
		// 	$mail->addReplyTo($fields['email'], $fields['name']);
		// 	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		// 	$mail->isHTML(false);                                  // Set email format to HTML
		// 	$mail->Subject = $fields['subject'];
		// 	$mail->Body    = $fields['message'];
		// 	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		// 	if(!$mail->send()) {
		// 		echo 'Message could not be sent.';
		// 		echo 'Mailer Error: ' . $mail->ErrorInfo;
		// 	} else {
		// 		echo 'Message has been sent';
		// 	}
		// } catch (phpmailerException $e) {
		// 	echo $e->errorMessage(); //Pretty error messages from PHPMailer
		// } catch (Exception $e) {
		// 	echo $e->getMessage(); //Boring error messages from anything else!
		// }
		

		$subject = $data[0]['nosurat'];
		foreach ($pegawai as $vpegawai) {

			
			$fields['message'] = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
    <title>' . html_escape($subject) . '</title>
    <style type="text/css">
        body {
            font-family: Arial, Verdana, Helvetica, sans-serif;
            font-size: 16px;
        }
    </style>
</head>
<body>
Kepada 
Yth : <br>

Bersama ini kami menugaskan saudara : ' . $vpegawai->Namapeg . '
<table style="width:80%" border: 1px solid black>
  <tr>
    <th>Surat</th>
    <th>Keterangan</th> 
    </tr>
  <tr>
    <td>No Surat</td>
    <td>' . $data['nosurat'] . '</td> 
   </tr>
   <tr>
    <td>Dasar</td>
    <td>' . $data['nosurat'] . '</td> 
   </tr>
  <tr>
    <td>No Surat</td>
    <td>' . $data['nosurat'] . '</td> 
   </tr>
     <tr>
    <td>Dasar</td>
    <td>' . $data['dasar'] . '</td> 
   </tr>  
   <tr>
    <td>menimbang </td>
    <td>' . $data['menimbang'] . '</td> 
   </tr>
    <tr>
    <td>Keperluan </td>
    <td>' . $data['nosurat'] . '</td> 
   </tr>  <tr>
    <td>Tanggal Berangkat</td>
    <td>' . $tanggal_berangkat . '</td> 
   </tr>  
   <tr>
    <td>Tanggal Pulang</td>
    <td>' . $tanggal_pulang . '</td> 
   </tr>
   <tr>
    <td>Tanggal Surat</td>
    <td>' . $data['tanggalttd'] . '</td> 
   </tr>
</table>
			
	Kepala:
	' . $data[0]['pjttd'] . ';	
	<br>
	Generate Email From STONLINE Balai KIPM Semarang		
</body>
</html>';

		$fields['email'] 	= "kevinpratama18@gmail.com";
		$fields['subject'] 	= "Subjek";
		$fields['name'] 	= "Kevin Pratama";

		try {
			$mail = new PHPMailer(true); 
			// $mail->SMTPDebug = 1;                               // Enable verbose debug output
			$mail->isSMTP();                                    // Set mailer to use SMTP
			$mail->Host = 'mail.kkp.go.id'; // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                             // Enable SMTP authentication
			$mail->Username = 'bkipmsemarang';           // SMTP username
			$mail->Password = 'Kkp12345';                       // SMTP password
			$mail->SMTPSecure = 'ssl';                          // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 465;                                  // TCP port to connect, tls=587, ssl=465
			$mail->From = 'bkipmsemarang@kkp.go.id';
			$mail->FromName = 'Testing kirim email';
			$mail->addAddress($fields['email'], $fields['name']);     // Add a recipient
			$mail->addReplyTo($fields['email'], $fields['name']);
			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			$mail->isHTML(false);                                  // Set email format to HTML
			$mail->Subject = $fields['subject'];
			$mail->Body    = $fields['message'];
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
			} catch (phpmailerException $e) {
				echo $e->errorMessage(); //Pretty error messages from PHPMailer
			} catch (Exception $e) {
				echo $e->getMessage(); //Boring error messages from anything else!
			}
		}
	}
	public function view($id_doc)
	{
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaile')])->row_array();
		$qry = $this->db->query("select * from tb_dokumen where id_doc=" . $id_doc)->result_array();
		$data = json_encode($qry);
		print_r($data);
	}

	

	public function update()
	{
		ob_start();
		// edit ediit elemen update
		$id_doc				= $this->input->post('id_doc');
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

		if (empty($pegawai)) {

			echo "<script>alert('TIdak ada perubahan data petugas'); </script>";
		} else {

			$this->db->where('id_doc', $id_doc);
			$this->db->delete('tb_detail_dokumen');
			$this->load->view('employee/templates/header', $data);
			$this->load->view('employee/templates/sidebar', $data);
			$this->load->view('employee/page_dokumen', $data);
			$this->load->view('employee/templates/footer');


			//echo "not empty";
			// Cek data kembar


			foreach ($pegawai as $vpegawai) {
				$cek = $this->db->query("select * from tb_detail_dokumen where  NIP= '$vpegawai' and (tanggal_pulang >= '$tanggal_berangkat' and tanggal_berangkat <= '$tanggal_pulang') ")->num_rows();


				if ($cek == 1) {
					$hasil = $this->db->query("select * from tb_pegawai where  NIP= '$vpegawai'")->result_array();

					dumper($hasil);
					redirect('Dokumen');
				} else {

					$data = array(
						'id_doc'  			=> $id_doc,
						'NIP'				=> $vpegawai,
						'tanggal_berangkat'	=> $tanggal_berangkat,
						'tanggal_pulang'	=> $tanggal_pulang
					);

					$this->db_model->insert_dokumen_detail($data);
				}
			}
		}

		$data = array(

			'id_doc'  			=> $id_doc,
			'nosurat'			=> $nosurat,
			'menimbang'			=> $menimbang,
			'dasar'				=> $dasar,
			'tanggal_berangkat'	=> $tanggal_berangkat,
			'tanggal_pulang'	=> $tanggal_pulang,
			'tujuandl'			=> $tujuandl,
			'keperluandl'		=> $keperluandl,
			'tanggalttd'		=> $tanggalttd,
			'pjttd'				=> $pjttd,
			'pj'				=> $pj,
			'class_id'			=> $kelas,
			'created_date'		=> date('Y-m-d H:i:00'),
			'updated_date' 		=> date('Y-m-d H:i:00')
		);
		$data_qr = array(

			'nosurat'			=> $nosurat,
			'tanggal_berangkat'	=> $tanggal_berangkat,
			'tanggal_pulang'	=> $tanggal_pulang,
		);



		print_r($data);
		$this->db->where('id_doc', $id_doc);
		$cek =   $this->db->update('tb_dokumen', $data);

		if ($cek != 1) {
			echo "<script>alert('Error Save'); </script>";
		} else {

			$filename = $id_doc . '.png';

			$params['data'] = json_encode($data_qr);
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = FCPATH . $filename;
			$this->ciqrcode->generate($params);

			redirect('Dokumen');
		}


		ob_flush();
	}

	

	public  function Tglindo($tgl)
	{
		//$tanggal = substr($tgl, 8, 2);
		$bulan = $this->getBulan(substr($tgl, 5, 2));
		$tahun = substr($tgl, 0, 4);
		return $tgl . ' ' . $bulan . ' ' . $tahun;
	}

	public function getBulan($bln)
	{
		switch ($bln) {
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


	public function phpmailer()
	{

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
	public function qrcode()
	{
		$this->load->library('ciqrcode');
		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= ''; //string, the default is application/cache/
		$config['errorlog']		= ''; //string, the default is application/logs/
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= ''; //interger, the default is 1024
		$config['black']		= array(224, 255, 255); // array, default is array(255,255,255)
		$config['white']		= array(70, 130, 180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);
	}
	public function getrovbulan($bln)
	{
		switch ($bln) {
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

	// public function userList(){
	// 	// POST data
	// 	$postData = $this->input->post();

	// 	// Get data
	// 	$data = $this->User_model->getUsers($postData);

	// 	echo json_encode($data);
	//   }

}
