<?php
/*
 * Este es el php que se encarga de insertar en la base de datos las notas.
 * recibe del html por POST 2 parametros (cTitulo y cNota)(ojo no hace validaciones de seguridad)
 * luego con el include("configuracion.php"); carga los parametros de confuguración, con $enlace establece la conexion
 * a la base de datos y construye el insert. Devuelve  "Nota guardada exitosamente" si no muere (die) por algun error 
 * con la conexion o con la ejecucion del query
 */
    session_start();
    include("sesion.php");
    include("configuracion.php");
    
    $enlace = mysql_connect($db_host,$db_user,$db_password)
            or die('No pudo conectarse: ' . mysql_error());
            mysql_select_db($db_database) or die('No pudo seleccionarse la BD.');
            mysql_set_charset('utf8',$enlace); //para el tema de tildes

    $horamodificacion = date("Y-m-d H:i:s");
    
// debería validar que titulo y nota no permitan SQL inyection        
    
    $query =sprintf("INSERT INTO tb_notas(titulo_nota, info_nota, fechacreacion_nota, fechamodificacion_nota, tb_Usuarios_id_Usuario) VALUES ('%s','%s','%s','%s','%s')", 
            mysql_real_escape_string($_POST['cTitulo']),
            mysql_real_escape_string($_POST['cNota']),
            mysql_real_escape_string($horamodificacion),
            mysql_real_escape_string($horamodificacion),
            mysql_real_escape_string($_SESSION['id_usr']));

    //echo $query;
    mysql_query($query)or $respuesta='Error al cear la nota : '.mysql_error();  
    
    $query ="SELECT MAX(id_nota) FROM tb_notas";
    
    $result = mysql_query($query);
    
    if ($result>0){
        $_SESSION['idNota']=$result[0];
        $respuesta='Nota creada exitósamente.';
    }else{
        $respuesta='Error al cear la nota.';
    }

    echo $respuesta;

?>