app.controller("myNoteCtrl", function($scope) {
    $scope.message = "";
    $scope.left = function() {
        return 500 - $scope.message.length;
    };
    $scope.clear = function() {
        $scope.message="";
        $scope.title="";
    };
    $scope.loadXMLDoc = function(){
        var xmlhttp;
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open("POST","guardarNota.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
        xmlhttp.send("cTitulo="+encodeURI($scope.title)+"&cNota="+encodeURI($scope.message));
    }; 
    $scope.save = function() {
        $scope.loadXMLDoc();
    };
    $scope.create=function(){
        var xmlhttp;
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                alert(xmlhttp.responseText);
            }
        }
        xmlhttp.open("POST","crearNota.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
        xmlhttp.send("cTitulo="+encodeURI($scope.title)+"&cNota="+encodeURI($scope.message));
    }
    
    $scope.delete=function(){
        var xmlhttp;
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                alert(xmlhttp.responseText);
                window.location = window.location.protocol + "//" + window.location.hostname +"/NotasIDEA/indexApp.php";
            }
        }
        xmlhttp.open("POST","borrarNota.php",true);
        xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded"); 
        xmlhttp.send();
    }
    
    
    
});
   