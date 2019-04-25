<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Progres Order PO.xls");
?>
<table class="table table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th width="200">Order ID</th>
            <th width="425">Site</th>
            <th width="125">Start Progres</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once 'database/connection.php';
            $dataDok = mysql_query("SELECT * FROM tbl_order_po WHERE status_order = 'Progress Order' ORDER BY id DESC");
            $no = 1;
            while ($fetchDataDok = mysql_fetch_array($dataDok)){
        ?>
            <tr>
                <td>
                    <a href="#" data-toggle="modal" data-target="#myModal<?php echo $fetchDataDok['id']; ?>">
                    <span class="glyphicon glyphicon-trash red" title="Delete : <?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?>"left"." data-toggle="tooltip"></span></a>
                </td>
                <td><?php echo $no++; ?></td>
                <td><?php echo $fetchDataDok['order_id'].$fetchDataDok['noUrut']; ?></td>
                <td>
                    <?php echo $fetchDataDok['site']; ?>
                </td>
                <td>
                    <?php 
                        $formatdate = date_create($fetchDataDok['start_progress']);
                        echo date_format($formatdate, "d M Y");
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
</table>