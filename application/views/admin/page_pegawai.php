<!-- START PAGE CONTAINER -->
        <div class="content-wrapper">
            
            <!-- PAGE CONTENT -->
            <div class="page-content">                    
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url();?>admin">Dashboard</a></li>
                    <li><a href="#">Administrasi</a></li>
                    <li class="active">Data Pegawai</li>
                </ul>
                <!-- END BREADCRUMB -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">
					<div class="col-md-12">
				
					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title" >Data Pegawai</h3>
                        <div class="pull-right">
							<button class="btn btn-danger toggle" data-toggle="exportTable"><i class="glyphicon glyphicon-plus"></i> Tambah Data</button>
						</div>
                    </div>
					<div class="panel-body" id="exportTable" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">

						<form method="post" class="form-horizontal" action="<?php echo base_url(); ?>Pegawai/submit" enctype="multipart/form-data">
                            <div class="panel panel-default">                                
                                <div class="panel-body"> 
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">No. Duk </label>
                                        <div class="col-md-6 col-xs-12">                              
                                            <input type="text" class="form-control" name="noduk">
                                            <span class="help-block">No. Duk</span>
                                        </div>
                                    </div>           
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">NIP</label>
                                        <div class="col-md-6 col-xs-12">                          
                                            <input type="text" class="form-control" name="nip">		
                                            <span class="help-block">NIP</span>
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Nama </label>
                                        <div class="col-md-6 col-xs-12">                              
                                            <input type="text" class="form-control" name="namapeg">
                                            <span class="help-block">Nama Pegawai</span>
                                        </div>
                                    </div>
									
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Jabatan</label>
                                        <div class="col-md-6 col-xs-12">           
                                            <select class="form-control select2" style="width: 100%;" name="jabatan">
                                              <option>Kepala Balai</option>
                                              <option>Kasubag TU</option>
                                              <option>Kasie P2I</option>
                                              <option>Kasie Tata Pelayanan</option>
                                              <option>PHPI Ahli Pertama</option>
                                              <option>PHPI Ahli Muda</option>
                                              <option>PHPI Ahli Madya</option>
                                              <option>Pranata Komputer Ahli Pertama</option>
                                              <option>Pranata Komputer Ahli Muda</option>
                                              <option>Arsiparis Ahli Muda</option>
                                              <option>Inspektur Mutu</option>
                                              <option>Pengawas Mutu</option>
                                                <option selected="jabatan">PHPI Ahli Pertama</option>
                                               <option selected="jabatan">PHPI Ahli Muda</option>
                                               <option selected="jabatan">PHPI Ahli Madya</option>
                                               <option selected="jabatan">Analisis SDM Aparatur</option>
                                              
                                              <option selected="jabatan">-</option>
                                            
                                              <option>Staff</option>
                                            
                                            </select>
                                                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Golongan</label>
                                        <div class="col-md-6 col-xs-12">                              
                                            <select class="form-control select2" style="width: 100%;" name="golongan">
                                                 <option selected="golongan">Pembina Tingkat I/IVb</option>
                                              <option selected="golongan">Pembina/IVa</option>
                                              <option>Penata Tingkat I/IIId</option>
                                              <option>Penata /IIIc</option>
                                              <option>Penata Muda Tingkat I/IIIb</option>
                                              <option>Penata Muda /IIIa</option>
                                             <option>Pengatur Muda /IIa</option>
                                             <option>Pengatur Muda Tingkat I /IIb</option>
                                             <option>Pengatur /IIc</option>
                                             <option>Pengatur Tingkat I/IId</option>
                                             
                                            </select>
                                            <span class="help-block">Jabatan Pegawai</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Email </label>
                                        <div class="col-md-6 col-xs-12" >
                                                                
                                            <input type="email" class="form-control" name="email">
                                            <span class="help-block">Email</span>
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
				<div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
					
                <table class="table datatable">
                    <thead>
						<tr>
							<th width="5%">No DUK</th>
                            <th width="30%">NIP</th>
                            <th>Nama</th>                            
							<th>Action</th>                            
                        </tr>
                    </thead>
					<tbody>

                      	<?php  		

                      	foreach ($data as $row) {
                      
                        ?>
                    	<tr>					
                    	    	<td><?php echo $row->no_duk; ?></td>

							<td><?php echo $row->NIP; ?></td>

							<td align="center"><?php echo $row->Namapeg; ?></td>
						<td align="center">
							<div class="btn-group" role="group">                            
								<a href="<?php echo base_url(); ?>Pegawai/edit_pegawai/<?php echo $row->NIP;?>" class="btn btn-info btn-primary btn-xs">
								<i class="fa fa-edit"></i></a>
							
								<a href="<?php echo base_url(); ?>Pegawai/delete_pegawai/<?php echo $row->NIP;?>" onclick="javascript: return confirm('Are you sure delete ? ')" class="btn btn-sm btn-danger btn-xs"><i class="fa fa-trash-o">
								</i></a>
							
							</div>
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
         
