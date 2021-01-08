<?php
 namespace Components;
 use Utils\ArrayUtils\ArrayUtils;
 use Repositories\AutorRepo;
 use Repositories\GeneroRepo;
 use Repositories\CategoriaRepo;
 use Repositories\UsuarioRepo;

 class SearchTable{
 
    public static function renderHTMLSearchResultTable(array $Audios , array $Autores,String $id_usuario=""){
        $result = self::renderAudios($Audios,$id_usuario);
        $autoresResult = self::renderAutores($Autores);

        return (object)['audios' => $result , 'autores' => $autoresResult];
    }
    
    private static function renderAudios(array $Audios, String $id_usuario=""){
        
        $listas=UsuarioRepo::ObtenerSimpleListasUsuario($id_usuario);
        $result = '<div class="row" id="audios">

                        <div class="container-fluid mt-4">
                            <div class="bg-secondary text-white col-sm-12 px-3 py-3 rounded-lg">
                                <h2>Canciones </h2>
                            </div>
                        </div>';

        foreach ($Audios as $audio) {
        $usuario = UsuarioRepo::ObtenerUsuario($audio->id_usuario);
        $autores = ArrayUtils::ObjectLinearString($audio->autores, "nombre");
        $generos = ArrayUtils::ObjectLinearString($audio->generos, "nombre");
        $categorias = ArrayUtils::ObjectLinearString($audio->categorias , "nombre");
        $id_audio = "\"{$audio->_id}\"";
        // $dropDownMenu=SearchTable::dropDownMenu($id_audio,$id_usuario);
       
        $dropDown = '<div class="btn-group dropright btn-block">
                                <button type="button" class="btn btn-primary">Agregar a Lista</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu">';
        foreach ($listas as $lista) {
            $dropDown=$dropDown.'<div class="dropdown-item" onclick="agregar_lista(\''.$lista->_id.'\',\''.$audio->_id.'\')">'.$lista->nombre.'</div>';                                
        }
                                   
                                

        $dropDown=$dropDown.'</div></div>';
        $result= $result ."<div class='col-sm-6 col-md-4 col-lg-3 my-4'>
                                <div class='card'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$audio->titulo}</h5>
                                        <p class='card-text'> Autor:  {$autores}<br>Generos: {$generos} <br>Categoria: {$categorias}<br>Usuario: {$usuario->nombre}<br></p>
                                        <a onclick='reproducir({$id_audio} , event)' class='btn btn-primary btn-block'>Reproducir</a>
                                        {$dropDown}
                                    </div>
                                </div>
                            </div>";
        }
        $result .="</div>";
        return $result;
    }

    private static function renderAutores(array $Autores){
        $result = '<div class="row" id="autores">
                        <div class="container-fluid mt-4">
                            <div class="bg-secondary text-white col-sm-12 px-3 py-3 rounded-lg">
                                <h2>Autores</h2>
                             </div>
                        </div>';

        foreach ($Autores as $autor) {
                
        $result= $result ."<div class='col-sm-6 col-md-4 col-lg-3 my-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <h5 class='card-title'>{$autor->nombre}</h5>
                                    <p class='card-text'>
                                        <a href='Buscar.php?buscar={$autor->nombre}' class='btn btn-primary btn-block'>Ver mas</a>
                                    </p> 
                                </div>
                            </div>
                        </div>";
                   
        }
        $result .=  "</div>";
        return $result;
    }    

   
 }