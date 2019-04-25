<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C" || $fetchDataUserBySesion['jabatan'] == "MK") {
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    header("Location: ?");
}

if (isset($_POST['submit'])) {
    include_once 'database/connection.php';
    // $PO = mysql_real_escape_string($_POST['PO']);
    $user = $_POST['user'];
    $customer = $_POST['customer'];
    $site = $_POST['site'];
    $job = $_POST['job'];
    $sistem = $_POST['sistem'];
    $area = $_POST['area'];
    $startprogres = $_POST['startprogres'];
    $teknisi = $_POST['teknisi'];
    $status = $_POST['status'];
    $DanaKontrak = $_POST['DanaKontrak'];
    $DanaKontrak2 = str_replace(".", "", $DanaKontrak);
    $datenow = date('y-m-d');
    $tahun = date('y');
    $array_bulan = array(1 => "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
    $bulan = $array_bulan[date('n')];
    $No_Order = "PO" . "/" . $_POST['user'] . '/' . $_POST['job'] . '/' . $_POST['sistem'] . '/' . $_POST['area'] . '/' . $tahun . '/' . $bulan . '/';

    $ResetNumber = date('y');
    $looping = "SELECT max(noUrut) as maxnoUrut, order_id FROM tbl_order_po WHERE year(start_progress)='$startprogres' AND order_id='$No_Order'";
    $hasil_looping = mysql_query($looping);
    $data_looping = mysql_fetch_array($hasil_looping);
    $no = $data_looping['maxnoUrut'];
    $noUrut = $no + 1;

    // untuk save site lebih dari 1, dengan rincian yg sama.
    foreach ($site as $value) {
        $value_string = $value_string . "('" . $No_Order . "','" . $noUrut . "', 'PO', '" . $user . "', '" . $customer . "', '" . $value . "', '" . $job . "', '" . $sistem . "', '" . $area . "', '" . $startprogres . "', '" . $teknisi . "', '" . $status . "', '" . $DanaKontrak2 . "', '" . $datenow . "'),";
    }

    $value_string = substr($value_string, 0, strlen($value_string) - 1);

    $saveFolder = mysql_query("INSERT INTO tbl_order_po(order_id,noUrut,retails_po,user,customer,`site`,job,`system`,area,start_progress,teknisi,status_order,dana_kontrak,date_order) VALUES " . $value_string) or die(mysql_error());
    if ($saveFolder) {
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
    <script type="text/javascript">
        $(document).ready(function() {

            // Format mata uang.
            $('.uang').mask('000.000.000', {
                reverse: true
            });

        })
    </script>
    <link rel="shortcut icon" href="img/gain.png">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myTable').DataTable();
        });

        function onload() {
            $("#datas").load("?p=data&id=1");
        }
    </script>
    <script language="javascript">
        function tambahSite() {
            var idf = document.getElementById("idf").value;
            var stre;
            stre = "<p id='srow" + idf + "'><input type='text' class='form-control input-sm' size='40' name='site[]' required> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'>Hapus</a></p>";
            $("#divSite").append(stre);
            idf = (idf - 1) + 2;
            document.getElementById("idf").value = idf;
        }

        function hapusElemen(idf) {
            $(idf).remove();
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
                            <a href="?g=Order">Tambah Order PO</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-header well" data-original-title="">
                                <h2><i class="glyphicon glyphicon-shopping-cart"></i> Order PO</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                                </div>
                            </div>

                            <div class="box-content">
                                <form role="form" action="" method="post">
                                    <!-- <div class="form-group has-success">
                                    <label class="control-label" for="inputSuccess1">PO</label>
                                    <select class="form-control input-sm" name="PO" onchange="javascript:handleSelect(this)" required>
                                        <option value="" disabled selected>-Pilih PO-</option>
                                        <option value="PO">PO</option>
                                    </select>
                                </div> -->
                                    <div class="form-group has-success">
                                        <label class="control-label" for="State">User</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='user' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM perusahaan ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih User</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[kode] . "'>$w[kode] - $w[perusahaan]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Customer</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='customer' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM customer ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih Customer</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[customer] . "'>$w[customer] - $w[description]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <button type="button" class="btn btn-default btn-sm" onclick="tambahSite(); return false;">Tambah Site</button>
                                    <input id="idf" value="1" type="hidden">
                                    <div id="divSite" class="form-group has-success">

                                    </div>
                                    <!-- <div class="form-group has-success">
                                    <label class="control-label" for="inputError1">Site</label>
                                    <input type="text" class="form-control input-sm" id="inputWarning1" name="site" required>
                                </div> -->
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Job</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='job' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM job ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih Pekerjaan</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[job] . "'>$w[job] - $w[description]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">System</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='sistem' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM system ORDER BY id");
                                        echo "<option value=''>Pilih System</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[system] . "'>$w[system] - $w[description]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Location/Area</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='area' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM area ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih Area</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[area] . "'>$w[area] - $w[description]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Teknisi</label>
                                        <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='teknisi' class='form-control input-sm' required>";
                                        $tampil = mysql_query("SELECT * FROM teknisi ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih Teknisi</option>";

                                        while ($w = mysql_fetch_array($tampil)) {
                                                echo "<option value='" . $w[teknisi] . "'>$w[teknisi]</option>";
                                            }
                                        echo "</select>";
                                        ?>
                                        <input type="hidden" class="form-control" id="inputWarning1" name="status" value="Progress Order">
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Start Progress</label>
                                        <input type="date" class="form-control input-sm" name="startprogres" required>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label" for="inputError1">Nilai Kontrak</label>
                                        <input type="text" class="form-control uang input-sm" name="DanaKontrak">
                                    </div>

                                    <button class="btn btn-default" name="submit" type="submit">Submit</button>
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
                <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-5108790028230107" data-ad-slot="3193373905"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
        <!-- Ad ends -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

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

    </div>
    <!--/.fluid-container-->

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