<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Control</title>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="notificacion reception"> 
        <img class="error_imagen" src="./imagenes/error.png" />
        <h1>Control de Accesos</h1>
        
        <c:choose>
            <c:when test="${param.logeado eq 'not'}">
                
                    <h2>Se a detectado que usted. 
                    Intenta realizar  la operacion: 
                    <span style="color:blue;">${param.operacion}</span> sin haberse logeado.
                    <br><br>A continuación se le permite ingresar como Anonimo, pero
                    solo tiene derechos para visualizar los libros existentes.</h2>
             
            </c:when>
            <c:when test="${param.logeado eq 'yes'}">
                
                    <h2>Su nivel de seguridad es:
                    <span style="color:red;">${sessionScope.nivel}</span>
                    El cual solo le permite realizar:
                    <c:set var="permiso" value="${sessionScope.nivel}"/>
                    <c:choose>
                        <c:when test="${permiso eq '0'}">
                            <br>*Visualizar los libros
                        </c:when>
                        <c:when test="${permiso eq '1'}">
                            <br>*Visualizar e Ingresar libros
                        </c:when>
                        <c:when test="${permiso eq '2'}">
                            <br>*Eliminar y Actualizar los libros
                        </c:when>                       
                    </c:choose>
                    </h2>
                   
            </c:when>                
        </c:choose>
            <p>
            <br>Dentro de unos segundos sera redirigido a la pagina de INICIO</p>
        
        </div>
        <script>
            setTimeout(function () {
                location.href = "index.jsp";
            }, 5000);
        </script>
    </body>
</html>
