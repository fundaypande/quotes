<?php
function limit($text, $limit){
  if(strlen($text)>$limit)
    $word = mb_substr($text, 0, $limit-3)."...";
  else
    $word = $text;
  return $word;
  }
 ?>
