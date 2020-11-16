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

   String isbnConsulta = request.getParameter("isbn");
   String editorial = request.getParameter("nombre");
   Statement state = conex.createStatement();
   ResultSet result = state.executeQuery("select * from libros where isbn='"+isbnConsulta+"'");
   Statement stateEdi = conex.createStatement();
   ResultSet resultEdi = stateEdi.executeQuery("select * from editorial");

   String codISBN = "";
   String title = "";
   String aut = "";
   String publica = "";
   String edi = "";

   while(result.next()){
      codISBN = result.getString("isbn");
      title = result.getString("titulo");
      aut = result.getString("autor");
      publica= result.getString("publicacion");
      edi = result.getString("id_editorial");
   }
   if(isbnConsulta != null){

   }

%>




<%
Connection conexion = getConnection(path);
   if (!conexion.isClosed()){

 
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial;");
      String orden = request.getParameter("orden");
      String busquedaTitulo = request.getParameter("titulo1");
      String busquedaAutor = request.getParameter("autor1");
      String buscar = request.getParameter("buscar");
      String refrescar = request.getParameter("refrescar");
       
      if(buscar != null){  
         if(!busquedaTitulo.equals("") && !busquedaAutor.equals("")){  
            rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial where titulo LIKE"+"'%"+busquedaTitulo+"%'"+" and autor LIKE"+"'%"+busquedaAutor+"%'");    
         }
         else if(!busquedaTitulo.equals("") && busquedaAutor.equals("")){
            rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial where titulo LIKE"+"'%"+busquedaTitulo+"%'");
         }
         else if(busquedaTitulo.equals("") && !busquedaAutor.equals("")){
            rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial where autor LIKE"+"'%"+busquedaAutor+"%'");
         }          
      }

      if(refrescar != null){
         rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial;");
      }
      
      
      if(orden != null){
         rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial ORDER BY libros.titulo;" );
      }
      // Ponemos los resultados en un table de html
      out.println("<div class='libros-container'>");
      int i=1;
      if(rs.next()){
         out.println("<table class='tabla-libros' border=\"1\"><tr class='table-libros-headers'><td>Num.</td><td>ISBN</td><td><a href='libros.jsp?orden=titulo' >Titulo</a></td><td>Autor</td><td>Publicacion</td><td>Editorial</td><td>Acción</td></tr>");
         //rs.beforeFirst();
         String isbn, publicacion, edit, titulo, autor;
         do
         {
            isbn = rs.getString("isbn");
            titulo = rs.getString("titulo");
            autor = rs.getString("autor");
            publicacion = rs.getString("publicacion");
            edit = rs.getString("nombre");

            out.println("<tr class='tr-libros'>");
            out.println("<td style='text-align: center;'>"+ i +"</td>");
            out.println("<td>"+isbn+"</td>");
            out.println("<td>"+titulo+"</td>");
            out.println("<td>"+autor+"</td>");
            out.println("<td>"+publicacion+"</td>");
            out.println("<td>"+edit+"</td>");
            out.println("<td class='btn-container'>"+"<a class='btn-actualizar' href='libros.jsp?isbn="+ isbn +"'>Actualizar</a><br><a class='btn-eliminar' href='matto.jsp?isbn="+ isbn +"&titulo=&Action=Eliminar'>Eliminar</a>" +"</td>");
            out.println("</tr>");
            i++;
         }        
         while (rs.next());
         
         out.println("</table></div>");
      }
      else{
         out.println("<p class='msg-NoLibros'>No hay libros que mostrar</p></div>");
      }
      // cierre de la conexion
      conexion.close();
}

%>


