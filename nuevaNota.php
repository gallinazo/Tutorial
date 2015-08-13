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
?>    
     
    <body>
        <script src="js/myNoteApp.js"></script>
        <script src="js/myNoteCtrl.js"></script>
        <div class="container" data-ng-app="NotasApp" data-ng-controller="myNoteCtrl"> 
            <div  class="span-12 last">
                <div class="span-12 last">
                    <h3 style="margin-bottom: 0; margin-top: 4">Titulo</h3>
                    <!-- aqui uso un modelo llamado "title", que luego llamo desde funciones del controlador "myNoteCtrl" -->
                    <input style="font-family: Arial, Helvetica, sans-serif; margin: 0" id="inputTitulo"  type="text" maxlength="50" name="cTitulo" size="55" placeholder="Escribe el título" data-ng-model="title">
                </div> 
                <div class="span-12 last">
                    <br>
                    <h3 style="margin: 0">Nota</h3>
                    <!-- aqui uso un modelo llamado "message", que luego llamo desde funciones del controlador "myNoteCtrl"  -->
                    <textarea style="font-family: Arial, Helvetica, sans-serif; margin: 0; width: 400px;" id="textNota"  maxlength="500" cols="40" name="cNota" rows="10" placeholder="Escribe tu nota" data-ng-model="message"></textarea>
                </div>
                <div class="span-12 last">
                    <!-- las funciones save y clear, estan en el controlador "myNoteCtrl" -->
                    <button data-ng_click="create()">Crear</button>
                    <button data-ng-click="clear()">Limpiar</button>
                </div>
                <!-- Aqui voy mostrando el total de caracteres disponibles, se calculan en el controler y se muestran aqui -->
                <p>Number of characters left: <span data-ng-bind="left()"></span></p>
                <p>[<a href="indexApp.php">Atras</a>]</p>
            </div>
        </div>
    </body>'