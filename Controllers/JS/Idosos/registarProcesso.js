



























// Obtém uma referência aos elementos do formulário
const socioNumeroInput = document.getElementById('socioNumero');
const contratoNumeroInput = document.getElementById('contratoNumero');
const dataSaidaInput = document.getElementById('dataSaida');
const motivoSaidaInput = document.getElementById('motivoSaida');
const habilitLiterariaInput = document.getElementById('habilitLiteraria');
const historiaVidaTextarea = document.getElementById('historiaVida');
const gostosPessoaisTextarea = document.getElementById('gostosPessoais');

// Define os valores que deseja preencher automaticamente
const valoresPreenchidos = {
  socioNumero: 12345,
  contratoNumero: 67890,
  dataSaida: '2023-06-18',
  motivoSaida: 'Motivo de saída',
  habilitLiteraria: 'Nível de escolaridade',
  historiaVida: 'Ut vulputate sagittis hendrerit. Phasellus finibus turpis velit, quis malesuada mi facilisis sed. Donec a mi nibh. Donec et ligula lectus. Donec mattis tincidunt pellentesque. Cras malesuada dictum turpis. Nullam leo tellus, porta mollis accumsan non, efficitur nec nulla. Proin ut nisl ligula. Aenean tempus, felis eu volutpat ullamcorper, nunc lorem vestibulum nisl, non mollis massa purus quis magna. Sed orci ante, congue vitae dui at, euismod blandit libero. Vivamus sit amet ex quis mauris eleifend varius at at turpis. Nam id lacinia ante. Duis nec tempus enim. Nulla sit amet nunc id ante vestibulum venenatis non vitae orci. Aliquam non accumsan metus. Cras id urna auctor, auctor metus at, posuere purus. Nam posuere velit a lectus mollis cursus. Sed vulputate neque sem, auctor scelerisque orci convallis accumsan. Cras et dui facilisis metus molestie tristique.',
  gostosPessoais: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eu dui et magna feugiat suscipit. Ut id urna bibendum, gravida magna non, cursus nulla. Ut pretium suscipit elit et placerat. Sed convallis orci molestie odio blandit sollicitudin. Etiam porttitor tempus est id tempor. Morbi euismod vestibulum enim vel auctor. Aenean iaculis dolor quis arcu condimentum commodo. Vivamus ultrices luctus tempus. In quis malesuada augue. Donec eu nisl sagittis, venenatis nisl quis, pulvinar tortor. Duis sollicitudin pharetra arcu. Mauris vel lacinia enim, sed finibus massa. Ut vitae purus orci. Cras laoreet purus quis efficitur imperdiet. Vestibulum id nisl mi. Nulla pulvinar non arcu vel semper. Suspendisse quis diam nulla. Ut at justo pulvinar, pulvinar odio et, mattis risus.  Quisque feugiat facilisis tellus, vitae porta nulla rhoncus et.'
};

// Preenche os campos com os valores desejados
socioNumeroInput.value = valoresPreenchidos.socioNumero;
contratoNumeroInput.value = valoresPreenchidos.contratoNumero;
dataSaidaInput.value = valoresPreenchidos.dataSaida;
motivoSaidaInput.value = valoresPreenchidos.motivoSaida;
habilitLiterariaInput.value = valoresPreenchidos.habilitLiteraria;
historiaVidaTextarea.value = valoresPreenchidos.historiaVida;
gostosPessoaisTextarea.value = valoresPreenchidos.gostosPessoais;














// // Função para alternar entre as seções
// function toggleSection(sectionName) {
//     const sections = document.getElementsByClassName("section");

//     for (let i = 0; i < sections.length; i++) {
//         if (sections[i].classList.contains(sectionName)) {
//             sections[i].classList.add("active");
//         } else {
//             sections[i].classList.remove("active");
//         }
//     }
// }


// // Função para verificar se todos os campos da seção atual foram preenchidos
// function verificarCamposPreenchidos(sectionName) {
//     const campos = document.querySelectorAll(`.section.${sectionName} input[required]`);

//     let camposVazios = true;

//     campos.forEach(function (campo) {
//         if (campo.value === "") {
//             camposVazios = false;
//             campo.classList.add("error");
//         } else {
//             campo.classList.remove("error");
//         }
//     });

//     return camposVazios;
// }

// // Event listener para os botões de seção
// const sectionButtons = document.getElementsByClassName("section-button");

// addEventListener("click", function (event) {

//     if (!event.target.classList.contains('active')) {
//         // const camposPreenchidos = verificarCamposPreenchidos("active");
//         const sectionName = event.target.getAttribute("data-section");

//         toggleSection(sectionName);
//         // Ativar o botão atual e desativar os outros
//         for (let j = 0; j < sectionButtons.length; j++) {
//             sectionButtons[j].classList.remove("active");
//         }

//         event.target.classList.add("active");
//         // if (camposPreenchidos) {

//         //     // Ativar o botão atual e desativar os outros
//         //     for (let j = 0; j < sectionButtons.length; j++) {
//         //         sectionButtons[j].classList.remove("active");
//         //     }

//         //     event.target.classList.add("active");
//         // } else {
//         //     alert("Por favor, preencha todos os campos antes de avançar para a próxima seção.");
//         // }
//     }
// });