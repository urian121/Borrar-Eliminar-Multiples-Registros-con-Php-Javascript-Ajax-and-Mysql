<?php
include('config.php');
$idRegistros = $_REQUEST['ids_array'];


foreach ($idRegistros as $Registro) {

$DeleteRegistro = ("DELETE FROM registros WHERE id= '".$Registro."' ");
mysqli_query($con, $DeleteRegistro); 

} 

?>