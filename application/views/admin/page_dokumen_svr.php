<!-- START PAGE CONTAINER -->
        <div class="content-wrapper">
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>admin">Beranda</a></li>
                    <li class="active">Surat Tugas Surveillance</li>
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

                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         
                          

					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Surat Tugas Online</h3>
                        <div class="pull-right">
							<button class="btn btn-danger toggle" data-toggle="exportTable">
							<i class="glyphicon glyphicon-plus"></i> Tambah Data
							</button>
						</div>
                    </div>
                    <div class="panel-body" id="exportTable" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">

						<form method="post" class="form-horizontal" action="<?php echo base_url(); ?>dokumen_svr/submit" enctype="multipart/form-data">

                            <div class="panel panel-default">                                
                                <div class="panel-body">
                                    <h3><span class="fa fa-mail-forward"></span> File Input</h3>
                                    <p>Add Surat Tugas <code>file</code> to file input Surat Tugas DB</p>
									
                                </div>
                                <div class="panel-body">                                                                        
                                    
                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">No Surat</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <input type="text" class="form-control" name='nosurat' placeholder="No. Surat" value="<?= $nosurat?>">
                                                    <span class="help-block">No Surat</span>
                                                </div>
                                            </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Menimbang</label>
                                        <div class="col-md-6 col-xs-12">                                     
                                          <select class="form-control select2" name='menimbang'style="width: 100%;">
                                              <option selected="selected">Bahwa sehubungan dengan pelaksanaan kegiatan Inspeksi Penerapan CKIB di</option>
                                              <option>Bahwa sehubungan dengan pelaksanaan kegiatan Kegiatan Inspeksi Penerapan IKI di</option>
                                              <option>Bahwa sehubungan dengan pelaksanaan kegiatan Verifikasi penerapan sistem HACCP di</option>
                                              <option>Bahwa sehubungan dengan pelaksanaan kegiatan Survailance penerapan sistem HACCP di</option>
                                              <option>Bahwa sehubungan dengan pelaksanaan kegiatan Inspeksi penerapan sistem HACCP di</option>
                                              <option>Bahwa sehubungan dengan pelaksanaan kegiatan Stuffing Kegiatan Mutu</option>
                                              <option>Bahwa dalam rangka kegiatan Survailance Penerbitan Health Certificate (HC)</option>
                                              <option>Bahwa dalam rangka kegiatan Inspeksi Sertifikasi CPIB</option>
                                              <option>Bahwa dalam rangka kegiatan Perpanjangan Sertifikat CPIB</option>
    
                                              
                                             
                                             </select>
                                            
                                         
                                                                                   
                                        </div>
                                    </div>   
                                        <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Dasar</label>
                                        <div class="col-md-6 col-xs-12">                                     
                                        
                                            <textarea class="form-control" name="dasar" id="myDokumen" rows="3">
                                            Biaya Perjalanan Dinas kegiatan ini dibebankan pada DIPA Balai KIPM Semarang Nomor DIPA-032.13.2.649661/2019 Tanggal 05 November 2018
                                            
                                            </textarea>    
                                        
                                                                                   
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Jenis Kegiatan</label>
                                        <div class="col-md-6 col-xs-12">                                                                                            
                                            <select class="form-control select" name="kelas" id="kelas">
                                                <option>Kegiatan</option>
												<?php foreach ($kelas as $row) { ?>
												<option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
												<?php } ?>
                                            </select>
                                            <span class="help-block">Jenis Kegiatan</span>
                                        </div>
                                    </div>
                                    
                                  
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Trader</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name='trader[]'>
                                            <option>Unit Pengolahan Ikan</option>
                                               <?php                                           
                                               foreach ($tr_trader as $row) { ?>
                                               <option value="<?php echo $row->id_trader;?>"><?php echo $row->nm_trader;?>/<?php echo $row->al_trader;?></option>
                                              
                                                <?php } ?>
                                            </select>
                                        </div>                          
                                             <span class="help-block"></span>
                                        
                                    </div>
                          
                                         <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Tanggal</label>
                                        <div class="col-md-3 col-xs-3">
                                          <div class="input-group">
                                             <div class="input-group-addon">
                                                 <i class="fa fa-calendar"></i>
                                             </div>
                            <input type="date" name="tanggal_berangkat" value="<?php echo $tanggal_berangkat; ?>"/>
                                             s/d
                                             </div>

                                          </div>  

                                          <div class="input-group">
                                             <div class="input-group-addon">
                                                 <i class="fa fa-calendar"></i>
                                             </div>

                            <input type="date" name="tanggal_pulang" value="<?php echo $tanggal_pulang; ?>"/>
                                             </div>
                                          </div>                           
                                          
                                        </div>
                               
                            
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Pegawai</label>
                                        <div class="col-md-3 col-xs-3">
                                            <select class="form-control select2" multiple="multiple" name='pegawai[]' data-placeholder="Pilih Pegawai DL"
                                            style="width: 100%;">
                                               <?php foreach ($pegawai as $row) { ?>
                                                <option value="<?php echo $row->NIP;?>"><?php echo $row->Namapeg;?></option>
                                                <?php } ?>
                                            </select>
                                        </div>                          
                                             <span class="help-block">Pegawai Perjalanan Dinas</span>
                                        
                                    </div>
                          

                
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tujuan DL</label>
                                        <div class="col-md-6 col-xs-12">
                                         <input type="text" class="form-control" name='tujuandl' placeholder="Enter ...">                 
                                         <span class="help-block">Tujuan Dl</span>
                                        </div>
                                    </div>
                                    
									<div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">File</label>
                                                <div class="col-md-6 col-xs-12">

                                                    <input type="file" name="attachments" id="attachments" class="fileinput btn-primary" title="Browse file" data-filename-placement="inside" multiple="true" />
                                                    <span class="help-block">Input type file</span>
                                                </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Keperluan</label>
                                        <div class="col-md-6 col-xs-12">                                     
										    <select class="form-control select2" name='keperluandl'style="width: 100%;">
                                              <option selected="selected">Inspeksi Penerapan CKIB</option>
                                              <option>Inspeksi Penerapan HACCP</option>
                                              <option>Inspeksi Penerapan IKI</option>
                                              <option>Survailance Penerapan HACCP</option>
                                              <option>Stuffing Mutu</option>
                                              
                                              
                                             </select>
                                            
                                            
                                                                                   
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tanggal Surat</label>
                                        <div class="col-md-6 col-xs-12">                                     
                                              <input type="date" name="tanggalttd" value="<?php echo $tanggalttd; ?>"/>
                                       
                                                                                   
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Pejabat Penandatangan</label>
                                        <div class="col-md-6 col-xs-12">  
                                            <select class="form-control select2" name='pjttd'style="width: 100%;">
                                              <option selected="selected">Raden Gatot Perdana</option>
                                              <option>Ely Musyarofah</option>
                                              <option>Joko Purwono</option>
                                              <option>Oky Fajar Sasongko</option>
                                              
                                             </select>
                                                                                   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Pejabat</label>
                                        <div class="col-md-6 col-xs-12">  
                                            <select class="form-control select2" name='pj'style="width: 100%;">
                                              <option selected="selected">Plh. Kepala</option>
                                              <option>Kepala</option>
                                             </select>
                                                                                   
                                        </div>
                                    </div>  

                                </div>
                                <div class="panel-footer">
                                    <button type="reset" class="btn btn-default toggle" data-toggle="exportTable">
									<i class="glyphicon glyphicon-remove"></i>
									Clear Form</button>
                                    <button class="btn btn-primary pull-right">
									<i class="fa fa-save"></i> Simpan</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                        
                    </div>
					
					</div>                
				
                <div class="panel-body">
                <table class="table datatable">
                    <thead>
						<tr>
							<th width="5%">Id</th>
							<th width="5%">Jenis Kegiatan</th>
                            <th width="10%">No Surat</th>
                            <th >Deskripsi Surat Tugas</th>
                            <th width="10%">Tanggal Berangkat</th>
                            <th width="10%">Tanggal Pulang</th>
                            <th width="10%">Trader</th>
                            
                            
  
                            <th width="15%">Status Surat Tugas</th>
                            <th align="center" width="15%">Action</th>
                            <th align="center" width="15%">Supplier</th>
                                                                            
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
							<td align="center"><?php echo $row->class_id?></td>
                            <td align="center"><?php echo $row->nosurat?></td>
                            <td><?php echo word_limiter($row->keperluandl,2000).'  <br>(jml kata: '.str_word_count($row->keperluandl).')'; ?>
						    </td>
							<td align="center"><?php echo $row->tanggal_berangkat?></td>
                            <td align="center"><?php echo $row->tanggal_pulang?></td>
                            <td align="center"><?php echo $row->nm_trader?></td>
                            
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
									<a href="<?php echo base_url(); ?>dokumen_svr/edit_dokumen/<?php echo $row->id_doc;?>">
									<span class="fa fa-pencil"></span></a>
								</button>
								
							
                                <button>
                                    <a href="<?php echo base_url(); ?>dokumen_svr/cetak_dokumen/<?php echo $row->id_doc;?>" 
                                                                       
                                    <span class="fa fa-print"></span></a>
                                </button>
                                 <button>
                                    <a href="<?php echo base_url(); ?>dokumen_svr/kirim_surat/<?php echo $row->id_doc;?>" 
                                                                       
                                    <span class="fa fa-fw fa-mail-forward"></span></a>
                                </button>
                                <button>
									<a href="<?php echo base_url(); ?>dokumen_svr/delete_dokumen/<?php echo $row->id_doc;?>" 
									onclick="javascript: return confirm('Are you sure delete ? ')" >									
									<span class="fa fa-trash-o"></span></a>
								</button>
							
							</div>
                        </td> 
                        <td align="center">
              <div class="btn-group" role="group">                            
      
               
                                <button>
                                    <a href="<?php echo base_url(); ?>dokumen_svr/cetak_dokumen_supp/<?php echo $row->id_doc;?>" 
                                                                       
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
                    <div class="mb-v footer">
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
       