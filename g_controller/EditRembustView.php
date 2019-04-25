<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM rembust WHERE id = '$id'");
    if(mysql_num_rows($dataDok) == 0){
        echo '<script>window.history.back()</script>';
    }else{
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }
?>
<?php
if(isset($_POST['submit'])){
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $Deskripsi = $_POST['Deskripsi'];
    $DanaSesudah = $_POST['DanaSesudah'];
    $DanaSesudah2 = str_replace(".", "", $DanaSesudah);

    $saveFolder = mysql_query("UPDATE rembust SET Deskripsi = '$Deskripsi', Dana_Rembust = '$DanaSesudah2' WHERE id = '$id'");
    $updateToKasKecil = mysql_query("UPDATE kaskecil SET kredit = '$DanaSesudah2', keterangan = '$Deskripsi' WHERE id_rembust = '$id'");
    if($saveFolder) {
        echo "<script>window.location.href = '/?g=ProgressOrderPO';</script>";
    } else {
        echo "QUERY ERROR";
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

    <link rel="shortcut icon" href="img/gain.png">
    <script src="dist/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
 
            })
        </script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function onload() {
        $("#datas").load("?p=data&id=1");
    }
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
                    <a href="?g=ProgressOrderPO">Progress Order</a>
                </li>
                <li>
                    <a href="#">Edit Rembust </a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                         <h2><i class="glyphicon glyphicon-shopping-cart"></i> Edit Rembust - <?php echo $fetchDataDok['Order_ID']; ?></h2>
                        <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>

                    <div class="box-content">
                        <form role="form" action="" method="post">
                            <input type="hidden" class="form-control" name="id" value="<?php echo $fetchDataDok['id']; ?>" >
                            <div class="form-group has-success">
                                <label class="control-label">Rembust ID</label>
                                <input type="text" class="form-control" name="RembustID" value="<?php echo $fetchDataDok['RembustID']; ?>" disabled>
                            </div>

                            <div class="form-group has-success">
                                <label class="control-label">Site</label>
                                <input type="text" class="form-control" name="Site" value="<?php echo $fetchDataDok['Site']; ?>" disabled>
                            </div>

                            <div class="form-group has-success">
                                <label class="control-label">Deskripsi</label>
                                <input type="text" class="form-control" name="Deskripsi" value="<?php echo $fetchDataDok['Deskripsi']; ?>">
                            </div>

                            <div class="form-group has-success">
                                <label class="control-label">Dana Rembust Sebelum</label>
                                <input type="text" class="form-control uang" name="DanaSesudah" placeholder="<?php echo $fetchDataDok['Dana_Rembust']; ?>">
                            </div>

                            <button  class="btn btn-success" name="submit" type="submit">Submit</button>
                        </form> 
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

