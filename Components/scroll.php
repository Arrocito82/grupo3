<script>
//jshint esversion: 6


let ultima_posicion = 0;
let destino=<?php echo $destino; ?>;
let cantidad=12;
let json_resultado=<?php echo $json_resultado; ?>;
let buscar="<?php echo $target;?>", limite=cantidad,ultimo=0,ultimo_target=0;
let cargando = false;
function cargar(){
    
    if( ultimo_target < json_resultado.length) {
                    //ultimo
                    //id
                    var http = new XMLHttpRequest();

                    //acciones cuando llegue el resultado
                    http.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                       
                            document.getElementById(destino).insertAdjacentHTML("beforeend", this.responseText);
             
                         
                        datos=document.querySelectorAll("#",destino," .col-sm-6.col-md-4.col-lg-3.my-4 .card").length;
                        if(datos%cantidad!=0||(this.responseText)==""){
                           
                            
                            ultimo_target++;ultimo=0;limite=cantidad-datos%cantidad;
                            cargar();
                           
                        }
                        }
                    };

                    //enviando peticion
                    http.open("POST", "Components/procesar.php", true);
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    http.send("buscar="+buscar+"&id="+json_resultado[ultimo_target]._id.$oid+"&ultimo="+ultimo+"&limite="+limite);
                    ultimo=limite;
                    limite+=limite;
                    
        }
}
               

cargar();
window.addEventListener("scroll", function() {
    
    if(document.documentElement.scrollHeight - document.documentElement.scrollTop === document.documentElement.clientHeight){
      cargar();
    }

});
</script>