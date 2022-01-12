<?php
include("../conexion.php");
$estudiante_id = $_POST['estudiante_id'];
$periodo_id = $_POST['periodo_id'];
$sql_estudiantes = $con->query("SELECT * FROM estudiantes WHERE id NOT IN (SELECT e.id FROM estudiantes e INNER JOIN trabajos t ON e.id = t.estudiante_id WHERE (t.estatus = 1 OR t.estatus = 0) OR (t.estatus = 2 AND t.periodo_id = '$periodo_id')) OR id = '$estudiante_id' ORDER BY nombres ASC, apellidos ASC")
?>
<option value="">Seleccione</option>
<?php
while($row = mysqli_fetch_assoc($sql_estudiantes)){
?>
<option value="<?php echo $row['id']; ?>" <?php if($estudiante_id == $row['id']) echo 'selected'; ?>><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
<?php } ?>