<?php
if (isset($_POST['submit'])) {
    include_once 'g_controller/database/connection.php';
    date_default_timezone_set('Asia/Jakarta');
    $dateLogout = date("Y-m-d H:i:s");

    $q_logout = mysql_query("UPDATE staff SET `status` = 'Log out', class = 'label-default label label-danger', logout_date = '$dateLogout' WHERE id_staff = '$fetchDataUserBySesion[id_staff]' AND jabatan = 'C'");
    if ($q_logout) {
        echo "<script>window.location.href = '/?g=out';</script>";
    } else {
        echo "<script>window.location.href = '/?g=Dashboard';</script>";
    }
}
?>
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">
        <button type="button" class="navbar-toggle pull-left animated flip">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="?g=dashboard"> <img src="img/gain.png" class="hidden-xs" />
            <span>Gain</span></a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default">
                <i class="glyphicon glyphicon-user"></i>
                <span class="hidden-sm hidden-xs">
                    <?= strtoupper($fetchDataUserBySesion['nama']); ?>
                </span>
            </button>
        </div>
        <div class="btn-group pull-right">
            <form action="" method="post">
                <input type="hidden" name="id_staff" value="<?= $fetchDataUserBySesion['id_staff']; ?>">
                <button class="btn btn-default btn-danger" type="submit" name="submit">
                    <i class="glyphicon glyphicon-off"></i>
                    <span class="hidden-sm hidden-xs">
                        Logout
                    </span>
                </button>
            </form>
        </div>
        <!-- user dropdown ends -->

        <!-- theme selector starts -->
        <!-- <div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div> -->
        <!-- theme selector ends -->
        <?php if ($fetchDataUserBySesion['jabatan'] == "SA") { ?>
        <ul class="collapse navbar-collapse nav navbar-nav top-menu">
            <li class="dropdown">
                <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> File Master <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="?g=MasterCustomer">Customer</a></li>
                    <li><a href="?g=MasterJob">Job</a></li>
                    <li><a href="?g=MasterSystem">System</a></li>
                    <li><a href="?g=MasterArea">Location/Area</a></li>
                    <li><a href="?g=MasterTeknisi">Teknisi</a></li>
                    <li><a href="?g=MasterUser">User</a></li>
                    <li><a href="?g=MasterBank">Bank</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Privilage</a></li>
                    <li><a href="?g=MasterUsers">Users</a></li>
                </ul>
            </li>
        </ul>
        <?php 
    } ?>
    </div>
</div> 