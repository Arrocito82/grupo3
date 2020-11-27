<%-- 
    Document   : update
    Created on : 25-nov-2020, 20:33:31
    Author     : felix
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.io.*,java.util.*,java.sql.*" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/core" prefix = "c" %>
<%@ taglib uri = "http://java.sun.com/jsp/jstl/sql" prefix = "sql" %>
<%@ include file="fuentedatos.jsp" %>

<c:set var="pageId" value="Update" />
<c:set var="standalone" value="not" />
<%@ include file="security.jsp" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
        
    </head>
    <body>
        <div>
            <h1>Se han actualizado los datos</h1>
        </div>
        
        <c:if test="${empty param.isbn or empty param.titulo or empty param.autor or empty param.editorial}">
            <c:redirect url="error.jsp">
                <c:param name="tipo" value="parametro"/>
                <c:param name="destino" value="index.jsp"/>
            </c:redirect>
        </c:if>
        
        <c:set var = "id" value = "${param.isbn}"/>
        
        <sql:update dataSource = "${fuenteDatos}" var = "count">
            UPDATE libro SET isbn=?,titulo=?,autor=?,editorial=? WHERE isbn=?
            <sql:param value="${param.isbnN}"/>
            <sql:param value="${param.titulo}"/>
            <sql:param value="${param.autor}"/>
            <sql:param value="${param.editorial}"/>
            <sql:param value="${id}"/>
        </sql:update>
        
        <div>
            <a href="index.jsp">Regresar inicio</a>
        </div>
    </body>
</html>
