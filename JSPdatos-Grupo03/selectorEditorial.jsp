<%@page contentType="text/html" pageEncoding="UTF-8" import="java.sql.*,net.ucanaccess.jdbc.*" %> 
<%@page import="java.lang.*" %>

<%!
public Connection getConnection(String path) throws SQLException {
String driver = "sun.jdbc.odbc.JdbcOdbcDriver";
String filePath= path+"\\datos.mdb";
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
   ServletContext context = request.getServletContext();
   String path = context.getRealPath("/data");
   Connection conex = getConnection(path);

   Statement stateEdi = conex.createStatement();
   ResultSet resultEdi = stateEdi.executeQuery("select * from editorial");

 
   if (!conex.isClosed()){
  String id, nombre;
  //out.println("<select>");
            while(resultEdi.next()){
               
                  id = resultEdi.getString("Id");
                  nombre = resultEdi.getString("nombre");
 
       out.println("<option value="+id+">"+nombre+"</option>");
      
}
//out.println("</select>");
}
conex.close();
   

%>


