carregar();
//ATUALIZAR DADOS
function guardar() {

    const dados = {
        id: document.getElementById("id").value,
        nomeU: document.getElementById("nomeU").value,
        apelidoU: document.getElementById("apelidoU").value,
        tipo: document.getElementById("tipo").value,
        origem: document.getElementById("origem").value,
        tipo: "Documento"
    }

    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        carregar();
        const mensagem = document.querySelector('#mensagem');
        mensagem.classList.remove('sucesso', 'erro');
        res = JSON.parse(this.responseText);

        if (res == "sucesso") {
            mensagem.textContent = 'Dados atualizados de sucesso';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

            mensagem.textContent = "Não foi possível atualizar!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 1000);

    }

    if (dados.nomeU === "" || dados.apelidoU === "" || dados.tipo === "" || dados.origem === "") {
        alert("Preencha todos os campos!")
    } else {

        browserEscondido.open("PUT", "../../../Controllers/API/api.php");
        browserEscondido.send(JSON.stringify(dados));

    }



}




//TORNAR UM CAMPO EDITÁVEL OU NÃO
function editar(el) {
    let input = document.querySelectorAll("input");
    let guardar = document.getElementById("guardar");
    let cancelar = document.getElementById("cancelar");
    var c = 0
    input.forEach((input) => {
        if (input.hasAttribute("disabled")) {
            c += 1
            input.removeAttribute("disabled")
        }

    })
    if (c > 0) {
        guardar.removeAttribute("disabled");
        cancelar.removeAttribute("disabled");
    }

}

document.addEventListener('click', function (e) {
    let input = document.querySelectorAll("input");
    let guardar = document.getElementById("guardar");
    // let cancelar = document.getElementById("cancelar");

    target = e.target.parentNode.tagName
    if (typeof target === "undefined") {
        input.forEach((input) => {
            if (!input.hasAttribute("disabled")) {

                input.setAttribute("disabled", true)
            }
        })
        guardar.setAttribute("disabled", true)
        // cancelar.setAttribute("disabled", true)
    }

})


function cancelar() {
    header("Location: index.php");
    exit;
}






function carregar() {
    const content = document.getElementById("content");
    const id = document.getElementById("idf").innerHTML;
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        content.innerHTML = '';
console.log(res);
        content.innerHTML += '\
            <div class="row mt-5">\
                <input id="id" type="number" hidden value="'+ res.idDocumento + '">\
                <div class="col">\
                    <div class="row">\
                        <h1 class="col h5">NOME</h1>\
                        <input id="n" type="text" required class="form-control mb-4 col" value="'+ res.nomeu + " " + res.apelidoU +'" disabled aria-label="Name">\
                    </div>\
                    <div class="row">\
                        <h1 class="col h5">TIPO</h1>\
                        <input id="o" type="text" required class="form-control mb-4 col" value="'+ res.tipo + '" disabled aria-label="Type">\
                    </div>\
                    \
                </div>\
\
                <div class="col">\
                <div class="row">\
                    <h1 class="col h5">ORIGEM</h1>\
                    <input id="o" type="text" required class="form-control mb-4 col" value="'+ res.origem + '" disabled aria-label="Origin">\
                </div>\
            </div>\
\
            <div style="display: flex;justify-content:space-between">\
                <button id="cancelar" disabled onclick="cancelar()">Cancelar</button>\
<<<<<<< HEAD
                    <input type="number" name="id" value="'+res.idDocumento+'" hidden>\
                    <input type="text" name="metodo" value="eliminar" hidden>\
                    <input type="text" name="pessoa" value="Familiar" hidden>\
                    <button type="submit">Eliminar</button>\
=======
>>>>>>> baed668b0c78ab1601c23f43e8054b29edf16e0d
                <button id="editar" onclick="editar()">Editar</button>\
                <button id="guardar" disabled onclick="guardar()">Guardar</button>\
            </div>\
            '


    }

    browserEscondido.open("GET", "../../../Controllers/API/Documentos.api.php?id="+id)
    browserEscondido.send()
}