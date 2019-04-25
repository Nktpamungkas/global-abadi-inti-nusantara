<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
} else {
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
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

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
                            <a href="?g=OrderPO">Tambah Order</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="box col-md-12">
                        <a href="?g=Export_ProgressOrderPO" class="btn btn-success btn-sm" target="BLANK">Export To Excel</a>
                    </div>

                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well">
                                <h2>Progress Order</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </div>

                            <div class="box-content">
                                <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                        <tr>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <th></th>
                                            <?php 
                                        } ?>
                                            <th width="50">No</th>
                                            <th width="200">Order ID</th>
                                            <th width="425">Site</th>
                                            <th width="125">Start Progres</th>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <th>Opsi</th>
                                            <?php 
                                        } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $user = $fetchDataUserBySesion[user];
                                        $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE status_order = 'Progress Order' AND user = '$user' ORDER BY id DESC");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#myModal<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="glyphicon glyphicon-trash red" title="Delete : <?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?>" left"." data-toggle="tooltip"></span></a>
                                            </td>
                                            <?php 
                                        } ?>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?></td>
                                            <td>
                                                <?php echo $fetchDataDok['site']; ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $formatdate = date_create($fetchDataDok['start_progress']);
                                                echo date_format($formatdate, "d M Y");
                                                ?>
                                            </td>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <td>
                                                <a href="?g=DetailOrderPO&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-primary label label-primary" title="Input Dana Kontrak" left"." data-toggle="tooltip">
                                                        Input Dana Kontrak
                                                    </span>
                                                </a>

                                                <a href="?g=EditPO&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-primary label label-info" title="Edit" left"." data-toggle="tooltip">
                                                        Edit
                                                    </span>
                                                </a>

                                                <a href="?g=EditOrderPO&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-success label label-default" title="Request Dana" left"." data-toggle="tooltip">
                                                        Req. Dana
                                                    </span>
                                                </a>

                                                <a href="?g=ViewRembustAllPO&id=<?php echo $fetchDataDok['id']; ?>" target="_BLANK">
                                                    <span class="label-success label label-warning" title="Lihat Request Dana" left"." data-toggle="tooltip">
                                                        View
                                                    </span>
                                                </a>

                                                <a href="?g=StopProgressOrderPO&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-default label label-danger" title="Progress Order Selesai" left"." data-toggle="tooltip">
                                                        Finish
                                                    </span>
                                                </a>
                                            </td>
                                            <?php 
                                        } ?>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal<?php echo $fetchDataDok['id']; ?>" role="dialog">
                                            <form role="form" action="?g=DeleteProgressOrderPO" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?php
                                                        $id = $fetchDataDok['id'];
                                                        $query_edit = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
                                                        while ($row = mysql_fetch_array($query_edit)) {
                                                            ?>
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                                            <h3>Hapus Progress Order</h3><br>
                                                            <?php echo $row['order_id'] . $row['noUrut']; ?>
                                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Delete</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                            } ?>
                                            </form>
                                        </div>
                                        <!-- End Modal -->
                                        <?php 
                                    } ?>
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
                <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5108790028230107" data-ad-slot="3193373905"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <!-- Ad ends -->
        <?php include_once 'footer.php'; ?>

    </div>
    <!--/.fluid-container-->

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