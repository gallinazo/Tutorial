<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>

<?php

    session_start();
    include("sesion.php");
    include("head.php");//en este agrego los css y el encoding de manera centralizada en un archivo
    include("configuracion.php");
    
    $enlace = mysql_connect($db_host,$db_user,$db_password)
        or die('No pudo conectarse: ' . mysql_error());
        mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
        mysql_set_charset('utf8',$enlace); //para el tema de tildes

    preg_match_all("/\d+/", $_GET['id'], $idNotaSanitizado);
    $_SESSION['idNota']= $idNotaSanitizado[0][0];
    
    $query =sprintf("SELECT * FROM tb_notas WHERE tb_Usuarios_id_Usuario='%s' and  id_nota='%s' order by id_nota", 
        mysql_real_escape_string($_SESSION['id_usr']),
        mysql_real_escape_string($_SESSION['idNota']));
    
    $result = mysql_query($query);        
    
            if (!$result) {
            $message  = 'Query invalido: ' . mysql_error() . "\n";
            $message .= 'Query completa: ' . $query;
            die($message);
        }
        
        $resultado = mysql_fetch_array($result);
        if ($resultado>0){
            
        echo '
    <body>
        <script src="js/myNoteApp.js" defer="defer"></script>
        <script src="js/myNoteCtrl.js" defer="defer"></script>
        <div class="container" data-ng-app="NotasApp" data-ng-controller="myNoteCtrl"> 
            <div  class="span-12 last">
                <div class="span-12 last">
                    <h3 style="margin-bottom: 0; margin-top: 4">Titulo</h3>
                    <!-- aqui uso un modelo llamado "title", que luego llamo desde funciones del controlador "myNoteCtrl" -->
        <input style="font-family: Arial, Helvetica, sans-serif; margin: 0" id="inputTitulo"  type="text" maxlength="50" name="cTitulo" size="55" placeholder="Escribe el título" data-ng-model="title" data-ng-init="title=\''.$resultado["titulo_nota"].'\'">
                </div> 
            <div class="span-12 last">
            <br>
            <h3 style="margin: 0">Nota</h3>
            <!-- aqui uso un modelo llamado "message", que luego llamo desde funciones del controlador "myNoteCtrl"  -->
            <textarea style="font-family: Arial, Helvetica, sans-serif; margin: 0; width: 400px;" id="textNota"  maxlength="500" cols="40" name="cNota" rows="10" placeholder="Escribe tu nota" data-ng-model="message" data-ng-init="message=\''.$resultado["info_nota"].'\'" ></textarea>
        </div>
        <div class="span-12 last">
        Fecha modificación: <span>'.$resultado["fechamodificacion_nota"].'</span> <br> Fecha creación: <span>'.$resultado["fechacreacion_nota"].'</span>
        </div>
        <div class="span-12 last">
            <!-- las funciones save y clear, estan en el controlador "myNoteCtrl" -->
            <button data-ng_click="save()">Guardar</button>
            <button data-ng-click="clear()">Limpiar</button>
            <button data-ng-click="delete()">Borrar</button>
        </div>
        <!-- Aqui voy mostrando el total de caracteres disponibles, se calculan en el controler y se muestran aqui -->
        <p>Number of characters left: <span data-ng-bind="left()"></span></p><p>[<a href="indexApp.php">Atras</a>]</p>
        </div>
        </div>
    </body>'  ;  
            
        }else{
            session_destroy();
            echo "La nota no existe!";
            die;
        }
        
?>
