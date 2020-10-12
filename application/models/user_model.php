<?php 

class User_model extends CI_Model{
    public function ambil_data($id)
    {
        $this->db->where('email', $id);
        return $this->db->get('tbl_users')->row();
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
            
        }else{
            $this->session->set_flashdata('error', 'Password Salah');
        }

    }

    public function isNotLogin(){
        return $this->session->userdata('user_logged') === null;
    }

    function cari($id){
        $query= $this->db->get_where('v_upload_ops',array('no_ppk'=>$id));
        return $query;
    }
}
?>