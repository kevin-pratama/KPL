<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="style.css">
 </head>

<body>
<div class="login-form"> 

    <form method="post" action="<?php echo base_url('login/proses_login');?>">
    <center>
        <img src="assets/images/users/logobkipm.jpg" width="50%">
        <h4 class="modal-title"> LOGIN BALAI KIPM </h4>
        <?= $this->session->flashdata('pesan');?>   
        <div class="form-group">
            <input type="text" name="email" id="username"class="form-control" placeholder="Email" required="required">
        </div>
        <div class="form-group">
            <input type="password" name="password" id="username" class="form-control" placeholder="Password" required="required">
        </div>
        <input type="submit" class="btn btn-primary btn-block btn-lg" value="Login" name="login">  
    </form>         
</div>




