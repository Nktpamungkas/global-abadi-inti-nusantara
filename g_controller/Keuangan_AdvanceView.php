<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
    
    if (isset($_POST['submit'])) {
        include_once 'database/connection.php';
        $tgl = $_POST['tgl'];
        $dk = $_POST['dk'];
        $nominal = $_POST['nominal'];
        $nominal2= str_replace(".", "", $nominal);
        $account = $_POST['account'];
        $keterangan = $_POST['keterangan'];

        if ($dk == "D") {
            $saveFolder = mysql_query("INSERT INTO kasbank(account,bank,tgl,debit,kredit,keterangan) VALUES('$account','ADV','$tgl','$nominal2','0','$keterangan')");
                
            if($saveFolder) {
                echo "<script>window.location.href = '/?g=Keuangan_Advance';</script>";
            } else {
                echo "QUERY ERROR DEBIT";
            }
        }elseif ($dk == "K") {
            $saveFolder = mysql_query("INSERT INTO kasbank(account,bank,tgl,debit,kredit,keterangan) VALUES('$account','ADV','$tgl','0','$nominal2','$keterangan')");
            // menampilkan id desc dari kasbank
            $query = "SELECT * FROM kasbank ORDER BY id DESC LIMIT 1";
            $mysql = mysql_query($query);
            $assoc = mysql_fetch_assoc($mysql);
            echo $idkasbank = $assoc['id'];

            // masuk ke kas besar sebagai DEBIT
            $saveToKasKecil = mysql_query("INSERT INTO kasbesar(id_kasbank,account,bank,uraian,tgl,debit,kredit,keterangan) 
            VALUES('$idkasbank','$account','ADV','$keterangan','$tgl','$nominal2','0','ADV')");
                
            if($saveFolder AND $saveToKasKecil) {
                echo "<script>window.location.href = '/?g=Keuangan_Advance';</script>";
            } else {
                echo "QUERY ERROR KREDIT";
            }
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
    <title>GAIN Satellite Web Apps | Kas Advance</title>
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
    <script src="dist/jquery.mask.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
 
                // Format mata uang.
                $( '.uang' ).mask('000.000.000', {reverse: true});
 
            })
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
                <a href="?g=Keuangan_Advance">Kas BNI</a>
            </li>
        </ul>
    </div>
        
        <div class="row">
            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-content">
                        <form action="" method="post">
                            <div class="form-group has-success">
                                <label class="control-label">Tanggal</label>
                                <input type="Date" class="form-control input-sm" name="tgl">
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Account</label>
                                <?php
                                    include_once 'database/connection.php';

                                        echo "<select name='account' class='form-control input-sm' required>";
                                        $tampil=mysql_query("SELECT * FROM account_kasbank WHERE bank = 'KA' ORDER BY id");
                                        echo "<option value='' disabled selected>Pilih User</option>";

                                        while($w=mysql_fetch_array($tampil))
                                        {
                                            echo "<option value='".$w[account]."'>$w[account] - $w[uraian]</option>";        
                                        }
                                         echo "</select>";
                                ?>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label" for="inputSuccess1">Debit / Kredit</label>
                                <select class="form-control input-sm" name="dk" required>
                                    <option value="" disabled selected></option>
                                    <option value="D">Debit</option>
                                    <option value="K">Kredit</option>
                                </select>
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Nominal</label>
                                <input type="text" class="form-control input-sm uang" name="nominal" placeholder="Kalo kas BANK semua yg kebawah masuk sebagai kredit, kas besar masuk sebagai debit">
                            </div>
                            <div class="form-group has-success">
                                <label class="control-label">Keterangan</label>
                                <input type="text" class="form-control input-sm" name="keterangan">
                            </div>
                           <button  class="btn btn-submit" name="submit" type="submit">Submit</button>                    
                        </form> 
                    </div>
                </div>
            </div>
            
            <div class="box col-md-12">
                <a href="?g=Export_Advance" class="btn btn-success btn-sm" target="BLANK">Export To Excel</a>
            </div>

            <div class="box col-md-12">
                <div class="box-inner">
                    <div class="box-content">
                        <table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th width="100">Tanggal</th>
                                    <th width="100">Kode</th>
                                    <th width="200">Uraian</th>
                                    <th width="100">Debit</th>
                                    <th width="100">Kredit</th>
                                    <th width="100">Saldo</th>
                                    <th width="200">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include_once 'database/connection.php';
                                $dataDok = mysql_query("SELECT * from kasbank WHERE bank='ADV' ORDER BY id ASC");
                                $no = 1;
                                while ($fetchDataDok = mysql_fetch_array($dataDok)){
                                echo "<tr>";
                                    echo "<td>$no</td>";
                                    echo "<td>".$fetchDataDok['tgl']."</td>";
                                    echo "<td>".$fetchDataDok['account']."</td>";
                                    echo '<td>';
                                            $akun = $fetchDataDok['account'];
                                            $query = mysql_query("SELECT * FROM account_kasbank WHERE account = '$akun'");
                                            $data = mysql_fetch_array($query);

                                            if($data['uraian']){
                                                echo $data['uraian'];
                                            }else{
                                                echo $fetchDataDok['uraian'];
                                            }
                                        '</td>';
                                    if ($no==1) {
                                        // Pertama Kali Deklarasi Debit
                                        echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                                        echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                                        $debit = $fetchDataDok['debit'];
                                        $saldo = $fetchDataDok['debit'];
                                        echo "<td>".number_format($saldo)."</td>";
                                    }else{
                                        if ($fetchDataDok['debit'] != 0) {
                                            // Jika debit tidak sama dengan 0
                                            echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                                            echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                                            $debit = $debit + $fetchDataDok['debit'];
                                            $saldo = $saldo + $fetchDataDok['debit'];
                                            echo "<td>".number_format($saldo)."</td>";
                                        }else{
                                            // Jika debit sama dengan 0
                                                echo "<td>".number_format($fetchDataDok['debit'])."</td>";
                                                echo "<td>".number_format($fetchDataDok['kredit'])."</td>";
                                                $kredit = 0;
                                                $kredit = $kredit + $fetchDataDok['kredit'];
                                                $saldo = $saldo - $fetchDataDok['kredit'];
                                                echo "<td>".number_format($saldo)."</td>";
                                        }
                                    }
                                echo "<td>".$fetchDataDok['keterangan']."</td>";
                                echo "</tr>";
                                $no++;                                
                                }
                            ?>
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

