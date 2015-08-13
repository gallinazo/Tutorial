<html>
    <?php
       include("head.php");//en este agrego los css y el encoding de manera centralizada en un archivo
       session_start();
       $_SESSION['id_usr']="";
    ?>
    <body>
       
        <script>
            function limpiar(){
                document.getElementById("usuario").value="";
                document.getElementById("password").value="";
            }
        </script>
        <div class="container">  
            <div class="span-8 append-8 prepend-8 last" >
                <form action="indexApp.php" method="POST">
                    <div class="span-8 last" style="padding-top: 100px; text-align: center">
                        <h1>Bien venido a la App de Notas</h1>
                    </div>
                      <br>  
                    <div class="span-6 append-1 prepend-1 last">
                        <input style="height: 40px; width: 230px; margin-top: 0; margin-bottom: 0" placeholder="Usuario" type="text" id="usuario" name="usuario">
                    </div>
                    <div class="span-6 append-1 prepend-1 last">
                        <input style="height: 40px; width: 230px; margin-top: 0; margin-bottom: 0" placeholder="Contraseña" type="password" id="password" name="password">
                    </div>
                    <div class="span-8 last">
                        <div class="span-3 prepend-1"><input style="height: 40px; width: 110px; margin: 0" type="submit" value="Entrar"></div>
                        <div class="span-3 append-1 last"><input style="height: 40px; width: 110px; margin: 0" type="button" value="Limpiar" onclick="limpiar()"></div>
                    </div>
                </form>
            </div>
        </div> 
    </body>
</html>