<!-- START PAGE CONTAINER -->
<div class="content-wrapper">
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
            
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>admin">Beranda</a></li>
                    <li class="active">Dokumen</li>
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
                        </div>

                    </div>

					<div class="panel panel-default">
					<div class="panel-heading">

                    <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>laporanemployee/filterdate" enctype="multipart/form-data">

                        <div class="pull-left">
                            Tanggal Berangkat:
                            <input type="date" class="form-control pull-left" name='tanggal_berangkat' id="datemask">
                        </div>

                        <div class="pull-left">
                            Tanggal Pulang:
                            <input type="date" class="form-control pull-right" name='tanggal_pulang' id="datemask2">
                        </div>
                        <div class="pull-left">
                            Filter
                            <br>
                            <button class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                            </button>
                        </div>
                      </form>
                      <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>laporanemployee/filterpegawai" enctype="multipart/form-data">

                        <div class="pull-left">
                            Pegawai:
                             <select class="form-control select2" multiple="multiple" name='NIP' data-placeholder="Pilih Pegawai DL"
                                            style="width: 100%;">
                                               <?php foreach ($pegawai as $row) { ?>
                                                <option value="<?php echo $row->NIP;?>"><?php echo $row->Namapeg;?></option>
                                                <?php } ?>
                                            </select>
                        </div>

                       
                        <div class="pull-left">
                            Filter
                            <br>
                            <button class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                            </button>
                        </div>
                      </form>
                      

                      
                    </div>
                               
				
                <div class="panel-body">
                <table class="table datatable">
                    <thead>
						<tr>
							<th width="5%">Id</th>
							<th width="5%">NIP</th>
                            <th width="10%">Nama</th>
                            <th width="10%">Tanggal Berangkat</th>
                             <th width="5%">Tanggal Pulang</th>
                            <th align=center width="15%">Action</th>       

                        </tr>
                    </thead>
					<tbody>
                      	 <?php                       
                        //$no = 1;
                        //$no = $this->uri->segment('3')+1;
                      
                        foreach ($data as $row) {
                 
                        ?>
                    	<tr>						
							<td><?php echo $row->id_doc?></td>
							<td align="center"><?php echo $row->NIP;?></td>
                            <td align="center"><?php echo $row->Namapeg;?></td>
                            <td align="center"><?php echo $row->tanggal_berangkat;?></td>
                            <td align="center"><?php echo $row->tanggal_pulang;?></td>
                           
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