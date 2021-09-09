<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h2>Ingrese Usuario</h2>
        <form action="" id="formulario" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre" id="">
            <input type="text" name="apellidos" placeholder="Apellidos" id="">
            <input type="file" name="imagen"  id="imagen">
            <select name="sexo">
                <option value="">Seleccione una opcion</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
            <input type="submit" value="Guardar" id="">
        </form>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Genero</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody id="table">
                <?php require_once "./server/select.php"; ?>
                <?php foreach($columns as $column): ?>
                <tr >                   
                    <td><?php echo $column['id'] ?></td>
                    <td><?php echo $column['nombre'] ?></td>
                    <td><?php echo $column['apellidos'] ?></td>
                    <td><?php echo $column['sexo'] ?></td>
                    <td>
                        <button type="submit" class="btn btn-primary" onclick="editar(<?php echo $column['id'] ?>, 300,'edit')">Editar</button>
                        <button type="submit" class="btn btn-danger" onclick="editar(<?php echo $column['id'] ?>, 300,'delete')">Eliminar</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./js/app.js"></script>
</body>
</html>