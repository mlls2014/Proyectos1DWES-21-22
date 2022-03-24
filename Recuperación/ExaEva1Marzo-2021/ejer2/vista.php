<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <div>
        <div>
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
                <div>
                    <label for="num">Cantidad: </label>
                    <input type="text" id="num" class="" placeholder="Introduzca la cantidad para calcular su cambio" name="num" value="<?= $cantidad; ?>">
                </div>
                <div>
                    <input type="submit" name="submit" value="Enviar" class="">
                </div>
            </form>
        </div>
        <div>
            <?php
            if(count($errores)==0){
                for ($i=0; $i < count($solucion); $i++) { 
                    if ($moneda[$i]>=5){
                        if($solucion[$i]!=0){
                            echo "Billetes de ".$moneda[$i]. ": ".$solucion[$i]."<br>";
                        }
                    }else{
                        if($solucion[$i]!=0){
                            echo "Monedas de ".$moneda[$i]. ": ".$solucion[$i]."<br>";
                        }
                    }
                }
            }else{
                for ($i=0; $i < count($errores); $i++) { 
                    echo "<div><strong>". $errores[$i] ."</strong></div>";
                }
            }              
            ?>
        </div>
    </div>
</body>
</html>