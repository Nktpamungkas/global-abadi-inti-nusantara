<?php
if (isset($_SESSION['userId'])) {
    // Sessi Ada
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);

    if ($fetchDataUserBySesion['jabatan'] == "C" || $fetchDataUserBySesion['jabatan'] == "MO"){
        echo "<script>window.location.href = '/?';</script>";
    }
} else {
    echo "<script>window.location.href = '/?';</script>";	
}
?>
<?php

    if(isset($_POST['submit'])){
        include_once 'database/connection.php';

        $id_invoice = $_POST['id_invoice'];
        $no_kuitansi = $_POST['no_kuitansi'];
        $pembayaran = $_POST['pembayaran'];

        $update = mysql_query("UPDATE invoice SET status_kuitansi = 'YES' WHERE id = '$id_invoice'");

        $save = mysql_query("INSERT INTO kuitansi_invoice (id_invoice, no_kuitansi, pembayaran) VALUES ('$id_invoice', '$no_kuitansi' ,'$pembayaran')");

        if ($save && $update) {
            echo "<script>window.location.href = '/?g=Invoice';</script>";
        } else {
            echo "<script>window.location.href = '/?g=Error';</script>";
        }
    } elseif(isset($_POST['submitR'])){
        include_once 'database/connection.php';

        $id_invoice_rembust = $_POST['id_invoice_rembust'];
        $no_kuitansi = $_POST['no_kuitansi'];
        $pembayaran = $_POST['pembayaran'];

        $update = mysql_query("UPDATE invoice_rembust SET status_kuitansi = 'YES' WHERE id = '$id_invoice_rembust'");

        $save = mysql_query("INSERT INTO kuitansi_invoice_rembust (id_invoice_rembust, no_kuitansi, pembayaran) VALUES ('$id_invoice_rembust', '$no_kuitansi' ,'$pembayaran')");

        if ($save && $update) {
            echo "<script>window.location.href = '/?g=InvoiceRembust';</script>";
        } else {
            echo "<script>window.location.href = '/?g=Error';</script>";
        }
    } elseif(isset($_POST['submitPO'])){
        include_once 'database/connection.php';

        $id_invoice_po = $_POST['id_invoice_po'];
        $no_kuitansi = $_POST['no_kuitansi'];
        $pembayaran = $_POST['pembayaran'];

        $update = mysql_query("UPDATE invoice_po SET status_kuitansi = 'YES' WHERE id = '$id_invoice_po'");

        $save = mysql_query("INSERT INTO kuitansi_invoice_po (id_invoice, no_kuitansi, pembayaran) VALUES ('$id_invoice_po', '$no_kuitansi' ,'$pembayaran')");

        if ($save && $update) {
            echo "<script>window.location.href = '/?g=InvoicePO';</script>";
        } else {
            echo "<script>window.location.href = '/?g=Error';</script>";
        }
    } elseif(isset($_POST['submitRPO'])){
        include_once 'database/connection.php';

        $id_invoice_rembust_po = $_POST['id_invoice_rembust_po'];
        $no_kuitansi = $_POST['no_kuitansi'];
        $pembayaran = $_POST['pembayaran'];

        $update = mysql_query("UPDATE invoice_rembust_po SET status_kuitansi = 'YES' WHERE id = '$id_invoice_rembust_po'");

        $save = mysql_query("INSERT INTO kuitansi_invoice_po_rembust (id_invoice_rembust, no_kuitansi, pembayaran) VALUES ('$id_invoice_rembust_po', '$no_kuitansi' ,'$pembayaran')");

        if ($save && $update) {
            echo "<script>window.location.href = '/?g=InvoiceRembustPO';</script>";
        } else {
            echo "<script>window.location.href = '/?g=Error';</script>";
        }
    } 
?>