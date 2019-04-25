<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM hasil_kerja_po WHERE id='$id'");
    if(mysql_num_rows($dataDok) == 0){
        echo '<script>window.history.back()</script>';
    }else{
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>ALL Rembust</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 2.5px;
        text-align: left;
    }
    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }
    table#t01 tr:nth-child(odd) {
       background-color: #fff;
    }
    table#t01 th {
        background-color: black;
        color: white;
    }
</style>
<body>
	<table>
        <tr>
            <td><b>Lokasi</b></td>
            <td><?php echo $fetchDataDok['lokasi'] ?></td>
        </tr>
        <tr>
            <td><b>Teknisi/No HP</b></td>
            <td><?php echo $fetchDataDok['teknisi'] ?> / <?php echo $fetchDataDok['no_hp'] ?></td>
        </tr>
        <tr>
            <td><b>Jenis Pekerjaan</b></td>
            <td><?php echo $fetchDataDok['jenis_pekerjaan'] ?> </td>
        </tr>
        <tr>
            <td><b>SN Modem</b></td>
            <td><?php echo $fetchDataDok['sn_modem'] ?> </td>
        </tr>
        <tr>
            <td><b>Adaptor</b></td>
            <td><?php echo $fetchDataDok['adaptor'] ?> </td>
        </tr>
        <tr>
            <td><b>SN RFT</b></td>
            <td>Lama : <?php echo $fetchDataDok['sn_rft_lama'] ?><br>
                Baru : <?php echo $fetchDataDok['sn_rft_baru'] ?> </td>
        </tr>
        <tr>
            <td><b>SN LNB</b></td>
            <td><?php echo $fetchDataDok['sn_lnb'] ?> </td>
        </tr>
        <tr>
            <td><b>Hasil Xpoll</b></td>
            <td>C/N : <?php echo $fetchDataDok['hasil_xpoll_cn'] ?>,  CPI : <?php echo $fetchDataDok['hasil_xpoll_cpi'] ?>
                <br>
                C/N : <?php echo $fetchDataDok['hasil_xpoll_asi'] ?>,  CPI : <?php echo $fetchDataDok['hasil_xpoll_satelit'] ?>
            </td>
        </tr>
        <tr>
            <td><b>Pengukuran Listrik</b></td>
            <td><?php echo $fetchDataDok['pengukuran_listrik'] ?></td>
        </tr>
        <tr>
            <td><b>Mounting Antena</b></td>
            <td><?php echo $fetchDataDok['mounting_antena'] ?></td>
        </tr>
        <tr>
            <td><b>PIC NOC</b></td>
            <td><?php echo $fetchDataDok['pic_noc'] ?></td>
        </tr>
        <tr>
            <td><b>PIC Telkom</b></td>
            <td><?php echo $fetchDataDok['pic_telkom'] ?></td>
        </tr>
        <tr>
            <td><b>Tgl Pekerjaan</b></td>
            <td><?php echo $fetchDataDok['tgl_pekerjaan'] ?></td>
        </tr>
        <tr>
            <td><b>Keterangan Pekerjaan</b></td>
            <td><?php echo $fetchDataDok['keterangan_pekerjaan'] ?></td>
        </tr>
        <tr>
            <td><b>Status Pekerjaan</b></td>
            <td><?php echo $fetchDataDok['status_pekerjaan'] ?></td>
        </tr>
    </table>
    Demikian yang dapat kami sampaikan atas perhatiannya kami ucapkan terimakasih

</body>
</html>