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
    <title>GAIN Satellite Web Apps | Finish Order Retails</title>
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
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="shortcut icon" href="img/gain.png">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function onload() {
            $("#datas").load("?p=data&id=1");
        }

        function submitOnclick() {
            //get array checklist where ceked
            var sapake = $("input[name='BAceklis']:checked");

            // looping based array length
            for (var i = 0; i < sapake.length; i++) {
                alert(sapake[i].value);
            }
            //use func savetodb

            //end looping

        }

        function saveTodb(invoiceid, sjid) {
            //query save db
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
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="?g=FinishOrderPO">Finish Order Retails</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="box col-md-12">
                        <a href="?g=Export_FinishOrder" class="btn btn-success btn-sm" target="BLANK">Export To Excel</a>
                    </div>
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2>Finish Progress Order</h2>

                                <div class="box-icon">
                                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                        <tr>
                                            <th width="50">No</th>
                                            <th width="200">Order ID</th>
                                            <th>Site</th>
                                            <th width="125">Start Progress</th>
                                            <th width="125">Stop Progress</th>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <th width="125" style="text-align: center;">Terima BA</th>
                                            <th>Opsi</th>
                                            <?php 
                                        } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $user = $fetchDataUserBySesion['nama'];
                                        $dataDok = mysql_query("SELECT * FROM tbl_order WHERE status_order='Finish Progress Order' AND user = '$user' ORDER BY id DESC");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?></td>
                                            <td><?php echo $fetchDataDok['site']; ?></td>
                                            <td>
                                                <?php 
                                                $formatdate_sp = date_create($fetchDataDok['start_progress']);
                                                echo date_format($formatdate_sp, "d M Y");
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $formatdate_spg = date_create($fetchDataDok['stop_progress']);
                                                echo date_format($formatdate_spg, "d M Y");
                                                ?>
                                            </td>
                                            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                                            <td style="color: red; font-weight: Bold;">
                                                <?php 
                                                if ($fetchDataDok['tgl_ba_terima'] == null) {
                                                    # null
                                                    echo $fetchDataDok['tgl_ba_terima'];
                                                } else {
                                                    $formatdate_ba = date_create($fetchDataDok['tgl_ba_terima']);
                                                    echo date_format($formatdate_ba, "d M Y");
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="?g=TerimaBA&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-primary label label-primary">Tgl BA</span></a>
                                                <br>
                                                <a href="?g=HasilKerja&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-danger label label-danger"><?php echo $fetchDataDok['opsi']; ?></span></a>
                                                <br>
                                                <a href="?g=SR_Number&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-warning label label-warning"><?php echo $fetchDataDok['sr_number']; ?></span></a>
                                                <br>
                                                <a href="?g=Pelunasan&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label-default label label-default"><?php echo $fetchDataDok['pelunasan']; ?></span></a>
                                                <br>
                                                <span class="label-success label label-success"><?php echo $fetchDataDok['hasil_kerja']; ?></span>
                                                <br>
                                            </td>
                                            <?php 
                                        } ?>
                                            <!-- <td><?php  ?></td> -->
                                        </tr>
                                        <?php 
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <!--/span-->

            </div>
            <!--/row-->

            <!-- content ends -->
        </div>
        <!--/#content.col-md-0-->
    </div>
    <!--/fluid-row-->

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