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
    $dataDok = mysql_query("SELECT * FROM kuitansi_invoice_rembust WHERE id='$id'");
    $cekAda = mysql_num_rows($dataDok);
    if($cekAda){
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }else{
        echo '<script>window.history.back()</script>';
    }
?>
<?php
if(isset($_POST['submit'])){
    include_once 'database/connection.php';

    $id_invoice = $_POST['id_invoice'];
    $pembayaran = $_POST['pembayaran'];

    $updateKuitansi = mysql_query("UPDATE kuitansi_invoice_rembust SET pembayaran = '$pembayaran' WHERE id = '$id_invoice'");
    if ($updateKuitansi) {
        echo "<script>window.location.href = '/?g=KwitansiRR';</script>";
    } else {
        echo "<script>window.location.href = '/?g=Error';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Order PO</title>
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
    <script src="dist/jquery.mask.min.js"></script>

    <link rel="shortcut icon" href="img/gain.png">
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function onload() {
        $("#datas").load("?p=data&id=1");
    }
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
                    <a href="?g=KwitansiR">Kuitansi Retail</a>
                </li>
                <li>
                    <a href="#">Edit Kuitansi</a>
                </li>
            </ul>
        </div>

        <div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <?php
                if (isset($reqerror)) {
                    echo '<b style=color:red><center>' . $reqerror . '</b></center>';
                }
            ?>
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Edit Kuitansi</h2>
            </div>
            <div class="box-content">
                <form role="form" action="" method="POST">
                    <input type="label" name="id_invoice" value="<?= $fetchDataDok['id']; ?>" hidden>

                    <div class="form-group has-success">
                        <label class="control-label">Nomor Kuitansi</label>
                        <input type="text" class="form-control" value="<?= $fetchDataDok['no_kuitansi']; ?>" readonly>
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Untuk Pembayaran</label>
                        <textarea name="pembayaran" class="form-control"><?= $fetchDataDok['pembayaran']; ?></textarea>
                    </div>

                    <button  class="btn btn-primary" name="submit" type="submit">Ubah</button>
                    <a href="?g=KwitansiRR" class="btn btn-default">Kembali</a> 
                </form>                   
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

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

<!-- external javascript -->

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

