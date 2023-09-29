
<div id="mensagem"></div>

<?php
if (!isset($_SESSION["idUser"]) || $_SESSION["user"] != "funcionario") {
  echo '<script>window.location.href="/Gaan/index.php";</script>';
  exit();

}

if (isset($_SESSION["res"]) && !$_SESSION['res'] && isset($_SESSION['dados'])) {

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
}
?>


<h1>Formulário Inscrição</h1>
<form onsubmit="return validarFormulario()" action="../../idosos/inserirInscricao/form" method="POST">
  <input type="text" name="idUserUtente" id="idUserUtente" hidden value="<?= $this->dados['idUser'] ?>">
  <section class="section-form">
    <fieldset class="responsive-fieldset">
      <div>
        <legend>Tipo Resposta</legend>
        <select id="tipoServico" name="tipoServico" onchange="toggleSection()">
          <option value="Centro de Convívio">Centro de Convívio</option>
          <option value="Centro do Dia">Centro do Dia</option>
          <option value="Serviço de Apoio ao Domicílio">Serviço de Apoio ao Domicílio</option>
        </select>
      </div>
      <!-- Dados do Utente -->
      <legend>Dados do Utente</legend>

      <label for="idUserResponsavel">Familiar Responsável:</label>
      <select id="idUserResponsavel" name="idUserResponsavel">
        <?php
        foreach ($this->dados2 as $d2) {

          ?>

          <option value="<?= $d2['idUser'] ?>"><?= $d2['nome'] . " " . $d2['apelido'] . " (" . $d2['email'] . ")" ?>
          </option>
          <?php
        }
        ?>
      </select>

      <label for="parentesco">Parentesco do Responsável:</label>
      <input type="text" id="parentesco" name="parentesco" required>

      <label for="assinatura">Assinatura do Utente ou Responsável:</label>
      <input type="text" id="assinatura" name="assinatura" placeholder="Ex.: Marcos Silva" required>
    </fieldset>

    <!-- Optional -->
    <fieldset class="responsive-fieldset optional">
      <legend>Motivo de Inscrição</legend>

      <div>
        <input type="radio" id="motivoInscricao0" name="motivoInscricao" value="Necessidade de mobilização" />
        <label for="motivoInscricao0">Necessidade de mobilização</label><br>

        <input type="radio" id="motivoInscricao1" name="motivoInscricao"
          value="Incapaz de realizar as tarefas do quotidiano" />
        <label for="motivoInscricao1">Incapaz de realizar as tarefas do quotidiano</label><br>

        <input type="radio" id="motivoInscricao2" name="motivoInscricao" value="Solidão" />
        <label for="motivoInscricao2">Solidão</label><br>

        <input type="radio" id="motivoInscricao3" name="motivoInscricao" value="Necessidade de ocupação" />
        <label for="motivoInscricao3">Necessidade de ocupação</label><br>

        <input type="radio" id="motivoInscricao4" name="motivoInscricao" value="Falta de apoio de alguém" />
        <label for="motivoInscricao4">Falta de apoio de alguém</label><br>
      </div>
    </fieldset>

    <fieldset class="responsive-fieldset optional">
      <legend>Tarefas a Realizar</legend>

      <ul>
        <li>
          <label>
            Alimentação
            <label for="simAlimentacao">SIM</label>
            <input type="radio" name="alimentacao" id="simAlimentacao" value="SIM">
            <label for="naoAlimentacao">NÃO</label>
            <input type="radio" name="alimentacao" id="naoAlimentacao" value="NÃO">
          </label><br>
          <ul>
            <li>
              <label>
                Semanal
                <label for="simSemanal">SIM</label>
                <input type="radio" name="semanal" id="simSemanal" value="SIM">
                <label for="naoSemanal">NÃO</label>
                <input type="radio" name="semanal" id="naoSemanal" value="NÃO">
              </label><br>
            </li>
            <li>
              <label>
                Fins-de-semana e feriados
                <label for="sfdsf">SIM</label>
                <input type="radio" name="fdsFeriados" id="sfdsf" value="SIM">
                <label for="nfdsf">NÃO</label>
                <input type="radio" name="fdsFeriados" id="nfdsf" value="NÃO">
              </label><br>
            </li>
          </ul>
        </li>

        <li>
          <label>
            Higiene pessoal
            <label for="shp">SIM</label>
            <input type="radio" name="higienePessoal" id="shp" value="SIM">
            <label for="nhp">NÃO</label>
            <input type="radio" name="higienePessoal" id="nhp" value="NÃO">
          </label><br>
        </li>
        <li>
          <label>
            Higiene habitacional
            <label for="shh">SIM</label>
            <input type="radio" name="higieneHabitacional" id="shh" value="SIM">
            <label for="nhh">NÃO</label>
            <input type="radio" name="higieneHabitacional" id="nhh" value="NÃO">
          </label><br>
        </li>
        <li>
          <label>
            Tratamento de roupa
            <label for="str">SIM</label>
            <input type="radio" name="tratamentoRoupa" id="str" value="SIM">
            <label for="ntr">NÃO</label>
            <input type="radio" name="tratamentoRoupa" id="ntr" value="NÃO">
          </label><br>
        </li>
      </ul>

    </fieldset>

    <!-- Problemas de saúde -->
    <fieldset class="responsive-fieldset optional">
      <legend>Outros informações</legend>

      <div>
        <label for="doencaInfetoconta">Sofre de doença infetocontagiosa:</label>
        <label for="simDI">Sim
          <input type="radio" id="simDI" name="doencaInfetoconta" value="SIM">
        </label>
        <label for="naoDI">Não
          <input type="radio" id="naoDI" name="doencaInfetoconta" value="NÃO">
        </label><br>

        <label for="doencaMental">Sofre de doença mental:</label>
        <label for="simDoencaMental">Sim
          <input type="radio" id="simDoencaMental" name="doencaMental" value="SIM">
        </label>
        <label for="naoDoencaMental">Não
          <input type="radio" id="naoDoencaMental" name="doencaMental" value="NÃO">
        </label><br>

        <label for="socioGrupoAmigos">É sócio do Grupo de Amigos de Avós e Netos:</label>
        <label for="simSocioGrupoAmigos">Sim
          <input type="radio" id="simSocioGrupoAmigos" name="socioGrupoAmigos" value="SIM">
        </label>
        <label for="naoSocioGrupoAmigos">Não
          <input type="radio" id="naoSocioGrupoAmigos" name="socioGrupoAmigos" value="NÃO">
        </label><br>
      </div>
    </fieldset>
  </section>

  <div id="enviar">
    <input type="submit" value="Enviar">
  </div>
</form>