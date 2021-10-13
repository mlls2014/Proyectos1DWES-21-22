<?php
$re = '`^[a-z0-9]+([._-]?[a-z0-9]+)*@[a-z0-9]+([.-]?[a-z0-9]+)*\.[a-z]{2,4}$`m';
$str = '4ama.mar90-456t@sdsd.cg';

preg_match($re, $str, $matches, PREG_OFFSET_CAPTURE, 0);


echo "<pre>";
var_dump($matches);
echo "</pre>";
   