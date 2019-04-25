<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
	$fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
	
	if ($fetchDataUserBySesion['jabatan'] == "C"){
		echo "<script>window.location.href = '/?';</script>";
	}
} else {
    echo "<script>window.location.href = '/?';</script>";	
}
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM invoice WHERE id='$id'");
    $fetchDataDok = mysql_fetch_assoc($dataDok);   
?>
<html>

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <link rel="shortcut icon" href="img/gain.png">
	
	<title>Invoice</title>
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>
</head>

<body onload="print();">

	<div id="page-wrap">

		<textarea id="header">INVOICE RETAILS</textarea>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-8">
						<img src="img/LogoGain.png" alt="logo" width="300" height="75">
					</div>
				</div>
          	</div>

		<div style="clear:both"><br></div>
		
		<div id="customer">

            <textarea id="address">&nbsp;Customer : 
										<?php echo $fetchDataDok['customer_to']; ?>
										<?php echo $fetchDataDok['address_customer']; ?></textarea>
            <table id="meta">
            	<tr>
            		<td colspan="2" class="meta-head"><center><b>Payment Ref</b></center></td>
            	</tr>
                <tr>
                    <td class="meta-head">Invoice Number</td>
                    <td style="font-size: 11px; font-weight: bold;"><?php echo $fetchDataDok['invoice'].$fetchDataDok['invoice_number']; ?></td>
                </tr>
                <tr>
                    <td class="meta-head">Date</td>
                    <td>
                    	<?php 
                    		$formatdate = date_create($fetchDataDok['date_invoice']);
                    		echo date_format($formatdate, "d M Y");
                    	?>
                    </td>
                </tr>
                <tr>
            </table>
		
		</div>
		
		<table id="items">
			<thead style="font-size: 12px;">
				<tr>
			      <th>No</th>
			      <th>DATE</th>
			      <th>SITE</th>
			      <th>DESCRIPTION</th>
			      <th>SR NUMBER</th>
			      <th>Unit Price</th>
			  	</tr>
			</thead>
			
			<tbody style="font-size: 12px;">
				<?php
					include_once 'database/connection.php';
					$invID = $fetchDataDok['invoice'].$fetchDataDok['invoice_number'];
                    $dataDok = mysql_query("SELECT * FROM invoice_detail WHERE invoice = '$invID' ORDER BY id ASC");
                    $no = 1;
                    while ($fetchData = mysql_fetch_array($dataDok)){
                ?>
                <tr>
                	<td align="center"><?php echo $no++; ?></td>
                	<td><?php 
							$formatdate = date_create($fetchDataDok['date_invoice']);
							echo date_format($formatdate, "d M Y");
						?>
                    <td><?php echo $fetchData['site']; ?></td>
                    <td><?php 
                    		$des = $fetchData['description'];
                    		$query = mysql_query("SELECT * FROM job WHERE job = '$des'");
                    		$data = mysql_fetch_assoc($query);

                    		echo $data['description']; 
                    	?>
                    </td>
                    <td>
                    	<?php 
                    		$orderid = $fetchData['sr_number'];
                    		$query = mysql_query("SELECT * FROM sr_number WHERE Order_ID = '$orderid'");
                    		$data = mysql_fetch_assoc($query);

                    		echo $data['sr_number']; 
                    	?>
                    </td>
                    <td align="right"><?php echo number_format($fetchData['dana_kontrak']) ?></td>
				</tr>
                <?php } ?>

                <tfoot style="font-size: 12px;">
                	<?php
					    include_once 'database/connection.php';
					    $id = $_GET['id'];
					    $dataTotal = mysql_query("SELECT sum(dana_kontrak) as dana_kontrak FROM invoice_detail WHERE invoice = '$invID' ORDER BY id ASC");
					    $fetchDataTotal = mysql_fetch_assoc($dataTotal);
					?>
					<tr>
				      <th colspan="4"></th>
				      <th align="left">Total</th>
				      <th align="right">Rp <?php echo number_format($fetchDataTotal['dana_kontrak']) ?> </th>
				  	</tr>
				  	<tr>
				  		<th colspan="4"></th>
				      	<th align="left">Vat (10%)</th>
				      	<th align="right">Rp 
				      		<?php
				      			$dk = $fetchDataTotal['dana_kontrak'];
				      			if (isset($fetchDataDok['vat'])) {
				      				if ($fetchDataDok['vat'] == "0.1"){
							      		$vat = $dk * 0.1;
							      		echo number_format($vat);
				      				}else{
				      					echo "0,-";
				      				}
				      			}
					      		
				      		?>
			      		</th>
				  	</tr>
				  	<tr>
				  		<th colspan="4"></th>
				  		<th align="left">Grand Total</th>
				  		<th align="right">Rp
				  			<?php
				      			if (isset($fetchDataDok['vat'])) {
				      				if ($fetchDataDok['vat'] == "0.1"){
				      					$grandtotal = $dk + $vat;
				  						echo number_format($grandtotal);
				      				} else{
				  						echo number_format($dk);
				      				}
				      			}
				      		?>
				  		</th>
				  	</tr>
				</tfoot>
			</tbody>
		  
		</table>
		<br>
		<textarea id="address">&nbsp;Payment To : 
									<?php echo $fetchDataDok['payment_to']; ?>
									<?php echo $fetchDataDok['address_payment']; ?>
		</textarea>

		<table id="meta">
            <tr>
            	<td colspan="2" class="meta-head"><center><b>Approved By</b></center></td>
           	</tr>
           	<tr>
           		<td><br><br><br><center><b><u><?php echo $fetchDataDok['aproved_by']; ?><br></u></b><i>Direktur</i></center>
           		</td>
           	</tr>
        </table>
	
	</div>
	
</body>

</html>