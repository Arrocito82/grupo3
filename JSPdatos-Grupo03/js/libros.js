//jshint esversion: 6
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

function crear() {

    var isbn = document.getElementById("isbn").value;
    var select = document.getElementById("edi1").value;

    var autor = document.getElementById("autor").value;
    var titulo = document.getElementById("titulo").value;
    var publicacion = document.getElementById("publicacion").value;
    var radioButton = document.getElementsByName("Action");
    var accion;
    radioButton.forEach(element => {
        if (element.checked) {
            accion = element.value;
        }
    });

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            refrescar();
        }
    };
    xhttp.open("POST", "matto.jsp", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("isbn=" + isbn + "&titulo=" + titulo + "&autor=" + autor + "&publicacion=" + publicacion + "&editorial=" + select + "&Action=" + accion);
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
            document.getElementById("t1").value = "";
            document.getElementById("a1").value = "";
            document.getElementById("isbn").value = "";
            document.getElementById("titulo").value = "";
            document.getElementById("autor").value = "";
            document.getElementById("publicacion").value = "";
            document.getElementById("edi1").value = "0";
            document.getElementById("radioCrear").checked = true;
        }
    };
    xhttp.open("GET", "procesaLibros.jsp?titulo1=&autor1=&refrescar=REFRESCAR", true);
    xhttp.send();
}

function cargarEditoriales() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("edi1").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "selectorEditorial.jsp", true);
    xhttp.send();
}

function eliminar(isbn) {

    var xhttp = new XMLHttpRequest();
    var libro = document.getElementById(isbn);
    var titulo = libro.childNodes[5].textContent;
    var autor = libro.childNodes[7].textContent;
    if (confirm("Desea eliminar el libro " + titulo + " con isbn " + isbn + " del autor" + autor) == true) {
        xhttp.open("GET", "matto.jsp?isbn=" + isbn + "&titulo=&Action=Eliminar", true);
        xhttp.send();
        alert("se elimino el libro" + titulo);
        refrescar();
    } else {

    }

}

function editar(isbn) {
    alert("se actualizo " + isbn);
    var libro = document.getElementById(isbn);

    var titulo = libro.childNodes[5].textContent;
    var autor = libro.childNodes[7].textContent;
    var publicacion = libro.childNodes[9].textContent;
    var editorial_id = libro.childNodes[11].getAttribute("value");
    document.getElementById("edi1").value = editorial_id;
    document.getElementById("autor").value = autor;
    document.getElementById("titulo").value = titulo;
    document.getElementById("publicacion").value = publicacion;
    document.getElementById("isbn").value = isbn;

    document.getElementById("radioActualizar").checked = true;
}