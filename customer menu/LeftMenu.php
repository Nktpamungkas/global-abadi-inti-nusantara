<?php
$idStaff = $_SESSION['userId'];
include_once 'database/connection.php';
$dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
$fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
?>
<div class="col-sm-2 col-lg-2">
    <div class="sidebar-nav">
        <div class="nav-canvas">
            <div class="nav-sm nav nav-stacked">

            </div>
            <ul class="nav nav-pills nav-stacked main-menu">
                <li class="nav-header">
                <li><a class="ajax-link" href="?g=dashboard"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                <li><a href="?g=ProgressOrder"><i class="glyphicon glyphicon-share"></i>&nbsp;&nbsp;Progress Order Retails</a></li>
                <li><a href="?g=ProgressOrderPO"><i class="glyphicon glyphicon-share"></i>&nbsp;&nbsp;Progress Order PO</a></li>

                <li><a href="?g=FinishOrder"><i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Finish Order Retails</a></li>
                <li><a href="?g=FinishOrderPO"><i class="glyphicon glyphicon-check"></i>&nbsp;&nbsp;Finish Order PO</a></li>

                <li><a href="?g=LapHasilKerja"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Hasil Kerja Retail</a></li>
                <li><a href="?g=LapHasilKerjaPO"><i class="glyphicon glyphicon-comment"></i>&nbsp;&nbsp;Hasil Kerja PO</a></li>

            </ul>
        </div>
    </div>
</div> 