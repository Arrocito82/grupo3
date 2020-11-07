<%@page contentType="text/csv" pageEncoding="iso-8859-1" import="java.sql.*,net.ucanaccess.jdbc.*"%>
<%!
public Connection getConnection() throws SQLException{
   String driver = "sun.jdbc.odbc.JdbcOdbcDriver";
   String filePath= "c:\\Apache\\Tomcat\\webapps\\grupo3\\SUCARNET\\data\\datos.mdb";
   String userName="",password="";
   String fullConnectionString = "jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};DBQ=" + filePath;
   Connection conn = null;
   try{
      Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
      conn = DriverManager.getConnection(fullConnectionString,userName,password);
      }
   catch (Exception e) {
      System.out.print("Error: " + e);
      }
   return conn;
   }%>
<%
   Connection conexion = getConnection();
   if (!conexion.isClosed()){
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("select * from libros" );
      response.setStatus(200);
      response.setContentType("application/vnd.ms-excel");
      response.setHeader("Content-Type", "application/csv");
      response.setHeader("Content-Disposition", "attachment; filename=listadoLibros.csv");
      out.print("Numero;ISBN;Titulo\n");
      int i=1;
      while (rs.next()){
         out.print(i +";");
         out.print(rs.getString("isbn")+";");
         out.print(rs.getString("titulo")+";");
         out.print("\n");
         i++;
         }
   conexion.close();/* cierre de la conexion */
   }
%>