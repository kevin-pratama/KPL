<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "user";

     public function rules()
    {
        return [
            
             ['field' => 'password',
            'label' => 'Password',
            'rules' => 'required']

        ];
    }

    public function cekUser(){
        $post = $this->input->post();
        $this->db->select("*");
        $this->db->where("username", $post["username"]);
        $this->db->where("password", $post["password"]);
        $user = $this->db->get("user")->num_rows();
        if($user > 0){
            return true;
        }else{
            false;
        }

    }

    public function getUser(){
        // cari user berdasarkan email dan username
        $post = $this->input->post();
        $this->db->select("*");
        $this->db->where("username", $post['username']);
        return $this->db->get("user")->row();  
    }

    public function getUser1($id){
        // cari user berdasarkan email dan username
        $post = $this->input->post();
        $this->db->select("*");
        $this->db->where("user_id", $id);
        return $this->db->get("user")->row();  
    }


    public function update($no){
        $post = $this->input->post();
        $password = $post["password"];
        $password_baru = $post["password_baru"];
        $sql = "SELECT * FROM user WHERE user_id = $no AND password LIKE '{$password}'";
        $user = $this->db->query($sql)->num_rows();
        if($user > 0){
            if($password_baru == ""){
                $this->db->set("username", $post["username"]);
                $this->db->where("user_id", $no, FALSE);
                $this->db->update('user');
                $this->session->set_userdata('username', $post["username"]);
                $this->session->set_flashdata('success', 'Perubahan berhasil');
            }else{
                $this->db->set("username", $post["username"]);
                $this->db->set("password", $password_baru);
                $this->db->where("user_id", $no, FALSE);
                $this->db->update('user');
                $this->session->set_userdata('username', $post["username"]);
                $this->session->set_userdata('password', $password_baru);
                $this->session->set_flashdata('success', 'Perubahan berhasil');
            }
            
kk


        }else{
            $this->session->set_flashdata('error', 'Password Salah');
        }

    }


}
