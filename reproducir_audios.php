<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";
require "Components/clases.php";


if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container'>
            
            <div class=' row'>
                <h1 class='mx-0 col-md-6 col-sm-12'>Mis Audios</h1>
                <div  id='reproducir_lista'  class='mt-auto mb-1 col-md-6 col-sm-12 h-75 d-flex flex-row-reverse' style='display:none;'>
                
                    <button type='button' class='btn btn-primary ' onclick='reproducirTodos();'> 
                    <i class='fas fa-play'></i> Reproducir Lista</button>
                </div>
            </div>
            <div class='bg-light mx-1 my-1 pt-2 row rounded' id='audio_controls_div'>
                    
                <div class='col-sm-12 col-md-6 ' >
                        <audio controls id='audio_controls' class='w-100 m-0'>
                            <source src='' type='audio/ogg'>
                            <source src='' type='audio/wav'>
                            <source src='' type='audio/mpeg'>
                            Your browser does not support the audio element.
                        </audio>
                </div>
                <div class='col-sm-12 col-md-6 '>
                    
                    
                </div>
            </div>
            <div class='scroll overflow-auto' style='max-height:55vh;' id='scroll_box'>
                    <ul class='list-group' id='audios'></ul>    
            
            </div>
        </div>";
            
}?>

<script>
  
      let id_usuario='<?php echo $_SESSION['id_usuario']?>';
      let audios_ids = [];
      let current_audio = 0;
      function cargar(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    document.getElementById('audios').innerHTML='';
                    result.forEach(element => {
                        audios_ids.push(element._id.$oid);
                        document.getElementById('audios').insertAdjacentHTML('beforeend', `<li class="list-group-item d-flex justify-content-between text-white bg-dark border-secondary" id="${element._id.$oid}">
                        <p class="my-auto" >
                              ${element.titulo}
                        </p>
                        <div class="d-flex flex-row-reverse bd-highlight">
                        
                        <button type="button" class="btn btn-primary mr-1" onclick="reproducir('${element._id.$oid}')"><i class='fas fa-play'></i></button>
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
      
      function reproducirTodos() {
            current_audio = 0;
            if(current_audio<audios_ids.length){
                reproducir(audios_ids[current_audio]);
            }

        }

        function siguiente() {

            current_audio++;
            if(current_audio<audios_ids.length){
                reproducir(audios_ids[current_audio]);
            }
            
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
                    
                    document.getElementById('audio_controls_div').innerHTML=`
                    
                  
                        <div class="col-sm-12 col-md-6">
                                <audio controls id="audio_controls" autoplay class='w-100 m-0' onended = "siguiente();">
                                <source src="${result[0]}" type="audio/ogg">
                                <source src="${result[0]}" type="audio/wav">
                                <source src="${result[0]}" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            
                                    <p class="mt-3 p-1">${result[1]}</p>
                            
                        </div>`;
                        

                }
            };
            xhttp.open("POST", "crud_audio.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(consulta);

           
            
      }
      function reproducirOne( id) {
        $('.alert').alert('close');
            let xhttp = new XMLHttpRequest();
            consulta=JSON.stringify({
                        'crud':'recuperar',
                        'audio_id':id
                        });
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    
                    document.getElementById('audio_controls_div').innerHTML=`
                    
                  
                        <div class="col-sm-12 col-md-6">
                                <audio controls id="audio_controls" autoplay class='w-100 m-0'>
                                <source src="${result[0]}" type="audio/ogg">
                                <source src="${result[0]}" type="audio/wav">
                                <source src="${result[0]}" type="audio/mpeg">
                                Your browser does not support the audio element.
                                </audio>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            
                                    <p class="mt-3 p-1">${result[1]}</p>
                            
                        </div>`;
                        

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