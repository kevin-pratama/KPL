<!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            
            <!-- PAGE CONTENT -->
            <div class="page-content">  
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Dokumen</a></li>
                    <li class="active">Edit Dokumen</li>
                </ul>
                <!-- END BREADCRUMB -->
                                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
				<div class="row">
					<div class="col-md-12">
				
					<div class="panel panel-default">
					<div class="panel-heading">
                        <h3 class="panel-title">Edit Dokumen</h3>                        
                    </div>
					<div class="panel-body" >
                    
						<form method="post" class="form-horizontal" action="<?php echo base_url(); ?>dokumen_svr/update" enctype="multipart/form-data">
                            <div class="panel panel-default">                                
                          
                                <div class="panel-body">                                                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">ID DOC</label>
                                           <div class="col-md-3 col-xs-3">
                                             <input type="text" class="form-control" name="id_doc" readonly value="<?php echo $id_doc;?>"/>    
                                            </div> 
                                    </div>        
                                      <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Request by</label>
                                           <div class="col-md-3 col-xs-3">
                                             <input type="text" class="form-control" name="Request" readonly value="<?php echo $request;?>"/>    
                                            </div> 
                                    </div> 
                                    <div class="form-group">
                                         <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">No Surat</label>
                                        <div class="col-md-3 col-xs-3">
                                      <input type="text" class="form-control" name='nosurat' value= "<?php echo $nosurat;?>" /> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Menimbang</label>
                                        <div class="col-md-6 col-xs-12">     
                                  <textarea class="form-control" name="menimbang" rows="3" placeholder="Enter ..."><?php echo htmlspecialchars($menimbang); ?></textarea>     
                                        
                                                                                   
                                        </div>
                                    </div>   
                                        <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Dasar</label>
                                        <div class="col-md-6 col-xs-12">         <textarea class="form-control" name="dasar" rows="3" placeholder="Enter ..."><?php echo htmlspecialchars($dasar); ?></textarea>    
                                        
                                                                                   
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Jenis Kegiatan</label>
                                        <div class="col-md-6 col-xs-12">    <select class="form-control select" name="kelas" id="kelas">
                                                <option>Jenis Kegiatan</option>
                                                <?php foreach ($kelas as $row) { ?>                                         
                                                <option value="<?php echo $row->id;?>" 
                                                <?php if ($class_id==$row->id) echo "selected" ?> >
                                                
                                                <?php echo $row->name;?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="help-block">Jenis Kegiatan</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Trader</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" name='trader[]' id="trader">
                                            <option>Unit Pengolahan Ikan</option>
                                               <?php foreach ($tr_trader as $row) { ?>
                                               <option value="<?php echo $row->id_trader;?>"
                                               <?php if ($id_trader==$row->id_trader) echo "selected" ?> >
                                               
                                               <?php echo $row->nm_trader;?>/<?php echo $row->al_trader;?></option>
                                              
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
                                             Sampai Dengan
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
                                    </div>
                            
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Pegawai</label>
                                        <div class="col-md-3 col-xs-3">
                                          <select class="form-control select2" multiple="multiple" name='pegawai[]' data-placeholder="Tolong Input Ulang Pegawai DL"
                                            style="width: 100%;" >
                                               <?php foreach ($pegawai as $row) { ?>
                                                <option value="<?php echo $row->NIP;?>"><?php echo $row->Namapeg;?></option>
                                                <?php } ?>
                                            </select>

                                             <div class="col-md-12 col-xs-12">
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
                                    </div>
                                                          
                                                                   
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tujuan</label>
                                        <div class="col-md-6 col-xs-12">
                                         <input type="text" class="form-control" name='tujuandl' value="<?php echo $tujuandl;?>">                 
                                         <span class="help-block">Tempat Pejalanan Dinas</span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">File</label>
                                                <div class="col-md-6 col-xs-12">
                                                    <img src="<?php echo base_url(); ?>assets/images<?php echo $detail->attachments; ?>
                                                    " style="widht:40%" >
                                                    <input type="file" name="attachments" id="attachments" class="fileinput btn-primary" title="Browse file" data-filename-placement="inside" multiple="true" />
                                                    <span class="help-block">Input type file</span>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Keperluan</label>
                                        <div class="col-md-6 col-xs-12">                                     
                                        
                                            <textarea class="form-control" name="keperluandl" id="myDokumen" rows="5">   
                                            <?php echo $keperluandl;?>
                                             </textarea>                                       
                                        </div>
                                    </div>     
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Tanggal Surat</label>
                                        <div class="col-md-2 col-xs-6">                                     
                                        
                                         <input type="date" class="form-control pull-right" name='tanggalttd'   value="<?php echo $tanggalttd;?>" >
                                 
                                        </div>
                                    </div>   
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Pejabat</label>
                                        <div class="col-md-3 col-xs-3">  <select class="form-control select" name='pj' style="width: 100%;">
                                              <option selected="selected">Kepala</option>
                                              <option>Plh. Kepala</option>
                                             <option>An. Kasubag TU</option>
                                             <option>An. Kasie Tata Pelayanan</option>
                                             <option>An. Kasie P2I</option>
                                             
                                             
                                             </select>
                                     
                                                                       
                                        </div>
                                    </div> 
                             
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-3 control-label">Pejabat TTD</label>
                                        <div class="col-md-3 col-xs-3">  <select class="form-control select2" name='pjttd' style="width: 100%;">
                                              <option selected="selected">Raden Gatot Perdana</option>
                                              <option>Ely Musyarofah</option>
                                              <option>Oky Fajar Sasongko</option>
                                              <option>Joko Purwono</option>
                                             
                                             </select>
                                     
                                                                       
                                        </div>
                                    </div> 

                                </div>
                                        

                                </div>
                                <div class="panel-footer">
                                    <button type="reset" class="btn btn-default" onclick="location.href='<?php echo base_url();?>dokumen_svr';">
									<i class="glyphicon glyphicon-remove"></i>
									Clear Form</button>
                                    <button class="btn btn-primary pull-right" >
									<i class="fa fa-save"></i>Update Data</button>
                                </div>
                            </div>
                            </form>
                            
                        
                   
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