<!-- START PAGE CONTAINER -->
        <div class="content-wrapper">
        <!-- PAGE CONTENT -->
            <div class="page-content">
                                  
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>manager">Beranda</a></li>
                    <li class="active">Surat Tugas PPC</li>
                </ul>
                <!-- END BREADCRUMB -->               
                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">

					
				    <div class="panel panel-default">
                        <div class="panel-heading">
                          <div class="pull-left">
                            <button class="btn btn-block btn-info " >
                            <i class="glyphicon glyphicon-plus"></i> Proses Verifikasi: 
                            <?php $data['Verifikasi']->verifikasi; 
                            echo $verifikasi;?>
                            </button>
                        </div>
                        <span></span>
                         <div class="pull-left">
                            <button class="btn btn-block btn-warning">
                              <i class="glyphicon glyphicon-plus"></i> Selesai Verifikasi : 
                            <?php $data['selesai_ver']->selesai_ver; 
                            echo $selesai_ver;?>

                            </button>
                        </div>
                        <div class="pull-left">
                            <button class="btn btn-block btn-info">
                              <i class="glyphicon glyphicon-plus"></i> Petugas Dinas Luar Hari ini : 
                            <?php  echo $sum_dl_today;?>

                            </button>
                        </div>
                        </div>

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         
                          <table>
                              
                    <tbody>
                           	<?php  	
                      	     echo date('l jS \of F Y h:i:s A') ; 

                            	foreach ($list_dl_today as $rows) {
                      	 ?>
                    		<tr class="color"><?php echo $rows->Namapeg?></tr><tr>-----</tr>
                        
				    	
                    </tbody>
                    	<?php }


              

						?>
                    
					</table>
                
                        <span></span>
                        </div>

                    </div>

					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Surat Tugas Online</h3>
                        <!--<div class="pull-right">
							<button class="btn btn-danger toggle" data-toggle="exportTable">
							<i class="glyphicon glyphicon-plus"></i> Tambah Data
							</button>
						</div>-->
                    </div>                 
				
                <div class="panel-body">
                <table class="table datatable">
                    <thead>
						<tr>
							<th width="5%">Id</th>
							<th width="5%">Jenis Kegiatan</th>
                            <th width="10%">No Surat</th>
                            
                            
                            <th >Deskripsi Surat Tugas</th>
                            
                            
  
                            <th width="15%">Status Surat Tugas</th>
                            <th align="center" width="15%">Action</th>
                            
                                                                            
                        </tr>
                    </thead>
					<tbody>
                      	<?php  						
                      	//$no = 1;
						//$no = $this->uri->segment('3')+1;
						
                      	foreach ($datas as $row) {
                      	    ?>
                    	<tr>						
							<td><?php echo $row->id_doc?></td>
							<td align="center"><?php echo $row->class_id?></td>
                            <td align="center"><?php echo $row->nosurat?></td>
                            <td><?php echo word_limiter($row->keperluandl,1000).'  <br>(jml kata: '.str_word_count($row->keperluandl).')'; ?>
							</td>
							
							<td>
						<?php 	
						  if (empty($row->nosurat)) {
							echo "<span class=\"label label-danger\">Verifikasi</span>";							
							echo "<a href=\"#\" 
									data-toggle=\"modal\" data-target=\"#modal_large\" onclick=\"httGet(".$row->id_doc.")\">
							<span class=\"label label-primary\"><i class=\"fa fa-eye\"></i> view</span>
							</a>";
						  }else {
							echo "<span class=\"badge bg-yellow\">Selesai</span>";
						  }
						?> 						
						</td>
						<td align="center">
							<div class="btn-group" role="group">                            
											
                                <button>
                                    <a href="<?php echo base_url(); ?>dokumen/cetak_dokumen/<?php echo $row->id_doc;?>" 
                                                                       
                                    <span class="fa fa-print"></span></a>
                                </button>
							</div>
                        </td> 
                                            		
                    	</tr>
                    	<?php }
						  //endforeach 
						?>
                    </tbody>
					</table>
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

		
			<!-- MODALS -->        		
        <div class="modal" id="modal_large" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">					
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
					
						<div class="panel panel-default">
                            <div class="panel-heading ui-draggable-handle">
                                <h3 class="panel-title">
								<span class="glyphicon glyphicon-list-alt" color="red"></span> View Deskripsi Surat Tugas</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                    <li><a href="#" class="panel-close" data-dismiss="modal">
										<span class="fa fa-times"></span></a></li>
                                    </ul>                                
                            </div>
                            <div class="panel-body">
							
							<div class="row">							
							<div class="col-md-12">
                            <!-- START ACCORDION -->        
                            <div class="panel-group accordion">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#accOneColOne">                                                												
												<span class="glyphicon glyphicon-hand-right"></span>
												&nbsp; Petugas
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body panel-body-open" id="accOneColOne">									
										<div id="myDataPre"></div>
                                    </div>                                
                                </div>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#accOneColTwo">
                                             <span class="glyphicon glyphicon-hand-right"></span>
											 &nbsp; Deskripsi Singkat
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body" id="accOneColTwo">
										<div id="myDataDok"></div>                                        
                                    </div>                                
                                </div>
                                
                            </div>
                            <!-- END ACCORDION -->                        
                        </div>
						</div>
							 
							 
                                
                            </div>      
                            
						</div>
					
                </div>
            </div>
        </div>    
		<!-- END MODALS-->
		
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type='text/javascript'>
        <script>
            function autoComplete(){
                var no_ppk = document.getElementById("no_ppk").value;
                // document.getElementById("demo").innerHTML = "You selected: ";
                // alert(no_pkk);
                $.ajax({
                    type :'post',
                    url : 'autocomplete.php',
                    data : 'no_ppk'+no_ppk,
                    success : function(data){
                        $('.perusahaan').html(data);
                    }
                });
            }
        </script>
        
  

