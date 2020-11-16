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

        <body style="margin-top:100px;" onload="cargar()">

            <H1>MANTENIMIENTO DE LIBROS</H1>





            <div class="formContainer">
                <form class="form-libro" action="matto.jsp" method="get" name="Actualizar">
                    <ul class="ul-form">
                        <li>ISBN: <input type="text" name="isbn" value="" size="50" maxlength="13" pattern="[0-9]*$" title="Solo se admiten numeros" required/></li>
                        <li>Titulo: <input type="text" name="titulo" value="" size="50" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$" title="No se permitem numeros" required/></li>
                        <li>Autor: <input type="text" name="autor" value="" size="50" required/></li>
                        <li>Publicacion: <input type="text" name="publicacion" value="" size="50" required required maxlength="4" pattern="[0-9]{4}" title="Debe introducir el año de publicacion del libro " /></li>

                        <li class="editorialLi">Editorial
                            <select class="editorial-select" name="editorial" id="edi1"></select>
                        </li>

                        <li class="ActionRadio"> Action

                            <input type="radio" name="Action" value="Actualizar" checked/> Actualizar
                            <input type="radio" name="Action" value="Eliminar" /> Eliminar
                            <input type="radio" name="Action" value="Crear" /> Crear

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
            <script>
                function buscar() {
                    var titulo1 = document.getElementById("t1").value;
                    var autor1 = document.getElementById("a1").value;
                    var buscar = document.getElementById("b1").value;
                    console.log(autor1);
                    console.log(titulo1);
                    console.log(buscar);
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("tablaDatos").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "procesaLibros.jsp?titulo1=" + titulo1 + "&autor1=" + autor1 + "&buscar=" + buscar, true);
                    xhttp.send();
                }

                function cargar() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("tablaDatos").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "procesaLibros.jsp", true);
                    xhttp.send();
                }

                function refrescar() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("tablaDatos").innerHTML = this.responseText;
                        }
                    };
                    xhttp.open("GET", "procesaLibros.jsp?titulo1=&autor1=&refrescar=REFRESCAR", true);
                    xhttp.send();
                }
            </script>
        </body>