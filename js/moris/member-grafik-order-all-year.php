 <?php 
 session_start();
 include '../../koneksi/koneksi.php';
    $kode=$_SESSION['kode'];
    $tahun=date("Y");
    $bulan=date("m");
    $query_wkt_shipment=mysql_query("select wkt_shipment from t4t_shipment where id_comp='$kode'");
    $wkt_shipment=mysql_fetch_row($query_wkt_shipment);

    ?>

      // Bar chart
      var ctx2 = document.getElementById("mybarChart");
      var mybarChart = new Chart(ctx2, {
          type: 'bar',
          data: {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [
              {
                label: '# of Votes',
                backgroundColor: "#26B99A",
                data: [51, 30, 40, 28, 92, 50, 45]
              },
              {
                label: '# of Votes',
                backgroundColor: "#03586A",
                data: [41, 56, 25, 48, 72, 34, 12]
              }]
            },

          options:{
            scales:{
              yAxes:[{
                ticks:{
                    beginAtZero:true
                }
              }]
            }
          }
      });