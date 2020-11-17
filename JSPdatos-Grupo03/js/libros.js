//jshint esversion: 6
var isbn = document.getElementById("isbn");
var select = document.getElementById("edi1");

var autor = document.getElementById("autor");
var titulo = document.getElementById("titulo");
var publicacion = document.getElementById("publicacion");
var radioButton = document.getElementsByName("Action");
var editorialFlag = false;
isbn.addEventListener("keydown", function(event) {
    validacionInput(/[0-9]+$/i , event)
});

autor.addEventListener("keydown", function(event){
    validacionInput(/[A-Za-zÁÉÍÓÚáéíóúñÑ ]+$/i , event);
});

titulo.addEventListener("keydown", function(event) {
    validacionInput(/[A-Za-zÁÉÍÓÚáéíóúñÑ0-9 ]+$/i , event);
});

publicacion.addEventListener("focusout", function(event) {
    validarPublicacionInput(/^(1[0-9][0-9][0-9]|20[0-9][0-9]|2100)$/i , event)
});
publicacion.addEventListener("keydown", function(event) {
    validacionInput(/[0-9 ]+$/i , event)
    
});

select.addEventListener("change", function() {

    if (select.selectedIndex > 0) editorialFlag = true;
});

function validarPublicacionInput(pattern, event){
    var element = event.currentTarget.value;
    var fecha = new Date();
    fecha = fecha.getFullYear();
    console.log(fecha);
    if(element.length < 4) element = "0" + element;    
    if(element.length < 4) element = "0" + element;  
    if (!(pattern.test(element))) {
        event.currentTarget.value = "";    
        alerta(event);
        return 0;    
    }
    if(element > fecha){ alert(message);}
}
function validacionInput(pattern , event){

    var element = event.keyCode || event.which;
    var teclasIgnoradas=[8,16,18,9,39,40,38,37];
    if(teclasIgnoradas.includes(element)) return 0;
    element = String.fromCharCode(element);
    if (!(pattern.test(element))) {
        event.returnValue = false;
        alerta(event); 
        return 0;       
    }
    alertaOff(event);
    
    
}
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

function aceptar() {
    

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
    editorialFlag = true;
}

function activarBusqueda() {
    if (document.getElementById("a1").value == "" && document.getElementById("t1").value == "") {
        document.getElementById("b1").disabled = true;
    } else {
        document.getElementById("b1").disabled = false;
    }
}


function validarFormulario() {
    console.log("validando..");

    if(isbn.value == "" | titulo.value =="" | publicacion.value == "" | autor.value == ""){  alert("Ingrese todos los datos del formulario"); return 0;}
    console.log("estan llenos");
    console.log(editorialFlag);
    if(!editorialFlag){
        alert("Seleccione una editorial")
        return 0;
    }

    aceptar();
}
function alerta(event){
   // console.log(event.currentTarget);
    var divError =event.currentTarget.parentNode.lastElementChild;
    divError.style.visibility = "visible";
}
function alertaOff(event){
  //  console.log(event.currentTarget);
    var divError =event.currentTarget.parentNode.lastElementChild;
    divError.style.visibility = "hidden";
}