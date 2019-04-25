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
    include_once 'database/connection.php';

    $id = $_POST['id'];
    $tgl_terbayar = $_POST['tgl_terbayar'];
    $bank = $_POST['bank'];
    $customer_to = $_POST['customer_to'];
    $grand_total = $_POST['grand_total'];
    $grand_total2= str_replace(".", "", $grand_total);
    $noinvR = $_POST['noinvR'];

    //query update
    if ($bank == "BRI") {
        $queryBank = mysql_query("INSERT INTO kasbank(bank,id_invoice,account,uraian,tgl,debit,kredit,keterangan) 
                                        VALUES('BRI','$id','PAID','$customer_to','$tgl_terbayar','$grand_total2','0','$noinvR')");
    }elseif ($bank == "BNI") {
        $queryBank = mysql_query("INSERT INTO kasbank(bank,id_invoice,account,uraian,tgl,debit,kredit,keterangan) 
                                        VALUES('BNI','$id','PAID','$customer_to','$tgl_terbayar','$grand_total2','0','$noinvR')");   
    }elseif ($bank == "MNC") {
        $queryBank = mysql_query("INSERT INTO kasbank(bank,id_invoice,account,uraian,tgl,debit,kredit,keterangan) 
                                        VALUES('MNC','$id','PAID','$customer_to','$tgl_terbayar','$grand_total2','0','$noinvR')");   
    }elseif ($bank == "BCA") {
        $queryBank = mysql_query("INSERT INTO kasbank(bank,id_invoice,account,uraian,tgl,debit,kredit,keterangan) 
                                        VALUES('BCA','$id','PAID','$customer_to','$tgl_terbayar','$grand_total2','0','$noinvR')");   
    }else{
        echo "Kode Bank Tidak Ditemukan";
    }
        $query = mysql_query("UPDATE invoice_rembust_po SET tgl_terbayar = '$tgl_terbayar', terbayar = 'Lunas' WHERE id = '$id'");

    if ($query AND $queryBank) {
        echo "<script>window.location.href = '/?g=invoiceRembustTerbayarPO';</script>";	
    }else{
         echo "ERROR, data gagal diupdate : ". mysql_error();
    }
?>