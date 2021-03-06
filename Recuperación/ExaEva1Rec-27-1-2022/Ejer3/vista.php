<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Ejercicio 3</title>
</head>

<body>
    <div>
        <div class="container">
            <h1>Solicitud de cita médica</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="nombre" value="<?= $datos['nombre']; ?>">
                </div>
                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="apellidos" value="<?= $datos['apellidos']; ?>">
                </div>
                <div class="mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input type="text" class="form-control" id="dni" name="dni" placeholder="dni" value="<?= $datos['dni']; ?>">
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="fecha" class="form-control" id="fecha" name="fecha" value="<?= $datos['fecha']; ?>" placeholder="--/--/----">
                </div>
                <label class="form-label">¿Es urgente? </label>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="urgente">Sí</label>
                    <input class="form-check-input" type="radio" name="urgente" id="urgente" value="si" <?= ($datos['urgente'] == 'si') ? 'checked' : ''; ?>>
                </div>
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="urgente">No</label>
                    <input class="form-check-input" type="radio" name="urgente" id="urgente" value="no" <?= ($datos['urgente'] == 'no') ? 'checked' : ''; ?>>
                </div>
                <div class="mb-3">
                    <label class="form-label">Especialidad</label>
                    <select class="form-select" name="especialidad" aria-label="Default select example">
                        <option value="0" <?= ($datos['especialidad'] == 0) ? 'selected' : ''; ?>>General</option>
                        <option value="1"<?= ($datos['especialidad'] == 1) ? 'selected' : ''; ?>>Neurología</option>
                        <option value="2"<?= ($datos['especialidad'] == 2) ? 'selected' : ''; ?>>Traumatología</option>
                        <option value="3" <?= ($datos['especialidad'] == 3) ? 'selected' : ''; ?>>Otorrinolaringología</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>

            </form>

        </div>
        <div>
            <?php

            ?>
        </div>
    </div>
</body>

</html>