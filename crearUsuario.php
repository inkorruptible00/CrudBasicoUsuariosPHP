<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>

<?php
if (isset($_REQUEST['guardar'])) {
    include_once "db.php";
    $con = mysqli_connect($host, $user, $pass, $db);

    $email = mysqli_real_escape_string($con, $_REQUEST['email']);
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['pass']));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre']);

    $query = "INSERT INTO usuarios 
        (email,pass,nombre) VALUES
        ('" . $email . "','" . $pass . "','" . $nombre . "');
        ";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=usuarios.php" />  ';
    } else {
?>
        <div class="alert alert-danger" role="alert">
            Error al crear usuario <?php echo mysqli_error($con); ?>
        </div>
<?php
    }
}
?>


<h2>Crear usuario n</h2>

<form action="CrearUsuario.php" method="post">
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control"  required="required" >
    </div>
    <div class="form-group">
        <label>Pass</label>
        <input type="password" name="pass" class="form-control"  required="required" >
    </div>
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control"  required="required" >
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
    </div>
</form>

</div>

</body>
</html>



