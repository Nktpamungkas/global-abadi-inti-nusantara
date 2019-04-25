<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
    $fetchDataDok = mysql_fetch_assoc($dataDok);   
?>
<?php
    include_once 'database/connection.php';
    $id = $_GET['id'];
    $dataHasilKerja = mysql_query("SELECT * FROM hasil_kerja_po WHERE id_order='$id'");
    $fetchDataHasilKerja = mysql_fetch_assoc($dataHasilKerja);   
?>
<?php
if(isset($_POST['submit'])){
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $order_id = $_POST['order_id'];
    $site = $_POST['site'];
    $teknisi = $_POST['teknisi'];
    $NoHp = $_POST['NoHp'];
    $jenispekerjaan = $_POST['jenispekerjaan'];
    $snmodem = $_POST['snmodem'];
    $adaptor = $_POST['adaptor'];
    $snrft_lama = $_POST['snrft_lama'];
    $snrft_baru = $_POST['snrft_baru'];
    $snlnb = $_POST['snlnb'];
    $cn = $_POST['cn'];
    $cpi = $_POST['cpi'];
    $asi = $_POST['asi'];
    $satelit = $_POST['satelit'];
    $Pengukuranlistrik = $_POST['Pengukuranlistrik'];
    $mountaningantena = $_POST['mountaningantena'];
    $pic_noc = $_POST['pic_noc'];
    $pic_telkom = $_POST['pic_telkom'];
    $tgl_pekerjaan = $_POST['tgl_pekerjaan'];
    $keterangan_pekerjaan = $_POST['keterangan_pekerjaan'];
    $status_pekerjaan = $_POST['status_pekerjaan'];

    $saveFolder = mysql_query("INSERT INTO hasil_kerja_po(id_order,order_id,lokasi,teknisi,no_hp,jenis_pekerjaan,sn_modem,adaptor,sn_rft_lama,sn_rft_baru,sn_lnb,hasil_xpoll_cn,hasil_xpoll_cpi,hasil_xpoll_asi,hasil_xpoll_satelit,pengukuran_listrik,mounting_antena,pic_noc,pic_telkom,tgl_pekerjaan,keterangan_pekerjaan,status_pekerjaan) VALUES('$id','$order_id','$site','$teknisi','$NoHp','$jenispekerjaan','$snmodem','$adaptor','$snrft_lama','$snrft_baru','$snlnb','$cn','$cpi','$asi','$satelit','$Pengukuranlistrik','$mountaningantena','$pic_noc','$pic_telkom','$tgl_pekerjaan','$keterangan_pekerjaan','$status_pekerjaan')") or die(mysql_error());
    $hasilkerja = mysql_query("UPDATE tbl_order_po SET Opsi = 'Edit Hasil Kerja', sr_number='SR Number', status_srnumber = '1' WHERE id = '$id'");
    if($saveFolder && $hasilkerja) {
        echo "<script>window.location.href = '/?g=LapHasilKerjaPO';</script>";
        $pesanError = 'Berhasil menginput hasil kerja, silahkan kembali.';
    } else {
        $pesanError = 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
        echo 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query. ';
    }
} elseif (isset($_POST['edit'])){
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $order_id = $_POST['order_id'];
    $site = $_POST['site'];
    $teknisi = $_POST['teknisi'];
    $NoHp = $_POST['NoHp'];
    $jenispekerjaan = $_POST['jenispekerjaan'];
    $snmodem = $_POST['snmodem'];
    $adaptor = $_POST['adaptor'];
    $snrft_lama = $_POST['snrft_lama'];
    $snrft_baru = $_POST['snrft_baru'];
    $snlnb = $_POST['snlnb'];
    $cn = $_POST['cn'];
    $cpi = $_POST['cpi'];
    $asi = $_POST['asi'];
    $satelit = $_POST['satelit'];
    $Pengukuranlistrik = $_POST['Pengukuranlistrik'];
    $mountaningantena = $_POST['mountaningantena'];
    $pic_noc = $_POST['pic_noc'];
    $pic_telkom = $_POST['pic_telkom'];
    $tgl_pekerjaan = $_POST['tgl_pekerjaan'];
    $keterangan_pekerjaan = $_POST['keterangan_pekerjaan'];
    $status_pekerjaan = $_POST['status_pekerjaan'];

    $Update = mysql_query("UPDATE hasil_kerja_po SET lokasi = '$lokasi',
                                                  teknisi = '$teknisi',
                                                  no_hp = '$NoHp',
                                                  jenis_pekerjaan = '$jenispekerjaan',
                                                  sn_modem = '$snmodem',
                                                  adaptor = '$adaptor',
                                                  sn_rft_lama = '$snrft_lama',
                                                  sn_rft_baru = '$snrft_baru',
                                                  sn_lnb = '$sn_lnb',
                                                  hasil_xpoll_cn = '$cn',
                                                  hasil_xpoll_cpi = '$cpi',
                                                  hasil_xpoll_asi = '$asi',
                                                  hasil_xpoll_satelit = '$satelit',
                                                  pengukuran_listrik = '$Pengukuranlistrik',
                                                  mounting_antena = '$mountaningantena',
                                                  pic_noc = '$pic_noc',
                                                  pic_telkom = '$pic_telkom',
                                                  tgl_pekerjaan = '$tgl_pekerjaan',
                                                  keterangan_pekerjaan = '$keterangan_pekerjaan',
                                                  status_pekerjaan = '$status_pekerjaan'
                                            WHERE id_order ='$id'") or die(mysql_error());
    if($Update){
        echo "<script>window.location.href = '/?g=LapHasilKerjaPO';</script>";
        $pesanError = 'Berhasil mengubah hasil kerja, silahkan kembali.';
    }else{
        $pesanError = 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query.';
        echo 'Jika terjadi kesalahan, mohon untuk TIDAK merefresh halaman tersebut. Hub. Development! Kesalahan Syntax Query. ';
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
    <script src="dist/jquery.mask.min.js"></script>
    
    <link rel="shortcut icon" href="img/gain.png">
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function onload() {
        $("#datas").load("?p=data&id=1");
    }
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
                    <a href="?g=FinishOrder">Finish Order</a>
                </li>
                <li>
                    <a href="#">Hasil Kerja</a>
                </li>
            </ul>
        </div>

        <div class="row">
    <div class="box col-md-9">
        
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Hasil Kerja : <?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?></h2>
            </div>
            <div class="box-content">
                <center><u>
                    <?php
                        if (isset($pesanError)) {
                            echo '<b style=color:red>' . $pesanError . '</b>';
                        }
                    ?>
                </u></center>
                <form role="form" action="" method="POST">
                    <div class="form-group has-success">
                        <label class="control-label">Lokasi</label>
                        <input type="hidden" name="id" value="<?php echo $fetchDataDok['id']; ?>">
                        <input type="hidden" name="order_id" value="<?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?>">
                        <input type="text" class="form-control input-sm" name="site" value="<?php echo $fetchDataDok['site']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Teknisi</label>
                        <input type="text" class="form-control input-sm" name="teknisi" value="<?php echo $fetchDataDok['teknisi']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">No HP</label>
                        <input type="text" class="form-control input-sm" name="NoHp" value="<?php 
                        	$natek = $fetchDataDok['teknisi']; 

                        	$query = "SELECT * FROM teknisi WHERE teknisi = '$natek'";
                        	$mysql = mysql_query($query);
                        	$array = mysql_fetch_array($mysql);
                        	echo $data = $array['no_hp'];
                        ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Jenis Pekerjaan</label>
                        <input type="text" class="form-control input-sm" name="jenispekerjaan" value="<?php echo $fetchDataHasilKerja['jenis_pekerjaan']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">SN Modem</label>
                        <input type="text" class="form-control input-sm" name="snmodem" value="<?php echo $fetchDataHasilKerja['sn_modem']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">SN Adaptor</label>
                        <input type="text" class="form-control input-sm" name="adaptor" value="<?php echo $fetchDataHasilKerja['adaptor']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">SN RFT</label>
                        <input type="text" class="form-control input-sm" name="snrft_lama" value="<?php echo $fetchDataHasilKerja['sn_rft_lama']; ?>">
                        <input type="text" class="form-control input-sm" name="snrft_baru" value="<?php echo $fetchDataHasilKerja['sn_rft_baru']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">SN LNB</label>
                        <input type="text" class="form-control input-sm" name="snlnb" value="<?php echo $fetchDataHasilKerja['sn_lnb']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Hasil Xpoll</label>
                        <input type="text" class="form-control input-sm" name="c/n" placeholder="c/n" value="<?php echo $fetchDataHasilKerja['hasil_xpoll_cn']; ?>">
                        <input type="text" class="form-control input-sm" name="cpi" placeholder="cpi" value="<?php echo $fetchDataHasilKerja['hasil_xpoll_cpi']; ?>">
                        <input type="text" class="form-control input-sm" name="asi" placeholder="asi" value="<?php echo $fetchDataHasilKerja['hasil_xpoll_asi']; ?>">
                        <input type="text" class="form-control input-sm" name="satelit" placeholder="satelit" value="<?php echo $fetchDataHasilKerja['hasil_xpoll_satelit']; ?>">
                    </div>

                    <div class="form-group has-success">
                        <label class="control-label">Pengukuran Listrik</label>
                        <input type="text" class="form-control input-sm" name="Pengukuranlistrik" value="<?php echo $fetchDataHasilKerja['pengukuran_listrik']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">Mounting Antena</label>
                        <input type="text" class="form-control input-sm" name="mountaningantena" value="<?php echo $fetchDataHasilKerja['mounting_antena']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">PIC NOC</label>
                        <input type="text" class="form-control input-sm" name="pic_noc" value="<?php echo $fetchDataHasilKerja['pic_noc']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">PIC Telkom</label>
                        <input type="text" class="form-control input-sm" name="pic_telkom" value="<?php echo $fetchDataHasilKerja['pic_telkom']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">Tgl Pekerjaan</label>
                        <input type="date" class="form-control input-sm" name="tgl_pekerjaan" value="<?php echo $fetchDataHasilKerja['tgl_pekerjaan']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">Keterangan Pekerjaan</label>
                        <input type="text" class="form-control input-sm" name="keterangan_pekerjaan" value="<?php echo $fetchDataHasilKerja['keterangan_pekerjaan']; ?>">
                    </div>

                     <div class="form-group has-success">
                        <label class="control-label">Status Pekerjaan</label>
                        <input type="text" class="form-control input-sm" name="status_pekerjaan" value="Done" value="<?php echo $fetchDataHasilKerja['status_pekerjaan']; ?>">
                    </div>

                    <?php
                        if (isset($fetchDataDok['opsi'])) {
                            if ($fetchDataDok['opsi'] == "Hasil Kerja") {
                                echo '<button class="btn btn-primary" name="submit" type="submit">Simpan</button>';
                            } else {
                                echo '<button class="btn btn-primary" name="edit" type="submit">Ubah Data</button>';
                            }
                        }
                    ?>
                    <a href="?g=FinishOrder" class="btn btn-default">Kembali</a>
                </form>                   
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

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

        <?php include_once 'footer.php'; ?>

</div><!--/.fluid-container-->

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