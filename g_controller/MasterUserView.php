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
    if(isset($_POST['submit'])){
        include_once 'database/connection.php';

        $kode = $_POST['kode'];
        $perusahaan = $_POST['perusahaan'];

        $alamat = $_POST['alamat'];
        $pajak = $_POST['pajak'];
        if($pajak == "PPN 10%"){
            $nilaipajak = "0.1";
        }else{
            $nilaipajak = "0";
        }

        $save2 = mysql_query("INSERT INTO perusahaan(kode,perusahaan,alamat,vat,nilai_vat)VALUES('$kode','$perusahaan','$alamat','$pajak','$nilaipajak')")or die(mysql_error());

        if($save2) {
            echo "<script>window.location.href = '/?g=MasterUser';</script>";
        } else {
            echo "<script>window.location.href = '/?';</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | File User</title>
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
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
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
                    <a href="?g=MasterUser">Account Perusahaan</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <form action="" method="post">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well">
                             <h2><i class="glyphicon glyphicon-file"></i> New Account Perusahaan</h2>
                            <div class="box-icon">
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <div class="form-group has-success">
                                <label class="control-label">Perusahaan</label>
                                <input type="text" class="form-control input-sm" name="perusahaan" required>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Kode</label>
                                <input type="text" class="form-control input-sm" name="kode" required>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Alamat</label>
                                <input type="text" class="form-control input-sm" name="alamat" required>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Berpajak</label>
                                 <select class="form-control input-sm"  name="pajak" required>
                                    <option value="" disabled selected></option>
                                    <option value="PPN 10%">Ya</option>
                                    <option value="Non PPN">Tidak</option>
                                </select>
                            </div>
                            <button  class="btn btn-default" name="submit" type="submit">Submit</button>                    
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
                                    <th>Perusahaan</th>
                                    <th>Kode</th>
                                    <th>Alamat</th>
                                    <th>Pajak</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        include_once 'database/connection.php';
                                        $dataDok = mysql_query("SELECT * FROM perusahaan");
                                        $no = 1;
                                        while ($fetchDataDok = mysql_fetch_array($dataDok)){
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $fetchDataDok['perusahaan']; ?></td>
                                            <td><?php echo $fetchDataDok['kode']; ?></td>
                                            <td><?php echo $fetchDataDok['alamat']; ?></td>
                                            <td><?php 
                                                    if($fetchDataDok['vat'] == "PPN 10%"){
                                                        echo "Ya";
                                                    }else{
                                                        echo "Tidak";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="#" data-toggle="modal" data-target="#myModal<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label label-success btn-setting">Edit</span></a>
                                                <a href="?g=DeleteMasterUser&id=<?php echo $fetchDataDok['id']; ?>">
                                                    <span class="label label-danger">Delete</span></a>
                                            </td>
                                        </tr>

                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $fetchDataDok['id']; ?>" role="dialog">
                <form role="form" action="?g=EditMasterUser" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                    <h3>Edit User</h3>
                                </div>
                                <div class="modal-body">
                                        <?php
                                            $id = $fetchDataDok['id']; 
                                            $query_edit = mysql_query("SELECT * FROM perusahaan WHERE id='$id'");
                                            while ($row = mysql_fetch_array($query_edit)) {  
                                        ?>
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <p>
                                            <label class="control-label">Perusahaan</label>
                                            <input type="text" class="form-control input-sm" name="perusahaan" value="<?php echo $row['perusahaan']; ?>" required>
                                        </p>
                                        <p>
                                            <label class="control-label">Kode</label>
                                            <input type="text" class="form-control input-sm" name="kode" value="<?php echo $row['kode']; ?>" required>
                                        </p>
                                        <p>
                                            <label class="control-label">Alamat</label>
                                            <input type="text" class="form-control input-sm" name="alamat" value="<?php echo $row['alamat']; ?>" required>
                                        </p>
                                        <p>
                                            <label class="control-label">Pajak</label>
                                            <select class="form-control input-sm"  name="pajak" required>
                                                <option value="" disable selected><?php 
                                                    if($fetchDataDok['vat'] == "PPN 10%"){
                                                        echo "Ya";
                                                    }else{
                                                        echo "Tidak";
                                                    }
                                                ?></option>
                                                <option value="PPN 10%">Ya</option>
                                                <option value="Non PPN">Tidak</option>
                                            </select>
                                        </p>                                        
                                </div>
                                <div class="modal-footer">  
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                        </div>
                    </div>
                    <?php } ?>
                </form>
                </div>
                <!-- End Modal -->
                                    <?php } ?>
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