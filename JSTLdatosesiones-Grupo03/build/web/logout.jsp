<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Logout</title>
        <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        
        <div class="notificacion">
            <img src="./imagenes/informacion.png" />
        <h1>Se a cerrado sesion</h1>
        
        <c:set var="user" value="" scope="session" />
        <c:set var="nombre" value="" scope="session" />
        <c:set var="nivel" value="-1" scope="session" />
        <p class="mensaje">
            Dentro de unos segundos sera redirigido a la pagina de INICIO</p></div>
        <script>
            setTimeout(function () {
                location.href = "index.jsp";
            }, 3000);
        </script>
    </body>
</html>
