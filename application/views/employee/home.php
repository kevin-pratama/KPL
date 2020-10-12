<!-- START PAGE CONTAINER -->
<div class="content-wrapper">
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
           
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendar
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home </a></li>
        <li class="active">Calendar</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h4 class="box-title">Daftar
              </h4>

            </div>
            
            <!-- /.box-body -->
          </div>

          <!-- /. box -->

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Pegawai Dinas Luar</h3>
            </div>
           <div class="box-body">
             
              <table id='example2' class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10%" >Nama</th>
                  <th width="5%" >Awal DL</th>
                  <th width="5%" >Akhir DL</th>
                </tr>
                </thead>
                <tbody>
           
                  <?php             
                        //$no = 1;
            //$no = $this->uri->segment('3')+1;
                  foreach ($pegawaidl as $row) {
           
                        ?>
                      <tr>            
                      <td><?php echo $row->Namapeg?></td>
                      <td align="center"><?php echo $row->tanggal_berangkat?></td>
                      <td align="center"><?php echo $row->tanggal_pulang?></td>
                           
           
                <?php
              }
            ?>
                 
                </tr>
                
                </tbody>
            
              </table>
              <!-- /input-group -->
            </div>

          </div>
        </div>

        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-body no-padding">
           
  <div id='calendar'></div>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  




