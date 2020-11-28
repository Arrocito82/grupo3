<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import= "java.io.*,java.util.*,java.sql.*" %>
<%@ page import = "javax.servlet.http.*,javax.servlet.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>

<c:set var="pageId" value="Insert" />
<c:set var="standalone" value="not" />
<%@ include file="security.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Insertar libro</title>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <div class="contenido">
            <img src="./imagenes/informacion.png" />
            <h1>Se a insertado el libro correctamente</h1>
       
        
        <c:if test="${empty param.isbn or empty param.titulo or empty param.autor or empty param.editorial}">
            <c:redirect url="error.jsp">
                <c:param name="tipo" value="parametro"/>
                <c:param name="destino" value="index.jsp"/>
            </c:redirect>
        </c:if>
        
        <sql:update dataSource = "${fuenteDatos}" var = "result">
            INSERT INTO libro (isbn,titulo,autor,editorial) VALUES (?,?,?,?);
            <sql:param value="${param.isbn}"/>
            <sql:param value="${param.titulo}"/>
            <sql:param value="${param.autor}"/>
            <sql:param value="${param.editorial}"/>
        </sql:update>
        
        
            <a class="inicio" href="index.jsp">Regresar inicio</a>
        </div>
    </body>
</html>
