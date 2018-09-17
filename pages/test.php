<?php
  $text = "gafasghfas##sasa11.jjj";

  if (strpos($text, '#') !== false) {
      echo str_replace("#","-",$text);
  }else{
      echo $text;
  }



?>
