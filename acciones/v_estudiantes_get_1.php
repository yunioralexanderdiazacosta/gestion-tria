<?php
session_start();
include("../conexion.php");
$periodo_id = isset($_POST['periodo']) ? $_POST['periodo'] : $_SESSION['periodo'];
$sql_estudiantes= $con->query("SELECT * FROM estudiantes WHERE id NOT IN (SELECT e.id FROM estudiantes e INNER JOIN trabajos t ON e.id = t.estudiante_id WHERE (t.estatus = 1 OR t.estatus = 0) OR (t.estatus = 2 AND t.periodo_id = '$periodo_id')) ORDER BY nombres ASC, apellidos ASC");
?>
<option value="">Seleccione</option>
<?php
while($row = mysqli_fetch_assoc($sql_estudiantes)){
?>
<option value="<?php echo $row['id']; ?>"><?php echo $row['cedula']; ?> - <?php echo $row['nombres']; ?> <?php echo $row['apellidos']; ?></option>
<?php } ?>