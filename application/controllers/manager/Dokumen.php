<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';
include "assets/vendor/mpdf/mpdf/mpdf.php";
//include "vendor/PHPMailer/PHPMailer/PHPMailer";
//include "vendor/PHPMailer/PHPMailer/Exception";

class Dokumen extends CI_Controller {
	public $id_doc = 0;	
	
	function __construct(){
		parent::__construct();
		$this->load->model('db_model');
		//$this->load->library('ciqrcode');
		//$this->load->library('email');
	}
	
	public function index()
	{				
		$this->load->helper('text');		
		
		$data['datas']	= $this->db_model->list_dok_ppc()->result_object();		
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$data['pegawai']= $this->db->query("select * from tb_pegawai")->result_object();
		$data['no_ppk']= $this->db->query("select * from v_upload_ops")->result_object();
        $data['tr_trader']= $this->db->query("select * from tb_r_trader")->result_object();
		$data['verifikasi'] = $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat='' ")->num_rows();
		$data['selesai_ver'] = $this->db->query("SELECT * FROM tb_dokumen  WHERE nosurat>'' ")->num_rows();
		
		$data['list_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen LEFT JOIN tb_pegawai ON tb_detail_dokumen.NIP = tb_pegawai.NIP WHERE tanggal_berangkat >= CURRENT_DATE() and tanggal_pulang <= CURRENT_DATE() ")->result_object();

		$data['sum_dl_today'] = $this->db->query("SELECT * FROM tb_detail_dokumen WHERE tanggal_berangkat >= CURRENT_DATE and tanggal_pulang <= CURRENT_DATE ")->num_rows();

		
		$data['page']	= "page_dokumen";		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_dokumen', $data);
		$this->load->view('admin/templates/footer');
	}
	
	public function add_dokumen(){
		   $data['tr_trader']= $this->db->query("select * from tb_r_trader")->result_object();
		   
	 
		$data['page']	= "add_dokumen";		
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/home', $data);
		$this->load->view('admin/templates/footer');
	}
	public function edit_dokumen($id_doc){
		$data_nosur = $this->db->query("SELECT nosurat FROM tb_dokumen WHERE tanggalttd= CURDATE()")->result_array();
	
		if (empty($data_nosur)){
					$nosuratlast = $this->db->query("SELECT nosurat FROM tb_dokumen ORDER BY nosurat DESC LIMIT 1")->result_array();
  					$nobaru= strval(substr($nosuratlast[0]['nosurat'],0,3));
  					$nobaru = $nobaru+3;

  					$bulan  = $this->getrovbulan(date('m'));
  					$tahun  = date('Y');
  					$vnosurat = strval($nobaru).'/ST/17.0/KP.440/'.$bulan.'/'.$tahun;
		} else {
					$nosuratlast = $this->db->query("SELECT nosurat FROM tb_dokumen ORDER BY nosurat DESC LIMIT 1")->result_array();
 					$nobaru= strval(substr($nosuratlast[0]['nosurat'],0,3));
  					$nobaru = $nobaru+1;
  					$bulan  = $this->getrovbulan(date('m'));
  					$tahun  = date('Y');
  					$vnosurat = strval($nobaru).'/ST/17.0/KP.440/'.$bulan.'/'.$tahun;
  					//467/ST/17.0/KP.440/IV/2019
  					//dumper($vnosurat);
		}

		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=".$id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
	
		  if (empty($data['nosurat'])){
            $data['pegawai']	= $this->db->query("select * from tb_pegawai")->result_object();
	    }
         else{
            $data['pegawai']= "Anda tidak diperkenankan edit";
         
         }
		$data['tr_trader']	= $this->db->query("select * from tb_r_trader")->result_object();
	
		
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
		$this->db->where('id_doc', $id_doc);
		$data['pegawaidl'] 		    = $this->db->get()->result_object();
		$data['nosurat']	 		= $data[0]['nosurat'];
		$data['id_doc'] 	 		= $data[0]['id_doc'];		
		$data['class_id'] 			= $data[0]['class_id'];
		$data['dasar'] 				= $data[0]['dasar'];
		$data['menimbang'] 			= $data[0]['menimbang'];
		$data['keperluandl'] 		= $data[0]['keperluandl'];
		$data['tujuandl'] 			= $data[0]['tujuandl'];
		$data['tanggalttd'] 		= $data[0]['tanggalttd'];
		$data['pjttd'] 				= $data[0]['pjttd'];
		$data['pj'] 				= $data[0]['pj'];
		$data['tanggal_berangkat']	= $data[0]['tanggal_berangkat'];
		$data['tanggal_pulang']		= $data[0]['tanggal_pulang'];
		$data['created_date']		= $data[0]['created_date'];
		$data['request']			= $data[0]['request'];
		$data['id_trader']			= $data[0]['id_trader'];
		$data['vnosurat']			= $vnosurat;



		$data['page']				= "page_dokumen";	
		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/sidebar', $data);
		$this->load->view('admin/page_dokumen_edit',$data);
		$this->load->view('admin/templates/footer');

	}
	
	public function cetak_dokumen($id_doc){
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

		$this->load->view('admin/page_surattugas',$data);	
	}
	public function kirim_surat($id_doc){
		//echo $id_doc;
		$data = $this->db->query("select * from tb_dokumen where id_doc=".$id_doc)->result_array();
		$data['kelas']	= $this->db->query("select * from tb_class")->result_object();
		$this->db->select('*');
		$this->db->from('tb_detail_dokumen');
		$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
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
		$kirim = 
		$mail             = new PHPMailer();

$subject = $data[0]['nosurat'];
 foreach ($pegawai as $vpegawai) {

// Get full html:
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

Bersama ini kami menugaskan saudara : '.$vpegawai->Namapeg.'
<table style="width:80%" border: 1px solid black>
  <tr>
    <th>Surat</th>
    <th>Keterangan</th> 
    </tr>
  <tr>
    <td>No Surat</td>
    <td>'.$data['nosurat'].'</td> 
   </tr>
   <tr>
    <td>Dasar</td>
    <td>'.$data['nosurat'].'</td> 
   </tr>
  <tr>
    <td>No Surat</td>
    <td>'.$data['nosurat'].'</td> 
   </tr>
     <tr>
    <td>Dasar</td>
    <td>'.$data['dasar'].'</td> 
   </tr>  
   <tr>
    <td>menimbang </td>
    <td>'.$data['menimbang'].'</td> 
   </tr>
    <tr>
    <td>Keperluan </td>
    <td>'.$data['nosurat'].'</td> 
   </tr>  <tr>
    <td>Tanggal Berangkat</td>
    <td>'.$tanggal_berangkat.'</td> 
   </tr>  
   <tr>
    <td>Tanggal Pulang</td>
    <td>'.$tanggal_pulang.'</td> 
   </tr>
   <tr>
    <td>Tanggal Surat</td>
    <td>'.$data['tanggalttd'].'</td> 
   </tr>
</table>
			
	Kepala:
	'.$data[0]['pjttd'].';	
	<br>
	Generate Email From STONLINE Balai KIPM Semarang		
</body>
</html>';
// Also, for getting full html you may use the following internal method:
//$body = $this->email->full_html($subject, $message);

$result = $this->email
 
->from('agus.widjanarko@kkp.go.id')
 
->to($vpegawai->email)
 
->subject($subject)
 
->message($body)
 
->send();


//var_dump($result);
//echo '<br />';
  
//echo $this->email->print_debugger();
}
//exit;
redirect('Dokumen');
ob_flush(); 
	

	}
	public function view($id_doc){
		$qry = $this->db->query("select * from tb_dokumen where id_doc=".$id_doc)->result_array();
		$data = json_encode($qry);
		print_r($data);

	}
	
	public function delete_dokumen($id){
		$this->db->delete('tb_dokumen', array('id_doc' => $id));
		$this->db->delete('tb_detail_dokumen', array('id_doc' => $id));
		$this->db->delete('events', array('id' =>  $id));
		
		header('location:'.base_url().'dokumen');
	}

	public function submit(){
		

		ob_start();
		$fileName		        	= "";
		$nosurat			        = $this->input->post('nosurat');
		$menimbang			        = $this->input->post('menimbang');
		$dasar 			        	= $this->input->post('dasar');
		$kelas				        = $this->input->post('kelas');
		$trader                     = $this->input->post('trader');
		$tgl_berangkat			= $this->input->post('tanggal_berangkat');
		$tgl_pulang 			= $this->input->post('tanggal_pulang');

		$pegawai			        = $this->input->post('pegawai');
		$tujuandl			        = $this->input->post('tujuandl');
		$keperluandl		        = $this->input->post('keperluandl');
		$tanggalttd			        = $this->input->post('tanggalttd');
		  $tanggalttd = str_replace('/','-',$tanggalttd);
      	   $tanggalttd = date('Y-m-d' , strtotime($tanggalttd));
      	 
		$pjttd				        = $this->input->post('pjttd');
	
		 	
	    if (empty($tgl_berangkat))
            echo "tanggal berangkat tidak boleh kosong\n";
      	    $tanggal_berangkat = str_replace('/','-',$tgl_berangkat);
      	    $tanggal_berangkat = date('Y-m-d' , strtotime($tanggal_berangkat));	
    
        if (empty($tgl_pulang))
           echo "tanggal pulang tidak boleh kosong\n";
      	   $tanggal_pulang = str_replace('/','-',$tgl_pulang);
      	   $tanggal_pulang = date('Y-m-d' , strtotime($tanggal_pulang));
      	   
      	 

  
		//if (!empty($_FILES)) {
		//	$tempFile = $_FILES['filename']['tmp_name'];
		//	$fileName = $_FILES['filename']['name'];
		//	$path = './uploads/';
		//	$targetFile = $path.$fileName ;
		//	move_uploaded_file($tempFile, $targetFile);
		//	if ($doc=="")
		//	  $doc = file_get_contents($_FILES['filename']['tmp_name']); 
		//}
		
		//echo "nama file : ".$fileName;
		//echo "kelas : ".$kelas;
		
	
		 
		 //echo "checked: ".$pre_proc;
       	  $data = $this->db->query("select ifnull(max(id_doc),0)+1 as jml from tb_dokumen")->result_array();
		  $this->id_doc = $data[0]['jml'];
           $data_parent = array(
            'id_doc'  			=> $this->id_doc,
            'nosurat'			=> $nosurat,
			'menimbang'			=> $menimbang,
			'dasar'				=> $dasar,
			'tanggal_berangkat'	=> $tanggal_berangkat,
            'tanggal_pulang'	=> $tanggal_pulang,
			'tujuandl'			=> $tujuandl,
			'keperluandl'		=> $keperluandl,
			'tanggalttd'		=> $tanggalttd,
			'pjttd'				=> $pjttd,
			'pj'                => $pj,
			'class_id'			=> $kelas,
			'id_trader'         => $trader[0],
          	'created_date' 		=> date('Y-m-d H:i:00'),
			'updated_date' 		=> ''
            

         );   
	    
	   
		// Cek data kembar
	    $tmp_pegawai_benar=array();
	    $tmp_pegawai_salah=array();
	    
	    
		 foreach ($pegawai as $vpegawai) {
    
		   $cek=$this->db->query("select * from tb_detail_dokumen where  NIP= '$vpegawai' and (tanggal_pulang >= '$tanggal_berangkat' and tanggal_berangkat <= '$tanggal_pulang') " )->num_rows();
	
		    if ($cek >= 1) {
		        
		      
	 	      array_push($tmp_pegawai_salah,$vpegawai);
	 	  
		        
		     // dumper($hasil);  
	         // redirect('Permohonan');
		    } else {
	          
	          array_push($tmp_pegawai_benar,$vpegawai);
	 	        
	 			  
     		}

		 }
	
	                if (empty($tmp_pegawai_salah))
                        {
                                 print_r($data_parent);
	
	                        	$cek = $this->db_model->insert_dokumen($data_parent);
	                        
	                            
                        echo "array is empty";
                            foreach ($tmp_pegawai_benar as $tmp_vpegawai) {
                        	$data_detail = array(
	                          'id_doc'  		=> $this->id_doc,
	                          'NIP'				=> $tmp_vpegawai,
	                         'tanggal_berangkat'	=> $tanggal_berangkat,
	                          'tanggal_pulang'	=> $tanggal_pulang 
       			                );
	 			
     		     	$this->db_model->insert_dokumen_detail($data_detail);	
                            
                            }    
                        }   
                    else
                        {
                        echo "not empty";
                        	 $tmp=$this->db->query("select * from tb_pegawai  WHERE nip IN (".implode(',',$tmp_pegawai_salah).") " )->result_array();
                        	 dumper($tmp);
                       
                            
                        } 
	    
		
	 
		 
		//	$this->Db_model->insert_events($data);	
	
	    

         redirect('Dokumen');
		 
		ob_flush(); 
		
	
		
	}	
	
	public function update(){
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
   	
   		if (empty($pegawai))

			{

  				echo "<script>alert('TIdak ada perubahan data petugas'); </script>";

		}
		else
			{

		  	$this->db->where('id_doc', $id_doc);
		  	$this->db->delete('tb_detail_dokumen');
		  	$this->load->view('admin/templates/header', $data);
			$this->load->view('admin/templates/sidebar', $data);
			$this->load->view('admin/page_dokumen', $data);
			$this->load->view('admin/templates/footer');
		    	

			    //echo "not empty";
		 // Cek data kembar
		
		 
	 		 foreach ($pegawai as $vpegawai) {
            		   $cek=$this->db->query("select * from tb_detail_dokumen where  NIP= '$vpegawai' and (tanggal_pulang >= '$tanggal_berangkat' and tanggal_berangkat <= '$tanggal_pulang') " )->num_rows();
		  
		  
		    if ($cek == 1) {
	 	         $hasil=$this->db->query("select * from tb_pegawai where  NIP= '$vpegawai'" )->result_array();
		        
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
     
       if ($cek!=1) {			  
			 echo "<script>alert('Error Save'); </script>";
		 }else{

		 $filename = $id_doc.'.png';

	 	 $params['data'] = json_encode($data_qr);
		 $params['level'] = 'H';
		 $params['size'] = 10;
		 $params['savename'] = FCPATH.$filename;
		 $this->ciqrcode->generate($params); 
		 
			  redirect('Dokumen');		
		 }
  	
		
		ob_flush();		
	}

			    // Cek data kembar
	public function checkDuplicateDL($post_email) {

    $this->db->where('pegawaidl', $email_id);

    $query = $this->db->get('my_registration_table');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
        return FALSE; // here I change TRUE to false.
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }
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

			// public function userList(){
			// 	// POST data
			// 	$postData = $this->input->post();
			
			// 	// Get data
			// 	$data = $this->User_model->getUsers($postData);
			
			// 	echo json_encode($data);
			//   }
	
}
