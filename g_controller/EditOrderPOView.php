<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C" || $fetchDataUserBySesion['jabatan'] == "MK"){
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";

}
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
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

    $id_order = mysql_real_escape_string($_POST['id_order']);
    $order_id = mysql_real_escape_string($_POST['order_id']);
    $tglRequest = mysql_real_escape_string($_POST['tglRequest']);
    $rembust = mysql_real_escape_string($_POST['rembust']);
    $site = mysql_real_escape_string($_POST['site']);
    $deskripsi = mysql_real_escape_string($_POST['deskripsi']);
    $nominaldana =mysql_real_escape_string($_POST['nominaldana']);
    $nominaldana2= str_replace(".", "", $nominaldana);
    $nominaldana2= str_replace(".", "", $nominaldana);
    $rekening = mysql_real_escape_string($_POST['rekening']);

    $saveRembust = mysql_query("INSERT INTO rembust(id_order,Order_ID,Tgl_request,RembustID,Site,Deskripsi,Dana_Rembust,Kas) 
                                            VALUES ('$id_order','$order_id','$tglRequest','$rembust','$site','$deskripsi','$nominaldana2','$rekening')")or die (mysql_error());
    // menampilkan id desc dari kasbesar
    $query = "SELECT * FROM rembust ORDER BY id DESC LIMIT 1";
    $mysql = mysql_query($query);
    $assoc = mysql_fetch_array($mysql);
    $id = $assoc['id'];

    $savekasKecil = mysql_query("INSERT INTO kaskecil(id_rembust,account,uraian,site,tgl,debit,kredit,keterangan) 
                                    VALUES('$id','$rembust','$order_id','$site','$tglRequest','0','$nominaldana2','$deskripsi')")or die (mysql_error());
    if($saveRembust && $savekasKecil) {
        echo "<script>window.location.href = '/?g=ProgressOrderPO';</script>";
        $reqerror =  "Request dana sebesar Rp.".$nominaldana. " Silahkan kembali !";
    } else {
        $reqerror =  "REQUEST TIDAK BERHASIL";
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

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
            <ul class="breadcrumb">
                <li>
                    <a href="?g=OrderPO">Order PO</a>
                </li>
                <li>
                    <a href="?g=ProgressOrderPO">Progress Order PO</a>
                </li>
            </ul>
        </div>

        <div class="row">
    <div class="box col-md-9">
        <div class="box-inner">
            <?php
                if (isset($reqerror)) {
                    echo '<b style=color:red><center>' . $reqerror . '</b></center>';
                }
            ?>
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Request Dana</h2>
            </div>
            <div class="box-content">
                <form role="form" action="" method="POST">
                    <input type="label" name="id_order" value="<?php echo $fetchDataDok['id']; ?>" hidden>
                    <input type="label" name="order_id" value="<?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?>" hidden>
                    <input type="label" name="site" value="<?php echo $fetchDataDok['site']; ?>" hidden>

                    <div class="form-group has-success">
                        <label class="control-label">Tgl Request</label>
                        <input type="Date" class="form-control input-sm" name="tglRequest" required>
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Rembust / Non Rembust</label>
                        <select class="form-control input-sm" name="rembust" required>
                            <option value="" disabled selected>Pilih Rembust</option>
                            <option value="Non Rembust">Non Rembust</option>
                            <option value="Rembust">Rembust</option>
                        </select>
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label" for="inputError1">Nominal</label>
                        <input type="text" class="form-control uang input-sm" name="nominaldana" required>
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label" for="inputError1">Deskripsi</label>
                        <input type="text" class="form-control input-sm" name="deskripsi" required>
                    </div>
                            <!-- Langsung masuk ke tabel kas kecil 1 atau kas kecil 2 -->
                    <div class="form-group has-success">
                        <label class="control-label" for="inputError1">Rekening</label>
                        <select class="form-control input-sm" name="rekening" required>
                            <option value="" disabled selected>Pilih Rekening</option>
                            <option value="KK 1">Kas Kecil 1</option>
                            <option value="KK 2">Kas Kecil 2</option>
                        </select>
                    </div>
                    <button  class="btn btn-primary" name="submit" type="submit">Submit</button>
                    <a href="?g=ProgressOrderPO" class="btn btn-default">Back</a> 
                </form>                   
            </div>
        </div>
    </div>
    <!--/span-->

    <div class="box col-md-3">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2>Description List</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <dl>
                    <dt>Order ID</dt>
                    <dd><?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?><dd>

                    <dt>User</dt>
                    <dd><?php echo $fetchDataDok['user']; ?></dd>

                    <dt>Customer</dt>
                    <dd><?php echo $fetchDataDok['customer']; ?></dd>

                    <dt>Area</dt>
                    <dd><?php echo $fetchDataDok['area']; ?></dd>

                    <dt>Start Progress</dt>
                    <dd><?php echo $fetchDataDok['start_progress']; ?></dd>

                    <dt>Teknisi</dt>
                    <dd><?php echo $fetchDataDok['teknisi']; ?></dd>

                    <dt>Dana Kontrak</dt>
                    <dd class="uang"><?php echo $fetchDataDok['dana_kontrak']; ?></dd>
                </dl>
            </div>
        </div>
    </div>

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

