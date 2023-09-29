<?php
if (!isset($_SESSION["idUser"])) {
  echo '<script>window.location.href="/Gaan/index.php";</script>';
  exit();

} elseif (isset($_SESSION["user"]) && $_SESSION["user"] != "funcionario") {

  echo '<script>window.location.href="/Gaan/index.php";</script>';
  exit();
}
?>

<div id="mensagem"></div>
<div class="container-fluid p-3 text-center">
    <h2>formulário de registo</h2>
</div>
<div class="container1">
  <div id="form">
    <section>
      <h2>Utilizador</h2>
      <section class="groupSection" style="justify-content:left">
        <section class="subGroupSection">
          <label for="perfil">Perfil:</label>
          <select id="perfil" name="perfil">
            <?php
            foreach ($this->dados as $d) {
              ?>
            <option value="<?= $d['idPerfil'] ?>"><?= $d['descricao'] ?></option>
              <?php
            }
            ?>
          </select>
        </section>

      </section>
    </section>

    <div class="navigation">
      <button class="section-button active" data-section="dados-pessoais">Dados Pessoais</button>
      <button class="section-button" data-section="endereco">Endereço e Contato</button>
      <button class="section-button" data-section="senha-perfil">Dados de acesso</button>
    </div>

    <section class="section dados-pessoais active">
      <h2>Dados Pessoais</h2>
      <section class="groupSection">
        <section class="subGroupSection">
          <label for="nome" class="required-label">Nome:</label>
          <input type="text" id="nome" name="nome" required>
        </section>

        <section class="subGroupSection">
          <label for="apelido" class="required-label">Apelido:</label>
          <input type="text" id="apelido" name="apelido" required>
        </section>

      </section>

      <section class="groupSection">
        <section class="subGroupSection">
          <label for="estadoCivil">Estado Civil:</label>
          <input type="text" id="estadoCivil" name="estadoCivil">
        </section>

        <section class="subGroupSection">
          <label for="dataNascimento">Data de Nascimento:</label>
          <input type="date" id="dataNascimento" name="dataNascimento">
        </section>

      </section>

      <section class="groupSection">
        <section class="subGroupSection">
          <label for="identificacao" class="required-label">Identificação:</label>
          <input type="text" id="identificacao" name="identificacao" class="datepicker" required>
        </section>

        <section class="subGroupSection">
          <label for="validadeIdentificacao" class="required-label">Validade da Identificação:</label>
          <input type="date" id="validadeIdentificacao" name="validadeIdentificacao" required>
        </section>

      </section>

      <section class="groupSection">
        <section class="subGroupSection">
          <label for="naturalidade" class="required-label">Naturalidade:</label>
          <input type="text" id="naturalidade" name="naturalidade" required>
        </section>

        <section class="subGroupSection">
          <label for="nif" class="required-label">Contribuinte:</label>
          <input type="text" id="nif" name="nif" required>
        </section>

      </section>

      <section class="groupSection">

        <section class="subGroupSection">
          <label for="sns" class="required-label">Número de Utente:</label>
          <input type="text" id="sns" name="sns" required>
        </section>

        <section class="subGroupSection">
          <label for="ss" class="required-label">Segurança Social:</label>
          <input type="text" id="ss" name="ss" required>
        </section>

      </section>


    </section>

    <section class="section endereco">
      <section>
        <h2>Endereço</h2>


        <section class="groupSection">
          <section class="subGroupSection">
            <label for="rua" class="required-label">Rua:</label>
            <input type="text" id="rua" name="rua" required>
          </section>

          <section class="subGroupSection">
            <label for="numero">Número:</label>
            <input type="number" id="numero" name="numero">
          </section>

        </section>

        <section class="groupSection">
          <section class="subGroupSection">
            <label for="andar">Andar:</label>
            <input type="number" id="andar" name="andar">
          </section>

          <section class="subGroupSection">
            <label for="lado">Lado:</label>
            <input type="text" id="lado" name="lado">
          </section>

        </section>

        <section class="groupSection">
          <section class="subGroupSection">
            <label for="cp" class="required-label">Código Postal:</label>
            <input type="text" id="cp" name="cp" required>
          </section>

          <section class="subGroupSection">
            <label for="localidade" class="required-label">Localidade:</label>
            <input type="text" id="localidade" name="localidade" required>
          </section>

        </section>

      </section>

      <section>
        <h2>Contato</h2>

        <section class="groupSection">
          <section class="subGroupSection">
            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone">
          </section>

          <section class="subGroupSection">
            <label for="telemovel" class="required-label">Telemóvel:</label>
            <input type="text" id="telemovel" name="telemovel" required>
          </section>

        </section>


      </section>
    </section>


    <section class="section senha-perfil">
      <h2>Dados de acesso</h2>

      <section class="groupSection" style="justify-content:left !important">
        <section class="subGroupSection">
          <label for="email" class="required-label">Email:</label>
          <input type="email" id="email" name="email" required>
        </section>
        <section class="subGroupSection">
          <label for="confEmail" class="required-label">Confirmar Email:</label>
          <input type="email" id="confEmail" name="confEmail" required>
        </section>

      </section>
      <section class="groupSection">
        <section class="subGroupSection">
          <label for="senha" class="required-label">Senha:</label>
          <input type="password" id="senha" name="senha" required>
        </section>

        <section class="subGroupSection">
          <label for="confSenha" class="required-label">Confirmar Senha:</label>
          <input type="password" id="confSenha" name="confSenha" required>
        </section>

      </section>



      <section class="groupSection">
        <section class="subGroupSection">
          <button type="button" class="submit" onclick="adicionar()">Registar</button>
        </section>

      </section>

    </section>


  </div>
</div>