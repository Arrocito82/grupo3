<%-- 
    Document   : frmupdate
    Created on : 25-nov-2020, 19:52:35
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
            function actualizacion(){
                var isbn = document.getElementById("isbn_a").value;
                var titulo = document.getElementById("titulo_a").value;
                var autor = document.getElementById("autor_a").value;
                var editorial = document.getElementById("editorial_a").value;
                location.href="update.jsp?isbn="+${param.isbn}+"&titulo="+titulo+"&autor="+autor+"&editorial="+editorial+"&isbnN="+isbn;
            }
        </script>
         <link rel="stylesheet" href="./css/estilo.css">
    </head>
    <body>
        <%@ include file="header.jsp" %>
        <div class="formulario">
            <h1>Actualización</h1>
       
       
            <form method="POST" action="javascript:actualizacion();">
               
                    <label for="isbn_a">ISBN:<input id="isbn_a"  type="text" value="${param.isbn}"></label>
                    
                <label for="titulo_a">Titulo: <input id="titulo_a"  type="text" value="${param.titulo}"></label>
                   
                    <label for="autor_a">Autor:<input id="autor_a"  type="text" value="${param.autor}"></label>
                    
                    <label for="editorial_a">Editorial:<input id="editorial_a"  type="text" value="${param.editorial}"></label>
                    
              
                    <button id="actualizar">Actualizar</button>
              
            </form>    
                   <a class="inicio" href="index.jsp">Regresar inicio</a>
        </div>
    </body>
</html>
