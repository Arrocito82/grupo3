<%@page contentType="text/csv" pageEncoding="iso-8859-1" import="java.sql.*,net.ucanaccess.jdbc.*"%><%!
public Connection getConnection(String path) throws SQLException{
   String driver = "sun.jdbc.odbc.JdbcOdbcDriver";
   String filePath= path+"\\datos.mdb";
   String userName="",password="";
   String fullConnectionString = "jdbc:odbc:Driver={Microsoft Access Driver (*.mdb)};DBQ=" + filePath;
   Connection conn = null;
   try{
      Class.forName("sun.jdbc.odbc.JdbcOdbcDriver");
      conn = DriverManager.getConnection(fullConnectionString,userName,password);}
   catch (Exception e) {
      System.out.print("Error: " + e);}
   return conn;}%><%
   ServletContext context=request.getServletContext();
   String path=context.getRealPath("/data");
   Connection conexion = getConnection(path);
   if (!conexion.isClosed()){
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("SELECT * FROM libros INNER JOIN editorial ON libros.id_editorial = editorial.Id" );
      response.setStatus(200);
      response.setContentType("application/vnd.ms-excel");
      response.setHeader("Content-Type", "application/csv");
      response.setHeader("Content-Disposition", "attachment; filename=listadoLibros.csv");
      out.print("Numero;ISBN;Titulo;Autor;Publicacion;Editorial\n");
      int i=1;
      while (rs.next()){
         out.print(i +";");
         out.print(rs.getString("isbn")+";");
         out.print(rs.getString("titulo")+";");
         out.print(rs.getString("autor")+";");
         out.print(rs.getString("publicacion")+";");
         out.print(rs.getString("nombre")+";");
         out.print("\n");
         i++;}
   conexion.close();/* cierre de la conexion */}%>