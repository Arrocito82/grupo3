//jshint esversion:6
let lista_activa = [];
let fuente_id, current_list, index, end_index, first_time = true;
const draggable_list = document.getElementById('draggable-list');
const p = document.querySelector('#scroll_box p');

let checkbox = document.querySelector("#all_ids");

checkbox.addEventListener('change', function() {
    if (this.checked) {
        let checkboxes = document.querySelectorAll('li input[id=delete_ids]');

        for (let x = 0; x < checkboxes.length; x++) {
            checkboxes[x].checked = true;
        }

    } else {
        let checkboxes = document.querySelectorAll('li input[id=delete_ids]');

        for (let x = 0; x < checkboxes.length; x++) {
            checkboxes[x].checked = false;
        }
    }
});

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

                    listItem.setAttribute('data-index', e);
                    listItem.setAttribute('draggable', true);

                    listItem.classList.add('text-left');
                    listItem.id = `${element._id}`;
                    listItem.innerHTML = `
                                    <input type="checkbox"  id="delete_ids" value="${element._id}" style="margin:1.5rem 0 1.5rem 1rem;">
                                    <div class="draggable">
                                        <p>${element.titulo}</p>
                                        <i class="fas fa-grip-lines"></i>
                                    </div>`;

                    draggable_list.appendChild(listItem);
                }
                document.querySelector('#all_ids_div').style.display = 'block';
                document.getElementById('controles').innerHTML = `<button type="button" class="btn btn-outline-danger my-2 mr-1" onclick="eliminar()">Eliminar</button>`;
                document.getElementById('scroll_box').classList.add('border');
                document.getElementById('scroll_box').classList.add('border-secondary');
                document.getElementById('scroll_box').classList.add('rounded-sm');

            } else {
                document.getElementById('controles').innerHTML = '';
                document.querySelector('#all_ids_div').style.display = 'none';
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

function update_mesaje() {
    document.getElementById('controles').insertAdjacentHTML('afterend', `
            <div class="alert alert-secondary fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$('.alert').alert('close');">Lista Actualizada</div>`);
    setTimeout(() => {
        $('.alert').alert('close')
    }, 2000);
}

function actualizar() {

    let xhttp = new XMLHttpRequest();
    console.log(end_index);
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
            }

        }
    };


    xhttp.open("POST", "crud_lista.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");

    xhttp.send(consulta);
}

function eliminar() {
    let xhttp = new XMLHttpRequest();
    let list_aux = document.querySelectorAll("#delete_ids");
    let ids_lista = [];

    list_aux.forEach(element => {
        if (element.checked) {
            ids_lista.push(element.value);
        }
    });


    let consulta = JSON.stringify({
        "crud": "delete",
        'lista_id': current_list,
        'audios_id': ids_lista
    });

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            reset();
            console.log(this.responseText);
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
        list_aux[i].removeAttribute("data-index");;
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