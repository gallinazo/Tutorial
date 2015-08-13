<?php
//    session_start();
    include("sesion.php");
    include("configuracion.php");
    
    $enlace = mysql_connect($db_host,$db_user,$db_password)
            or die('No pudo conectarse: ' . mysql_error());
            mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
            mysql_set_charset('utf8',$enlace); //para el tema de tildes
  
    $query =sprintf("SELECT * FROM tb_notas WHERE tb_Usuarios_id_Usuario='%s' order by id_nota", 
        mysql_real_escape_string($_SESSION['id_usr']));
    
    $result = mysql_query($query);

    if (!$result) {
        $message  = 'Query invalido: ' . mysql_error() . "\n";
        $message .= 'Query completa: ' . $query;
        die($message);
    }
    echo "<table border='1' cellspacing='0'>";
    
        echo "<tr>";
        echo "<td><b>Titulo</b></td><td><b>Modificación</b></td>";
        echo "</tr>";

    while($resultado = mysql_fetch_array($result)){
        echo "<tr>";
        echo "<td><a href=\"verNota.php?id=".$resultado["id_nota"]."\" >".$resultado["titulo_nota"]."</a></td>";
        echo "<td>".$resultado["fechamodificacion_nota"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
?>