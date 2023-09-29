function validarFormulario() {

    var campos = document.querySelector("#form1").querySelectorAll('select, textarea, input[type="text"], input[type="date"]');

    for (var i = 0; i < campos.length; i++) {
        var campo = campos[i];

        if (!campo.value) {
            alert('Por favor, preencha todos os campos visíveis antes de enviar o formulário.');
            return false;
        }
    }
    return true;
}

// FUNÇÕES PARA AUMENTAR A PRODUTIVIDADE

// CALCULA O TOTAL DE PONTUAÇÕES DE CRITÉRIOS
var total = document.getElementById("tot");
var pontuacaoCriterio = document.getElementById("pontuacaoCriterio");
var selects = document.querySelectorAll("select");
var criterios = {};

function totalCrit(el) {
    if (el.value != "") {

        criterios[el.id] = parseInt(el.value);
        var sum = 0;
        for (var t in criterios) {
            sum += criterios[t]
        }
        total.innerHTML = sum;
        pontuacaoCriterio.value = sum;
    } else {

        criterios[el.id] = 0;
        var sum = 0;
        for (var t in criterios) {
            sum += criterios[t]
        }
        total.innerHTML = sum;
        pontuacaoCriterio.value = sum;
    }
}


// FUNÇÃO PARA OBTER TODOS OS SELECTS E FAZER O CÁLUCLO DA PONTUAÇÃO DE CRITÉRIOS
// calcularTotal();
function calcularTotal() {
    selects.forEach((sel) => {
        if (sel.id != "respostaServico" && sel.id != "tipoServico" && sel.id != "idUserResponsavel") {
            criterios[sel.id] = parseInt(sel.value);
            var sum = 0;
            for (var t in criterios) {
                sum += criterios[t]
            }
            total.innerHTML = sum;
            pontuacaoCriterio.value = sum;
        }
    })
}

// FUNÇÃO PARA PREENCHER O FORMULÁRIO AUTOMATICAMENTE
function preencherFormulario() {


    document.getElementById('observacao').value = 'Observações sobre a inscrição';

    document.getElementById('relatorio').value = 'Relatório da visita domiciliária<br>Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam voluptatum laudantium totam commodi similique eius iusto. Consequatur harum nam nulla ducimus. Vel quis culpa veritatis autem ratione suscipit aliquam voluptate.';

    document.getElementById('grauAutonomia').value = '1';
    document.getElementById('comQuemVive').value = '4';
    document.getElementById('temApoioAlguem').value = '3';
    document.getElementById('motivoSolicitacao').value = '2';
    document.getElementById('serSocio').value = '3';

}
try {
    preencherFormulario();
} catch (e) {

}
calcularTotal();

function minhaFuncao(el) {
    try {
        var outro = document.getElementById("outro");
        var selectedOption = el.options[el.selectedIndex];
        var selectedId = selectedOption.value;
        if (selectedId === "") {
            outro.style.display = "block";
            outro.setAttribute("name", "respostaServico");
            el.removeAttribute("name")
        } else {
            outro.removeAttribute("name")
            el.setAttribute("name", "respostaServico");
            outro.style.display = "none";
        }
    } catch (e) {
        console.log(e)
    }
}