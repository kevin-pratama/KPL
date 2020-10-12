<?php

$output = '
<head>  
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.line-title {
    border: 0;
    border-style: inset;
    border-top: 1px solid #000;
}
</head>
<body>
    <img src="" style="position: absolute; width: 60px; height: auto;">
    <table style="width: 100%;">
        <tr>
            <td align="center">
                <span style="line-height: 2.5; font-weight:bold;">
                BALAI KARANTINA IKAN DAN PENGENDALIAN MUTU <br> KOTA SEMARANG
                </span><br>
                <small>Jl. Ki Mangunsarkoro No.23, Karangkidul, Kec. Semarang Tengah, Kota Semarang, Jawa Tengah 50241</small>
                <br>
            </td>
        </tr>
    </table>
    <hr class="line-title">
    <p align="center">
        LAPORAN ALAT UKUR
    </p>
    <div style="font-size: 10px;">
        <table class="table table-bordered">
            <tr>
            <th>Kode Alat Ukur</th>
            <th>Nama Alat Ukur</th>
            <th>Pegawai Peminjam</th>
            <th>Pegawai Pengembali</th>
            <th>Tanggal Peminjaman</th>
            <th>Tanggal Pengembalian</th>
            <th>Nama Admin</th>
            </tr>
            <tbody>
            ';
while ($row = mysqli_fetch_array($result)) {
    $output .= '
    
                    <tr>
                        <td>' . $row["kd_alatukur"] . ' </td>
                        <td>' . $row["nama_alatukur"] . ' </td>
                        <td>' . $row["pegawai_peminjam"] . ' </td>
                        <td>' . $row["pegawai_pengembali"] . ' </td>
                        <td>' . $row["tanggal_peminjaman"] . '</td>
                        <td>' . $row["tanggal_pengembalian"] . ' </td>
                        <td>' . $row["nama_admin"] . ' </td>
                    </tr>
                    ';
}
$output .= '
</tbody>
</table>
</div>
</body>';



$document->loadHtml($output);
$document->setPaper('A4', 'potrait');
$document->render();
$document->stream("alatukur.pdf", array("Attachment" => 0));
