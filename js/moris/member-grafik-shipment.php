<?php 
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
        $tahun=date("Y"); 

        ?>
                $(function () {
                Morris.Area({
                    element: 'graph_area2',
                    data: [
                    <?php for ($i=0; $i < 10 ; $i++) { 
                        $period=$tahun-$i;
                    $ship=mysql_query("select count(*) from t4t_shipment where id_comp='$kode' and acc=1 and acc_paid=1 and wkt_shipment like '%$period%'");
                    $fee=mysql_query("select sum(fee) from t4t_shipment where id_comp='$kode' and acc=1 and acc_paid=1 and wkt_shipment like '%$period%'");
                    $item=mysql_query("select sum(item_qty) from t4t_shipment where id_comp='$kode' and acc=1 and acc_paid=1 and wkt_shipment like '%$period%'");
                    $ship2=mysql_fetch_row($ship);
                    $fee2=mysql_fetch_row($fee);
                    $item2=mysql_fetch_row($item);

                    ?>
                      {period: '<?php echo $period ?>', ship: <?php echo json_encode($ship2[0]) ?>, fee: <?php echo json_encode($fee2[0]) ?>, item: <?php echo json_encode($item2[0]) ?> }, 
                    <?php
                    } ?>
                       
                    ],
                    xkey: 'period',
                    ykeys: ['ship', 'fee', 'item'],
                    lineColors: ['#eb9d27', '#5a89e3', '#26B99A'],
                    labels: ['Shipment', 'Fee', 'Item Qty'],
                    pointSize: 2,
                    hideHover: 'auto'
                });

            });