<?php

 $a="";


if (empty($a)){
    echo "esta vacío";
}else{
    echo "no esta vacío";
}
echo "<br>";
unset($a);

if (isset($a)){
    echo "esta establecida";
}else{
    echo "no esta establecida";
}