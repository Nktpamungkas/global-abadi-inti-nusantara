<?php
    if(isset($_SESSION['userId'])){
        //sessi ada
        $idStaff = $_SESSION['userId'];
        include_once 'database/connection.php';
        $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
        $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

        if(isset($_POST['submit'])){
            include_once 'database/connection.php';

            $invoice = $_POST['invoice'];
            $order = $_POST['order'];

            $dateInvoice = $_POST['dateInvoice'];
            $cusTo = $_POST['cusTo'];
            $addressCustomer = $_POST['addressCustomer'];
            $payment = $_POST['payment'];
            $nameBank = $_POST['nameBank'];
            $AddressPayment = $_POST['AddressPayment'];
            $approved = $_POST['approved'];
            $position = $_POST['position'];
            $nilaivat = $_POST['nilaivat'];
            
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
            $save = mysql_query("INSERT INTO invoice_po(invoice,invoice_number,date_invoice,customer_to,address_customer,payment_to,bank,address_payment,aproved_by,position,vat) 
            VALUES('$invoice','$hasilkode','$dateInvoice','$cusTo','$addressCustomer','$payment','$nameBank','$AddressPayment','$approved','$position','$nilaivat')");

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

                $value_string = $value_string. "('".$value."','".$invoice.$hasilkode."','".$value_data."','".$value_dateInv."','".$value_site."','".$value_des."','".$value_sr."'),";
                $valueorder = $valueorder. "'".$value."',";
                // echo $value;
            }

            $value_data = substr($value_data, 0);
            $value_string = substr($value_string, 0, strlen($value_string) - 1);
            $id_value = substr($id_value, 0);
            $valueorder = substr($valueorder, 0, strlen($valueorder) - 1);
            // echo $value_string;

            //Cari data order PO jika ada lebih dari 1 po yang sama
            $cariPO = mysql_query("SELECT * FROM tbl_order_po WHERE id IN"."(".$valueorder.")");
            $arrayPO = mysql_fetch_array($cariPO);
            $orderPO = $arrayPO['order_id'];
            $noUrutPO = $arrayPO['noUrut'];

            // untuk save invoice detail 
            $save_order = mysql_query("INSERT INTO invoice_detail_po(orders, invoice, dana_kontrak,date_invoice,site,description,sr_number) VALUES ".$value_string) or die(mysql_error());
            // untuk memasukkan nomor invoice ke tabel rembust
            $updateRembust = mysql_query("UPDATE rembust SET invoice_rembust='$invoice$hasilkode' WHERE substr(Order_ID,1,2) = 'PO' AND Order_ID='$orderPO$noUrutPO'")or die(mysql_error());
            
            // untuk mengubah status pada tbl_order karena telah di invoice'kan

            $updateOrder = mysql_query("UPDATE tbl_order_po SET status_invoice='$invoice$hasilkode' WHERE order_id='$orderPO' AND noUrut='$noUrutPO'")or die(mysql_error());
            
            // untuk menjumlahkan keseluruhan dana kontrak sesuai yang di ceklis
            $sumDanaKontrak = "SELECT sum(dana_kontrak) AS dana_kontrak FROM tbl_order_po WHERE id IN"."(".$valueorder.")";
            $hasil_SumDanaKontrak = mysql_query($sumDanaKontrak);
            $Data_DanaKontrak = mysql_fetch_array($hasil_SumDanaKontrak);
            $hasilDanaKontrak = $Data_DanaKontrak['dana_kontrak'];

            $updateDanaKontrak = mysql_query("UPDATE invoice_po SET grand_total='$hasilDanaKontrak' WHERE invoice='$invoice' AND invoice_number='$hasilkode'")or die(mysql_error());

            if($save_order AND $updateRembust AND $save) {
                header("Location: ?g=InvoicePO");
            } else {
                echo "QUERY ERROR";
            }
        }
    } else {
        header("Location: ?");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Kwitansi PO</title>
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
                    <a href="#">Kwitansi PO</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <form action="" method="post">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-content">
                        <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                                <tr>
                                    <th>Invoice PO</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        include_once 'database/connection.php';
                                        $statusorder = ' ';
                                        $dataDok = mysql_query("SELECT CONCAT(invoice,invoice_number) AS invoice FROM invoice 
                                        ");
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)){
                                    ?>
                                        <tr>
                                            <td><?php echo $fetchDataDok['invoice']; ?></td>
                                            <td>
                                                <input type="checkbox" name="order[]" value="<?php echo $fetchDataDok['id']; ?>" required>
                                            </td>
                                        </tr>
                                    <?php } ?>
                            </tbody>
                        </table>
                        <button  class="btn btn-default" name="submit" type="submit">Submit</button>                    
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