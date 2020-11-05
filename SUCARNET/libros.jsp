<%@page contentType="text/html" pageEncoding="UTF-8" import="java.sql.*,net.ucanaccess.jdbc.*" %> 
 <html>
 <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>Actualizar, Eliminar, Crear registros.</title>
 </head>
 <body>

<H1>MANTENIMIENTO DE LIBROS</H1>

<% 
   String isbnConsulta = request.getParameter("isbn");
   Statement stat = conexion.createStatement();
   ResultSet result = stat.executeQuery("select * from libros where isbn="+isbnConsulta);
%>

<form action="matto.jsp" method="get" name="Actualizar">
 <table>
 <tr>
 <td>ISBN<input type="text" name="isbn" value="<%=result.getString("isbn")%>" size="40"/>
</td>
  </tr>
 <tr>
 <td>Titulo<input type="text" name="titulo" value="" size="50"/></td>
 
 </tr>
 <tr><td> Action <input type="radio" name="Action" value="Actualizar" /> Actualizar
 <input type="radio" name="Action" value="Eliminar" /> Eliminar
 <input type="radio" name="Action" value="Crear" checked /> Crear
  </td>
 <td><input type="SUBMIT" value="ACEPTAR" />
</td>
 </tr>
 </tr>
 </table>
 </form>
 <form name="formbusca" action="libros.jsp" method="seleccion">
   Titulo a buscar: <input type="text" name="titulo" placeholder="ingrese un título"> 
   <input type="submit" name="buscar" value="BUSCAR">
 </form>
<br><br>

<%!
public Connection getConnection() throws SQLException {
String driver = "sun.jdbc.odbc.JdbcOdbcDriver";
String filePath= "c:\\Apache\\Tomcat\\webapps\\SUCARNET\\data\\datos.mdb";
String userName="",password="";
String fullConnectionString = "jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};DBQ=" + filePath;

    Connection conn = null;
try{
        Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
 conn = DriverManager.getConnection(fullConnectionString,userName,password);

}
 catch (Exception e) {
System.out.println("Error: " + e);
 }
    return conn;
}
%>
<%
Connection conexion = getConnection();
   if (!conexion.isClosed()){
out.write("OK");
 
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("select * from libros" );
      String orden = request.getParameter("orden");
      String busqueda = request.getParameter("titulo");
      String buscar = request.getParameter("buscar");
      


      if(orden != null){
         rs = st.executeQuery("select * from libros ORDER BY titulo" );
      }
      // Ponemos los resultados en un table de html
      out.println("<table border=\"1\"><tr><td>Num.</td><td>ISBN</td><td><a href='libros.jsp?orden=titulo' >Titulo</a></td><td>Acción</td></tr>");
      int i=1;
      String isbn,titulo;
      String resultado = "";
      while (rs.next())
      {
         isbn = rs.getString("isbn");
         titulo = rs.getString("titulo");
         out.println("<tr>");
         out.println("<td>"+ i +"</td>");
         out.println("<td>"+isbn+"</td>");
         out.println("<td>"+titulo+"</td>");
         out.println("<td>"+"<a href='libros.jsp?isbn="+ isbn +"'>Actualizar</a><br><a href='matto.jsp?isbn="+ isbn +"&titulo=&Action=Eliminar'>Eliminar</a>" +"</td>");
         out.println("</tr>");
         i++;
         if(titulo.equals(busqueda)){
            resultado = "El libro "+busqueda+" se ha encontrado";
         }
         else{
            resultado = "El libro "+busqueda+" no se ha encontrado";
         }
      }
      if(buscar != null){
         out.println(resultado);
         buscar = null;
      }
      
      out.println("</table>");
      // cierre de la conexion
      conexion.close();
}

%>
 </body>