function minhaFuncao(el) {
    try {
        var outro = document.getElementById("outro");
        var selectedOption = el.options[el.selectedIndex];
        var selectedId = selectedOption.value;
        if (selectedId === "") {
            outro.style.display = "block";
            outro.classList.add("respostaServico");
            el.classList.remove("respostaServico")
        } else {
            outro.classList.remove("respostaServico")
            el.classList.add("respostaServico");
            outro.style.display = "none";
        }
    } catch (e) {
        console.log(e)
    }
}


// Função para abrir o modal
function openModal(el) {
    var modal = document.getElementById("myModal");
    document.getElementById("idInscricao").value = el;
    modal.style.display = "block";
}

// Função para fechar o modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}


function atualizaTabela(dados){
    var tabela = document.getElementById("tabela");

    tabela.innerHTML = '';
    dados.forEach((dado)=>{
        tabela.innerHTML += "\
        <tr>\
        <td>" +dado.nome + " " + dado.apelido + "</td>\
        <td>" +dado.dataInscricao+ "</td>\
        <td>" +dado.dataVisitaDomicilio+ "</td>\
        <td>" +dado.grauAutonomia+ "</td>\
        <td>" +dado.comQuemVive+ "</td>\
        <td>" +dado.temApoioAlguem+ "</td>\
        <td>" +dado.motivoSolicitacao+ "</td>\
        <td>" +dado.serSocio+ "</td>\
        <td>" +dado.pontuacaoCriterio+ "</td>\
        <td><button onclick='openModal("+dado.idInscricao +")'>Responder</button></td>\
        </tr>\
        ";
    });

}

// Função para adicionar Users à base de dados
function enviarResposta() {


    const dados = {
        respostaServico: document.getElementsByClassName("respostaServico")[0].value,
        idInscricao: document.getElementById("idInscricao").value,
        tecnicoRespondeu: document.getElementById("tecnicoRespondeu").value,
        listaEspera: "listaEspera"
    }
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        const mensagem = document.querySelector('#mensagem');
        mensagem.classList.remove('sucesso', 'erro');
        res = JSON.parse(this.responseText);

        console.log(res.dados);
        if (res.res == "sucesso") {
            mensagem.classList.add('sucesso');
            mensagem.textContent = 'Resposta enviada com sucesso';
            closeModal();
            atualizaTabela(res.dados);

        } else if (res.res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Não foi possível enviar resposta!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 3000);

    }

    browserEscondido.open("PUT", "/Gaan/Controllers/API/Idosos.api.php");
    browserEscondido.send(JSON.stringify(dados));


}