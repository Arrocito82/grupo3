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
      response.setContentType("application/json");
      response.setHeader("Content-Type", "application/json");   
      response.setHeader("Content-Disposition", "attachment; filename=listadoLibros.json");
      out.print("{");
      out.print("\n");
      System.out.print(rs);
      int i=1;
      int n=1;
      int j=0;
      String ti;
      out.print("\"libros\"" + ": [\n" );
      while (rs.next()){
         ti=rs.getString("titulo");
         out.print("{\"Num\": " + i + " , \"ISBN\": "+ rs.getString("isbn") + " , \"Titulo\": \"" + ti + "\" }");
         
         out.print(" ,");
         out.print("\n");
         i++;
         }
         out.print(" ]");
         out.print("\n");
         out.print("}");
   conexion.close();/* cierre de la conexion */}%>
