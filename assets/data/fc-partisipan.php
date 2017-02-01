<?php

	$q = strtolower($_POST['nama']);
	$query = "select nm_petani from t4t_petani where nm_petani like '%$q%' order by nm_petani";
	$query = mysql_query($query);
	$num = mysql_num_rows($query);
	  if($num > 0){
	  while ($row = mysql_fetch_array($query)){
	    $row_set[] = htmlentities(stripslashes($row[0]));
	  }
	  echo json_encode($row_set);
	}
?>