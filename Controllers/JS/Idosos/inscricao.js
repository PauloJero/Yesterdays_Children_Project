// Função para ocultar ou exibir seções com base na opção selecionada
function toggleSection() {
  var resposta = document.getElementById('tipoServico').value;

  if (resposta === "Centro do Dia") {
    document.querySelectorAll(".optional").forEach((optional) => {
      optional.style.display = "none";
    })
  } else {
    document.querySelectorAll(".optional").forEach((optional) => {
      optional.style.display = "block";
    })

  }


}
toggleSection();

function validarFormulario() {

  document.querySelectorAll(".optional").forEach((optional) => {

    if (optional.style.display == "none") {
      var inputs = optional.querySelectorAll("input");
      inputs.forEach((input) => {
        input.removeAttribute("name");
      });
    }
  });

  var camposTextoVisiveis = [];
  var camposVisiveis = document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked, input[type="text"], select, textarea');

  camposVisiveis.forEach(function (campoTexto) {
    var display = campoTexto.style.display;

    if (display == 'none' || campoTexto.hasAttribute("n") || !campoTexto.hasAttribute("name")) {

    } else {
      camposTextoVisiveis.push(campoTexto);

    }
  });

  for (var i = 0; i < camposTextoVisiveis.length; i++) {
    var campo = camposTextoVisiveis[i];

    if (!campo.value) {
      alert('Por favor, preencha todos os campos visíveis antes de enviar o formulário.');
      return false;
    }
  }

  return true;
}





// FUNÇÃO PARA PREENCHER O FORMULÁRIO AUTOMATICAMENTE
function preencherFormulario() {
  document.getElementById('tipoServico').value = 'Centro de Convívio';
  document.getElementById('parentesco').value = 'Filho';
  document.getElementById('assinatura').value = 'José Pereira';

  document.getElementById('motivoInscricao0').checked = true;
  document.getElementById('simSocioGrupoAmigos').checked = true;
  document.getElementById('naoDoencaMental').checked = true;
  document.getElementById('naoDI').checked = true;
  document.getElementById('simAlimentacao').checked = true;
  document.getElementById('simSemanal').checked = true;
  document.getElementById('sfdsf').checked = true;
  document.getElementById('shp').checked = true;
  document.getElementById('shh').checked = true;
  document.getElementById('str').checked = true;

  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach((check) => {
    check.checked = true;
  })
}

preencherFormulario();