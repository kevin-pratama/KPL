
<?php

error_reporting(0);

$timezone = "Asia/Jakarta";
if(function_exists(date_default_timezone_set)) date_default_timezone_set($timezone);

$this->db->select('*');
$this->db->from('tb_detail_dokumen');
$this->db->join('tb_pegawai', 'tb_pegawai.NIP = tb_detail_dokumen.NIP','left');
$this->db->where('id_doc', $id_doc);
$this->db->order_by('tb_pegawai.no_duk', "Asc");
$query = $this->db->get()->result_array();
$this->db->select('*');
$this->db->from('tb_dokumen');
$this->db->join('tb_r_trader', 'tb_r_trader.id_trader = tb_dokumen.id_trader','left');
$this->db->where('id_doc', $id_doc);
$trader = $this->db->get()->result_array();

$filename = $id_doc.'.png';
$substr_nosurat = substr($nosurat,4,26);
$substr_awal    = str_repeat('&nbsp;', 8);


ob_start();

echo '  
    <html>
    <head><title></title>
        <style type="text/css">
    p{
        text-align:left;
        font-size:7px;
        font-family:"Times New Roman", Times, serif;
        color:#000066;
    }
    body{
        font-size:14px;
        font-family:"Times New Roman", Times, serif;    
    }
    
    table{
        border-style:none;
        border-width:thin;
        border-spacing:inherit;
    }
        
    </style>
    
    </head>
    <body>
    <table width="100%" cellspacing="0">
    <tr><td align=center style="font-size:14px;">
    </td>
    </tr>
    <tr><td align=center style="font-size:14px;">  
    </td></tr>
    
    <tr><td align=center style="font-size:12px;"></td></tr>
    
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    <tr><td align=center style="font-size:10px;"></td></tr>
    </table>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
 
    
  <table width=100%>
<tr>
    <td align="center"><h2  align=center>SURAT TUGAS</h2></td>
</tr> 
<tr>

    <td align="center"><h3  align=center>Nomor :'.$substr_awal.''.$substr_nosurat.'</h3></td>
</tr> 
</table>

    <br>
    
   
    <br>
 
     <table border=0  width="100%" cellspacing="0" cellpadding="2" 
     style="font-family:Times New Roman;font-size:14px;" text-align="justify">
     <tr><td valign="top">Menimbang </td>
     <td valign="top" >:</td>
     
     <td valign="top" text-align="justify">'.$menimbang.' '.$trader[0]['nm_trader'].'-'.$tujuandl.'</td>
     <td valign="top"></td>


     </tr>

    </table>

      <br>
         <table border=0  width="100%" cellspacing="0" cellpadding="2" 
              style="font-family:Times New Roman;font-size:14px;"  text-align="justify">
     <tr><td valign="top">Dasar</td>
     <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>><td valign="top">:</td>
     
     <td valign="top" text-align="justify" >'.$dasar.' .</td>


     <td valign="top"></td>


     </tr>

    </table>

    
      <br>
       <table width="100%" border="0">
    <tr><td align=center style="font-size:14px;">Memberi Tugas</td></tr> 
    </table>
    <br>
           <table width="100%" border="0">
    <tr><td width="80px" align=left style="font-size:14px;">Kepada     :</td></tr> 
    </table>
    <br>
    




<table border="1" cellpadding="3" cellspacing="3" repeat_header=1 width=100% style="margin-top:10px; margin-left:70px;">
<thead>
<tr>
<th style="text-align:center; font-weight:bold;">No</td>
<th style="text-align:center; font-weight:bold;">Nama/NIP</td>
<th style="text-align:center; font-weight:bold;">Pangkat/Golongan</td>
<th style="text-align:center; font-weight:bold;">Jabatan</td>

</tr>
</thead>';

$no = 1;

foreach ($query as $row) {
                       
    echo '<tr>
    <td align=right>'.$no.'</td>
    <td>'.$row[Namapeg].'/ <br>'.$row[NIP].'</td>
    <td>'.$row[Golongan].'<br> </td>
    <td>'.$row[Jabatan].'<br> </td>
    </tr>';
    $no++;
};



echo '
</table>

    <br>

    
   <table border=0  width="100%" cellspacing="0" cellpadding="2" 
              style="font-family:Times New Roman ;font-size:14px;" >
     <tr><td valign="top" width="60px">Untuk </td><td valign="top">:</td> <td valign="top">1.</td>

     <td valign="top" text-align="justify"> '.$keperluandl.' di '.$trader[0]['nm_trader'].' dengan alamat  '.$trader[0]['al_trader'].' Pada tanggal '.$tanggal_berangkat.' s/d '.$tanggal_pulang.'. </td>
     </tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
            <tr><td> </td><td></td><td valign="top">2.</td>
            <td valign="top" text-align="justify"> Setelah selesai melaksanakan tugas diharapkan membuat laporan kepada atasan langsung dan dilaksana
              kan sebaik-baiknya dengan penuh rasa tanggung jawab. </td></tr>

    

    </table>
    <br>
        <br>
            <br>
   <table width=100%>
  <tr>
    <td width="30%">
    </td>

    <td width="30%">

    </td>
     <td >
        
        <table>
            <tr><td width="250px">Semarang,  '.$tanggalttd.'</td></tr>
            <tr><td width="60px">'.$pj.',</td></tr>
              
          
        </table><br>
        <left>
          <br><br><br><br>

          '.$pjttd.'<br>
         <br>
         </left>
    </td>
  </tr>
</table> 
<br>
<br>

  <table width=100%>
  <tr>

     <td >
        
    
         <table width="60%" cellspacing="0" >
    <tr><td rowspan="6" width="15%" align=center><img src='.$filename.'  width="60px" height="60px" ></img></td>
      
    
    <tr><td align=left style="font-size:9px;font-weight:bold; ">Untuk Perhatian:</td></tr>
     <tr><td align=left style="font-size:9px;font-weight:bold;">Dilarang memberikan sesuatu</td></tr>
     <tr><td align=left style="font-size:9px;font-weight:bold;">yang dapat menimbulkan GRATIFIKASI</td></tr>
    
    </table>
     
    </td>
  </tr>
</table>    
    
   
   
    </body></html>';

$html   = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('utf-8','A4');
$mpdf->setFooter('');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf",'I');
exit;
  
?>

