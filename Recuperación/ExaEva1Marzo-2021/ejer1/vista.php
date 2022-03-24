<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <div>
        <div>
            <h1>Información del sensor:</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <table border=1>
                    <tr>
                        <td>Ciudad: (*)</td>
                        <td><input type="text" name="ciudad" value="<?= $datos['ciudad']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>Dirección: (*)</td>
                        <td><input type="text" name="direccion" value="<?= $datos['direccion']; ?>" />
                        </td>
                    </tr>

                    <tr>
                        <td>Estado sensor de temperatura:</td>
                        <td>
                            <input type="radio" name="estado" value="Activo" <?= ($datos['estado'] == 'Activo') ? 'checked' : ''; ?>>Activo
                            <input type="radio" name="estado" value="Apagado" <?= ($datos['estado'] == 'Apagado') ? 'checked' : ''; ?>>Apagado
                        </td>
                    </tr>

                    <tr>
                        <td>Unidades:</td>
                        <td>
                            <input type="checkbox" name="unidades[]" <?= in_array('c', $datos['unidades']) ? "checked='checked'" : "" ?> value="c" /> Celsius
                            <input type="checkbox" name="unidades[]" <?= in_array('f', $datos['unidades']) ? "checked='checked'" : "" ?> value="f" /> Fharenheit
                            <input type="checkbox" name="unidades[]" <?= in_array('k', $datos['unidades']) ? "checked='checked'" : "" ?> value="k" /> Kelvin
                        </td>

                    </tr>
                    <tr>
                        <td>Número de mediciones:</td>
                        <td><select name="mediciones">
                                <option value='0' <?= ($datos['mediciones'] == 0) ? 'selected' : ''; ?>>1 a 10
                                <option value='1' <?= ($datos['mediciones'] == 1) ? 'selected' : ''; ?>>11 a 100
                                <option value='2' <?= ($datos['mediciones'] == 2) ? 'selected' : ''; ?>>Más de 100
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Fecha: </td>
                        <td><input type="text" name="fecha" value="<?= $datos['fecha']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="enviar" value="Enviar">
                            <input type="reset" value="Borrar datos">
                        </td>
                    </tr>
                </table>
            </form>

        </div>
        <div>
            <?php
            
            ?>
        </div>
    </div>
</body>

</html>