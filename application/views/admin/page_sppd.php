
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
     table, th, td {
            border: 1px solid black;
            width: 400px;
            height: 165px;
         }
        
    </style>
    
    </head>
    <body>
 
     <table border=1  width="100%" cellspacing="1" cellpadding="1" 
     style="font-family:Times New Roman;font-size:14px;" text-align="justify"     >
 
  <col width="100">

    <tr>
    <td valign="top" height="100"></td>
    <td valign="top" height="100">I. Berangkat dari : Semarang
    <br> (Tempat Kedudukan)
    <br> Ke
    <br> Pada Tanggal
    <br> Kepala Balai KIPM Semarang
    <br>
    <br>
    <br>
    <br><u> Raden Gatot Perdana, A.Pi, M.M.Pi </u>
    <br> NIP. 197305311998031002

 

    </td>
  </tr>
  <tr>
    <td valign="top">II. Tiba di    : '.$trader[0]['nm_trader'].'
    <br> Pada Tanggal : '.$tanggal_berangkat.'
    <br> Kepala
      
    </td>
    <td valign="top" height="100" >
    I. Tiba di    :  '.$trader[0]['nm_trader'].'
    <br> Pada Tanggal : '.$tanggal_pulang.'
    <br> Kepala    
   
    </td>
  </tr>

  <tr>
    <td valign="top" height="100">Berangkat dari   :
    <br> Ke :
    <br> pada tanggal :
    <br> Kepala       :
    </td>
    <td valign="top" height="100" >
    I. Tiba di    :
    <br> Pada Tanggal :
    <br> Kepala    
    </td>
  </tr>
    <tr>
    <td valign="top" height="100">I. Tiba di    :
    <br> Pada Tanggal :
    <br> Kepala
    </td>
    <td valign="top" height="100" >
    I. Tiba di    :
    <br> Pada Tanggal :
    <br> Kepala    
    </td>
  </tr>
      <tr>
    <td valign="top" height="100">I. Tiba di    :
    <br> Pada Tanggal :
    <br> Pejabat Pembuat Komitmen
    </td>
    <td valign="top" height="100" >
    Telah diperiksa dengan keterangan bahwa perjalanam  :
    <br> tersebut atas perintahnnya dan semata-mata untuk :
    <br> kepentingan jabatan dalam waktu yang sesingkat-    
    <br> singkatnya.
    <br>
    </td>
  </tr> 
   <tr rowspan ="2">
    <td valign="top" height="10%">Catatan Lain-lain
   
    </td>
    <td valign="top" height="10%">
    
    </td>
  </tr> 
    <tr>
    <td valign="top" colspan="2">
           
    VI. PERHATIAN
    <br>
    PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/ 
    tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan -
    <br>
    peraturan Keuangan Negara apabila Negara menderita rugi akibat  kesalahan, kelalaian dan kealpaaanya.
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

