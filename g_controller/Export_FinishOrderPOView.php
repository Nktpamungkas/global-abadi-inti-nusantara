<?php
    $idStaff = $_SESSION['userId'];
    include_once 'database/connection.php';
    $dataUserBySesion = mysql_query("SELECT * FROM staff WHERE id_staff = '$idStaff'");
    $fetchDataUserBySesion = mysql_fetch_assoc($dataUserBySesion);
?>
<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Finish Order PO.xls");
?>
<table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
        <tr>
            <th>No</th>
            <th width="200">Order ID</th>
            <th>Site</th>
            <th width="125">Start Progress</th>
            <th width="125">Stop Progress</th>
            <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                <th width="125" style="text-align: center;">Terima BA</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once 'database/connection.php';
            $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE status_order='Finish Progress Order' OR status_order='BA' ORDER BY id Desc");
            $no=1;
            while ($fetchDataDok = mysql_fetch_array($dataDok)){
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?></td>
                <td><?php echo $fetchDataDok['site']; ?></td>
                <td>
                    <?php 
                        $formatdate_sp = date_create($fetchDataDok['start_progress']);
                        echo date_format($formatdate_sp, "d M Y");
                    ?>
                </td>
                <td>
                    <?php 
                        $formatdate_spg = date_create($fetchDataDok['stop_progress']);
                        echo date_format($formatdate_spg, "d M Y");
                    ?>
                </td>
                <?php if ($fetchDataUserBySesion['jabatan'] == "SA" || $fetchDataUserBySesion['jabatan'] == "MO" || $fetchDataUserBySesion['jabatan'] == "AO") { ?>
                    <td style="color: red; font-weight: Bold;">
                        <?php 
                            if ($fetchDataDok['tgl_ba_terima'] == NULL) {
                                # null
                                echo $fetchDataDok['tgl_ba_terima'];
                            }else{
                                $formatdate_ba = date_create($fetchDataDok['tgl_ba_terima']);
                                echo date_format($formatdate_ba, "d M Y");
                            }
                        ?>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
</table>