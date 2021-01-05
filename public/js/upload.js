
let tablaAutores = document.getElementById('tablaAutores');
let tablaCategorias = document.getElementById('tablaCategorias');
let tablaGenero = document.getElementById('tablaGeneros');
var autoresids = [];
var categoriasids = [];
var generosids = [];
function agregarAutor(event){
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    var nombreAutor = select.selectedOptions[0].text;

    autoresids.push(id);
    introducirElemento(tablaAutores, nombreAutor , "autoresids");
}

function agregarCategoria(event){
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    var nombreCategoria = select.selectedOptions[0].text;

    categoriasids.push(id);
    introducirElemento(tablaCategorias,nombreCategoria , "categoriasids");
}

function agregarGenero(event){
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    var nombreGenero = select.selectedOptions[0].text;

    generosids.push(id);
    introducirElemento(tablaGenero , nombreGenero , "generosids");
   
}

function removeItemFromArray(array, i) {    
       
    if (i > -1) {
       array.splice(i, 1);
    }
  
    return array; 
}

function introducirElemento(tabla , cuerpoString , nombreArray){   
    var row = tabla.tBodies[0].insertRow(-1);
    var cuerpo = row.insertCell(0);        
    cuerpo.scope = 'row';
    cuerpo.innerHTML = cuerpoString + "<i class='icono-close ml-5 fas fa-times' onclick='deleteRow(event,"+nombreArray+")'></i>";
}


function deleteRow(event, array) {
    var row = event.currentTarget.parentElement.parentElement;
    var tabla = row.parentElement.parentElement;
    
    var i = row.rowIndex -1;
    console.log(i);
    var newAr = removeItemFromArray(array , i);
    console.log(newAr);
    array = [];
    array = newAr;
    
    tabla.deleteRow(row.rowIndex);
}

function enviarDatos(){
    var fi = document.getElementsByName("uploadedFile")[0];
    var ruta = "uploadtest.php"
    var object = {
        'autoresids': autoresids,
        'categoriasids' : categoriasids,
        'generosids': generosids,
        'md5':document.getElementById('md5').value,
        'ext':fi.value.substr(fi.value.lastIndexOf(".")),
        'titulo': document.getElementById('titulo').value,
    }
    $.ajax({
        type: "GET",
        url: ruta,
        contentType: 'application/json',
        data: {datos : JSON.stringify(object)},
        async: true,
        dataType: "text",
        success: function(data){
            console.log(data);
            if(data){
                //alert("Se ha guardado con exito");
            }
            else{
                //alert("A ocurrido un error");
            }
           
            
        }
    });
}
