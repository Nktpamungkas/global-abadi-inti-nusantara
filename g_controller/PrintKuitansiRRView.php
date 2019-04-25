<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
	$fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
	
	if ($fetchDataUserBySesion['jabatan'] == "C" || $fetchDataUserBySesion['jabatan'] == "MO"){
		echo "<script>window.location.href = '/?';</script>";
	}
} else {
    echo "<script>window.location.href = '/?';</script>";	
}
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT a.id, b.invoice_rembust,
                                    a.no_kuitansi,
                                    b.customer_to,
                                    format((b.grand_total * b.vat) + b.grand_total, 0) AS grand_total,
                                    (b.grand_total * b.vat) + b.grand_total AS angka_terbilang,
                                    a.pembayaran,
                                    b.payment_to,
                                    c.bank,
                                    c.address,
                                    c.norek,
                                    b.aproved_by,
                                    b.position
                                FROM
                                    kuitansi_invoice_rembust a
                                    LEFT JOIN ( SELECT * FROM invoice_rembust b ) b ON b.id = a.id_invoice_rembust
                                        LEFT JOIN ( SELECT * FROM bank c ) c ON c.bank = b.bank
                                WHERE
                                    a.id ='$id'");
    $cekAda = mysql_num_rows($dataDok);
    if($cekAda){
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }else{
        echo '<script>window.history.back()</script>';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Print Kwitansi PO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/gain.png">
    <script src="main.js"></script>
    <style>
        body {
        background: white; 
        }
        page[size="A4"] {
        background: white;
        width: 29.7cm;
        height: 21cm;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
    
        @media print {
        body, page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
        }
        table, th, td {
                border-collapse: collapse;
                /* border: 1px solid black; */
            }
            th, td {
                padding: 0.1px;
                font-size: 14px;
            }
            table#t01 tr:nth-child(even) {
                background-color: white;
            }
            table#t01 tr:nth-child(odd) {
            background-color: white;
            }
            table#t01 th {
                background-color: black;
                color: white;
            }
    </style>
    <script type="text/javascript">
        
    </script>
</head>

<body onload="print();">
<div style="width: 800px; padding: 20px;">
<img src="img/LogoGain.png" alt="logo" width="300" height="75">
	<div style="width: 100%;">
		<table style="width: 100%;">
			<tr>
				<td><h2><center>KWITANSI</center></h2></td>
			</tr>
		</table>
	</div>
	<div style="clear: both"></div>
	
	<div style="float: left; width: 60%;">&nbsp;</div>
	<div style="float: right; width: 39%;">
		<table>
			<tr>
				<td colspan="3"><u><b>Kwitansi Tagiahan</b></u></td>
			</tr>
			<tr>
				<td style="width: 110px;"><b>No Kwitansi</td>
				<td style="width: 10px;"><b>:</td>
				<td><b><?= $fetchDataDok['no_kuitansi']; ?></b></td>
			</tr>
			<tr>
				<td><b>Tanggal</td>
				<td style="width: 10px;"><b>:</td>
				<td><b><?= date("d-M-Y");?></b></td>
			</tr>
			<tr>
				<td style="vertical-align: top;"><b>No Invoice</td>
				<td style="width: 10px; vertical-align: top;"><b>:</td>
				<td><b><?= $fetchDataDok['invoice_rembust']; ?></b></td>
			</tr>
		</table>
	</div>
	<div style="clear: both"></div>
	
	<br />
	<div style="border: 2px solid;">
		<table>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 140px; "><u>Sudah Terima Dari</u></td>
				<td style="width: 30px;">:</td>
				<td><b><?= $fetchDataDok['customer_to']; ?></b></td>
			</tr>
			<tr>
				<td><i>Received From</i></td>
				<td>&nbsp;</td>
				<td><?= $fetchDataDok['address']; ?></td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 140px; "><u>Banyaknya Uang</u></td>
				<td style="width: 30px;">:</td>
                <td><b><i><?php 
                            function penyebut($nilai) {
                                $nilai = abs($nilai);
                                $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                                $temp = "";
                                if ($nilai < 12) {
                                    $temp = " ". $huruf[$nilai];
                                } else if ($nilai <20) {
                                    $temp = penyebut($nilai - 10). " belas";
                                } else if ($nilai < 100) {
                                    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                                } else if ($nilai < 200) {
                                    $temp = " seratus" . penyebut($nilai - 100);
                                } else if ($nilai < 1000) {
                                    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                                } else if ($nilai < 2000) {
                                    $temp = " seribu" . penyebut($nilai - 1000);
                                } else if ($nilai < 1000000) {
                                    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                                } else if ($nilai < 1000000000) {
                                    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                                } else if ($nilai < 1000000000000) {
                                    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                                } else if ($nilai < 1000000000000000) {
                                    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                                }     
                                return $temp;
                            }
                        
                            function terbilang($nilai) {
                                if($nilai<0) {
                                    $hasil = "minus ". trim(penyebut($nilai));
                                } else {
                                    $hasil = trim(penyebut($nilai));
                                }     		
                                return $hasil;
                            }
                            $angka = $fetchDataDok['angka_terbilang']; 
                            echo terbilang($angka); 
                        ?> Rupiah</b></i></td>
			</tr>
			<tr>
				<td><i>Amount Received</i></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
			<tr>
				<td style="width: 140px; "><u>Untuk Pembayaran</u></td>
				<td style="width: 30px;">:</td>
				<td><b><i><?= $fetchDataDok['pembayaran']; ?></b></i></td>
			</tr>
			<tr>
				<td><i>In Payment Of</i></td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
		</table>
	</div>
	
	<br />
	<div style="border: 1px solid; width: 150px;">
		<table border=0>
			<tr>
				<td><b>Rp </td>
				<td style="width: 81%; text-align: right;"><b><?= $fetchDataDok['grand_total']; ?>,-</b></td>
			</tr>
		</table>
	</div>
	
	<br />
	<div style="float: left; width: 73%">
		Catatan:
		<table>
			<tr>
				<td style="vertical-align: top;">1. </u><td>
				<td>Mohon Pembayaran ditransfer ke rekening bank berikut ini ( Transfer Payment to : ) :<td>
			</tr>
			<tr>
				<td>&nbsp;<td>
				<td>
					<table>
						<tr>
							<td><u>Atas Nama</u><td>
							<td><b>: <?= $fetchDataDok['payment_to']; ?><td>
						</tr>
						<tr>
							<td><i>Name of Account</i><td>
							<td>&nbsp;<td>
						</tr>
						<tr>
							<td><u>No Rekening</u><td>
							<td><b>: <?= $fetchDataDok['norek']; ?><td>
						</tr>
						<tr>
							<td><i>Bank of Account</i><td>
							<td>&nbsp;<td>
						</tr>
						<tr>
							<td><u>Pada Bank</u><td>
							<td><b>: <?= $fetchDataDok['address']; ?><td>
						</tr>
						<tr>
							<td><i>Bank Of Address</i><td>
							<td>&nbsp;<td>
						</tr>
					</table>
				<td>
			</tr>
			<tr>
				<td style="vertical-align: top;">2. </u><td>
				<td>Pembayaran baru dianggap sah setelah cek/ giro / cash dicairkan dan diterima dengan baik direkening kami<td>
			</tr>
		</table>
	</div>
	<div style="float: right; width: 23%">
		<table>
			<tr>
				<td><b><center>Tangerang, <?= date("d F Y");?></center></b><td>
			</tr>
			<tr>
				<td>
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
					<br />
				<td>
			</tr>			
			<tr>
				<td><b><center><?= $fetchDataDok['aproved_by']; ?></center></b><td>
			</tr>		
			<tr>
				<td><i><center><?= $fetchDataDok['position']; ?></center></i><td>
			</tr>
		</table>
	</div>
</div>
</body>
</html>