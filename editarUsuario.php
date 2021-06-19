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
include_once "db.php";
$con = mysqli_connect($host, $user, $pass, $db);
if (isset($_REQUEST['guardar'])) {

    $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['pass'] ?? ''));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');

    $query = "UPDATE usuarios SET
        email='" . $email . "',pass='" . $pass . "',nombre='" . $nombre . "'
        where id='".$id."';
        ";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0; url=usuarios.php" />  ';
    } else {
?>
        <div>
            Error al crear usuario <?php echo mysqli_error($con); ?>
        </div>
<?php
    }
}
$id= mysqli_real_escape_string($con,$_REQUEST['id']??'');
$query="SELECT id,email,pass,nombre from usuarios where id='".$id."'; ";
$res=mysqli_query($con,$query);
$row=mysqli_fetch_assoc($res);
?>

<b>Editar usuario:</b>

<form action="editarUsuario.php" method="post">
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" required="required" >
    </div>
    <div class="form-group">
        <label>Pass</label>
        <input type="password" name="pass" class="form-control"  required="required" >
    </div>
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?php echo $row['nombre'] ?>"  required="required" >
    </div>
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>" >
        <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
    </div>
</form>


</body>
</html>

