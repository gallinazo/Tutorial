<?php

//Cargar script en cada pagina, si la sesion no es valida, lo devuelvo al index.php
if ($_SESSION['id_usr']=="") {
	header("Location: index.php");
	exit();
}