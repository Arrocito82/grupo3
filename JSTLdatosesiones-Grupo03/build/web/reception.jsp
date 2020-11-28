<%-- 
    Document   : reception
    Created on : 26-nov-2020, 11:12:49
    Author     : felix
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="notificacion">
        <h1>Control de Accesos</h1>
        <c:choose>
            <c:when test="${param.logeado eq 'not'}">
                Hemos detectado que ud. 
                intenta realizar  la operacion: 
                <span style="color:blue;">${param.operacion}</span> sin haberse logeado.
                A continuación se le permite ingresar como Anonimo, pero
                solo tiene derechos para visualizar los libros existentes.               
            </c:when>
            <c:when test="${param.logeado eq 'yes'}">
                Hemos detectado que ud. 
                intenta realizar  la 
                operacion: <span style="color:blue;">${param.operacion}</span>
                pero su nivel de seguridad es:
                <span style="color:red;">${sessionScope.nivel}</span>
                El cual solo le permite realizar:
                <c:set var="permiso" value="${sessionScope.nivel}"/>
                <c:choose>
                    <c:when test="${permiso eq '0'}">
                        Visualizar los libros
                    </c:when>
                    <c:when test="${permiso eq '1'}">
                        Visualizar e Ingresar libros
                    </c:when>
                    <c:when test="${permiso eq '2'}">
                        Eliminar y Actualizar los libros
                    </c:when>                       
                </c:choose>

            </c:when>                
        </c:choose>
            <p style="color:red;">
                <br>Dentro de unos segundos sera redirigido a la pagina de INICIO</p></div>
        <script>
            setTimeout(function () {
                location.href = "index.jsp";
            }, 5000);
        </script>
    </body>
</html>
