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
} else {
    echo "<script>window.location.href = '/?';</script>";
}
?>
<?php
include_once 'database/connection.php';
$id = $_GET['id'];
$dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE id='$id'");
if (mysql_num_rows($dataDok) == 0) {
    echo '<script>window.history.back()</script>';
} else {
    $fetchDataDok = mysql_fetch_assoc($dataDok);
}
?>
<?php
include_once 'database/connection.php';
$id = $_GET['id'];
$dataDRembust = mysql_query("SELECT sum(Dana_Rembust) AS Dana_Rembust FROM rembust WHERE id_order='$id' AND SUBSTR(Order_ID,1,2) = 'PO'");
if (mysql_num_rows($dataDRembust) == 0) {
    echo '<script>window.history.back()</script>';
} else {
    $fetchDataRembust = mysql_fetch_assoc($dataDRembust);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | All Rembust</title>
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

        $(document).ready(function() {
            // Format mata uang.
            $('.uang').mask('000.000.000', {
                reverse: true
            });

        })
    </script>

<body>
    <div class="row">
        <div class="col-sm-4">
            <table class="table bootstrap-datatable table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>:</th>
                        <th><?php echo $fetchDataDok['order_id'] . $fetchDataDok['noUrut']; ?></th>
                    </tr>
                    <tr>
                        <th>Total Rembust</th>
                        <th>:</th>
                        <th><?php echo number_format($fetchDataRembust['Dana_Rembust']); ?></th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    include_once 'database/connection.php';
                    $id = $_GET['id'];

                    $dataDok = mysql_query("SELECT * FROM rembust WHERE id_order = '$id' AND SUBSTR(Order_ID,1,2) = 'PO' ORDER BY id ASC");
                    while ($fetchDataDok = mysql_fetch_array($dataDok)) {
                        ?>
                    <tr>
                        <td>Tgl Request</td>
                        <td>:</td>
                        <td><a href="?g=EditRembust&id=<?php echo $fetchDataDok['id']; ?>" type="hidden"><?php echo $fetchDataDok['Tgl_request'] ?></a></td>
                        <td><a href="?g=DeleteRembust&id=<?php echo $fetchDataDok['id']; ?>" type="hidden"><span class="glyphicon glyphicon-trash red"></span></a></a></td>
                    </tr>
                    <tr>
                        <td>Rembust</td>
                        <td>:</td>
                        <td><?php echo $fetchDataDok['RembustID'] ?></td>
                    </tr>
                    <tr>
                        <td>Site</td>
                        <td>:</td>
                        <td><?php echo $fetchDataDok['Site'] ?></td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td><?php echo $fetchDataDok['Deskripsi'] ?></td>
                    </tr>
                    <tr>
                        <td>Dana Rembust</td>
                        <td>:</td>
                        <td><?php echo number_format($fetchDataDok['Dana_Rembust']); ?></td>
                    </tr>
                    <tr>
                        <td>Kas</td>
                        <td>:</td>
                        <td><?php echo $fetchDataDok['Kas'] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>
        </div>
    </div>

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