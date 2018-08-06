<?php
require_once '../../action/function/class.backdoor.php';
$backdoor = new Backdoor();

if ($_GET['lvl']=="administrator") {

      $lihat_lahan = $backdoor->tambah_stok_perfc('140120090073','052016');

      foreach ($lihat_lahan as $lihat_lahans) {
        ?>
        <table>
          <tr>
            <td><b> <?php echo $lihat_lahans->no; echo " /";?></b></td>
            <td><b><?php echo $lihat_lahans->kd_mu; echo " /";?></b></td>
            <td><b><?php echo $lihat_lahans->koordinat; echo " /";?></b></td>
            <td><b><?php echo $lihat_lahans->id_pohon; echo " /";?></b></td>
            <td><b> <?php echo $lihat_lahans->jml_realisasi; ?></b></td>
          </tr>
        </table>
        <?php
        for ($i=1; $i <= $lihat_lahans->jml_realisasi ; $i++) {
          echo $i; echo " /";
          echo $no_t4tlahan=$lihat_lahans->no; echo " /";
          echo $last_mont=1; echo " /";
          echo $hidup=1; echo " /";
          echo $used=0; echo " /";
          echo $kd_mu=$lihat_lahans->kd_mu; echo " /";
          echo $id_pohon=$lihat_lahans->id_pohon; echo " /";
          echo $koordinat=$lihat_lahans->koordinat; echo " /";

          $backdoor->current_tree_insert(
            $i,
            $no_t4tlahan,
            $last_mont,
            $hidup,
            $used,
            $kd_mu,
            $id_pohon,
            $koordinat,'','');


          echo "<br>";
        }




      }
}
?>
