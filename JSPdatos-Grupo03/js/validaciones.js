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
  