<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <?php
        session_start();
        include("head.php");//en este agrego los css y el encoding de manera centralizada en un archivo
        include("configuracion.php");
        
        if ($_SESSION['id_usr']=="") {
            preg_match_all("/\w+/", $_POST['usuario'], $usuarioSanitizado);
            $_SESSION['usuario']=$usuarioSanitizado[0][0];
            $_SESSION['password']= hash("sha256", $_POST['password']);

            $enlace = mysql_connect($db_host,$db_user,$db_password)
                or die('No pudo conectarse: ' . mysql_error());
                mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
                mysql_set_charset('utf8',$enlace); //para el tema de tildes

            $query =sprintf("SELECT * FROM tb_usuarios WHERE nUsuario='%s'", 
                mysql_real_escape_string($_SESSION['usuario']));

            $result = mysql_query($query);

            if (!$result) {
                $message  = 'Query invalido: ' . mysql_error() . "\n";
                $message .= 'Query completa: ' . $query;
                die($message);
            }

            $resultado = mysql_fetch_array($result);
            if ($resultado>0){
                if ($resultado[2] == $_SESSION['password']){
                    $_SESSION['id_usr']=$resultado[0];
                }else{
                    session_destroy();
                    echo "Usuario o Contraseña invalidos";
                    die;
                }
            }else{
                session_destroy();
                echo "Usuario o Contraseña invalidos";
                die;
            }
            include("sesion.php");
        }
    ?>
    <body>

        <!-- Mi app "NotasApp" esta en la siguiente division y tambien el controlador "myNoteCtrl" -->
        <div class="container" > 

            <div class="span-8 prepend-1 ">
               <h1 style="margin-top: 10px">NotasApp</h1>
            </div>
            <div class="span-4  append-11 last" style="text-align: right">
                <?php echo $_SESSION['usuario']?>
            </div>
            <div class="span-23 prepend-1 last">
                    <a href="nuevaNota.php">Nueva nota</a>
            </div>
            <div class="span-12 prepend-1 append-11 last">

                <!-- Aqui llamo al que muestra las notas en una tabla -->
                <?php
                   include("listarNotas.php");
                ?>

            </div>
        </div>
    </body>
</html>
