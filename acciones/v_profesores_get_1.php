<?php
include("../conexion.php");
$trabajo_id     = $_POST['trabajo_id'];
$profesor_id    = $_POST['profesor_id'];
$sql_profesores = $con->query("SELECT * FROM profesores WHERE  id NOT IN (SELECT profesor_id FROM trabajos_jurados WHERE trabajo_id = '$trabajo_id') AND estatus = 1 OR id = '$profesor_id'  ORDER BY nombres ASC, apellidos ASC")
?>
<option value="">Seleccione</option>
<?php
while($row = mysqli_fetch_assoc($sql_profesores)){
?>
<option value="<?php echo $row['id']; ?>"  <?php if($profesor_id == $row['id']) echo 'selected'; ?>><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
<?php } ?>