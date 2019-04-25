<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
    if(mysql_num_rows($dataDok) == 0){
        echo '<script>window.history.back()</script>';
    }else{
        $fetchDataDok = mysql_fetch_assoc($dataDok);   
    }
?>
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

    if(isset($_POST['submit'])){
       include_once 'database/connection.php';
        $id = $_GET['id'];
        $orderidPO = $fetchDataDok['order_id'];
        $nourutPO = $fetchDataDok['noUrut'];
        $site = mysql_real_escape_string($_POST['site']);
        $startprogres = mysql_real_escape_string($_POST['startprogres']);
        $teknisi = mysql_real_escape_string($_POST['teknisi']);
        $DanaKontrak = mysql_real_escape_string($_POST['DanaKontrak']);
        $DanaKontrak2= str_replace(".", "", $DanaKontrak);

        $updateOrder = mysql_query("UPDATE tbl_order_po SET dana_kontrak = '$DanaKontrak2'
                                                    WHERE order_id = '$orderidPO' AND noUrut = '$nourutPO'") or die(mysql_error());
        if($updateOrder) {
            // alert("Berhasil input dana kontrak, silahkan kembali");
            $pesanSuccess = "Berhasil input dana kontrak, silahkan kembali";
            echo "<script>window.location.href = '/?g=ProgressOrderPO';</script>";
        } else {
            echo "QUERY ERROR";
        }
    }
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Detail Order PO</title>
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
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
 
            })
        </script>
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
                    <a href="?g=Order">Show/Edit Order PO</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-header well" data-original-title="">
                         <h2><i class="glyphicon glyphicon-shopping-cart"></i> Order PO : <?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?></h2>
                        <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                        </div>
                    </div>

                    <div class="box-content">
                        <form role="form" action="" method="post">
                                <div class="form-group has-success">
                                    <label class="control-label">PO</label>
                                    <select class="form-control input-sm" name="retails" disabled>
                                        <option value="" selected><?php echo $fetchDataDok['retails_po'];?></option>
                                        <option value="R">Retails</option>
                                        <option value="PO">PO</option>
                                    </select>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">User</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='user' selected='' class='form-control input-sm' disabled>";
                                        $tampil=mysql_query("SELECT * FROM perusahaan ORDER BY id");
                                        echo "<option value='$fetchDataDok[user]' selected>$fetchDataDok[user]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[kode]."'>$w[kode] - $w[perusahaan]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Customer</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='customer' class='form-control input-sm' disabled>";
                                        $tampil=mysql_query("SELECT * FROM customer ORDER BY id");
                                        echo "<option value='$fetchDataDok[customer]' selected>$fetchDataDok[customer]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[customer]."'>$w[customer] - $w[description]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Site</label>
                                    <input type="text" disabled class="form-control input-sm" name="site" value="<?php echo $fetchDataDok['site'];?>" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Job</label>
                                     <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='job' class='form-control input-sm' disabled>";
                                        $tampil=mysql_query("SELECT * FROM job ORDER BY id");
                                        echo "<option value='' disabled selected>$fetchDataDok[job]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[job]."'>$w[job] - $w[description]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">System</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='sistem' class='form-control input-sm' disabled>";
                                        $tampil=mysql_query("SELECT * FROM system ORDER BY id");
                                        echo "<option value='' disabled selected>$fetchDataDok[system]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[system]."'>$w[system] - $w[description]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Location/Area</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='area' class='form-control input-sm' disabled>";
                                        $tampil=mysql_query("SELECT * FROM area ORDER BY id");
                                        echo "<option value='' disabled selected>$fetchDataDok[area]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[area]."'>$w[area] - $w[description]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Teknisi</label>
                                    <?php
                                        include_once 'database/connection.php';

                                        echo "<select name='teknisi' disabled class='form-control input-sm' required>";
                                        $tampil=mysql_query("SELECT * FROM teknisi ORDER BY id");
                                        echo "<option value='$fetchDataDok[teknisi]' selected>$fetchDataDok[teknisi]</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[teknisi]."'>$w[teknisi]</option>";        
                                        }
                                         echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Start Progress</label>
                                    <input type="date" disabled class="form-control input-sm" name="startprogres" value="<?php echo $fetchDataDok['start_progress'];?>" required>
                                </div>
                                <div class="form-group has-success">
                                    <label class="control-label">Nilai Kontrak</label>
                                    <input type="text" class="form-control uang input-sm" name="DanaKontrak" value="<?php echo $fetchDataDok['dana_kontrak'];?>" required>
                                </div>

                                <button  class="btn btn-primary" name="submit" type="submit">Submit</button>
                                <a href="?g=ProgressOrderPO" class="btn btn-default">Back</a>
                                <?php
                                    if (isset($pesanSuccess)) {
                                        echo '<b style=color:red>' . $pesanSuccess . '</b>';
                                    }
                                ?>                    
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

