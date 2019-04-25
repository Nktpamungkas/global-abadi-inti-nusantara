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
    $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
    $fetchDataDok = mysql_fetch_assoc($dataDok);   
?>

<?php
if(isset($_POST['submit'])){
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $tglbaditerima = $_POST['tglbaditerima'];

    $cektglba = "SELECT tgl_ba_terima FROM tbl_order_po WHERE id='$id'";
    $hasilcek = mysql_query($cektglba);
    $datacek = mysql_fetch_array($hasilcek);
    $data = $datacek['tgl_ba_terima'];

    if ($data == null) {
        $saveFolder = mysql_query("INSERT INTO finish_order_ba_po(order_id,tgl_terima_ba) VALUES('$id','$tglbaditerima')");
        $updateTblOrder = mysql_query("UPDATE tbl_order_po SET tgl_ba_terima='$tglbaditerima' WHERE id='$id'");
        if($saveFolder) {
            echo "<script>window.location.href = '/?g=FinishOrderPO';</script>";	
            $pesanError = 'Berhasil input tanggal berita acara tanggal "'.$tglbaditerima.'", silahkan kembali.';
        } else {
            // header("Location: ?");
            $pesanError = 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
            echo 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
        }
    } else{
        $pesanError = 'Tidak Bisa Menyimpan karena status sudah terima BA';
    }
    
    
}elseif (isset($_POST['edit'])) {
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $tglbaditerima = $_POST['tglbaditerima'];

    $cektglba = "SELECT tgl_ba_terima FROM tbl_order_po WHERE id='$id'";
    $hasilcek = mysql_query($cektglba);
    $datacek = mysql_fetch_array($hasilcek);
    $data = $datacek['tgl_ba_terima'];

    if ($data == null) {
        $pesanError = 'Tidak Bisa Merubah karena status BA belum diterima';
    }else{
        $updateOrder = mysql_query("UPDATE tbl_order_po SET tgl_ba_terima='$tglbaditerima' WHERE id='$id'");
        $updateFinishOrder = mysql_query("UPDATE finish_order_ba_po SET tgl_terima_ba = '$tglbaditerima' WHERE order_id='$id'");
        if($updateOrder && $updateFinishOrder) {
            echo "<script>window.location.href = '/?g=FinishOrderPO';</script>";	
            $pesanError = 'Berhasil ubah tanggal berita acara tanggal "'.$tglbaditerima.'", silahkan kembali.';
        }else{
            // header("Location: ?");
            $pesanError = 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
            echo 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
        }
    }  
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Order</title>
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
                    <a href="?g=FinishOrder">Finish Order</a>
                </li>
                <li>
                    <a href="#">Tanggal Berita Acara</a>
                </li>
            </ul>
        </div>

<div class="row">
    <div class="box col-md-9">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Tanggal BA Diterima</h2>
            </div>
            <div class="box-content">
                <center><u>
                    <?php
                        if (isset($pesanError)) {
                            echo '<b style=color:red>' . $pesanError . '</b>';
                        }
                    ?>
                </u></center>
                <form role="form" action="" method="POST">
                    <div class="form-group has-success">
                        <label class="control-label">Order ID</label>
                        <input type="hidden" name="id" value="<?php echo $fetchDataDok['id']; ?>">
                        <input type="text" class="form-control  input-sm" name="order_id" value="<?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?>" disabled>
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Tgl BA</label>
                        <input type="date" class="form-control input-sm" name="tglbaditerima" value="<?php echo $fetchDataDok['tgl_ba_terima']; ?>">
                    </div>
						<button class="btn btn-primary" name="submit" type="submit">Simpan</button>
						<button class="btn btn-danger" name="edit" type="submit">Ubah Data</button>
                    <a href="?g=FinishOrder" class="btn btn-default">Kembali</a>
                </form>                   
            </div>
        </div>
    </div>

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