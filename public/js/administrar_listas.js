//jshint esversion:6
function fetchLista(e) {
    current_list = e;
    var t = new XMLHttpRequest();
    t.onreadystatechange = function() {
        if (4 == this.readyState && 200 == this.status) {
            let e = JSON.parse(this.responseText);
            if (draggable_list.innerHTML = "", p.style.display = "none", e.length > 0) {
                for (let t = 0; t < e.length; t++) {
                    let n = document.createElement("li");
                    const d = e[t];
                    n.setAttribute("data-index", t), n.setAttribute("draggable", !0), n.classList.add("text-left"), n.id = `${d._id}`, n.innerHTML = `\n                                    <input type="checkbox"  id="delete_ids" value="${d._id}" style="margin:1.5rem 0 1.5rem 1rem;">\n                                    <div class="draggable">\n                                        <p>${d.titulo}</p>\n                                        <i class="fas fa-grip-lines"></i>\n                                    </div>`, draggable_list.appendChild(n)
                }
                document.querySelector("#all_ids_div").style.display = "block", document.getElementById("controles").innerHTML = '<button type="button" class="btn btn-outline-danger my-2 mr-1" onclick="eliminar()">Eliminar</button>', document.getElementById("scroll_box").classList.add("border"), document.getElementById("scroll_box").classList.add("border-secondary"), document.getElementById("scroll_box").classList.add("rounded-sm")
            } else document.getElementById("controles").innerHTML = "", document.querySelector("#all_ids_div").style.display = "none", p.style.display = "block", document.getElementById("scroll_box").classList.remove("border"), document.getElementById("scroll_box").classList.remove("border-secondary"), document.getElementById("scroll_box").classList.remove("rounded-sm");
            addEventListeners()
        }
    }, t.open("POST", "crud_lista.php", !0), t.setRequestHeader("Content-type", "application/json"), t.send(JSON.stringify({ crud: "find", lista_id: e }))
}

function reset() { fetchLista(current_list) }

function update_mesaje() { document.getElementById("controles").insertAdjacentHTML("afterend", '\n            <div class="alert alert-secondary fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$(\'.alert\').alert(\'close\');">Lista Actualizada</div>'), setTimeout(() => { $(".alert").alert("close") }, 2e3) }

function delete_mesaje() { document.getElementById("controles").insertAdjacentHTML("afterend", '\n            <div class="alert alert-danger fade show d-md-inline-block w-lg-50" role="alert" ondblclick="$(\'.alert\').alert(\'close\');">Audios Eliminados</div>'), setTimeout(() => { $(".alert").alert("close") }, 2e3) }

function actualizar() {
    let e = new XMLHttpRequest();
    let t = JSON.stringify({ crud: "update", lista_id: current_list, fuente_id: fuente_id, destino: end_index });
    e.onreadystatechange = function() {
        if (4 == this.readyState && 200 == this.status) {
            let e = +this.responseText;
            1 == e && update_mesaje()
        }
    }, e.open("POST", "crud_lista.php", !0), e.setRequestHeader("Content-type", "application/json"), e.send(t)
}

function eliminar() {
    let e = new XMLHttpRequest(),
        t = document.querySelectorAll("#delete_ids"),
        n = [];
    t.forEach(e => { e.checked && n.push(e.value) });
    let d = JSON.stringify({ crud: "delete", lista_id: current_list, audios_id: n });
    e.onreadystatechange = function() { 4 == this.readyState && 200 == this.status && (reset(), +this.responseText > 0 && delete_mesaje()) }, e.open("POST", "crud_lista.php", !0), e.setRequestHeader("Content-type", "application/json"), e.send(d)
}

function dragStart() { index = +this.closest("li").getAttribute("data-index"), fuente_id = this.closest("li").getAttribute("id") }

function dragLeave() { this.classList.remove("over") }

function dragOver(e) { e.preventDefault(), this.classList.add("over") }

function dragDrop() { this.classList.remove("over"), this.classList.remove("drag"), end_index = +this.closest("li").getAttribute("data-index"), mover(), actualizar() }

function mover() {
    let e = document.querySelector("#draggable-list");
    end_index < index ? e.insertBefore(e.childNodes[index], e.childNodes[end_index]) : end_index > index && (end_index += 1, e.insertBefore(e.childNodes[index], e.childNodes[end_index]));
    let t = document.querySelectorAll("#draggable-list li");
    for (let e = 0; e < t.length; e++) {
        let n = document.createAttribute("data-index");
        n.value = e, t[e].removeAttribute("data-index"), t[e].setAttributeNode(n)
    }
}

function addEventListeners() {
    let e = document.querySelectorAll(".draggable-list li");
    e.forEach(e => { e.addEventListener("dragover", dragOver), e.addEventListener("drop", dragDrop), e.addEventListener("dragleave", dragLeave), e.addEventListener("dragstart", dragStart) })
}
let fuente_id, current_list, index, end_index, lista_activa = [],
    first_time = !0;
const draggable_list = document.getElementById("draggable-list"),
    p = document.querySelector("#scroll_box p");
let checkbox = document.querySelector("#all_ids");
checkbox.addEventListener("change", function() { if (this.checked) { let e = document.querySelectorAll("li input[id=delete_ids]"); for (let t = 0; t < e.length; t++) e[t].checked = !0 } else { let e = document.querySelectorAll("li input[id=delete_ids]"); for (let t = 0; t < e.length; t++) e[t].checked = !1 } }), document.querySelectorAll("button.list-group-item")[0].click();