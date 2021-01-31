<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar - Multiples - Registros - con - Php - Ajax- Mysql :: WebDeveloper Urian Viera</title>
    <link type="text/css" rel="shortcut icon" href="assets/img/logo-mywebsite-urian-viera.svg"/>
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <span class="navbar-brand">
           <img src="assets/img/logo-mywebsite-urian-viera.svg" alt="Web Developer Urian Viera" width="120">
             Web Developer Urian Viera
       </span>
     </nav>
    
<div class="container top">
<h3 class="text-center mt-5">Borrar (Eliminar) - Múltiples - Registros - con - Php - Mysql - Ajax y jquery 
    <span style="float: right;">
        <button type="button" class="btn btn-info" id="btn_borrar">Eliminar</button>
    </span> 
</h3>

<hr><br>

<?php
require_once ('config.php');
$QueryConsulta = ("SELECT * FROM registros ORDER BY id");
$resultado     = mysqli_query($con, $QueryConsulta);
?>



<div class="panel-body">
            <div class="table-responsive">
                <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Nombre y Apellido</th>
                            <th>Profesión</th>
                            <th>Perfil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                       while ($dataRegistro = mysqli_fetch_assoc($resultado)) { ?>
                            <tr id="id<?php echo $dataRegistro['id']; ?>">
                                <td class="text-center">
                                    <?php echo $dataRegistro['id']; ?>
                                    <input type="checkbox" name="ids[]"  value="<?php echo $dataRegistro['id']; ?>" class="delete_checkbox"> 
                                </td>
                                <td><?php echo $dataRegistro['nombre']; ?></td>
                                <td><?php echo $dataRegistro['profesion']; ?></td>
                                <td>
                                	<img src="assets/img/<?php echo $dataRegistro['imagen']; ?>" alt="Perfil" class="drop__img">
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
            </div>
        </div>

        <div id="resp"></div>
  </div>


<script type="text/javascript" charset="utf-8" src="assets/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$( "#btn_borrar" ).click(function() {

/**OPCION 1 */
    var ids_array = [];
      $("input:checkbox[class=delete_checkbox]:checked").each(function () {
        ids_array.push($(this).val());
      }); 

/****OPCION 2 */
/* var ids_array = [];
$('.delete_check:checked').each(function(i){
    ids_array[i] = $(this).val();		
}); */

if (ids_array.length>0) {
    //console.log(ids_array);

    url = "Delete.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {ids_array: ids_array},
            success: function(data)
            {
        //Para recorrer todos los ids seleccionado, y desaparecerlos
        $.each(ids_array,function(indice,id) {
           // console.log('Indice es ' + indice + ' y id es: ' + id);
            var fila = $("#id" + id).remove(); //Oculto las filas eliminadas
            //console.log(fila);
          });
            
            $('#resp').html(data);
            }
        }); 
    }     

    }); 
});
</script>
</body>
</html>