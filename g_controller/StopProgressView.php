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
if(isset($_POST['submit'])){
    include_once 'database/connection.php';
    $id_order = $_POST['id_order'];
    $stop = $_POST['stop'];

    //
    $saveFolder = mysql_query("UPDATE tbl_order SET stop_progress ='$stop' WHERE id_order = '$id_order' )");
        if($saveFolder) {
        echo "<script>window.location.href = '/?g=Dashboard';</script>";	
        } else {
            echo "QUERY ERROR";
        }
} else {
    echo "<script>window.location.href = '/?';</script>";	
}
?>

