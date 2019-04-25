<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Invoice Terbayar PO</title>
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

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <link rel="shortcut icon" href="img/gain.png">
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function onload() {
        $("#datas").load("?p=data&id=1");
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

<body onload="onload();">
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
                    <a href="?g=NewInvoicePO">Tambah Invoice PO</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" >
                        <h2>Invoice</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-round btn-default"><i
                                class="glyphicon glyphicon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round btn-default"><i
                                 class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                                <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Date Invoice</th>
                                    <th>Customer</th>
                                    <th>PPN</th>
                                    <th>Grand Total</th>
                                    <th>Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT * FROM invoice_rembust_po WHERE terbayar = 'Lunas' ORDER BY id ASC");
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)){
                                    ?>
                                        <tr>
                                            <td width="200"><?php echo $fetchDataDok['invoice_rembust']; ?></td>
                                            <td><?php echo $fetchDataDok['date_invoice']; ?></td>
                                            <td><?php echo $fetchDataDok['customer_to']; ?></td>
                                            <td><?php echo $fetchDataDok['vat']; echo "%"?></td>
                                            <td class="uang"><?php if ($fetchDataDok['vat'] == "0.1") {
                                                                    $perkalian = $fetchDataDok['grand_total'] * 0.1;
                                                                    $jumlah = $perkalian + $fetchDataDok['grand_total'];
                                                                    echo $jumlah;
                                                                }else{
                                                                    echo $fetchDataDok['grand_total']; 
                                                                } ?></td>
                                            <td><?php echo $fetchDataDok['terbayar']; ?></td>
                                        </tr>
                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $fetchDataDok['id']; ?>" role="dialog">
                <form role="form" action="?g=ProsesInvoiceTerbayar" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <?php
                                    $id = $fetchDataDok['id']; 
                                    $query_edit = mysql_query("SELECT * FROM invoice WHERE id='$id'");
                                    while ($row = mysql_fetch_array($query_edit)) {  
                                ?>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h3>Input Terbayar - <?php echo $row['invoice'].$row['invoice_number']; ?></h3>
                                </div>
                                <div class="modal-body"> 
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <p>
                                            <label class="control-label">Tanggal Bayar</label>
                                            <input type="Date" class="form-control input-sm" name="tgl_terbayar" value="" required>
                                        </p>
                                </div>
                                <div class="modal-footer">  
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                    </div>
                    <?php } ?>
                </form>
                </div>
                <!-- End Modal -->
                                    <?php } ?>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Ad, you can remove it -->
    <div class="row">
        <div class="col-md-9 col-lg-9 col-xs-9 hidden-xs">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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
    <?php include_once 'footer.php'; ?>

</div><!--/.fluid-container-->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
</html>

