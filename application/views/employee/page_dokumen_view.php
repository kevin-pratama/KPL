        <!-- START PAGE CONTAINER -->
        <div class="content-wrapper">
    
            <!-- PAGE CONTENT -->
            <div class="page-content">                 
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Dokumen</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">
					<div class="col-md-12">
				
					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Detail Surat Tugas</h3>                        
                    </div>
					<div class="panel-body" >
                    
						<!-- <form method="post" class="form-horizontal" action="<?php echo base_url(); ?>dokumen/update" enctype="multipart/form-data">
                            <div class="panel panel-default">                                 -->
                          
                                <div class="panel-body">                                                                        
                                    
                                    <div class="form-group">

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Request</label>
                                      
                                         <div class="col-md-6 col-xs-12">
                                         <input type="textarea" class="form-control" name='Request' placeholder=<?php echo $request;?> disabled>                 
                                
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">No Surat</label>
                                      
                                         <div class="col-md-6 col-xs-12">
                                         <input type="textarea" class="form-control" name='nosurat' placeholder=<?php echo $nosurat;?> disabled>                 
                                
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Menimbang</label>
                                         <div class="col-md-6 col-xs-12">
                                         <input type="textarea" class="form-control"  name='menimbang' placeholder=<?php echo $menimbang;?> disabled>              
                                      
                                        </div>
                                       
                                    </div>   
                                        <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Dasar</label>
                                        <div class="col-md-6 col-xs-12">
                                         <input type="textarea" class="form-control"  name='dasar' placeholder=<?php echo $dasar;?> disabled>              
                                      
                                        </div>
                                      
                                                                                   
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Jenis Kegiatan</label>
                                        <div class="col-md-6 col-xs-12">    <select class="form-control select" name="kelas" id="kelas">
                                                <option>Select Class</option>
                                                <?php foreach ($kelas as $row) { ?>                                         
                                                <option value="<?php echo $row->id;?>" 
                                                <?php if ($class_id==$row->id) echo "selected" ?> >
                                                
                                                <?php echo $row->name;?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                  
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Tanggal</label>
                                        
                                        <div class="col-md-6 col-xs-12">
                                        
                                           <?php 
                                             echo $tanggal_berangkat;
                                             echo "s/d";
                                             echo $tanggal_pulang;
                                            ?>   
                                       
                                           
                                        </div>
                                    </div>
                            
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Pegawai</label>
                                         <div class="col-md-6 col-xs-12">
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th width="5%">NIP</th>
                            <th width="5%">Nama</th>
                            <th width="5%">Jabatan</th>
                            <th width="5%">Golongan</th>
                           
                                                                     
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                             foreach ($pegawaidl as $vpegawai) {

                        ?>
                        <tr>
                                <td><?php echo $vpegawai->NIP?></td>
                                <td><?php echo $vpegawai->Namapeg?></td>
                                <td><?php echo $vpegawai->Jabatan?></td>
                                <td><?php echo $vpegawai->Golongan?></td>
                               
                               
                         </tr>
                           
                         <?php
                        }
                         ?>                       
                    </tbody>
                    </table>
                                         </div>                      
                                             
                                             
                                           
                                        
                                    </div>
                          

                
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tujuan</label>
                                        <div class="col-md-6 col-xs-12">
                                         <input type="text" class="form-control" name='tujuandl' placeholder=<?php echo $tujuandl;?> disabled>                 
                                      
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">File</label>
                                        <div class="col-md-6 col-xs-12">
                                                                                                                            
                                             <input type="file" name="attachments[]" id="attachments" class="fileinput btn-primary" title="Browse file" data-filename-placement="inside" multiple="true"/>
                                            <span class="help-block">Input type file</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Keperluan</label>
                                        <div class="col-md-6 col-xs-12">                                    <input type="text" class="form-control" name='keperluandl' placeholder=<?php echo $keperluandl;?>> 
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tanggal Surat</label>
                                        <div class="col-md-6 col-xs-12"> 
                                        <?php echo $tanggalttd;?> 
                                       
                                                                                   
                                        </div>
                                    </div>                                
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Pejabat TTD</label>
                                        <div class="col-md-6 col-xs-12">   <input type="text" class="form-control" name='pjttd' placeholder=
                                             <?php echo $pjttd;?>
                                             disabled>                          
                                        </div>
                                    </div> 

                                </div>
                                        

                                </div>
                                <div class="panel-footer">
                                    <button type="reset" class="btn btn-default" onclick="location.href='<?php echo base_url();?>Permohonan';">
									<i class="glyphicon glyphicon-remove"></i>
									Close</button>
                                  
                                </div>
                            </div>
                            </form>
                            
                        
                   
					</div>                 -->
<!-- 				
                <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="5%">Permohonan</th>
                            <th width="5%">Koreksi</th>
                            <th width="5%">Paraf Kasubag</th>
                            <th width="5%">TTD Kepala</th>
                            <th width="5%">Status</th>
                                                                     
                        </tr>
                    </thead>
                    <tbody>
                   
                        <tr>
                                <td><?php echo $created_date?></td>
                                <td><?php echo $updated_date?></td>
                                <td><?php echo $created_date?></td>
                                <td><?php echo $updated_date?></td>
                                <td><?php echo $created_date?></td>
                               
                         </tr>
                           <tr>
                                <td> -->
                        <?php   
                          if (empty($created_date)) {
                            echo "<span class=\"label label-danger\">Verifikasi</span>";                            
                            
                          }else {
                            echo "<span class=\"badge bg-red\">Selesai</span>";
                          }
                        ?>                      
                        </td>
                                     <td>
                        <?php   
                          if (empty($update_date)) {
                            echo "<span class=\"label label-danger\">Verifikasi</span>";                            
                            
                          }else {
                            echo "<span class=\"badge bg-red\">Selesai</span>";
                          }
                        ?>                      
                        </td>
                                     <td>
                        <?php   
                          if (empty($created_date)) {
                            echo "<span class=\"label label-danger\">Verifikasi</span>";                            
                            
                          }else {
                            echo "<span class=\"badge bg-red\">Selesai</span>";
                          }
                        ?>                      
                        </td>
                                     <td>
                        <?php   
                          if (empty($created_date)) {
                            echo "<span class=\"label label-danger\">Verifikasi</span>";                            
                            
                          }else {
                            echo "<span class=\"badge bg-red\">Selesai</span>";
                          }
                        ?>                      
                        </td>
                              </td>
                                     <td>
                        <?php   
                          if (empty($created_date)) {
                            echo "<span class=\"label label-danger\">Verifikasi</span>";                            
                            
                          }else {
                            echo "<span class=\"badge bg-red\">Selesai</span>";
                          }
                        ?>                      
                        </td>

                    </tr>
                           <tr>
                                <td>Permohonan Online</td>
                                <td>Operator</td>
                                <td>Berkas di Kasubag TU</td>
                                <td>Berkas di Kepala balai</td>
                                <td>Berkas di ambil di Persuratan</td>
                               
                         </tr>
                       
                    
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
