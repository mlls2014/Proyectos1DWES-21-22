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
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <label for="num"><?= "{$_SESSION['op1']} {$_SESSION['op']} {$_SESSION['op2']} = "?></label>
                <input type="resultado" id="num" class="" placeholder="Resultado" name="resultado" value="">
            </div>
            <div>
                <input type="submit" name="comprobar" value="Comprobar" class="">
            </div>
        </form>
    </div>


</body>

</html>