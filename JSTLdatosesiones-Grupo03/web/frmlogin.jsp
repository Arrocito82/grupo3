<%-- 
    Document   : frmlogin
    Created on : 26-nov-2020, 9:53:39
    Author     : felix
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        
        <script>
            function login(){
                var usuario = document.getElementById("usuario").value;
                var clave = document.getElementById("clave").value;
                location.href="validar.jsp?usuario="+usuario+"&clave="+clave;
            }
        </script>
        <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="formulario">
       <img id="login_imagen" src="./imagenes/login.png" />
          <h1>Login</h1>  
       
        <c:if test="${not empty param.msg}">
            <p style="color:red;">Error: ${param.msg}</p>
        </c:if>
        <div>
            <form action="javascript:login();">
                <label for="usuario">Usuario:<input id='usuario' type='text' autocomplete="off" ></label>
                
                <label for="clave">Contraseña:<input id='clave' type='text' autocomplete="off"></label>
                
                <button id='login'>Ingresar</button>
            </form>
        </div></div>
    </body>
</html>
