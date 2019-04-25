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
                            <a href="?g=ProgressOrder">Progress Order</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <!-- Start Approve Retail -->
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well">
                                <h2>Approve Retails dan PO</h2>
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
                                            <th width="50">No</th>
                                            <th width="200">Nomor PO/R</th>
                                            <th width="200">Uraian</th>
                                            <th width="250">Site</th>
                                            <th width="100">Rembust/Non Rembust</th>
                                            <th width="100">Tanggal Request</th>
                                            <th width="150">Nominal Dana</th>
                                            <th width="150">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT id_rembust, uraian, keterangan, `site`, account, tgl, format(kredit, 2) AS kredit FROM kaskecil WHERE kas is null AND NOT id_rembust is null ORDER BY id ASC");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['uraian']; ?></td>
                                            <td><?php echo $fetchDataDok['keterangan']; ?></td>
                                            <td><?php echo $fetchDataDok['site']; ?></td>
                                            <td><?php echo $fetchDataDok['account']; ?></td>
                                            <td>
                                                <?php 
                                                $formatdate = date_create($fetchDataDok['tgl']);
                                                echo date_format($formatdate, "d M Y");
                                                ?>
                                            </td>
                                            <td class="uang"><?php echo $fetchDataDok['kredit']; ?></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#approveR<?php echo $fetchDataDok['id_rembust']; ?>">Aprroved</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="approveR<?php echo $fetchDataDok['id_rembust']; ?>" role="dialog">
                                            <form role="form" action="?g=ProsesApprovedR" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?php
                                                        $id_rembust = $fetchDataDok['id_rembust'];
                                                        $query_edit = mysql_query("SELECT * FROM kaskecil WHERE id_rembust = '$id_rembust'");
                                                        $select_kaskecil = mysql_query("SELECT SUBSTR(Kas,4,1) AS kas FROM rembust WHERE id = '$id_rembust'");
                                                        $fetch_kaskecil = mysql_fetch_assoc($select_kaskecil);
                                                        while ($row = mysql_fetch_array($query_edit)) {
                                                            ?>
                                                        <div class="modal-body">
                                                            <label>Apakah anda akan menyetujui bahwa dana akan di langsungkan ke kas kecil <?= $fetch_kaskecil['kas']; ?> ?</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" value="<?php echo $row['id_rembust']; ?>" name="id_rembust">
                                                            <button type="submit" class="btn btn-success">Approved</button>
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
                    <!-- End Approve Retail -->

                    <!-- Start Pelunasan Retail -->
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well">
                                <h2>Approve Pelunasan Retail</h2>
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
                                            <th width="50">No</th>
                                            <th width="200">Nomor PO</th>
                                            <th width="300">Site</th>
                                            <th width="150">Tanggal Pelunasan</th>
                                            <th width="150">Nominal Dana</th>
                                            <th width="150">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT id_pelunasan, uraian, `site`, tgl, format(kredit, 2) AS kredit FROM kaskecil WHERE kas is null AND account = 'LN' AND SUBSTR(uraian, 1,1) = 'R' ORDER BY id ASC");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['uraian']; ?></td>
                                            <td><?php echo $fetchDataDok['site']; ?></td>
                                            <td>
                                                <?php 
                                                $formatdate = date_create($fetchDataDok['tgl']);
                                                echo date_format($formatdate, "d M Y");
                                                ?>
                                            </td>
                                            <td class="uang"><?php echo $fetchDataDok['kredit']; ?></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#approveLN<?php echo $fetchDataDok['id_pelunasan']; ?>">Aprroved</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="approveLN<?php echo $fetchDataDok['id_pelunasan']; ?>" role="dialog">
                                            <form role="form" action="?g=ProsesApprovedLN" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?php
                                                        $id_pelunasan = $fetchDataDok['id_pelunasan'];
                                                        $query_edit = mysql_query("SELECT * FROM kaskecil WHERE id_pelunasan = '$id_pelunasan' AND kas is null AND account = 'LN' AND SUBSTR(uraian, 1,1) = 'R'");
                                                        $select_rekening = mysql_query("SELECT SUBSTR(rekening,4,1) AS rekening FROM pelunasan WHERE id = '$id_pelunasan'");
                                                        $fetch_rekening = mysql_fetch_assoc($select_rekening);
                                                        while ($row = mysql_fetch_array($query_edit)) {
                                                            ?>
                                                        <div class="modal-body">
                                                            <label>Apakah anda akan menyetujui bahwa dana akan di langsungkan ke kas kecil <?= $fetch_rekening['rekening']; ?> ?</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" value="<?php echo $row['id_pelunasan']; ?>" name="id_pelunasan">
                                                            <button type="submit" class="btn btn-success">Approved</button>
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
                    <!-- End Pelunasan Retail -->

                    <!-- Start Pelunasan PO -->
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well">
                                <h2>Approve Pelunasan PO</h2>
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
                                            <th width="50">No</th>
                                            <th width="200">Nomor PO</th>
                                            <th width="300">Site</th>
                                            <th width="150">Tanggal Pelunasan</th>
                                            <th width="150">Nominal Dana</th>
                                            <th width="150">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT id_pelunasan, uraian, `site`, tgl, format(kredit, 2) AS kredit FROM kaskecil WHERE kas is null AND account = 'LN' AND SUBSTR(uraian, 1,2) = 'PO' ORDER BY id ASC");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['uraian']; ?></td>
                                            <td><?php echo $fetchDataDok['site']; ?></td>
                                            <td>
                                                <?php 
                                                $formatdate = date_create($fetchDataDok['tgl']);
                                                echo date_format($formatdate, "d M Y");
                                                ?>
                                            </td>
                                            <td class="uang"><?php echo $fetchDataDok['kredit']; ?></td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#approveLNr<?php echo $fetchDataDok['id_pelunasan']; ?>">Aprroved</a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="approveLNr<?php echo $fetchDataDok['id_pelunasan']; ?>" role="dialog">
                                            <form role="form" action="?g=ProsesApprovedLNr" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <?php
                                                        $id_pelunasan = $fetchDataDok['id_pelunasan'];
                                                        $query_edit = mysql_query("SELECT * FROM kaskecil WHERE id_pelunasan = '$id_pelunasan' AND kas is null AND account = 'LN' AND SUBSTR(uraian, 1,2) = 'PO' ORDER BY id ASC");
                                                        $select_rekening = mysql_query("SELECT SUBSTR(rekening,4,1) AS rekening FROM pelunasan_po WHERE id = '$id_pelunasan'");
                                                        $fetch_rekening = mysql_fetch_assoc($select_rekening);
                                                        while ($row = mysql_fetch_array($query_edit)) {
                                                            ?>
                                                        <div class="modal-body">
                                                            <label>Apakah anda akan menyetujui bahwa dana akan di langsungkan ke kas kecil <?= $fetch_rekening['rekening']; ?> ?</label>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" value="<?php echo $row['id_pelunasan']; ?>" name="id_pelunasan">
                                                            <button type="submit" class="btn btn-success">Approved</button>
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
                    <!-- End Pelunasan PO -->
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
    <script src=' bower_components / moment / min / moment . min . js '></script>
    <script src=' bower_components / fullcalendar / dist / fullcalendar . min . js '></script>
    <!-- data table plugin -->
    <script src=' js / jquery . dataTables . min . js'></script>

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