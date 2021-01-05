<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container'>
            <h1 class='mx-0'>Mis Audios</h1>
            <div class='scroll overflow-auto' style='max-height:65vh;' id='scroll_box'>
            <ul class='list-group' id='audios'></ul>    
            </div>
      </div>";
            
}?>

<script>
      let id_usuario='<?php echo $_SESSION['id_usuario']?>';
      function cargar(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    
                    result.forEach(element => {
                        document.getElementById('audios').insertAdjacentHTML('beforeend', `<li class="list-group-item d-flex justify-content-between text-white bg-dark border-secondary" id="${element._id.$oid}">
                        <p class="my-auto" >
                              ${element.titulo}
                        </p>
                        <div class="d-flex flex-row-reverse bd-highlight">
                        
                        <button type="button" class="btn btn-danger " onclick="eliminar('${element._id.$oid}')">Eliminar</button>
                        <button type="button" class="btn btn-success mr-1" onclick="modificar('${element._id.$oid}')">Modificar</button>
                        <button type="button" class="btn btn-primary mr-1" onclick="reproducir('${element._id.$oid}')">Reproducir</button>
                        </div></li>`);
                    });
                    

                }
            };
            xhttp.open("POST", "crud_audio.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({
                'crud': 'find',
                'usuario_id': id_usuario
            }));
            
      }
      function reproducir( id) {
        $('.alert').alert('close');
            let xhttp = new XMLHttpRequest();
            consulta=JSON.stringify({
                        'crud':'recuperar',
                        'audio_id':id
                        });
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    
                    document.getElementById('scroll_box').insertAdjacentHTML('afterend',`<div class="alert alert-dark fade show d-flex justify-content-between" role="alert">
                  
                  <div class="d-flex justify-content-center">
                        <audio controls>
                        <source src="${result.url}" type="audio/ogg">
                        <source src="${result.url}" type="audio/mpeg">
                        Your browser does not support the audio element.
                        </audio><h5 class="my-auto ml-5 d-inline-block" >${result.titulo}</h5>
                  </div>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button></div>`);
                        

                }
            };
            xhttp.open("POST", "crud_audio.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(consulta);

           
            
      }
      cargar();
</script>
<!-- <script src="public/js/administrar_audios.js"></script> -->

<?php
    require "Components/footer.php"; 
    ?>