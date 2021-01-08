<?php 
$title="Administrar Listas";
use Repositories\UsuarioRepo;
require "Components/header.php";


if(!(isset($_SESSION['userName']))){

    header("Location: index.php");
}
if(isset($_SESSION['id_usuario'])){
   
   $listas = UsuarioRepo::ObtenerSimpleListasUsuario($_SESSION['id_usuario']);
    
    


echo "  <div class='container'style='min-height:90vh; >
            <h1 class='mx-0'>Mis Audios</h1>
            <div class='scroll overflow-auto' style='max-height:65vh;' id='scroll_box'>
            <ul class='list-group' id='audios'></ul>    
            </div>
      </div>";
            
}?>
<div class="modal fade" id="modificar_audio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="current_titulo"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="new_titulo" class="col-form-label">Titulo:</label>
                            <input type="text" class="form-control" id="new_titulo">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="modificar();">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
<script>
    let modificar_id, modificar_titulo;
      let id_usuario='<?php echo $_SESSION['id_usuario']?>';
      function update_mesaje() {
            document.getElementById('scroll_box').insertAdjacentHTML('afterend', `
                    <div class="alert alert-secondary fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$('.alert').alert('close');">Audios Actualizado</div>`);
            setTimeout(() => {
                $('.alert').alert('close');
            }, 2000);
        }

        function delete_mesaje() {
            document.getElementById('scroll_box').insertAdjacentHTML('afterend', `
                    <div class="alert alert-danger fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$('.alert').alert('close');">Audio Eliminado</div>`);
            setTimeout(() => {
                $('.alert').alert('close');
            }, 2000);
        }
      function eliminar(id){
        let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=+this.responseText;
                    
                    if(result>0){
                        cargar();
                        delete_mesaje();
                    }
                    

                }
            };
            xhttp.open("POST", "crud_audio.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send(JSON.stringify({
                'crud': 'delete',
                'audio_id': id
            }));
            
      }
      function cargar(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result=JSON.parse(this.responseText);
                    document.getElementById('audios').innerHTML='';
                    result.forEach(element => {
                        document.getElementById('audios').insertAdjacentHTML('beforeend', `<li class="list-group-item d-flex justify-content-between text-white bg-dark border-secondary" id="${element._id.$oid}">
                        <p class="my-auto" >
                              ${element.titulo}
                        </p>
                        <div class="d-flex flex-row-reverse bd-highlight">
                        
                        <button type="button" class="btn btn-danger " onclick="eliminar('${element._id.$oid}')">Eliminar</button>
                        <button type="button" class="btn btn-success mr-1" onclick="mostrar('${element._id.$oid}','${element.titulo}')">Modificar</button>
                        </li>`);
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
      function mostrar(id,titulo) {
            modificar_id=id;
            modificar_titulo=titulo;
            document.getElementById('new_titulo').value=titulo;
            document.getElementById('current_titulo').innerText=titulo;
            $('#modificar_audio').modal('toggle');
        }
      function modificar() {
        $('#modificar_audio').modal('hide');
        let new_titulo=document.getElementById('new_titulo').value;
            consulta = JSON.stringify({
                'crud': 'update',
                'audio_id': modificar_id,
                'titulo':new_titulo,

            });
            
            let xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    result =+this.responseText;
                    if(result>0){
                        cargar();
                        update_mesaje();
                    }
                   
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