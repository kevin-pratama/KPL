        <!-- START PAGE CONTAINER -->
        <div class="content-wrapper">
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                 
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Administrasi</a></li>
                    <li class="active">Edit Profil</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">
					<div class="col-md-12">

          <div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Edit Profile</h3>                        
          </div>

          <div class="panel-body" >
                   
            <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>profile" enctype="multipart/form-data">
                            <div class="panel panel-default">                                                                
                              <div class="panel-body">                                                                        
                                           
                                  <div class="form-group">
                                      <label class="col-md-3 col-xs-12 control-label">Email</label>
                                      <div class="col-md-6 col-xs-12">                                                                                            
                                          <input type="text" class="form-control" name="email" >		
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-3 col-xs-12 control-label">Nama</label>
                                      <div class="col-md-6 col-xs-12">                                                                                            
                                          <input type="text" class="form-control" name="name" >		
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-md-3 col-xs-12 control-label">Password Baru</label>
                                      <div class="col-md-6 col-xs-12">                              
                                          <input type="text" class="form-control" name="Password" >
                                     </div>
                                  </div>  
                                  <div class="form-group">
                                      <label class="col-md-3 col-xs-12 control-label">Konfirmasi Password</label>
                                      <div class="col-md-6 col-xs-12">                              
                                          <input type="text" class="form-control" name="Password" >
                                      </div>
                                  </div>
                                  <br>
                                  <div class="form-group">
                                      <label class="col-md-3 col-xs-12 control-label">Password Baru</label>
                                      <div class="col-md-6 col-xs-12">                              
                                          <input type="text" class="form-control" name="Password" >
                                     </div>
                                  </div>
                                </div>                
				
        <div class="panel-body">
        </div>
        </div>                        

          </div>                        
         </div>                    
        </div>
        <!-- END PAGE CONTENT WRAPPER -->                                    
    </div>            
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>                    
                <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- success -->
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-check"></span> Success</div>
            <div class="mb-content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec at tellus sed mauris mollis pellentesque nec a ligula. Quisque ultricies eleifend lacinia. Nunc luctus quam pretium massa semper tincidunt. Praesent vel mollis eros. Fusce erat arcu, feugiat ac dignissim ac, aliquam sed urna. Maecenas scelerisque molestie justo, ut tempor nunc.</p>
            </div>
            <div class="mb-footer">
                <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end success -->

<!-- END MESSAGE BOX-->

<!-- START PRELOADS -->
<audio id="audio-alert" src="<?php echo base_url();?>audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="<?php echo base_url();?>audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->               







