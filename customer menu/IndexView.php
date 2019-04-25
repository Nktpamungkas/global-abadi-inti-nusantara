<?php
if (isset($_SESSION['userId'])) {
    // Sesi Ada
    echo "<script>window.location.href = '/?g=dashboard';</script>";
} else {
    // Sesi Tidak Ada
    if (isset($_POST['submit'])) {

        if (empty($_POST['namaTxt']) || empty($_POST['passTxt'])) {

            $pesanError = 'Please fill the field';
        } else {
            include_once 'g_controller/database/connection.php';
            $nama = $_POST['namaTxt'];
            $pas = $_POST['passTxt'];
            $cekData = mysql_query("SELECT * FROM staff WHERE nama = '$nama' AND `password` = '$pas' AND jabatan = 'C'");
            $cekAda = mysql_num_rows($cekData);

            if ($cekAda) {
                date_default_timezone_set('Asia/Jakarta');
                $dateLogin = date("Y-m-d H:i:s");

                $cekLog = mysql_query("SELECT * FROM staff WHERE nama = '$nama' AND `password` = '$pas' AND `status` = 'Log out'");
                $cek = mysql_query("SELECT IF( login_date > logout_date, 'masuk', 'keluar' ) AS `log` FROM staff WHERE nama = '$nama' AND `password` = '$pas' AND `status` = 'Login'");
                $cek_fetch = mysql_fetch_assoc($cek);
                $cekAdaLog = mysql_num_rows($cekLog);

                if ($cekAdaLog || $cek_fetch['log'] == "masuk") {
                    $dataUser = mysql_fetch_array($cekData);
                    // set Sesi
                    $_SESSION['userId'] = $dataUser['id_staff'];
                    $_SESSION['nama'] = $dataUser['nama'];
                    $_SESSION['privillage'] = $dataUser['jabatan'];
                    mysql_query("UPDATE staff SET `status` = 'Login', class = 'label-success label label-default', login_date = '$dateLogin' WHERE id_staff = '$dataUser[id_staff]' ");
                    echo "<script>window.location.href = '/?g=index';</script>";
                } else {
                    $pesanError = 'Account is being used. Please account other!';
                }
            } else {
                $pesanError = 'Name and Password not Match';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GAIN Satellite Web Apps | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
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

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/gain.png">

</head>

<body>
    <div class="ch-container">
        <div class="row">

            <div class="row">
                <div class="col-md-12 center login-header">
                    <h2>Welcome to GAIN Satellite Web Apps</h2>
                </div>
                <!--/span-->
            </div>
            <!--/row-->

            <div class="row">
                <div class="well col-md-5 center login-box">
                    <?php
                    if (isset($pesanError)) {
                        echo '<div class="alert alert-danger">' . $pesanError . '</div>';
                    } else {
                        echo '<div class="alert alert-info">Please login with your Username and Password.</div>';
                    }
                    ?>
                    <form class="form-horizontal" action="" method="post">
                        <fieldset>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                                <input class="form-control" placeholder="Username" name="namaTxt" type="text" autofocus="">
                            </div>
                            <div class="clearfix"></div><br>

                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                                <input class="form-control" placeholder="Password" name="passTxt" type="password">
                            </div>
                            <div class="clearfix"></div>

                            <div class="clearfix"></div>

                            <p class="center col-md-5">
                                <button class="btn btn-primary" type="submit" name="submit">Login</button>
                            </p>
                        </fieldset>
                    </form>
                </div>
                <!--/span-->
            </div>
            <!--/row-->
        </div>
        <!--/fluid-row-->

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