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

                    <!-- ------------------------------------------------------------------------------------------------------------ -->
                    <!-- ------------------------------------------------------------------------------------------------------------ -->
                    <!-- START ORDER RETAILS -->
                    <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i><span> Order Retails</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=Order">Tambah Order Retails</a></li>
                        <?php 
                    } ?>
                        <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO" || $fetchDataUserBySesion['jabatan'] == "C") { ?>
                        <li><a href="?g=ProgressOrder">Progress Order Retails</a></li>
                        <li><a href="?g=FinishOrder">Finish Order Retails</a></li>
                        <?php 
                    } ?>
                        <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END ORDER RETAILS -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START ORDER PO -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i><span> Order PO</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=OrderPO">Tambah Order PO</a></li>
                        <?php 
                    } ?>
                        <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO" || $fetchDataUserBySesion['jabatan'] == "C") { ?>
                        <li><a href="?g=ProgressOrderPO">Progress Order PO</a></li>
                        <li><a href="?g=FinishOrderPO">Finish Order PO</a></li>
                        <?php 
                    } ?>
                        <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END ORDER PO -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START HASIL KERJA -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO" || $fetchDataUserBySesion['jabatan'] == "C") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-file"></i><span> Laporan</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=LapHasilKerja"><span> Hasil Kerja Retail</span></a></li>
                        <li><a href="?g=LapHasilKerjaPO"><span> Hasil Kerja PO</span></a></li>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END HASIL KERJA -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START INVOICE RETAILS -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MK" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-book"></i><span> Invoice Retails</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=NewInvoice">Tambah Invoice</a></li>
                        <li><a href="?g=invoice">Data Invoice</a></li>
                        <li><a href="?g=invoiceRembust">Data Rembust</a></li>
                        <li><a href="?g=invoiceTerbayar">Data Invoice Terbayar</a></li>
                        <li><a href="?g=invoiceRembustTerbayar">Data Rembust Terbayar</a></li>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END INVOICE RETAILS -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START INVOICE PO -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MK" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-book"></i><span> Invoice PO</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=NewInvoicePO">Tambah Invoice PO</a></li>
                        <li><a href="?g=invoicePO">Data Invoice PO</a></li>
                        <li><a href="?g=invoiceRembustPO">Data Rembust PO</a></li>
                        <li><a href="?g=invoiceTerbayarPO">Data Invoice Terbayar PO</a></li>
                        <li><a href="?g=invoiceRembustTerbayarPO">Data Rembust Terbayar PO</a></li>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END INVOICE PO -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START KUITANSI RETAILS & PO -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MK" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-book"></i><span> Kuitansi</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=KwitansiR">Kuitansi Retails</a></li>
                        <li><a href="?g=KwitansiRR">Kuitansi Rembust Retails</a></li>
                        <li><a href="?g=KwitansiPO">Kuitansi PO</a></li>
                        <li><a href="?g=KwitansiRPO">Kuitansi Rembust PO</a></li>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END KUITANSI RETAILS & PO-->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START KEUANGAN -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MK") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-tasks"></i><span> Keuangan</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="?g=ApproveR">Approve</a></li>
                        <!-- <li><a href="?g=ApprovePO">Approve PO</a></li> -->
                        <li><a href="?g=Keuangan_KasKecil1">Kas Kecil 1</a></li>
                        <li><a href="?g=Keuangan_KasKecil2">Kas Kecil 2</a></li>
                        <li><a href="?g=Keuangan_KasBesar">Kas Besar</a></li>
                        <li><a href="?g=Keuangan_BRI">BRI</a></li>
                        <li><a href="?g=Keuangan_BCA">BCA</a></li>
                        <li><a href="?g=Keuangan_BNI">BNI</a></li>
                        <li><a href="?g=Keuangan_MNC">MNC</a></li>
                        <li><a href="?g=Keuangan_Advance">Kas Advance</a></li>
                    </ul>
                </li>
                <?php 
            } ?>
                <!-- END KEUANGAN -->

                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- ------------------------------------------------------------------------------------------------------------ -->
                <!-- START ACCOUNT -->
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MK") { ?>
                <li class="accordion">
                    <a href="#"><i class="glyphicon glyphicon-book"></i><span> Account</span></a>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="?g=Account_kasbank">Keuangan</a>
                        </li>
                </li>
                <?php 
            } ?>
                <!-- START ACCOUNT -->
            </ul>
        </div>
    </div>
</div> 