<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C") {
        echo "<script>window.location.href = '/?';</script>";
    }

    if (isset($_POST['submit'])) {
        include_once 'database/connection.php';

        $nama = $_POST['nama'];
        $password = $_POST['password'];
        $Upassword = $_POST['Upassword'];
        $akses = $_POST['akses'];
        date_default_timezone_set('Asia/Jakarta');
        $datecreate = date("Y-m-d H:i:s");

        if ($password == $Upassword) {

            if ($akses == "C") {
                $save = mysql_query("INSERT INTO staff(nama,`password`,jabatan,staff_create,status,`image`,class)VALUES('$nama','$password','$akses','$datecreate','Log out','profile_user.jpg','label-default label label-danger')") or die(mysql_error());
                if ($save) {
                    echo "<script>window.location.href = '/?g=MasterUsers';</script>";
                } else {
                    echo "<script>window.location.href = '/?';</script>";
                }
            } elseif ($akses == "SA" && $akses == "AO") {
                $save = mysql_query("INSERT INTO staff(nama,`password`,jabatan,staff_create,status,`image`,class)VALUES('$nama','$password','$akses','$datecreate','Log out','profile1.png','label-default label label-danger')") or die(mysql_error());
                if ($save) {
                    echo "<script>window.location.href = '/?g=MasterUsers';</script>";
                } else {
                    echo "<script>window.location.href = '/?';</script>";
                }
            } else {
                $save = mysql_query("INSERT INTO staff(nama,`password`,jabatan,staff_create,status,`image`,class)VALUES('$nama','$password','$akses','$datecreate','Log out','manager.png','label-default label label-danger')") or die(mysql_error());
                if ($save) {
                    echo "<script>window.location.href = '/?g=MasterUsers';</script>";
                } else {
                    echo "<script>window.location.href = '/?';</script>";
                }
            }

            
        } else {
            $pesanError = 'Password tidak sama, silahkan ulangi kembali!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Users</title>
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
    <link rel="shortcut icon" href="img/gain.png">
    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
    <link rel="shortcut icon" href="img/gain.png">

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

            <div id="content" class="col-lg-10 col-sm-10">
                <!-- content starts -->
                <div>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="?g=MasterUsers">Users</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <form action="" method="post">
                        <div class="box col-md-12">
                            <div class="box-inner">
                                <div class="box-header well">
                                    <h2><i class="glyphicon glyphicon-user"></i> New User</h2>
                                    <div class="box-icon">
                                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                                    </div>
                                </div>
                                <div class="box-content">
                                    <div class="form-group has-success">
                                        <label class="control-label">Name Users</label>
                                        <input type="text" class="form-control input-sm" name="nama" required>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control input-sm" name="password" required>
                                    </div>
                                    <?php
                                    if (isset($pesanError)) {
                                        echo '<b style=color:red>' . $pesanError . '</b>';
                                    }
                                    ?>
                                    <div class="form-group has-success">
                                        <label class="control-label">Ulangi Password</label>
                                        <input type="password" class="form-control input-sm" name="Upassword" required>
                                    </div>
                                    <div class="form-group has-success">
                                        <label class="control-label">Hak Akses</label>
                                        <select class="form-control input-sm" name="akses" required>
                                            <option value="" disabled selected></option>
                                            <option value="SA">Super Admin</option>
                                            <option value="MO">Manager Operasional</option>
                                            <option value="AO">Admin Operasional</option>
                                            <option value="MK">Manager Keuangan</option>
                                            <option value="C">Customer</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-default" name="submit" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="box col-md-12">
                        <div class="box-inner">
                            <div class="box-content">
                                <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Privilege</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT * FROM staff");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                                            ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['nama']; ?></td>
                                            <td><?php 
                                                $jabatan = $fetchDataDok['jabatan'];
                                                if ($jabatan == "SA") {
                                                    echo "Super Admin";
                                                } elseif ($jabatan == "MO") {
                                                    echo "Manager Operasional";
                                                } elseif ($jabatan == "AO") {
                                                    echo "Admin Operasional";
                                                } elseif ($jabatan == "MK") {
                                                    echo "Manager Keuangan";
                                                } elseif ($jabatan == "C") {
                                                    echo "Customer";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#ModalEditPassword<?= $fetchDataDok['id_staff']; ?>">
                                                    <span class="label label-success">Edit Password</span></a>
                                                <a href="?g=DeleteMasterStaff&id_staff=<?= $fetchDataDok['id_staff']; ?>">
                                                    <span class="label label-danger">Delete</span></a>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="ModalEditPassword<?php echo $fetchDataDok['id_staff']; ?>" role="dialog">
                                            <form role="form" action="?g=EditMasterStaff" method="POST">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                                            <h3>Edit User</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php
                                                            $id_staff = $fetchDataDok['id_staff'];
                                                            $query_edit = mysql_query("SELECT * FROM staff WHERE id_staff = '$id_staff'");
                                                            while ($row = mysql_fetch_array($query_edit)) {
                                                                ?>
                                                            <input type="hidden" name="id_staff" value="<?= $row['id_staff']; ?>">
                                                            <p>
                                                                <label class="control-label">Name Users</label>
                                                                <input type="text" class="form-control input-sm" name="nama" value="<?= $row['nama']; ?>" required>
                                                            </p>
                                                            <p>
                                                                <label class="control-label">Password Lama</label>
                                                                <input type="password" class="form-control input-sm" name="pas_lama" required>
                                                            </p>
                                                            <p>
                                                                <label class="control-label">Password Baru</label>
                                                                <input type="password" class="form-control input-sm" name="pas_baru" required>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    </div>

    <!-- Ad, you can remove it -->
    <div class="row">
        <div class="col-md-9 col-lg-9 col-xs-9 hidden-xs">
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