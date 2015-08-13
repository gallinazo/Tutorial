<?php

session_start();
include("sesion.php");
include("configuracion.php");

$_SESSION['vTitulo']=$_POST['cTitulo'];
$_SESSION['vNota']=$_POST['cNota'];

$enlace = mysql_connect($db_host,$db_user,$db_password)
        or die('No pudo conectarse: ' . mysql_error());
        mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
        mysql_set_charset('utf8',$enlace); //para el tema de tildes

$horamodificacion = date("Y-m-d H:i:s");
               
$query =sprintf("UPDATE tb_notas SET id_nota='%s', titulo_nota ='%s', info_nota ='%s', fechamodificacion_nota ='%s', tb_Usuarios_id_Usuario ='%s' WHERE id_nota='%s'", 
        mysql_real_escape_string($_SESSION['idNota']),
        mysql_real_escape_string($_SESSION['vTitulo']),
        mysql_real_escape_string($_SESSION['vNota']),
        mysql_real_escape_string($horamodificacion),
        mysql_real_escape_string($_SESSION['id_usr']),
        mysql_real_escape_string($_SESSION['idNota']));

//echo $query;
mysql_query($query)or die('Error, en la inserción de la nota. ' . mysql_error().' el query es: '.$query);

echo "Nota guardada exitosamente";
