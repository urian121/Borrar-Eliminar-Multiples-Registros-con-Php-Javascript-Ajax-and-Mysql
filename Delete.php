<?php
include('config.php');
$idRegistros = $_REQUEST['ids_array'];

foreach ($idRegistros as $Registro) {

$DeleteRegistro = ("DELETE FROM drag_drop WHERE id= '".$Registro."' ");
mysqli_query($con, $DeleteRegistro); 

}
?>