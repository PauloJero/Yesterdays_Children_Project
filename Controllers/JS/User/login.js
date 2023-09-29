// Função para verificar login
function login() {

    const mensagem = document.getElementById("mensagem");
    const dados = {
        email: document.getElementById("email").value,
        senha: document.getElementById("senha").value
    };

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

    if (dados.email === "" || dados.senha === "") {
        mensagem.textContent = "Preencha todos os campos";
        mensagem.classList.add('erro');
        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 3000);

    } else {
        browserEscondido.open("POST", "/Gaan/Controllers/API/User.php");
        browserEscondido.send(JSON.stringify(dados));

    }


}
