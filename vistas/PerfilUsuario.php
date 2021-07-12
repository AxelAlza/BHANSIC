<?php
   require '../utils/autoloader.php';
   $usuario=$_SESSION['USER'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/static/css/bootstrap.min.css" rel="stylesheet" />
    <title>Document</title>
</head>
<body>
    
    <ul class="list-group">
        <li class="list-group-item"><?=$usuario -> CedulaUsuario ?></li>
        <li class="list-group-item"><?=$usuario -> CedulaUsuario ?></li>
        <li class="list-group-item">A third item</li>
        <li class="list-group-item">A fourth item</li>
        <li class="list-group-item">And a fifth one</li>
</ul>
</body>
</html>