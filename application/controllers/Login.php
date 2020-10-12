
<?php 

if (!defined('BASEPATH'))
        exit('No direct script access allowed');
        
class Login extends CI_Controller{

    public function index(){
        $this->load->view('template/header');
        $this->load->view('login');
        $this->load->view('template/footer');
    }

    public function proses_login(){

        $this->form_validation->set_rules('email','email','required',['required' => 'Email harus diisi!']);
        $this->form_validation->set_rules('password','Password','required',['required' => 'Password harus diisi!']);
        if ($this->form_validation->run() == FALSE){
            $this->load->view('template/header');
            $this->load->view('login');
            $this->load->view('template/footer');
        }else{
            $email = $this->input->post('email');
            $password = md5($this->input->post('password'));


            $user = $this->db->get_where('tbl_users', ['email' => $email, 'password' => $password])->row_array();

            if ($user){
                
                if($user['roleId'] == '1'){
                    $data = [
                        'emaila' => $user['email'],
                        'roleIda' => $user['roleId'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('admin');
                } else if($user['roleId'] == '2'){
                    $data = [
                        'emailm' => $user['email'],
                        'roleIdm' => $user['roleId'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('manager');
                } else if($user['roleId'] == '3'){
                    $data = [
                        'emaile' => $user['email'],
                        'roleIde' => $user['roleId'],
                    ];
                    $this->session->set_userdata($data);
                    redirect('Employee');
                }
                else{
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Email atau Password salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    redirect('login');
                }
            }else{
                $this->session->set_flashdata('pesan','<div class="alert alert-danger alert dismissible" role="alert">Email atau Password salah<button type="button" class="close" data-dismiss="alert" aria=label="Close"><span aria-hidden="true">&times;</span></button></div>');
                redirect('login');
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect ('login');
    }

    public function test(){
        redirect('admin');

    }

}

?>

