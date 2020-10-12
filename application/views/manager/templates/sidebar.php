 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <center>
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/images/users/logobkipm.jpg')?>" width="50%" class="img-circle" alt="User Image">
        </div>
        </center>
        <center>
        <div class="pull-left" style="color:white; text-align:center;margin-left:35%;">
          <p>BKIPM-KKP</p>
        </div>
        </center>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?php echo base_url('manager'); ?>">
            <i class="fa fa-home"></i> <span>Beranda</span>
            <span class = 'pull-right-container'></span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i>
            <span>Surat Tugas</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url('DokumenManager'); ?>"><i class="fa fa-circle-o"></i> PPC </a></li>
            <li class="active"><a href="<?php echo base_url('Dokumen_svrManager'); ?>"><i class="fa fa-circle-o"></i> Surveilence </a></li>
          </ul>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li class="active"><a href="<?php echo base_url('LaporanPPCManager'); ?>"><i class="fa fa-circle-o"></i> Laporan PPC </a></li>
            <li class="active"><a href="<?php echo base_url('LaporanManager'); ?>"><i class="fa fa-circle-o"></i> Laporan Surveillance</a></li>
            <li class="active"><a href="<?php echo base_url('SppdManager'); ?>"><i class="fa fa-circle-o"></i> SPPD </a></li>
          </ul>
          <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Administrasi</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url('PegawaiManager'); ?>"><i class="fa fa-circle-o"></i> Data Pegawai </a></li>
            <li class="active"><a href="<?php echo base_url('CutiManager'); ?>"><i class="fa fa-circle-o"></i> Cuti </a></li>
            <li class="active"><a href="<?php echo base_url('TraderManager'); ?>"><i class="fa fa-circle-o"></i> Trader </a></li>
          </ul>
    </section>
    <!-- /.sidebar -->
  </aside>