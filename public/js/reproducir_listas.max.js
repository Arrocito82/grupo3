//jshint esversion:6
let lista_activa = [];
let fuente_id, current_list, index, end_index, first_time = true;
const draggable_list = document.getElementById('draggable-list');
const p = document.querySelector('#scroll_box p');
let audios_ids = [];
let current_audio = 0;
let checkbox = document.querySelector("#all_ids");



function fetchLista(id_lista) {
    current_list = id_lista;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(JSON.parse(this.responseText));
            let result = JSON.parse(this.responseText);
            draggable_list.innerHTML = "";
            p.style.display = 'none';
            if (result.length > 0) {
                for (let e = 0; e < result.length; e++) {
                    let listItem = document.createElement('li');
                    const element = result[e];
                    audios_ids[e] = element._id;
                    listItem.setAttribute('data-index', e);
                    listItem.setAttribute('draggable', true);

                    listItem.classList.add('text-left');
                    listItem.id = `${element._id}`;
                    listItem.innerHTML = `
                                    
                                    <div class="draggable-reproducir">
                                    
                                    <i class="fas fa-grip-lines"></i>
                                        <p>${element.titulo}</p>
                                        
                                        
                                    </div>
                                    <button type="button" class="btn btn-primary mr-1 h-75 my-auto" onclick="reproducirOne('${element._id}');"><i class="fas fa-play"></i></button>
                                    `;

                    draggable_list.appendChild(listItem);
                }
                document.querySelector('#reproducir_lista').classList.add("d-flex");
                document.querySelector('#reproducir_lista').classList.add("flex-row-reverse");


                document.getElementById('scroll_box').classList.add('border');
                document.getElementById('scroll_box').classList.add('border-secondary');
                document.getElementById('scroll_box').classList.add('rounded-sm');

            } else {

                document.querySelector('#reproducir_lista').classList.remove('d-flex');
                document.querySelector('#reproducir_lista').classList.remove('flex-row-reverse');
                p.style.display = 'block';
                document.getElementById('scroll_box').classList.remove('border');
                document.getElementById('scroll_box').classList.remove('border-secondary');
                document.getElementById('scroll_box').classList.remove('rounded-sm');
            }
            addEventListeners();


        }
    };
    xhttp.open("POST", "crud_lista.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(JSON.stringify({
        "crud": "find",
        "lista_id": id_lista
    }));
}
document.querySelectorAll('button.list-group-item')[0].click();

function reset() {
    fetchLista(current_list);
}

function reset_urls() {


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(JSON.parse(this.responseText));
            let result = JSON.parse(this.responseText);

            if (result.length > 0) {
                for (let e = 0; e < result.length; e++) {
                    audios_ids[e] = (result[e])._id;
                }

            }

        }
    };
    xhttp.open("POST", "crud_lista.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(JSON.stringify({
        "crud": "find",
        "lista_id": current_list
    }));

}

function reproducirTodos() {
    current_audio = 0;

    if (current_audio < audios_ids.length) {
        reproducir(audios_ids[current_audio]);
    }

}

function siguiente() {

    current_audio++;
    if (current_audio < audios_ids.length) {
        reproducir(audios_ids[current_audio]);
    }
}

function reproducirOne(id) {

    let xhttp = new XMLHttpRequest();
    consulta = JSON.stringify({
        'crud': 'recuperar',
        'audio_id': id
    });
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            result = JSON.parse(this.responseText);

            document.getElementById('audio_controls_div').innerHTML = `
            <audio controls id="audio_controls" class="w-100" autoplay>
                <source src="${result[0]}" type="audio/ogg">
                <source src="${result[0]}" type="audio/wav">
                <source src="${result[0]}" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <div class="d-block justify-align-content-between">
                        
                
                <p class="my-auto d-inline-block p-1" id="current_audio_titulo">${result[1]}</p>
               </div>`;
            document.querySelectorAll('#audio_controls source').forEach(url => {
                url.src = result[0];
            });

            document.getElementById('current_audio_titulo').innerText = result[1];
        }
    };
    xhttp.open("POST", "crud_audio.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(consulta);



}

function reproducir(id) {

    let xhttp = new XMLHttpRequest();
    consulta = JSON.stringify({
        'crud': 'recuperar',
        'audio_id': id
    });
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            result = JSON.parse(this.responseText);

            document.getElementById('audio_controls_div').innerHTML = `
            <audio controls id="audio_controls" class="w-100" onended = "siguiente();" autoplay>
                <source src="${result[0]}" type="audio/ogg">
                <source src="${result[0]}" type="audio/wav">
                <source src="${result[0]}" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <div class="d-block justify-align-content-between">
                        
                
                <p class="my-auto d-inline-block p-1 " id="current_audio_titulo">${result[1]}</p>
               </div>`;
            document.querySelectorAll('#audio_controls source').forEach(url => {
                url.src = result[0];
            });

            document.getElementById('current_audio_titulo').innerText = result[1];
        }
    };
    xhttp.open("POST", "crud_audio.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(consulta);



}

function update_mesaje() {
    document.getElementById('controles').insertAdjacentHTML('afterend', `
            <div class="alert alert-secondary fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$('.alert').alert('close');">Lista Actualizada</div>`);
    setTimeout(() => {
        $('.alert').alert('close');
    }, 2000);
}

function actualizar() {

    let xhttp = new XMLHttpRequest();

    let consulta = JSON.stringify({
        "crud": "update",
        'lista_id': current_list,
        'fuente_id': fuente_id,
        'destino': end_index
    });

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let modified = +this.responseText;
            if (modified == 1) {
                update_mesaje();
                reset_urls();

            }

        }
    };


    xhttp.open("POST", "crud_lista.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");

    xhttp.send(consulta);
}



function dragStart() {
    index = +this.closest('li').getAttribute('data-index');
    fuente_id = this.closest('li').getAttribute('id');

}


function dragLeave() {
    this.classList.remove('over');


}

function dragOver(e) {
    e.preventDefault();

    this.classList.add('over');

}

function dragDrop() {

    this.classList.remove('over');
    this.classList.remove('drag');
    end_index = +this.closest('li').getAttribute('data-index');

    mover();
    actualizar();

}

function mover() {

    let list = document.querySelector("#draggable-list");

    if (end_index < index) {
        list.insertBefore(list.childNodes[index], list.childNodes[end_index]);
    } else if (end_index > index) {

        end_index += 1;

        list.insertBefore(list.childNodes[index], list.childNodes[end_index]);
    }



    let list_aux = document.querySelectorAll("#draggable-list li");

    for (let i = 0; i < list_aux.length; i++) {
        let attr = document.createAttribute("data-index");
        attr.value = i;
        list_aux[i].removeAttribute("data-index");
        list_aux[i].setAttributeNode(attr);

    }

}


function addEventListeners() {

    let listItems = document.querySelectorAll('.draggable-list li');

    listItems.forEach(item => {
        item.addEventListener('dragover', dragOver);
        item.addEventListener('drop', dragDrop);
        item.addEventListener('dragleave', dragLeave);
        item.addEventListener('dragstart', dragStart);

    });

}