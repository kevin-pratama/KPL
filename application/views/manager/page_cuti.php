<!-- START PAGE CONTAINER -->
<div class="content-wrapper">
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                    
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>manager">Beranda</a></li>
                    <li><a href="#">Administrasi</a></li>
                    <li class="active">Cuti</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">
					<div class="col-md-12">
				
					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Cuti</h3>
                        
                    </div>
					<div class="panel-body" id="exportTable" style="display: none;">
                    <div class="row">
                        
                        
                    </div>
					
					</div>                
				
                <div class="panel-body">
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
					
                <table class="table datatable">
                    <thead>
						<tr>
							<th width="5%">no.</th>
                            <th width="30%">NIP</th>
                            <th widht>Nama</th>                            
                                                     
                        </tr>
                    </thead>
					<tbody>

                      	<?php  		

                      	foreach ($data as $row) {
                      
                        ?>
                    	<tr>					
                    	    	<td><?php echo $row->id_cuti; ?></td>

							<td><?php echo $row->NIP; ?></td>

							<td align="left"><?php echo $row->Namapeg; ?></td>
						
							
                        </td>                  		
                    	</tr>
                    	<?php }
						  //endforeach 
						?>
                    </tbody>
					</table>
                

					</div>
					<div class="col-md-1">
					</div>
				</div>
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
         
