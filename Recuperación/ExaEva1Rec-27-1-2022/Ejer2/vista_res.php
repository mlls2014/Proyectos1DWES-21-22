<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego Matemático</title>
</head>

<body>
    <div>
        <p> <?= "{$_SESSION['op1']} {$_SESSION['op']} {$_SESSION['op2']} = $resultado " . ($acierto ? "Has acertado" : "Has fallado")  ?> </p>
        <p>
            <a href="<?= $_SERVER['PHP_SELF'] . '?operacion=+' ?>">Sumar</a>
            <a href="<?= $_SERVER['PHP_SELF'] . '?operacion=-' ?>">Restar</a>
            <a href="<?= $_SERVER['PHP_SELF'] . '?operacion=*' ?>">Multiplicar</a>
            <a href="<?= $_SERVER['PHP_SELF'] . '?operacion=r' ?>">Reiniciar</a>
        </p>
        <p>
            <?= "Aciertos: " . $_SESSION['aciertos'] . " / Fallos: " . $_SESSION['fallos']. " / Jugadas: " . ($_SESSION['aciertos'] + $_SESSION['fallos']) ?>
        </p>
    </div>


</body>

</html>