<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Error</title>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="notificacion">
         <img src="./imagenes/error.png" /><h1>
            <c:choose>
                <c:when test="${param.tipo eq 'contexto'}">
                    Error, intento de ejecutar una página, la cual debe estar en un contexto dentro de otra página
                </c:when>
                <c:when test="${param.tipo eq 'parametro'}">
                    Error, debe de ingresar todos los datos del libro.
                    <br>Se redireccionara a la pantalla de inicio.
                </c:when>                
            </c:choose>
                    
            <script>
                setTimeout(function () {
                    location.href = "${param.destino}";
                }, 5000);
            </script>
        </h1>
        </div>
    </body>
</html>
