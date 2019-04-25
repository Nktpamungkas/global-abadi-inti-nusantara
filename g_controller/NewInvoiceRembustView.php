<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM invoice WHERE id='$id'");
    if(mysql_num_rows($dataDok) == 0){
        echo '<script>window.history.back()</script>';
    }else{
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok_rembust = mysql_query("SELECT * FROM invoice_rembust WHERE invoice='$id'");
    $fetchData_rembust = mysql_fetch_assoc($dataDok_rembust);   
?>
<?php
    if(isset($_SESSION['userId'])){
        //sessi ada
        $idStaff = $_SESSION['userId'];
        include_once 'database/connection.php';
        $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
        $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

        if ($fetchDataUserBySesion['jabatan'] == "C"){
            echo "<script>window.location.href = '/?';</script>";
        }

        if(isset($_POST['submit'])){
            include_once 'database/connection.php';

            $invoice = $fetchDataDok['id'];
            $invoice_Rembust = $_POST['invoice_Rembust'];
            $order_Rembust = $_POST['order_Rembust'];

            $dateInvoice_Rembust = $_POST['dateInvoice_Rembust'];
            $cusTo_Rembust = $_POST['cusTo_Rembust'];
            $addressCustomer_Rembust = $_POST['addressCustomer_Rembust'];
            $payment_Rembust = $_POST['payment_Rembust'];
            $bank = $_POST['bank'];
            $AddressPayment_Rembust = $_POST['AddressPayment_Rembust'];
            $approved_Rembust = $_POST['approved_Rembust'];
            $position_Rembust = $_POST['position_Rembust'];
            $nilaivat_Rembust = $_POST['nilaivat_Rembust'];
            // untuk di invoice rembust
            $IdInv = $fetchDataDok['invoice'];
            $NoInv = $fetchDataDok['invoice_number'];
            // untuk di rembust
            $inv = $fetchDataDok['invoice'].$fetchDataDok['invoice_number'];
            
            $ResetNumber = date('Y');
            $looping = "SELECT max(invoice_number) as maxinvoice_number, invoice_rembust FROM invoice_rembust WHERE year(date_invoice)='$dateInvoice_Rembust' AND invoice_rembust='$invoice_Rembust'";
            $hasil_looping = mysql_query($looping);
            $data_looping = mysql_fetch_array($hasil_looping);
            $no = $data_looping['maxinvoice_number'];
            $noUrut= $no + 1;
            $hasilkode = str_pad($noUrut, 3, "0", STR_PAD_LEFT);     

            $value_string = '';
            $id_value = '';
            // $value_dana= '';
            $save = mysql_query("INSERT INTO invoice_rembust(invoice,invoice_rembust,invoice_number,date_invoice,customer_to,address_customer,payment_to,bank,address_payment,aproved_by,position,vat) VALUES('$invoice','$invoice_Rembust','$hasilkode','$dateInvoice_Rembust','$cusTo_Rembust','$addressCustomer_Rembust','$payment_Rembust','$bank','$AddressPayment_Rembust','$approved_Rembust','$position_Rembust','$nilaivat_Rembust')")or die(mysql_error());

            $dana_rembust = $_POST['dana_rembust'];
            $dana_rembust2= str_replace(".", "", $dana_rembust);
            $indexDana = 0;
            $sum = 0;
            // Untuk Save Order - Order Detail
            foreach ($order_Rembust as $value) {
                $id_value = $id_value. $value;
                $value_string = $value_string. "('".$value."','".$invoice_Rembust."','".$dana_rembust2[$indexDana]."'),";
                $sum+= $dana_rembust2[$indexDana];
                $indexDana++;
            }
                $value_string = substr($value_string, 0, strlen($value_string) - 1);
                $id_value = substr($id_value, 0);

                // untuk save invoice detail rembust
                $save_order = mysql_query("INSERT INTO invoice_detail_rembust(idRembust, invoice_rembust, dana_rembust) VALUES ".$value_string) or die(mysql_error());
                
                // untuk merubah status menjadi invoiced(telah dibuatkan invoice) ke tabel rembust
                $update = mysql_query("UPDATE rembust SET status = 'Invoiced' WHERE invoice_rembust ="."('".$inv."')");
                
                // untuk menjumlahkan keseluruhan dana kontrak sesuai yang di ceklis
                $updateDanaRembust = mysql_query("UPDATE invoice_rembust SET grand_total='$sum' WHERE invoice_rembust='$invoice_Rembust'")or die(mysql_error());
                // echo $sum;

                // echo $hasilDanaRembust;

                if($save_order AND $update AND $updateDanaRembust) {
                    echo "<script>window.location.href = '/?g=InvoiceRembust';</script>";
                    $pesanError = "New Invoice Rembust success input.";
                } else {
                    $pesanError = 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
                    echo 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
                }
        }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | New Invoice Rembust</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="img/gain.png">

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
     <script src="dist/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
 
            })
        </script>
    <script type="text/javascript">
        function proses(){
            var perusahaan = document.getElementById("perusahaan").value;        

            $.get("?g=api_alamat&perusahaan="+perusahaan, function(item){
                // alert("Result: " + result + "\nItem: " + item);
                document.getElementById("customer").value = item.alamat;
                // console.log(item);
            });

            $.get("?g=api_ppn&perusahaan="+perusahaan, function(ppn){
                // alert("Result: " + result + "\nItem: " + item);
                document.getElementById("vat").value = ppn.vat;
                // console.log(item);
            });

            $.get("?g=api_nomorInvoice&perusahaan="+perusahaan, function(item, bulan, tahun, hasilkode){
                // alert("Result: " + result + "\nItem: " + item);
                document.getElementById("inv_number").value = "GAIN/" + item.kode + "/" + item.bulan + "." + item.tahun + "/INV-";
                // console.log(item.bulan);
            });
        }
    </script>

</head>

<body>
    <!-- topbar starts -->
    <?php include_once 'TopMenu.php'; ?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <?php include_once 'LeftMenu.php'; ?>
        <!--/span-->
        <!-- left menu ends -->

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="?g=invoiceRembust">Invoice  Rembust</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <form action="" method="post">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <center>
                        <?php
                            if (isset($pesanError)) {
                                echo '<b style=color:red>' . $pesanError . '</b>';
                            }
                        ?>
                        </center>
                        <div class="box-header well">
                             <h2><i class="glyphicon glyphicon-file"></i> New Invoice  Rembust</h2>
                            <div class="box-icon">
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                                <div class="form-group has-success">
                                    <label class="control-label">Invoice Rembust Number</label>
                                    <input type="text" class="form-control input-sm" name="invoice_Rembust" value="<?php echo $fetchDataDok['invoice'].$fetchDataDok['invoice_number']; echo"A"; ?>">
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Date</label>
                                    <input type="date" class="form-control input-sm" name="dateInvoice_Rembust" value="<?php echo $fetchDataDok['date_invoice']; ?>">
                                </div>
                                <div class="form-group has-success col-md-4">
                                    <label class="control-label">Customer To</label>
                                    <input type="text" class="form-control input-sm" name="cusTo_Rembust" value="<?php echo $fetchDataDok['customer_to']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-8">
                                    <label class="control-label">Address Customer</label>
                                    <input type="text" class="form-control input-sm" name="addressCustomer_Rembust" value="<?php echo $fetchDataDok['address_customer']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-4">
                                    <label class="control-label">Payment To</label>
                                    <input type="text" class="form-control input-sm" name="payment_Rembust" value="<?php echo $fetchDataDok['payment_to']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-4">
                                    <label class="control-label">Bank</label>
                                    <input type="text" class="form-control input-sm" name="bank" value="<?php echo $fetchDataDok['bank']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-4">
                                    <label class="control-label">Address Payment</label>
                                    <input type="text" class="form-control input-sm" name="AddressPayment_Rembust" value="<?php echo $fetchDataDok['address_payment']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-4">
                                    <label class="control-label">Approved By</label>
                                    <input type="text" class="form-control input-sm" name="approved_Rembust" value="<?php echo $fetchDataDok['aproved_by']; ?>" >
                                </div>
                                <div class="form-group has-success col-md-8">
                                    <label class="control-label">Position</label>
                                    <input type="text" class="form-control input-sm" name="position_Rembust" value="<?php echo $fetchDataDok['position']; ?>" >
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">VAT 10%</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='nilaivat_Rembust' class='form-control input-sm'  required>";
                                        $show=mysql_query("SELECT * FROM ppn ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih PPN</option>";

                                        while($d=mysql_fetch_array($show))
                                        {
                                            echo "<option value='".$d[deskripsi]."'>$d[PPN]</option>";        
                                        }
                                            echo "</select>";
                                    ?>
                                    <!-- <input type="text" class="form-control input-sm" name="nilaivat_Rembust" value="<?php echo $fetchDataDok['vat']; ?>" > -->
                                </div>
                    <!--             <div class="form-group has-success col-md-2">
                                    <label class="control-label">Date Now</label>
                                    <input type="Date" class="form-control input-sm">
                                </div>
                                <div class="form-group has-success col-md-2">
                                    <label class="control-label">Due Date</label>
                                    <input type="Date" class="form-control input-sm">
                                </div>
                                <div class="form-group has-success col-md-8">
                                    <label class="control-label">Order ID - Rembust</label>
                                    <?php
                                        // include_once 'database/connection.php';
                                          
                                        // echo "<select name='typeram' class='form-control input-sm' required>";
                                        // $tampil=mysql_query("SELECT * FROM rembust");
                                        //     while($w=mysql_fetch_array($tampil)){
                                        //         echo"<option value='".$w[Order_ID]."'>$w[Order_ID]</option>"; 
                                        //      }
                                        //         echo"</select>";
                                     ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label"></label>
                                </div> -->
                        </div>
                    </div>
                </div>

                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-content">
                            <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                    <tr>
                                        <th>Tgl Request</th>
                                        <th>Rembust</th>
                                        <th>Site</th>
                                        <th>Deskripsi</th>
                                        <th>Nominal Dana</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            include_once 'database/connection.php';
                                            
                                            $invoice_rembust = $fetchDataDok['invoice'].$fetchDataDok['invoice_number'];
                                            $Datainvoice_rembust = $fetchData_rembust['invoice_rembust'].$fetchData_rembust['invoice_number'];
                                            
                                            $datarembust = mysql_query("SELECT * FROM rembust WHERE invoice_rembust = '$invoice_rembust' AND NOT RembustID = 'Non Rembust' AND substr(Order_ID,1,1)= 'R' Order By id ASC");

                                            while ($fetchDataRembust = mysql_fetch_array($datarembust)){
                                        ?>
                                            <tr>
                                                <td><?php echo $fetchDataRembust['Tgl_request']; ?></td>
                                                <td><?php echo $fetchDataRembust['RembustID']; ?></td>
                                                <td><?php echo $fetchDataRembust['Site']; ?></td>
                                                <td><?php echo $fetchDataRembust['Deskripsi']; ?></td>
                                                <td>
                                                <?php
                                                    if ($fetchDataRembust['status'] == "Invoiced") {
                                                        echo "<input type='text' class='form-control uang input-sm' value='".$fetchDataRembust['Dana_Rembust']."' disabled>";
                                                    }else{
                                                        echo "<input type='text' name='dana_rembust[]' class='form-control uang input-sm' value='".$fetchDataRembust['Dana_Rembust']."'>";
                                                    }
                                                ?>
                                                </td>
                                                <td>
                                                <?php
                                                    if ($fetchDataRembust['status'] == "Invoiced") {
                                                        echo "<input type='checkbox' checked disabled>";
                                                    }else{
                                                        echo "<input type='checkbox' name='order_Rembust[]' required value='".$fetchDataRembust['id']."'>";
                                                    }
                                                ?> 
                                                </td>
                                            </tr>
                            <?php } ?>                
                                        
                                </tbody>
                            </table>
                            
                            <?php
                                if ($fetchDataRembust['status'] == "Invoiced") {
                                    echo " ";
                                }else{
                                    echo "<button  class='btn btn-default' name='submit' type='submit'>Submit</button>";
                                }
                            ?> 
                            <a href="?g=invoice" class="btn btn-primary">Kembali</a>    
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Ad, you can remove it -->
    <div class="row">
        <div class="col-md-9 col-lg-9 col-xs-9 hidden-xs">
            <!-- Charisma Demo 2 -->
            <ins class="adsbygoogle"
                 style="display:inline-block;width:728px;height:90px"
                 data-ad-client="ca-pub-5108790028230107"
                 data-ad-slot="3193373905"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    <!-- Ad ends -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3>Settings</h3>
                    </div>
                    <div class="modal-body">
                        <p>
                            <label class="control-label" for="inputError1">Stop Progress</label>
                            <input type="date" class="form-control" id="inputError1" name="startprogres" required>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <a href="#" class="btn btn-primary" data-dismiss="modal" name="submit">Save changes</a>
                    </div>

            </div>
        </div>
    </div>
    <!-- End Modal -->

    <?php include_once 'footer.php'; ?>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="js/jquery.cookie.js"></script>
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<script src='js/jquery.dataTables.min.js'></script>
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<script src="js/jquery.noty.js"></script>
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<script src="js/jquery.raty.min.js"></script>
<script src="js/jquery.iphone.toggle.js"></script>
<script src="js/jquery.autogrow-textarea.js"></script>
<script src="js/jquery.uploadify-3.1.min.js"></script>
<script src="js/jquery.history.js"></script>
<script src="js/charisma.js"></script>
</body>
</html>