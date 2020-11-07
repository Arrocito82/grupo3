<%@page contentType="text/html" pageEncoding="UTF-8" import="java.sql.*,net.ucanaccess.jdbc.*" %> 

 <html>
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <title>Actualizar, Eliminar, Crear registros.</title>
 <link rel="stylesheet" href="./css/style.css">
 </head>
 <body style="margin-top:100px;">

<H1>MANTENIMIENTO DE LIBROS</H1>

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
   System.out.println(path);
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


<div class="formContainer">
<form class="form-libro" action="matto.jsp" method="get" name="Actualizar">
 <table>
 <tr>
 <td>ISBN:  <input oninput="activarBtnAceptar()" type="text" name="isbn" value="<%=codISBN%>" size="50"/>
</td>
  </tr>
 <tr>
 <td>Titulo:  <input  oninput="activarBtnAceptar()" type="text" name="titulo" value="<%=title%>" size="50"/></td>
 </tr>
<tr>
 <td>Autor:  <input  oninput="activarBtnAceptar()" type="text" name="autor" value="<%=aut%>" size="50"/>
</td>
</tr>
<tr>
 <td>Publicacion:  <input  oninput="activarBtnAceptar()" type="text" name="publicacion" value="<%=publica%>" size="45"/>
</td>
</tr>
<tr>
 <td>Editorial
    <select class="editorial-select" name="editorial" id="edi1" >
    <% 
      String id, nombre;
      while(resultEdi.next()){
      id = resultEdi.getString("Id");
      nombre = resultEdi.getString("nombre");

      if(id.equals(edi)){ %>   
      <option value="<%=id%>" selected><%=nombre%></option>
      <% } else { %>
      <option value="<%=id%>" ><%=nombre%></option>
   <% }} %> 
    </select>
</td>
</tr>


 <tr><td> Action
 <% if(isbnConsulta != null){ %>
 <input type="radio" name="Action" value="Actualizar" checked/> Actualizar
 <input type="radio" name="Action" value="Eliminar" /> Eliminar
 <input type="radio" name="Action" value="Crear"  /> Crear
 <% } else { %>
 <input type="radio" name="Action" value="Actualizar" /> Actualizar
 <input type="radio" name="Action" value="Eliminar" /> Eliminar
 <input type="radio" name="Action" value="Crear" checked /> Crear
 <% } %>
  </td>
 <td><input id='btnAcepp' class='btn-aceptar'type="SUBMIT" value="ACEPTAR" disabled />
</td>
 </tr>
 </tr>
 </table>
 </form>

 <form class='buscarform' name="formbusca" action="libros.jsp" method="get">
   Titulo a buscar: <input id="t1" type="text" oninput="activarBusqueda()" name="titulo1"  placeholder="Ingrese un título"><br><br>
   Autor a buscar: <input id="a1" type="text" oninput="activarBusqueda()" name="autor1" placeholder="Ingrese un autor">
 <input id="b1" class="btn-buscar" type="submit" name="buscar" value="BUSCAR" disabled>
   
 </form>
</div>
<br><br>


<%
Connection conexion = getConnection(path);
   if (!conexion.isClosed()){

 
      Statement st = conexion.createStatement();
      ResultSet rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial;");
      String orden = request.getParameter("orden");
      String busquedaTitulo = request.getParameter("titulo1");
      String busquedaAutor = request.getParameter("autor1");
      String buscar = request.getParameter("buscar");
      String titulo, autor; 
       
      if(buscar != null){
         while(rs.next()){
            titulo = rs.getString("titulo");
            autor = rs.getString("autor");

            if(busquedaTitulo.equals(titulo) && busquedaAutor.equals(autor)){
               rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial where titulo='"+busquedaTitulo+"' and autor='"+busquedaAutor+"'" );
               break;
            }else if((!(busquedaTitulo.equals(titulo)) && busquedaAutor.equals(autor)) || (busquedaTitulo.equals(titulo) && !(busquedaAutor.equals(autor)))){
               rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial where titulo='"+busquedaTitulo+"' or autor='"+busquedaAutor+"'" );
               break;
            }
            
         }
      }
      
      
      if(orden != null){
         rs = st.executeQuery("SELECT libros.titulo, libros.isbn, libros.autor, libros.publicacion, editorial.nombre FROM editorial INNER JOIN libros ON editorial.Id = libros.id_editorial ORDER BY libros.titulo;" );
      }
      // Ponemos los resultados en un table de html
      out.println("<div class='libros-container'><table class='tabla-libros' border=\"1\"><tr class='table-libros-headers'><td>Num.</td><td>ISBN</td><td><a href='libros.jsp?orden=titulo' >Titulo</a></td><td>Autor</td><td>Publicacion</td><td>Editorial</td><td>Acción</td></tr>");
      int i=1;
      String isbn, publicacion, edit;
      String resultado = "";
      while (rs.next())
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
      if(buscar != null){
         out.println(resultado);
         buscar = null;
      }
      
      out.println("</table></div>");
      // cierre de la conexion
      conexion.close();
}

%>
<a class="btn-csv" href="listado-csv.jsp" download="Libros.csv">Descargar Listado CSV</a>
 <script type="text/javascript"> 
   function activarBusqueda(){
      if(document.getElementById("a1").value=="" && document.getElementById("t1").value==""){
         document.getElementById("b1").disabled = true;
      }else{
         document.getElementById("b1").disabled = false;
      }
   }
   function activarBtnAceptar(){
      var forInputList = document.querySelectorAll('.form-libro > table > tbody > tr > td > input[type="text"]');
      
      if(forInputList[0].value=="" && forInputList[1].value=="" && forInputList[2].value=="" && forInputList[3].value==""){
         document.getElementById('btnAcepp').disabled= true;
      }
      else{
         document.getElementById('btnAcepp').disabled= false;
      }
   }
    
 </script>

 </body>