<?php
require '../utils/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Document</title>
</head>

<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="foto" accept="image/png, image/jpeg">FOTO</input>
        <button type="submit">subir</button>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $foto = $_FILES['foto'];
        $ruta = Contenido::GuardarImagen($foto);
        echo <<<HTML
        <img src="{$ruta}">
        HTML;
    }
    ?>
</body>
</html>