<div id="mensagem"></div>
<?php
if (!isset($_SESSION["idUser"]) || $_SESSION["user"] != "funcionario") {
    echo '<script>window.location.href="/Gaan/index.php";</script>';
    exit();

}
if (isset($_SESSION["res"]) && !$_SESSION['res'] && isset($_SESSION['dados'])) {
    // echo "<pre>";
    // print_r($_SESSION);
    // exit();
    ?>
    <script>
      const mensagem = document.querySelector('#mensagem');
      // Exibir a mensagem
      mensagem.classList.add('erro');
      var m = "<?= $_SESSION['mensagem'] ?>";
      mensagem.textContent = m;
      mensagem.style.top = '0';
      setTimeout(() => {
        mensagem.style.top = '-70px';
      }, 3000);
    </script>
    <?php
    unset($_SESSION["res"]);
    unset($_SESSION["dados"]);
    unset($_SESSION["mensagem"]);
  }elseif(isset($_SESSION["res"]) && $_SESSION['res']){
?>
    <script>
      const mensagem = document.querySelector('#mensagem');
      // Exibir a mensagem
      mensagem.classList.add('sucesso');
      var m = "<?= $_SESSION['mensagem'] ?>";
      mensagem.textContent = m;
      mensagem.style.top = '0';
      setTimeout(() => {
        mensagem.style.top = '-70px';
      }, 3000);
    </script>
<?php
 unset($_SESSION["res"]);
 unset($_SESSION["dados"]);
 unset($_SESSION["mensagem"]);
  }
  ?>

<?php 
if(isset($this->dados['idInscricao'])){
?>
<h1>Dados da Inscrição</h1>
<div>
    <h2>Dados do Utente</h2>
    <section class="secao dados-utente">
        <!-- DADOS PESSOAIS -->
            <section class="dados-pessoais">
                <section class="ident">
                    <h3><strong>Nome completo:</strong> <?= $this->dados['nome'] . " " . $this->dados['apelido'] ?></h3>
                </section>
                <section class="ident">
                    <p><strong>Data de nascimento:</strong> <?= $this->dados['dataNascimento'] ?></p>
                    <p><strong>BI/CC:</strong> <?= $this->dados['identificacao'] ?></p>
                    <p><strong>Validade:</strong> <?= $this->dados['validadeIdentificacao'] ?></p>

                </section>
                <section class="ident">
                    <p><strong>NIF:</strong> <?= $this->dados['nif'] ?></p>
                    <p><strong>SNS:</strong> <?= $this->dados['sns'] ?></p>
                    <p><strong>SS:</strong> <?= $this->dados['ss'] ?></p>
                </section>
                <section class="ident">
                    <p><strong>Morada:</strong> <?= $this->dados['rua'] ?></p>
                </section>
                <section class="ident">
                    <p><strong>Código Postal:</strong> <?= $this->dados['cp'] ?></p>
                    <p><strong>Telefone:</strong> <?= $this->dados['telefone'] ?></p>
                    <p><strong>Telemóvel:</strong> <?= $this->dados['telemovel'] ?></p>
                </section>
            </section>

            <!-- DADOS DE QUEM SOLICITA O APOIO -->
            <h2><br>DADOS DE QUEM SOLICITA O APOIO</h2>
            <section class="dados-responsavel">
                <section class="responsavel">
                    <h3><strong>Nome completo:</strong> <?= $this->dados2['nome'] . " " . $this->dados2['apelido'] ?></h3>
                </section>
                <section class="responsavel">
                    <p><strong>Morada:</strong> <?= $this->dados2['rua'] ?></p>
                </section>
                <section class="responsavel">
                    <p><strong>Código Postal:</strong> <?= $this->dados2['cp'] ?></p>
                    <p><strong>Telemóvel:</strong> <?= $this->dados2['telemovel'] ?></p>
                    <p><strong>Email:</strong> <?= $this->dados2['email'] ?></p>
                </section>

                <section class="responsavel">
                    <p><strong>BI/CC:</strong> <?= $this->dados2['identificacao'] ?></p>
                    <p><strong>Validade:</strong> <?= $this->dados2['validadeIdentificacao'] ?></p>
                    <p><strong>Grau de parentesco:</strong> <?= $this->dados['parentesco'] ?></p>
                </section>
                <section class="responsavel">
                    <p><strong>Data inscrição:</strong> <?= $this->dados['dataInscricao'] ?></p>
                    <p><strong>O próprio ou a pessoa que solicita:</strong> <?= $this->dados['assinatura'] ?></p>
                </section>

            </section>
        
            <?php 
    if($this->dados['tipoServico'] != "Centro do Dia"){
        ?>
        <!-- MOTIVO DA INSCRIÇÃO -->
            <section>
                <h2>Motivo de Inscrição</h2>
                <p><strong>Motivo Selecionado:</strong> <?= $this->dados['motivoInscricao'] ?></p>
            </section>
        <!-- APOIO DE OUTRAS INFORMAÇÕES -->
        <section class="apoio-outras">
            <section>
                <h2>Que tipo de apoio necessita:</h2>
                <ul>
                    <li><strong>Alimentação:</strong> <?= $this->dados['alimentacao'] ?></li>
                    <ul>
                        <li><strong>Semanal:</strong> <?= $this->dados['semanal'] ?></li>
                        <li><strong>Fins-de-semana e feriados:</strong><?= $this->dados['fdsFeriados'] ?></li>
                    </ul>
                    <li><strong>Higiene pessoal:</strong> <?= $this->dados['higienePessoal'] ?></li>
                    <li><strong>Higiene habitacional:</strong> <?= $this->dados['higieneHabitacional'] ?></li>
                    <li><strong>Tratamento de roupa:</strong> <?= $this->dados['tratamentoRoupa'] ?></li>
                </ul>
            </section>

            <section>
                <h2>Outras informações</h2>
                <p><strong>Sofre de doença infetocontagiosa:</strong> <?= $this->dados['doencaInfetoconta'] ?></p>
                <p><strong>Sofre de doença mental:</strong> <?= $this->dados['doencaMental'] ?></p>
                <p><strong>É sócio do Grupo de Amigos de Avós e Netos:</strong> <?= $this->dados['socioGrupoAmigos'] ?></p>
            </section>
        </section>
        <?php 
}
?>
    </section>


    <section class="visita-docimiliaria">
        <h2>Inspeção Serviço</h2>
        <?php 
if(empty($this->dados['pontuacaoCriterio'])){
?>

<section class="secao servico">
    <section class="servico-avaliacao">
        <!-- FORMULÁRIO INSPEÇÃO SERVIÇO -->
        <form onsubmit="return validarFormulario()" action="../../idosos/atualizarInscricao/form" method="POST" id="form1">
        <input type="text" name="idInscricao" value="<?=$this->dados['idInscricao']?>" hidden>
        <input type="text" name="tecnicoVisitou" value="<?=$_SESSION['funcionario']?>" hidden>
        <input type="text" name="idUserUtente" value="<?=$this->dados['idUserUtente']?>" hidden>
            <!-- Relatório da Visita Domiciliária -->
            <section class="textarea">
                <section>
                    <h3>Observações</h3>
                    <textarea id="observacao" name="observacao"></textarea>
                </section>
                <section>
                    <h3>Relatório da Visita Domiciliária</h3>
                    <textarea id="relatorio" name="relatorio"></textarea>
                </section>
            </section>

            <!-- Critérios de Avaliação -->
            <section class="avaliacao">
            <h3>Critérios de Avaliação</h3>
            <div>
                <label for="grauAutonomia">1. Grau de autonomia:</label><br>
                <select id="grauAutonomia" name="grauAutonomia" onchange="totalCrit(this)">
                    <option value=""></option>
                    <option value="1">1. Autónomo</option>
                    <option value="1">1. Semi-dependente I</option>
                    <option value="2">2. semi-dependente II</option>
                    <option value="3">3. dependente</option>
                </select>
            </div>
            <div>
                <label for="comQuemVive">2. Com quem vive:</label><br>
                <select id="comQuemVive" name="comQuemVive" onchange="totalCrit(this)">
                    <option value=""></option>
                    <option value="1">1. Acompanhado, sempre com apoio</option>
                    <option value="2">2. acompanhado, com apoio às vezes</option>
                    <option value="3">3. acompanhado, mas sem qualquer apoio às vezes</option>
                    <option value="4">4. Sozinho</option>
                </select>
            </div>

            <div>
            <label for="temApoioAlguem">3. Tem apoio de alguém:</label><br>
            <select id="temApoioAlguem" name="temApoioAlguem" onchange="totalCrit(this)">
                <option value=""></option>
                <option value="1">1. Sempre</option>
                <option value="2">2. Periodicamente</option>
                <option value="3">3. Não tem</option>
            </select>
            </div>

            <div>
                <label for="motivoSolicitacao">Razões porque solicita apoio:</label><br>
                <select id="motivoSolicitacao" name="motivoSolicitacao" onchange="totalCrit(this)">
                    <option value=""></option>
                    <option value="1">1. Necessidade de mobilização</option>
                    <option value="2">2. Incapaz de realizar as tarefas do quotidiano</option>
                    <option value="1">1. Solidão</option>
                    <option value="1">1. Necessidade de ocupação</option>
                    <option value="2">2. Falta de apoio de alguém</option>
                </select>
            </div>

            <div>
                <label for="serSocio">Ser sócio:</label><br>
                <select id="serSocio" name="serSocio" onchange="totalCrit(this)">
                    <option value=""></option>
                    <option value="0">0. Não sócio</option>
                    <option value="1">1. Menos de um ano</option>
                    <option value="2">2. 1-5 anos</option>
                    <option value="3">3. Mais de 5 anos</option>
                </select>
            </div>
            <div>Total: <span id="tot">0</span></div>
            <input type="text" name="pontuacaoCriterio" id="pontuacaoCriterio" value="0" hidden>
            </section>
            <section>
                <label for="dataVisitaDomicilio">Data Visita Domicílio: </label>
                <input type="date" name="dataVisitaDomicilio" id="dataVisitaDomicilio">
            </section>

            <div id="enviarAvaliacao">
                <input type="submit" value="Submeter dados da inspeção">
                <!-- <button type="button" onclick="validarFormulario()">Enviar</button> -->
            </div>
        </form>
    </section>
<?php
}else{

    ?>
    <!-- Observações e Relatório -->
    <section class="obs-rel">
        <section class="obs">
            <h3>Observações</h3>
            <p><?= $this->dados['observacao'] ?></p>
        </section>
        <section class="rel">
            <h3>Relatório</h3>
            <p><?= $this->dados['relatorio'] ?></p>
        </section>
    </section>
    <!-- AVALIAÇÃO -->
     <section class="pontuacao-avaliacao">
            <section>
                <h2>Critérios de avaliação/prioritização:</h2>
                <p><strong>Grau de autonomia:</strong> <?= $this->dados['grauAutonomia'] ?></p>
                <p><strong>Com quem vive:</strong> <?= $this->dados['comQuemVive'] ?></p>
                <p><strong>Tem apoio alguém:</strong> <?= $this->dados['temApoioAlguem'] ?></p>
                <p><strong>Razões porque solicita apoio:</strong> <?= $this->dados['motivoSolicitacao'] ?></p>
                <p><strong>Ser sócio:</strong> <?= $this->dados['serSocio'] ?></p>
                <p><strong>Total pontuação:</strong> <?= $this->dados['pontuacaoCriterio'] ?></p>
            </section>
        </section>
     <section class="visita-domicilio">
            <section>
                
                <p><strong>Data visita ao domicílio:</strong> <?= $this->dados['dataVisitaDomicilio'] ?></p>
                <p><strong>O Técnico:</strong> <?= $this->dados['tecnicoVisitou'] ?></p>
            </section>
        </section>

    <?php
}
        ?>
    </section>
    <?php 
if(!empty($this->dados['relatorio']) && empty($this->dados['respostaServico'])){
   
    ?>
    <section class="resposta">
      <h3>Dar Resposta ao Serviço</h3>

      <section>
          <form action="../../idosos/respostaInscricao/form" method="POST">

          <input type="text" name="idInscricao" value="<?=$this->dados['idInscricao']?>" hidden>
        <input type="text" name="tecnicoRespondeu" value="<?=$_SESSION['funcionario']?>" hidden>
        <input type="text" name="idUserUtente" value="<?=$this->dados['idUserUtente']?>" hidden>

        <label for="respostaServico">Resposta ao Serviço:</label>
        <select id="respostaServico" name="respostaServico" onchange="minhaFuncao(this)">
          <option value="Admitido na valência">Admitido na valência</option>
          <option value="Encaminhado para outra valência">Encaminhado para outra valência</option>
          <option value="Manutenção em lista de espera">Manutenção em lista de espera</option>
          <option value="">Outro</option>
        </select>
        <input type="text" id="outro" style="display: none;" value="">

        <div id="enviarResposta">
                <input type="submit" value="Enviar Resposta">
            </div>
        </form>
      </section>
    </section>
<?php
}else{

    ?>
    <section class="respostaDada">
        <h2>Resposta do serviço</h2>
        <?php 
if(!empty($this->dados['respostaServico'])){
        ?>
        <p><?= $this->dados['respostaServico'] ?></p>
        <?php
}else{
    ?>
<p>PENDENTE</p>
<p><?=$this->dados['respostaServico'] ?></p>
    <?php 
}
?>
    </section>
<?php
}
        ?>


</div>

<?php 
}else{
?>

<SEM style="text-align:center;color:red;">SEM INSCRIÇÃO FEITA</h1>

<?php 

}
?>