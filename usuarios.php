<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style type="text/css">
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        }
    </style>    


</head>
<body>
    
<?php
include_once "db.php";
$con = mysqli_connect($host, $user, $pass, $db);
if(isset($_REQUEST['idBorrar'])){
    $id= mysqli_real_escape_string($con,$_REQUEST['idBorrar']??'');
    $query="DELETE from usuarios  where id='".$id."';";
    $res=mysqli_query($con,$query);
    if($res){
        ?>
        <div>
            Usuario borrado con éxito
        </div>
        <?php
    }else{
        ?>
        <div>
            Error al borrar <?php echo mysqli_error($con); ?>
        </div>
        <?php
    }
}
  ?>



<table style="width:70%">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones </th>
            <th><a href="crearUsuario.php"> Agregar Usuario </a> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT id,email,nombre from usuarios;  ";
        $res = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
                <td><?php echo $row['nombre'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td>
                    <a href="editarUsuario.php?editarUsuario&id=<?php echo $row['id'] ?>"> Editar </a>
                </td>
                <td>
                    <a href="usuarios.php?&idBorrar=<?php echo $row['id'] ?>"> Borrar </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

</body>
</html>


