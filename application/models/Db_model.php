<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_model extends CI_Model {
	
 
   // =========== Dokumen testing ====================================================================
   
  public function list_dokuji()
  {
	return $this->db->query("SELECT * FROM tb_dokumen_uji order by id_doc desc");
  }

  public function getPegawai($NIP){
    $this->db->select("*");
    $this->db->where("NIP", $NIP, FALSE);
  return $this->db->get("tb_pegawai")->row();
  }
  

  
  public function insert_BoW_uji($data){	  
	$this->db->query("insert into tb_kata_uji(id_doc,id_kata,kata) values ".$data);
	return $this->db->affected_rows();	  
  }
  
  // ============ end ================================================================================
  
  //Dokumen
  public function list_dok()
  {
	return $this->db->query("SELECT * FROM tb_dokumen order by id_doc desc");
  }

  public function list_dok_ppc()
  {
	return $this->db->query("SELECT * FROM tb_dokumen  WHERE       (class_id > 6 AND class_id < 10 ) OR class_id IN (20,21,22,23) and YEAR(tanggal_berangkat)=2020 order by id_doc desc");
  }

  public function list_dok_svr()
  {
	return $this->db->query("SELECT * FROM tb_dokumen LEFT JOIN tb_r_trader
    ON tb_dokumen.id_trader = tb_r_trader.id_trader where (class_id > 3 AND class_id < 7) or (class_id > 8 AND class_id < 20) or class_id IN (22,23,24,25) order by id_doc desc");
  }
  
  public function list_dok_verifikasi()
  {
  return $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat=''order by id_doc desc");
  $this->db->join('NIP','');
  }



   //Kegiatan
  public function list_kelas()
  {
	return $this->db->query("SELECT * FROM tb_class");
  }

  //Manajemen User
  public function list_users()
  {
  return $this->db->query("SELECT * FROM tbl_users");
  }

  public function insert_user($data){    
    $this->db->insert('tbl_users', $data); 
    return $this->db->affected_rows();    
    }


     //Pegawai
  public function list_pegawai()
  {
  return $this->db->query("SELECT * FROM tb_pegawai");
  }
  
  public function list_pegawai_detail_dl()
  {
  return $this->db->query("SELECT * FROM tb_detail_dokumen");
  }
  
   //Trader
   public function list_trader()
   {
   return $this->db->query("SELECT * FROM tb_r_trader WHERE npwp IS NOT NULL");
   }

  public function list_pegawai_dl() {
  return $this->db->join('tb_pegawai', 'tb_pegawai = tb_detail_dokumen.NIP', 'left outer');
  }

  public function get_pegawai_dl_month(){
  $this->db->select('*');
  $this->db->from('tb_detail_dokumen');
  $this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
  $this->db->where("MONTH(tanggal_berangkat)= MONTH(now()) ");
  return $this->db->get();
  
  }

//Cuti
  public function list_cuti(){
    return $this->db->query("SELECT * FROM tb_cuti as a,tb_pegawai as b WHERE a.NIP = b.NIP");
  }
  public function insert_cuti($data){    
    $this->db->insert('tb_cuti', $data); 
    return $this->db->affected_rows();    
    }
  public function getNama(){
    return $this->db->query("SELECT namapeg FROM tb_pegawai");
  }

  public function getCuti($id_cuti){
    $this->db->select("*");
    $this->db->where("id_cuti", $id_cuti, FALSE);
  return $this->db->get("tb_cuti")->row();
  }




   //select class dokumen
  public function getClassDokumen()
  {
	return $this->db->query("SELECT * FROM tb_class");	
  }
  
 

  public function jumlah_dok()
  {
	return $this->db->query("SELECT * FROM tb_dokumen")->num_rows();
  }

  public function jumlah_verifikasi()
  {
  return $this->db->query("SELECT * FROM tb_dokumen WHERE nosurat ='' ")->num_rows();
  }


  public function jumlah_kelas()
  {
	return $this->db->query("SELECT * FROM tb_class")->num_rows();
  }  
  
  public function insert_dokumen($data){	  
	$this->db->insert('tb_dokumen', $data);	
	return $this->db->affected_rows();	  
  }

  public function insert_events($data){   
  $this->db->insert('events', $data); 
  return $this->db->affected_rows();    
  }
  
  public function insert_dokumen_detail($data){
    $this->db->insert('tb_detail_dokumen',$data);
    return $this->db->affected_rows();
  }
  public function insert_kelas($data){	  
	$this->db->insert('tb_class', $data);	
	return $this->db->affected_rows();	  
  }

  public function insert_pegawai($data){    
  $this->db->insert('tb_pegawai', $data); 
  return $this->db->affected_rows();    
  }
  public function insert_trader($data){    
  $this->db->insert('tb_r_trader', $data); 
  return $this->db->affected_rows();    
  }
  
  public function insert_BoW($data){	  
	$this->db->query("insert into tb_kata(id_doc,id_kata,kata) values ".$data);
	return $this->db->affected_rows();	  
  }
  
  //pre-processing
  public function getCount_preproc()
  {
	return $this->db->query("SELECT * FROM tb_dokumen where pre_proc=true")->num_rows();
  }
  
  public function getList_preproc($from,$offset)
  {
	return $this->db->query("SELECT * FROM tb_dokumen where pre_proc=true order by id_doc desc limit ".$from.','.$offset);
  }

  
  public function getList_template($templateID)
  {
  return $this->db_.query("SELECT * FROM templates WHERE 1=1 AND templateID='".filter($templateID)."' ");

  }
  
  
	
  public function getLoginData($user,$pwd){	 
	  $cek_login=$this->db->get_where('users', array('username'=>$user,'password'=>md5($pwd)));
	  //echo $cek_login->num_rows();	  
	  if ($cek_login->num_rows()>0){
		  $r = $cek_login->row();
		  if ($user==$r->username && md5($pwd)==$r->password){
			  $session = array(
				'username' => $r->username,
				'status' => $r->status,
			  );
			  $this->session->set_userdata($session);
			  
			  if ($r->status==0)
				  header('location:'.base_url().'admin');  // name controller
			  else
				  header('location:'.base_url().'user'); 
		  }
	  }else{
		  echo "<script>alert('username/password salah....')</script>";
	  }
	  
	  
  }

  // public function getData(){
  //   $response = array();

  //   if(isset($postData['search']) ){
  //     // Select record
  //     $this->db->select('*');
  //     $this->db->where("no_ppk like '%".$postData['search']."%' ");

  //     $records = $this->db->get('v_upload_ops')->result();

  //     foreach($records as $row ){
  //        $response[] = array("value"=>$row->id,"label"=>$row->username);
  //     }

  //   }

  //   return $response;
  // }

}
