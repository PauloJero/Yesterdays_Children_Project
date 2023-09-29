const tbody = document.getElementById("tbody");

carregar();


function carregar() {
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        tbody.innerHTML = '';
        res.forEach(el => {
            tbody.innerHTML += "\
                <tr>\
            <td>"+ el.nomeU +" "+el.apelidoU+ "</td>\
            <td>"+ el.tipo + "</td>\
            <td>"+ el.origem + "</td>\
            <td>\
            <a href='/Gaan/index.php/documentos/detalhes/"+ el.idDocumento + "'>Mais detalhes</a>\
            </td>\
                </tr >";
        });

    }

    browserEscondido.open("GET", "../Controllers/API/Documentos.api.php")
    browserEscondido.send()
}
  

//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tipo: "Familiar" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);

        if (res == "sucesso") {
            mensagem.textContent = 'Familiar eliminado com sucesso!';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Familiar não pode ser eliminado!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 1000);

    }


    browserEscondido.open("DELETE", "../Controllers/API/Documentos.api.php")
    browserEscondido.send(JSON.stringify(dados));


}

function filtrar() {

    const nome = document.getElementById("filt_nome").value;
    const apelido = document.getElementById("filt_apelido").value;

    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        tbody.innerHTML = '';

        res.forEach(el => {
            tbody.innerHTML += "\
                <tr>\
            <td>"+ el.nome + "</td>\
            <td>"+ el.apelido + "</td>\
            <td>"+ el.email + "</td>\
            <td>\
            <a href='/Gaan/index.php/documentos/detalhes/"+ el.idDocumento + "'>Mais detalhes</a>\
            </td>\
                </tr >";
        });

    }
    if (nome === "" && apelido === "") {
        carregar();
    } else {
        
        browserEscondido.open("GET", "../Controllers/API/Documentos.api.phpnome=" + nome + "&apelido=" + apelido);
        browserEscondido.send()
    }
}
