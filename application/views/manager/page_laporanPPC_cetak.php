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
   
    
  <div class="col-md-12" style="text-align: center; font-size: 18px; margin-bottom: 50px"><b>LAPORAN PERJALANAN DINAS</b>
    </div>

';


    foreach ($query as $row) {
        echo'
<div class="col-md-12" style="font-size: 14px; margin-left: 50px">
<table border=0>
<tr >
<td height=30px width=20px>1. </td>
<td width=180px>Nama</td>
<td width=10px>: </td>
<td>'.$row[Namapeg].'</td>
</tr>

<tr >
<td height=30px>2. </td>
<td >NIP</td>
<td>: </td>
<td>'.$row[NIP].'</td>
</tr>

<tr >
<td height=30px>3. </td>
<td>Pangkat/Golongan</td>
<td>: </td>
<td>'.$row[Golongan].'</td>
</tr>

<tr>
<td height=30px>4. </td>
<td>Jabatan</td>
<td>: </td>
<td>'.$row[Jabatan].'</td>
</tr>

<tr>
<td height=30px>5. </td>
<td>Tanggal</td>
<td>: </td>
<td>'.$tanggal_berangkat.' s/d '.$tanggal_pulang.'</td>
</tr>

<tr>
<td height=30px>6. </td>
<td >Dasar Rangka</td>
<td>: </td>
<td>'.$dasar.'</td>
</tr>

<tr>
<td height=30px>7. </td>
<td>Tempat</td>
<td>: </td>
<td>'.$id_trader.'</td>
</tr>

<tr>
<td height=30px>8. </td>
<td>Dasar Kegiatan</td>
<td>: </td>
<td>'.$keperluandl.'</td>
</tr>

<tr>
<td height=30px>9. </td>
<td>Hasil Perjalanan Dinas</td>
<td>: </td>
<td>'.$hsldinas.'</td>
</tr>

</table>
</div>
';
};


echo '

<div class="col-md-12" style="font-size: 14px; margin-top: 80px; ">
   <center><table width=100%>
  <tr>
    <td width="60%">
    </td>
     <td >Semarang,  '.$tanggalttd.'</td>
     </tr>
     <tr>
     <td height=80px></td>
     <td style="vertical-align: top">'.$pj.',</td>
     </tr>
     <tr>
     <td></td>
     <td>'.$pjttd.'</td>
      </tr>
</table></center>
</div>



<div class="col-md-12" style="font-size: 14px; margin-top: 80px; ">
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
<div>  
    
   
   
    </body></html>';

$html   = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('utf-8','A4');
$mpdf->setFooter('');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf",'I');
exit;
  
?>

