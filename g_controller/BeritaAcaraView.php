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

    //oldPassTxt newPassTxt reNewPassTxt

    if (isset($_POST['submit'])) {
            include_once 'database/connection.php';
            $nomorsr = $_POST['nomorsr'];
            $tglpelunasan = $_POST['tglpelunasan'];
            $danapelunasan = $_POST['danapelunasan'];
            $ket = $_POST['ket'];
            $check = serialize($_POST['checkbox']);

            $saveFolder = mysql_query("INSERT INTO ba(nomor_sr,tgl_pelunasan,dana_pelunasan,keterangan) 
                                            VALUES('$nomorsr','$tglpelunasan','$danapelunasan','$ket')");
            // $updateFolder = mysql_query("UPDATE tbl_order SET status_order = 'BA' WHERE id = '$OrderId[$i]'");
            if($saveFolder) {
                echo "<script>window.location.href = '/?g=BeritaAcara';</script>";
            } else {
                echo "QUERY ERROR";
            }
} } else {
    echo "<script>window.location.href = '/?';</script>";
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
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="?g=Order">Berita Acara</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                         <h2><i class="glyphicon glyphicon-book"></i> Berita Acara</h2>
                        <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>

                    <div class="box-content">
                        <form role="form" action="" method="post">
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1">Nomor SR</label>
                                    <input type="text" class="form-control" name="nomorsr" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="State">Tanggal Pelunasan</label>
                                    <input type="date" class="form-control" id="inputError1" name="tglpelunasan" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputError1">Nominal Dana Pelunasan</label>
                                    <input type="text" class="form-control" name="danapelunasan" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label" for="inputError1">Keterangan</label>
                                    <textarea class="form-control" name="ket"></textarea>
                                </div>
                                <button  class="btn btn-default" name="submit" type="submit">Submit</button>                    
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2>Finish Progress Order</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-setting btn-round btn-default"><i
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
                            <th>Order ID</th>
                            <th>Site</th>
                            <th>Start Progress</th>
                            <th>Stop Progress</th>
                            <th>Opsi</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                include_once 'database/connection.php';
                                $dataDok = mysql_query("SELECT * FROM tbl_order WHERE status_order='Finish Progress Order' OR status_order='BA' ORDER BY id ASC");
                                while ($fetchDataDok = mysql_fetch_array($dataDok)){
                            ?>
                                <tr>
                                    <td><?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?></td>
                                    <td><?php echo $fetchDataDok['site']; ?></td>
                                    <td><?php echo $fetchDataDok['start_progress']; ?></td>
                                    <td><?php echo $fetchDataDok['stop_progress']; ?></td>
                                    <td>
                                        <a href="#">
                                            <span class="label-primary label label-primary">Edit</span></a>

                                        <a href="#">
                                            <span class="label-default label label-danger">Delete</span></a>
                                    </td>
                                    <td><input type="checkbox" name="" value="<?php echo $fetchDataDok['retails_po']; ?>"> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!--/row-->
    <!--/span-->

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

