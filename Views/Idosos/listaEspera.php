<div id="mensagem"></div>
<?php
if (!isset($_SESSION["idUser"]) || $_SESSION["user"] != "funcionario") {
    echo '<script>window.location.href="/Gaan/index.php";</script>';
    exit();

}
?>
<div class="container-fluid p-3 text-center">
    <h2>lista de espera</h2>
</div>
<?php
if (empty($this->dados)) {
    ?>

    <h3 style="text-align: center;margin-top:10px;color:red">Lista de espera vazia</h3>
    <?php
} else {

    ?>
    <!-- Modal -->
    <div id="myModal" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Opções</h2>
            <select id="respostaServico" name="respostaServico" class="respostaServico" onchange="minhaFuncao(this)">
                <option value="Admitido na valência">Admitido na valência</option>
                <option value="Encaminhado para outra valência">Encaminhado para outra valência</option>
                <option value="">Outro</option>
            </select>
            <br>
            <input type="hidden" name="tecnicoRespondeu" id="tecnicoRespondeu" value="<?=$_SESSION['funcionario']?>">
            <input type="hidden" name="idInscricao" id="idInscricao">
            <input type="text" id="outro" style="display: none;" value="">
            <br><br>
            <button onclick="enviarResposta()">Enviar</button>
        </div>
    </div>


    <div id="tooltip"></div>
    <table class="table">
            <thead>
                <tr>
                    <td>Nome</td>
                    <td>Data inscrição</td>
                    <td>Data visita domiciliário</td>
                    <td class="hoverable" data-tooltip="1. Autónomo \n2. Semi-dependente \n3. Semi-dependente II">Grau de Autonomia</td> 
                    <td class="hoverable" data-tooltip="1. Acompanhado c/ apoio sempre \n2. Acompanhado c/ apoio periódico \n3. Acompanhado s/ apoio \n4. Sozinho">Vive com alguém?</td>
                    <td class="hoverable" data-tooltip="1. Sempre \n2. Periodicamente \n3. Sem apoio">Recebe apoio?</td>
                    <td class="hoverable" data-tooltip="1. Necessidade de mobilização\n2. Incapaz de realizar as tarefas do quotidiano \n3. Solidão \n4. Necessidade de ocupação \n5. Falta de apoio de alguém">Motivo da solicitação</td>
                    <td class="hoverable" data-tooltip="0. Não é sócio \n1. < 1 ano como sócio \n2. 1-5 anos como sócio \n3. > 5 anos como sócio">É sócio?</td>
                    <td>Pontuação</td>
                    <td></td>
                </tr>
            </thead>

            <tbody id="tabela tbody">
                <?php
                foreach ($this->dados as $dado) {
                    ?>
                    <tr>
                        <td><?= $dado['nome'] . " " . $dado['apelido'] ?></td>
                        <td><?= $dado['dataInscricao'] ?></td>
                        <td><?= $dado['dataVisitaDomicilio'] ?></td>
                        <td><?= $dado['grauAutonomia'] ?></td>
                        <td><?= $dado['comQuemVive'] ?></td>
                        <td><?= $dado['temApoioAlguem'] ?></td>
                        <td><?= $dado['motivoSolicitacao'] ?></td>
                        <td><?= $dado['serSocio'] ?></td>
                        <td><?= $dado['pontuacaoCriterio'] ?></td>
                        <td><button onclick="openModal(<?= $dado['idInscricao'] ?>)">Responder</button></td>
                    </tr>
                    <?php


                }
                ?>
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="10">Nota: Será admitido o utente inscrito que obtenha o valor mais elevado nos somatórios
                        das pontuações
                    </td>
                </tr>
            </tfoot>
    </table>

    <script>
        //Esse script permite que cada célula tenha uma legenda ao passar o mouse por cima 

        // Obter todas as células que podem receber hover
        var cells = document.getElementsByClassName("hoverable");

        // Percorrer cada célula
        for (var i = 0; i < cells.length; i++) {
            // Adicionar um event listener para mouseenter
            cells[i].addEventListener("mouseenter", function(event) {
                var cellText = event.target.innerText; // Obter o texto dentro da célula
                var tooltipText = event.target.getAttribute("data-tooltip"); // Obter o texto do tooltip
                var tooltip = document.getElementById("tooltip");
                tooltip.innerHTML = tooltipText.replace(/\\n/g, "<br>"); // Substituir \\n por tags <br>
                
                // Posicionar o tooltip acima da célula
                var rect = event.target.getBoundingClientRect();
                var tooltipTop = rect.top - tooltip.offsetHeight - 10; // 10 é o deslocamento para o espaçamento
                var tooltipLeft = rect.left + (rect.width - tooltip.offsetWidth) / 2;
                tooltip.style.top = tooltipTop + "px";
                tooltip.style.left = tooltipLeft + "px";
                
                tooltip.style.display = "block"; // Mostrar o tooltip
            });

            // Adicionar um event listener para mouseleave
            cells[i].addEventListener("mouseleave", function() {
                var tooltip = document.getElementById("tooltip");
                tooltip.style.display = "none"; // Ocultar o tooltip
            });
        }
    </script>



    <?php

}
?>