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
            <td>"+ el.nome + "</td>\
            <td>"+ el.apelido + "</td>\
            <td>\
            <a href='/Gaan/index.php/idosos/detalhes/"+ el.idUser + "'>Mais detalhes</a>\
            </td>\
                </tr >";
        });

    }

    browserEscondido.open("GET", "../Controllers/API/Idosos.api.php")
    browserEscondido.send()
}

//ELIMINAR DADOS
function eliminar(id) {
    const dados = { id: id, tipo: "Idoso" };

    const browserEscondido = new XMLHttpRequest();

    browserEscondido.onload = function () {
        carregar();
        const res = JSON.parse(this.responseText);

        if (res == "sucesso") {
            mensagem.textContent = 'Idoso eliminado com sucesso!';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
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


    browserEscondido.open("DELETE", "../Controllers/API/api.php")
    browserEscondido.send(JSON.stringify(dados));


}

function filtrar() {

    var n = document.getElementById("filt_nome").value;
    n = n.split(" ");

    var nome = n.shift();
    if (n.length === 0) {
        console.log("Vazio")
        var apelido = " "
    } else {
        var apelido = n.slice(0).join(" ");
    }
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {

        const res = JSON.parse(this.responseText);
        tbody.innerHTML = '';

        res.forEach(el => {
            tbody.innerHTML += "\
                <tr>\
            <td>"+ el.nome + "</td>\
            <td>"+ el.apelido + "</td>\
            <td>\
            <a href='/Gaan/index.php/idosos/detalhes/"+ el.idUser + "'>Mais detalhes</a>\
            </td>\
                </tr >";
        });

    }
    if (nome === "" && apelido === "") {
        carregar();
    } else {
        browserEscondido.open("GET", "../Controllers/API/Idosos.api.php?nome=" + nome + "&apelido=" + apelido);
        browserEscondido.send()
    }
}