let newACGtipo = "";
let tablaAutores = document.getElementById('tablaAutores');
let tablaCategorias = document.getElementById('tablaCategorias');
let tablaGenero = document.getElementById('tablaGeneros');
var autoresids = [];
var categoriasids = [];
var generosids = [];
let modalCrear = document.getElementById('modalCrear');
function agregarAutor(event){    
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    if(autoresids.includes(id))
        return 0;
    var nombreAutor = select.selectedOptions[0].text;

    autoresids.push(id);
    introducirElemento(tablaAutores, nombreAutor , "autoresids");
}

function agregarCategoria(event){
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    if(categoriasids.includes(id))
        return 0;
    var nombreCategoria = select.selectedOptions[0].text;

    categoriasids.push(id);
    introducirElemento(tablaCategorias,nombreCategoria , "categoriasids");
}

function agregarGenero(event){
    var select = event.currentTarget.parentElement.parentElement.querySelectorAll("select")[0];
    var id = select.value;
    if(generos.includes(id))
        return 0;
    var nombreGenero = select.selectedOptions[0].text;

    generosids.push(id);
    introducirElemento(tablaGenero , nombreGenero , "generosids");
   
}

function newACG(tipo){
    newACGtipo = tipo;   
    
    const nameCapitalized = tipo.charAt(0).toUpperCase() + tipo.slice(1)
    document.getElementById('mtCrear').innerHTML= 'Crear Nuevo ' + nameCapitalized;
    document.getElementById('mbCrear').innerHTML = 'Ingresa el nombre del nuevo ' + nameCapitalized;
    $('#modalCrear').modal('toggle');
}

function send(){
    var nombre = "";
    var tipo = newACGtipo;
    nombre = document.getElementById('inputCrear').value;
    if(nombre==""){
        alert("ingresa un nombre para el nuevo" + newACGtipo);
        return 0;
    }
    $('#modalCrear').modal('hide');
    var object = {
        'nombre': nombre,
        'tipo': tipo
    }
    var ruta = "/new.php";
    $.ajax({
        type: "GET",
        url: ruta,
        contentType: 'application/json',
        data: {datos : JSON.stringify(object)},
        async: true,
        dataType: "text",
        success: function(data){
            console.log(data);          
            
            if(tipo == 'autor'){
                autoresids.push(data);
                introducirElemento(tablaAutores, nombre , "autoresids");
            }
            if(tipo =='categoria'){
                categoriasids.push(data);
                introducirElemento(tablaCategorias, nombre , "categoriasids");
            }
            if(tipo == 'genero'){
                generosids.push(data);
                introducirElemento(tablaGenero, nombre , "generosids");
            }
           
            
            if(data){
                //alert("Se ha guardado con exito");
            }
            else{
                //alert("A ocurrido un error");
            }
           
            
        }
    });
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
    if(cuerpoString.length > 12)
        cuerpoString = cuerpoString.substr(0,9)+ "..";
    
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
$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });