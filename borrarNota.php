<?php

session_start();
include("sesion.php");
include("configuracion.php");

$enlace = mysql_connect($db_host,$db_user,$db_password)
        or die('No pudo conectarse: ' . mysql_error());
        mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
        mysql_set_charset('utf8',$enlace); //para el tema de tildes

        
$horamodificacion = date("Y-m-d H:i:s");
               
$query =sprintf("DELETE FROM tb_notas WHERE tb_Usuarios_id_Usuario='%s' and id_nota='%s'", 
        mysql_real_escape_string($_SESSION['id_usr']),
        mysql_real_escape_string($_SESSION['idNota']));

//echo $query;
mysql_query($query)or die('Error, en la inserción de la nota. ' . mysql_error().' el query es: '.$query);

echo "Nota borrada exitosamente";
