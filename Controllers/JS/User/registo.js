
// Função para alternar entre as seções
function toggleSection(sectionName) {
    const sections = document.getElementsByClassName("section");

    for (let i = 0; i < sections.length; i++) {
        if (sections[i].classList.contains(sectionName)) {
            sections[i].classList.add("active");
        } else {
            sections[i].classList.remove("active");
        }
    }
}


// Função para verificar se todos os campos da seção atual foram preenchidos
function verificarCamposPreenchidos(sectionName) {
    const campos = document.querySelectorAll(`.section.${sectionName} input[required]`);

    let camposVazios = true;

    campos.forEach(function (campo) {
        if (campo.value === "") {
            camposVazios = false;
            campo.classList.add("error");
        } else {
            campo.classList.remove("error");
        }
    });

    return camposVazios;
}

// Event listener para os botões de seção
const sectionButtons = document.getElementsByClassName("section-button");

addEventListener("click", function (event) {

    if (!event.target.classList.contains('active') && event.target.tagName === 'BUTTON' && !event.target.classList.contains('submit')) {
        const camposPreenchidos = verificarCamposPreenchidos("active");
        const sectionName = event.target.getAttribute("data-section");

        if (camposPreenchidos) {
            toggleSection(sectionName);

            // Ativar o botão atual e desativar os outros
            for (let j = 0; j < sectionButtons.length; j++) {
                sectionButtons[j].classList.remove("active");
            }

            event.target.classList.add("active");
        } else {
            alert("Por favor, preencha todos os campos antes de avançar para a próxima seção.");
        }
    }
});

// Função para adicionar Users à base de dados
function adicionar() {
    const sectionButtons = document.getElementsByClassName("section-button");
    var inputs = document.querySelectorAll("input");
    var selects = document.querySelectorAll("select");
    var dados = {}
    for (var i = 0; i < inputs.length; i++) {
        var element = inputs[i];
        var name = element.name;
        var value = element.value;
        dados[name] = value;
    }
    for (var i = 0; i < selects.length; i++) {
        var element = selects[i];
        var name = element.name;
        var value = element.value;
        dados[name] = value;
    }


    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        const mensagem = document.querySelector('#mensagem');
        mensagem.classList.remove('sucesso', 'erro');
        res = JSON.parse(this.responseText);

        if (res == "sucesso") {
            toggleSection("dados-pessoais");
            // Ativar o botão atual e desativar os outros
            for (let j = 1; j < sectionButtons.length; j++) {
                sectionButtons[j].classList.remove("active");
            }
            sectionButtons[0].classList.add("active");
            limparCampos()
            mensagem.textContent = 'Utilizador registado com sucesso';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else if (res == "existe") {

            mensagem.textContent = "Existe um Utilizador com um ou mais campos iguais!";
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Não foi possível fazer o User!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 3000);

    }

    if (dados.email != dados.confEmail || dados.senha != dados.confSenha) {
        alert("Palavras-chave ou emails não coincidem!")


    } else {

        browserEscondido.open("POST", "/Gaan/Controllers/API/User.php");
        browserEscondido.send(JSON.stringify(dados));

    }


}


// FUNÇÃO PARA LIMPAR OS CAMPOS
function limparCampos() {
    // Obtenha todos os elementos de entrada (inputs) e seleção (select)
    var inputs = document.querySelectorAll('input');
    var selects = document.querySelectorAll('select');

    // Limpe os valores dos campos de entrada
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].value = '';
    }

    // Redefina os valores dos campos de seleção para a opção padrão
    for (var j = 0; j < selects.length; j++) {
        selects[j].selectedIndex = 0;
    }
}

