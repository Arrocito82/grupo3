<%-- 
    Document   : delete
    Created on : 25-nov-2020, 21:15:01
    Author     : felix
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>

<c:set var="pageId" value="Delete" />
<c:set var="standalone" value="not" />
<%@ include file="security.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body> 
        <div class="notificacion">
            <img src="./imagenes/informacion.png" />
            <h1>Eliminar libro</h1>
        
         
        <c:if test="${empty param.isbn}">
            <c:redirect url="error.jsp">
                <c:param name="tipo" value="parametro"/>
                <c:param name="destino" value="index.jsp"/>
            </c:redirect>
        </c:if> 
        
        <sql:update dataSource = "${fuenteDatos}" var = "count">
            DELETE FROM libro WHERE isbn = ?
            <sql:param value = "${param.isbn}"/>
        </sql:update>
            
        <div>
            <p>A continuación se elimino el libro con los siguientes datos:</p>
        </div>
        <div>
            <table class="tablaLibros">
                <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                </tr></thead>
                <tbody>
                <tr>
                    <td>${param.isbn}</td>
                    <td>${param.titulo}</td>
                    <td>${param.autor}</td>
                    <td>${param.editorial}</td>
                </tr>
                </tbody>
            </table>
        </div>
       
                <a class="inicio" href="index.jsp">Regresar inicio</a>
        </div>
    </body>
</html>
