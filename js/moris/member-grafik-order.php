<?php
session_start();
include '../../koneksi/koneksi.php';
$kode=$_SESSION['kode'];
$_SESSION['level'];

       $tahun=date("Y");

       $cek_order_pertama=$conn->query("SELECT substr(wkt_order,1,4) as th from t4t_order where id_comp='$kode' order by th limit 1")->fetch();       if ($cek_order_pertama[0]!='') {
        $jarak=$tahun-$cek_order_pertama[0]+1;
      }else{
        $jarak=1;
      }

       ?>
               $(function () {
               Morris.Area({
                   element: 'graph_line',
                   data: [
                   <?php

                   for ($i=0; $i < $jarak ; $i++) {
                     $period=$tahun-$i;
                     $q_tag=$conn->query("SELECT sum(jml_wins) as jml from t4t_order where id_comp='$kode' AND wkt_order like '%$period%' and acc=1");
                        $tag=$q_tag->fetch();

                     $or_req_tt=$conn->query("SELECT sum(b.jml) from t4t_order a, t4t_orderrequest b where a.no_order=b.no_order and a.id_comp='$kode' and b.no_req=1 AND wkt_order like '%$period%' and a.acc=1");
                        $tt=$or_req_tt->fetch();

                     $or_req_a1=$conn->query("SELECT sum(b.jml) from t4t_order a, t4t_orderrequest b where a.no_order=b.no_order and a.id_comp='$kode' and b.no_req=2 AND wkt_order like '%$period%' and a.acc=1");
                        $a1=$or_req_a1->fetch();

                     $or_req_a4=$conn->query("SELECT sum(b.jml) from t4t_order a, t4t_orderrequest b where a.no_order=b.no_order and a.id_comp='$kode' and b.no_req=3 AND wkt_order like '%$period%' and a.acc=1");
                        $a4=$or_req_a4->fetch();
                   ?>
                        {year: '<?php echo $period; ?>', hang: <?php echo json_encode($tag[0]) ?>, posta1: <?php echo json_encode($a1[0]) ?>, posta4: <?php echo json_encode($a4[0]) ?>, table_t: <?php echo json_encode($tt[0]) ?> },
                   <?php
                   } ?>

                   ],
                   xkey: 'year',
                   ykeys: ['hang', 'posta1', 'posta4', 'table_t'],
                   lineColors: ['#26B99A'],
                   labels: ['Hang Tags', 'Poster A1', 'Poster A4', 'Table Tent'],
                   pointSize: 2,
                   hideHover: 'auto'
               });

           });