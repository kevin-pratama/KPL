<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'assets/vendor/autoload.php';

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($this->session->userdata['roleIda'])){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible fade show" role="alert">Anda Belum Login<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('login');
		}
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
        
        $this->load->view('admin/templates/header');
		$this->load->view('admin/templates/sidebar');
		$this->load->view('admin/page_profile');
		$this->load->view('admin/templates/footer');
    }

    public function edit($no)
     {
		$data['user'] = $this->db->get_where('tbl_users', ['email' => $this->session->userdata('emaila')])->row_array();
        $post = $this->input->post();
         if (!isset($no)) show_404();
       
         $user_model = $this->user_model;
         $validation = $this->form_validation;
         $validation->set_rules($user_model->rules());

         if ($validation->run()) {
             if($post["password_baru"] == $post["password_baru_konfirm"]){
                $user_model->update($no);  
             }else{
                $this->session->set_flashdata('error', 'konfirmasi password baru tidak sama');
             }
         }
         redirect(site_url('admin/profile'));
     }

    // public function delete($no=null)
    // {
    //     if (!isset($no)) show_404();
        
    //     if ($this->bayar_spp_model->delete($no)) {
    //         redirect(site_url('admin/bayar_spp'));

    //     }
    // }

    // public function rekapSPP(){
    //     $bulan = date('m');
    //     $tahun = date('Y');
  
    //     $bayar_spp = $this->bayar_spp_model;
    //     $data["bulan"] = $bulan;
    //     $data["tahun"] = $tahun;
    //     $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
    //     $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
    //     $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
    //     $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
    //     $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);


    //     $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
    //     $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
    //     $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
    //     $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);


    //     $this->load->view("admin/bayar_spp/rekap_spp", $data);
    // }

    // public function rekapSPPGo(){
    //     $post = $this->input->post();
    //     $bulan = $post["bulan"];
    //     $tahun = $post["tahun"];

    //     $bayar_spp = $this->bayar_spp_model;
    //     $data["bulan"] = $bulan;
    //     $data["tahun"] = $tahun;
    //     $data["jumlah_lunas"] = count($bayar_spp->getLunasByBulanTahun($bulan,$tahun));
    //     $data["jumlah_blmlunas"] = count($bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun));
    //     $data["siswa_lunas"] = $bayar_spp->getLunasByBulanTahun($bulan,$tahun);
    //     $data["siswa_blmlunas"] = $bayar_spp->getBelumLunasByBulanTahun($bulan,$tahun);
    //     $data["spp_terbayar"] = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $data["spp_belum_terbayar"] = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);

    //     $data["rekapSPPBayarTotal"] = $bayar_spp->getRekapSPPTerbayar($bulan,$tahun);
    //     $data["rekapSPPBelumBayarTotal"] = $bayar_spp->getRekapSPPBelumTerbayar($bulan,$tahun);
    //     $data["rekapSPPTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPTerbayarGroupKelas($bulan,$tahun);
    //     $data["rekapSPPBelumTerbayarGroupByKelas"] = $bayar_spp->getRekapSPPBelumTerbayarGroupKelas($bulan,$tahun);

        
    //     $spp_terbayar = $bayar_spp->getSPPTerbayar($bulan,$tahun);
    //     $spp_belum_terbayar = $bayar_spp->getSPPBelumTerbayar($bulan,$tahun);
    //     $data["target_spp"] = 5000 ;
    //     $this->load->view("admin/bayar_spp/rekap_spp", $data);
    // }


    // function get_autocomplete(){
    //     if (isset($_GET['term'])) {
    //         $result = $this->bayar_spp_model->search_blog($_GET['term']);
    //         if (count($result) > 0) {
    //         foreach ($result as $row)
    //             $arr_result[] = array(
    //                 'label' => $row->nama_siswa." (".$row->NIS.")",
    //                 'nomor'   => $row->NIS,
    //                 'kelas'   => $row->kelas,
    //                 'biaya'   => $row->biaya_spp,
    //             );
    //             echo json_encode($arr_result);
    //         }
    //     }
    // }
    

}