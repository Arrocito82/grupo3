<%@page contentType="text/html" pageEncoding="UTF-8" import="java.sql.*,net.ucanaccess.jdbc.*" %>
    <%@page import="java.lang.*" %>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar, Eliminar, Crear registros.</title>
            <link rel="stylesheet" href="./css/style.css">
            <script src="./js/validaciones.js"></script>

        </head>

        <body style="margin-top:100px;" onload="cargar();cargarEditoriales()">

            <H1>MANTENIMIENTO DE LIBROS</H1>





            <div class="formContainer">
                <form class="form-libro" action="matto.jsp" method="get" name="Actualizar">
                    <ul class="ul-form">
                        <li>ISBN: <input id="isbn" type="text" name="isbn" value="" size="50" maxlength="13" pattern="[0-9]*$" title="Solo se admiten numeros" required/></li>
                        <li>Titulo: <input id="titulo" type="text" name="titulo" value="" size="50" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" title="No se permitem numeros" required/></li>
                        <li>Autor: <input id="autor" type="text" name="autor" value="" size="50" required/></li>
                        <li>Publicacion: <input id="publicacion" type="text" name="publicacion" value="" size="50" required required maxlength="4" pattern="[0-9]{4}" title="Debe introducir el año de publicacion del libro " /></li>

                        <li class="editorialLi">Editorial
                            <select class="editorial-select" name="editorial" id="edi1"></select>
                        </li>

                        <li class="ActionRadio"> Action

                            <input id="radioActualizar" type="radio" name="Action" value="Actualizar" checked/> Actualizar
                            <input id="radioEliminar" type="radio" name="Action" value="Eliminar" /> Eliminar
                            <input id="radioCrear" type="radio" name="Action" value="Crear" /> Crear

                        </li>

                        <li><input id='btnAcepp' class='btn-aceptar' type="SUBMIT" value="ACEPTAR" /></li>
                    </ul>
                </form>

                <div class='buscarform'>
                    <ul class="ul-form">
                        <li> Titulo a buscar: <input id="t1" type="text" size="50" oninput="activarBusqueda()" name="titulo1" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" title="No se permitem numeros" placeholder="Ingrese un título" /></li>
                        <li> Autor a buscar: <input id="a1" type="text" size="50" oninput="activarBusqueda()" name="autor1" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" title="No se permitem numeros" placeholder="Ingrese un autor" /></li>
                        <li><button id="b1" class="btn-buscar" name="buscar" value="BUSCAR" onclick="buscar()" disabled>Buscar</button></li>
                        <li><button id="r1" class="btn-refrescar" name="refrescar" value="REFRESCAR" onclick="refrescar()">Refrescar</button></button>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="tablaDatos" onload="cargar()">

            </div>


            <div class="descargarbtn">
                <a class="btn-csv" href="listado-csv.jsp" download="Libros.csv">Descargar Listado CSV</a>
                <a class="btn-csv" href="listado-json.jsp" download="libros.json">Descargar Listado JSON</a>
                <a class="btn-csv" href="listado-txt.jsp" download="libros.txt">Descargar Listado TXT</a>
                <a class="btn-csv" href="listado-xml.jsp" download="libros.xml">Descargar Listado XML</a>
            </div>
            <script src="js/libros.js"></script>
        </body>