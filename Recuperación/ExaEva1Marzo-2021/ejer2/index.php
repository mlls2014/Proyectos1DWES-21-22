<?php
$solucion=[];
$moneda=[50,20,10,5,2,1];
$errores=[];
$cantidad="";

if(isset($_POST['submit'])){
    $cantidad=filter_var($_POST['num'],FILTER_SANITIZE_NUMBER_INT);
    $errores=validar($cantidad);

    if(count($errores)==0){
        $dinero=$cantidad;

        for ($i=0; $i < count($moneda); $i++) { 
            $solucion[$i]=intval($dinero/$moneda[$i]);
            $dinero=$dinero%$moneda[$i];
        }
    }
}

function validar($cantidad){
    $errores=[];
    if(!filter_var($cantidad,FILTER_VALIDATE_INT)){
        $errores[]="Error: Debe de introducir de un numero entero";
    }
    if($cantidad<=0){
        $errores[]="No se puede dar cambio para la cantidad introducida";
    }
    return $errores;
}

require ("vista.php");

?>