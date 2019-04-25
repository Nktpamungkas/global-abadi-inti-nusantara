<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM invoice_po WHERE id='$id'");
    $fetchDataDok = mysql_fetch_assoc($dataDok);   
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

            $invoice = $_POST['invoice'];
            $order = $_POST['order'];
            $id = $_GET['id'];
            $dateInvoice = $_POST['dateInvoice'];
            $cusTo = $_POST['cusTo'];
            $addressCustomer = $_POST['addressCustomer'];
            $payment = $_POST['payment'];
            $nameBank = $_POST['nameBank'];
            $AddressPayment = $_POST['AddressPayment'];
            $approved = $_POST['approved'];
            $position = $_POST['position'];
            $nilaivat = $_POST['nilaivat'];
            $nomorpo = $_POST['nomorpo'];
            
            $ResetNumber = date('Y');
            $looping = "SELECT max(invoice_number) as maxinvoice_number, invoice FROM invoice_po WHERE year(date_invoice)='$dateInvoice' AND invoice='$invoice'";
            $hasil_looping = mysql_query($looping);
            $data_looping = mysql_fetch_array($hasil_looping);
            $no = $data_looping['maxinvoice_number'];
            $noUrut= $no + 1;
            $hasilkode = str_pad($noUrut, 3, "0", STR_PAD_LEFT);     

            $value_string = '';
            $value_data = '';
            $id_value = '';
            $valueorder = '';
            $update = mysql_query("UPDATE invoice_po SET date_invoice = '$dateInvoice',
                                                        customer_to = '$cusTo',
                                                        address_customer = '$addressCustomer',
                                                        payment_to = '$payment',
                                                        bank = '$nameBank',
                                                        address_payment = '$AddressPayment',
                                                        aproved_by = '$approved',
                                                        position = '$position',
                                                        vat = '$nilaivat',
                                                        nomor_inv_po = '$nomorpo'
                                                    WHERE id = '$id'");
            if ($order != null) { // jika ada yang di ceklis
                // Untuk Save Order - Order Detail
                foreach ($order as $value) {
                    $query_dana = "SELECT * FROM tbl_order_po WHERE id = '$value'";
                    $hasil_query = mysql_query($query_dana);
                    $data_query = mysql_fetch_array($hasil_query);
                    $data = $data_query['dana_kontrak'];
                    $dateInv = $data_query['start_progress'];
                    $site = $data_query['site'];
                    $des = $data_query['job'];
                    $sr = $data_query['id'];

                    $value_data = $data;
                    $value_dateInv = $dateInv;
                    $value_site = $site;
                    $value_des = $des;
                    $value_sr = $sr;

                    $value_string = $value_string. "('".$value."','".$invoice."','".$value_data."','".$value_dateInv."','".$value_site."','".$value_des."','".$value_sr."'),";
                    $valueorder = $valueorder. "'".$value."',";
                    // echo $value;
                }

                $value_data = substr($value_data, 0);
                $value_string = substr($value_string, 0, strlen($value_string) - 1);
                $id_value = substr($id_value, 0);
                $valueorder = substr($valueorder, 0, strlen($valueorder) - 1);
                // echo $value_string;

                // untuk save invoice detail 
                $save_order = mysql_query("INSERT INTO invoice_detail_po(orders, invoice, dana_kontrak,date_invoice,site,description,sr_number) VALUES ".$value_string) or die(mysql_error());
                // untuk memasukkan nomor invoice ke tabel rembust

                $updateRembust = mysql_query("UPDATE rembust SET invoice_rembust='$invoice' WHERE id_order IN"."(".$valueorder.") AND substr(Order_ID,1,2) = 'PO'")or die(mysql_error());
                // untuk mengubah status pada tbl_order karena telah di invoice'kan

                $updateOrder = mysql_query("UPDATE tbl_order_po SET status_invoice='$invoice' WHERE id IN"."(".$valueorder.")")or die(mysql_error());
                // untuk menjumlahkan keseluruhan dana kontrak sesuai yang di ceklis

                $sumDanaKontrak = "SELECT sum(dana_kontrak) AS dana_kontrak FROM tbl_order_po WHERE id IN"."(".$valueorder.")";
                $hasil_SumDanaKontrak = mysql_query($sumDanaKontrak);
                $Data_DanaKontrak = mysql_fetch_array($hasil_SumDanaKontrak);
                $hasilDanaKontrak = $Data_DanaKontrak['dana_kontrak'];

                $updateDanaKontrak = mysql_query("UPDATE invoice_po SET grand_total='$hasilDanaKontrak' WHERE invoice='$invoice' AND invoice_number='$hasilkode'")or die(mysql_error());

                if($save_order AND $updateRembust AND $update) {
                    echo "<script>window.location.href = '/?g=InvoicePO';</script>";
                } else {
                    echo "QUERY ERROR";
                }
            }else{ //jika tidak ada yang diceklis
                echo "<script>window.location.href = '/?g=InvoicePO';</script>";
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
    <title>GAIN Satellite Web Apps | Edit Invoice PO</title>
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
    <script type="text/javascript">
        function proses(){
            var perusahaan = document.getElementById("perusahaan").value;

            $.get("?g=api_alamat&perusahaan="+perusahaan, function(item){
                // alert("Result: " + result + "\nItem: " + item);
                document.getElementById("customer").value = item.alamat;
                // console.log(item);
            });

            // $.get("?g=api_ppn&perusahaan="+perusahaan, function(vat){
            //     // alert("Result: " + result + "\nItem: " + item);
            //     document.getElementById("vat").value = vat.vat;
            //     document.getElementById("nilaivat").value = vat.nilaivat;
            //     // console.log(item);
            // });

            $.get("?g=api_nomorInvoice&perusahaan="+perusahaan, function(item, bulan, tahun, hasilkode){
                // alert("Result: " + result + "\nItem: " + item);
                document.getElementById("inv_number").value = "GAIN/" + item.kode + "/" + item.bulan + "." + item.tahun + "/INV-";
                // console.log(item.bulan);
            });
        }
    </script>
    <script type="text/javascript">
        function prosesBank(){
            var name_bank = document.getElementById("name_bank").value;        

            $.get("?g=api_bank&bank="+name_bank, function(item){
                document.getElementById("addressbank").value = item.address;
            });
        }     
    </script>
    <script src="dist/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
 
            })
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
                    <a href="#"> Edit Invoice PO</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <form action="" method="post">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well">
                         <h2><i class="glyphicon glyphicon-file"></i> Edit Invoice PO</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-minimize btn-round btn-default">
                                <i class="glyphicon glyphicon-chevron-up"></i>
                            </a>
                            <a href="#" class="btn btn-close btn-round btn-default">
                                <i class="glyphicon glyphicon-remove"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-content">
                            <div class="form-group has-success">
                                <label class="control-label">Invoice Number</label>
                                <input type="text" class="form-control input-sm" name="invoice" value="<?php echo $fetchDataDok['invoice'].$fetchDataDok['invoice_number']; ?>">
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control input-sm" name="dateInvoice" value="<?php echo $fetchDataDok['date_invoice']; ?>">
                            </div>
                            <div class="form-group has-success col-md-4">
                                <label class="control-label">Customer To</label>
                                <?php
                                    include_once 'database/connection.php';

                                    echo "<select name='cusTo' id='perusahaan' class='form-control input-sm' onchange='proses()' required>";
                                    $tampil=mysql_query("SELECT * FROM perusahaan ORDER BY id");
                                    echo "<option value='".$fetchDataDok[customer_to]."'>$fetchDataDok[customer_to]</option>";

                                    while($w=mysql_fetch_array($tampil))
                                    {
                                        echo "<option value='".$w[perusahaan]."'>$w[perusahaan]</option>";        
                                    }
                                        echo "</select>";
                                ?>
                            </div>

                            <div class="form-group has-success col-md-8">
                                <label class="control-label">Address Customer</label>
                                <input type="text" class="form-control input-sm" name="addressCustomer" id="customer" value="<?php echo $fetchDataDok['address_customer']; ?>">
                            </div>
                            <div class="form-group has-success col-md-4">
                                <label class="control-label">Payment To</label>
                                <input type="text" class="form-control input-sm" name="payment" value="PT. Global Abadi Inti Nusantara">
                            </div>
                            <div class="form-group has-success col-md-4">
                                <label class="control-label">Bank</label>
                                <?php
                                    include_once 'database/connection.php';

                                    echo "<select name='nameBank' id='name_bank' class='form-control input-sm' onchange='prosesBank()' required>";
                                    $show=mysql_query("SELECT * FROM bank ORDER BY id");
                                    echo "<option value='".$fetchDataDok[bank]."'>$fetchDataDok[bank]</option>";

                                    while($d=mysql_fetch_array($show))
                                    {
                                        echo "<option value='".$d[bank]."'>$d[bank]</option>";        
                                    }
                                        echo "</select>";
                                ?>
                            </div>
                            <div class="form-group has-success col-md-4">
                                <label class="control-label">Address Payment</label>
                                <input type="text" class="form-control input-sm" name="AddressPayment" value="<?php echo $fetchDataDok['address_payment']; ?>">
                            </div>
                            <div class="form-group has-success col-md-4">
                                <label class="control-label">Approved By</label>
                                <input type="text" class="form-control input-sm" name="approved" value="<?php echo $fetchDataDok['aproved_by']; ?>" required>
                            </div>
                            <div class="form-group has-success col-md-8">
                                <label class="control-label">Position</label>
                                <input type="text" class="form-control input-sm" name="position" value="<?php echo $fetchDataDok['position']; ?>">
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">VAT 10%</label>
                                <!-- <input type="text" class="form-control input-sm" name="vat" id="vat">
                                <input type="text" class="form-control input-sm" name="nilaivat" id="nilaivat"> -->
                                <?php
                                    include_once 'database/connection.php';

                                    echo "<select name='nilaivat' class='form-control input-sm' required>";
                                    $show=mysql_query("SELECT * FROM ppn ORDER BY id");
                                    echo "<option value='".$fetchDataDok[vat]."'>$fetchDataDok[vat]</option>";

                                    while($d=mysql_fetch_array($show))
                                    {
                                        echo "<option value='".$d[Deskripsi]."'>$d[PPN]</option>";        
                                    }
                                        echo "</select>";
                                ?>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Nomor PO</label>
                                <input type="text" class="form-control input-sm" name="nomorpo" value="<?php echo $fetchDataDok['nomor_inv_po']; ?>">
                            </div>
                    </div>
                </div>
            </div>

            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-content">
                        <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Site</th>
                                    <th>Start Progress</th>
                                    <th>Stop Progress</th>
                                    <th>Dana Kontrak</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TABEL INVOICE MUNCUL JIKA status_invoice = ' ' atau status_invoice = sesuai nomor invoice -->
                                <?php
                                    include_once 'database/connection.php';
                                    $statusorder = $fetchDataDok['invoice'].$fetchDataDok['invoice_number'];
                                    $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE status_invoice = '$statusorder' OR status_invoice = ' ' AND pelunasan = 'LUNAS' ORDER BY id ASC");
                                    while ($fetchDataDok_tblorder = mysql_fetch_array($dataDok)){
                                ?>
                                    <tr>
                                        <td><?php echo $fetchDataDok_tblorder['order_id'].$fetchDataDok_tblorder['noUrut']; ?></td>
                                        <td><?php echo $fetchDataDok_tblorder['site']; ?></td>
                                        <td><?php echo $fetchDataDok_tblorder['start_progress']; ?></td>
                                        <td><?php echo $fetchDataDok_tblorder['stop_progress']; ?></td>
                                        <td class="uang"><?php echo $fetchDataDok_tblorder['dana_kontrak']; ?></td>
                                        <td>
                                        <!-- CEKLIS DAN DISABLED OTOMATIS sesuai nomor invoice yang ada -->
                                        <?php
                                            if ($statusorder == $fetchDataDok_tblorder['status_invoice']) {
                                                echo '<input type="checkbox" checked disabled>';
                                            }else{
                                                echo "<input type='checkbox' name='order[]' value='".$fetchDataDok_tblorder['id']."'>";
                                            }
                                        ?>            
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <button  class="btn btn-default" name="submit" type="submit">Submit</button>
                        <a href="?g=invoicePO" class="btn btn-primary">Kembali</a>                    
                    </div>
                </div>
            </div>
            </form>
        </div>
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