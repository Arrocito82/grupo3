<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>

<c:set var="pageId" value="Index" />
<c:set var="standalone" value="not" />

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Inicio</title>
        
        <script>
            function insertar(){
                var isbn = document.getElementById("isbn").value;
                var titulo = document.getElementById("titulo").value;
                var autor = document.getElementById("autor").value;
                var editorial = document.getElementById("editorial").value;
                location.href="insert.jsp?isbn="+isbn+"&titulo="+titulo+"&autor="+autor+"&editorial="+editorial;
            }
            
            function modificaciones(isbn, titulo, autor, editorial, eleccion){
                location.href=eleccion+".jsp?isbn="+isbn+"&titulo="+titulo+"&autor="+autor+"&editorial="+editorial;   
            }
        </script>
        
    </head>
    <body>
         <%@ include file="header.jsp" %>
        <div>
            <h1>Libros</h1>
        </div>
         <c:if test="${sessionScope.nivel eq 1}">
            <div>
                <form method="POST" action="javascript:insertar();">
                    <div>
                    <label>ISBN</label>
                        <input id="isbn"  type="text">
                        <br><label>Titulo</label>
                        <input id="titulo"  type="text">
                        <br><label>Autor</label>
                        <input id="autor"  type="text">
                        <br><label>Editorial</label>
                        <input id="editorial"  type="text">
                    </div>
                    <div>
                        <button id="insertar" >Insertar</button>
                    </div>
                </form>
            </div>
        </c:if>
        
        <sql:query dataSource = "${fuenteDatos}" var = "result">
            SELECT * from libro;
        </sql:query>
        
        <div>
            <table border="1">
                <tr>
                    <th>ISBN</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <c:if test="${sessionScope.nivel eq 2}">   
                        <th>Accion</th>
                    </c:if>
                </tr>
                <c:forEach var = "row" items = "${result.rows}">
                    
                    <tr>
                        <td><c:out value = "${row.isbn}"/></td>
                        <td><c:out value = "${row.titulo}"/></td>
                        <td><c:out value = "${row.autor}"/></td>
                        <td><c:out value = "${row.editorial}"/></td>
                        <c:if test="${sessionScope.nivel eq 2}">
                            <td>
                                <button onclick="modificaciones('${row.isbn}', '${row.titulo}', '${row.autor}', '${row.editorial}', 'frmupdate');">Actualizar</button>
                                <br><button onclick="modificaciones('${row.isbn}', '${row.titulo}', '${row.autor}', '${row.editorial}', 'delete');">Eliminar</button>
                            </td>
                        </c:if>
                    </tr>
                </c:forEach>
            </table>
        </div>
    </body>
</html>
