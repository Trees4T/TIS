<?php
require_once '../../action/function/class.backdoor.php';
$backdoor = new backdoor();

$data = $backdoor->web_participant();
foreach ($data as $datas) {
  echo $id_part = $datas->id_part; echo "(ID) / <BR>";
  echo $above_map = $datas->above_map; echo "(ABOVE) / <BR>";
  echo $below_map = $datas->below_map; echo "(BELOW) / <BR>";
  echo $wincheck_text = $datas->wincheck_text; echo "(WINC) / <BR>";
  echo $refpage_text = $datas->refpage_text; echo "(REF) / <BR>";
  echo $qty_trees = $datas->qty_trees; echo "(TREE) / <BR>";
  echo $qty_families = $datas->qty_families; echo "(FAMS) / ";

  echo "<br>";
  echo "<br>";

  if ($_GET['acc']='1') {
    $backdoor->participant_insert($above_map,$below_map,$wincheck_text,$refpage_text,$qty_trees,$qty_families,$id_part);
  }

}
?>
