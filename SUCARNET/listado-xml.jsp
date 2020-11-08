<%@page contentType="text/csv" pageEncoding="iso-8859-1" import="java.sql.*,net.ucanaccess.jdbc.*"%><%!
public Connection getConnection() throws SQLException{
   String driver = "sun.jdbc.odbc.JdbcOdbcDriver";
   String filePath= "c:\\Apache\\Tomcat\\webapps\\grupo3\\SUCARNET\\data\\datos.mdb";
   String userName="",password="";
   String fullConnectionString = "jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};DBQ=" + filePath;
   Connection conn = null;
   try{
      Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
      conn = DriverManager.getConnection(fullConnectionString,userName,password);}
   catch (Exception e) {
      System.out.print("Error: " + e);}
   return conn;}%><%
   Connection conexion = getConnection();
   if (!conexion.isClosed()){
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("select * from libros" );
      response.setStatus(200);
      response.setContentType("text/xml");
      response.setHeader("Content-Type", "application/xml");   
      response.setHeader("Content-Disposition", "attachment; filename=listadoLibros.xml");
      out.print("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");
      out.print("\n");
      out.print("<libros>");
      out.print("\n");
      int i=1;
      while (rs.next()){
         out.print("<libro" + i +">");
         out.print("\n");
         out.print(" <numero>" + i);
         out.print(" </numero>");
         out.print("\n");
         out.print(" <ISBN>" + rs.getString("isbn"));
         out.print(" </ISBN>");
         out.print("\n");
         out.print(" <titulo>"+rs.getString("Titulo"));
         out.print(" </titulo>");
         out.print("\n");
         out.print("</libro" + i + ">");
         out.print("\n");
         i++;}
      out.print("</libros>");
   conexion.close();/* cierre de la conexion */}%>
