<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<table id="header">
    <tr>
        <td id="logo">
            Libros
        </td>
        <td>
            SISTEMA DE REGISTRO DE LIBROS<br>
            <b class="usuario">${sessionScope.nombre}</b>
        </td>
        <td id="login">
    
          <c:if test="${not empty sessionScope.user}">
              <c:if test="${sessionScope.user != 'Anonimo'}">
              <span class="usuario">
                  Usuario: ${sessionScope.user}</span><br>
                  <a href="logout.jsp">Logout</a>
              </c:if>
          </c:if>
        
   
    <c:if test="${empty sessionScope.user or sessionScope.user eq 'Anonimo'}">
          <span style="color:brown;font-size:5mm;">
              <a href="frmlogin.jsp">Login</a>
        </span>
    </c:if>
</td>
</tr>    
</table>
