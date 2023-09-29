// Função para adicionar Users à base de dados
function atualizar(secao) {
    const dados = {
        secao: secao,
        idUser: document.getElementById('idUser').value
    }


    var seccao = document.querySelector('.' + secao);
    var elementos = seccao.querySelectorAll('[ma="i"]');
    if (elementos.length === 0) {
        alert("Edite ainda qualquer campo antes de atualizar");
        return false;
    }
    elementos.forEach((ele) => {
        dados[ele.id] = ele.value;
    })

    var v = 0;
    for (let dado in dados) {
        if (dados[dado] === "") {
            v += 1;
        }
    }
    if (v > 0) {
        alert("Os campos não podem estar vazios");
        return false;
    }

    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        const mensagem = document.querySelector('#mensagem');
        mensagem.classList.remove('sucesso', 'erro');
        try {
            res = JSON.parse(this.responseText);
        } catch (e) {
            alert(e);
            return false;
        }

        if (res == "sucesso") {

            mensagem.textContent = 'Atualizado com sucesso';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else if (res == "incorreto") {

            mensagem.textContent = "Dado atual não corresponde";
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Não foi possível fazer a atualização";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 3000);

    }
    browserEscondido.open("PUT", "/Gaan/Controllers/API/User.php");
    browserEscondido.send(JSON.stringify(dados));

}


// Função para alternar a edição do campo quando clicado duas vezes
function toggleEditability(element) {
    if (element.hasAttribute("readonly")) {

        element.removeAttribute("readonly")
        element.setAttribute("ma", "i")
    }
}

ajustarTamanhoInputs()
function ajustarTamanhoInputs() {
    const inputs = document.querySelectorAll('input[type="text"], input[type="email"], input[type="password"]');

    inputs.forEach((input) => {
        if (input.value.length < 1) {

        } else {
            input.style.width = `${input.value.length + 3}ch`;

        }

    });
}


//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tipo: "Idoso" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);

        if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Idoso não pode ser eliminado!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 1000);

    }


    browserEscondido.open("DELETE", "../../../Controllers/API/api.php")
    browserEscondido.send(JSON.stringify(dados));


}
