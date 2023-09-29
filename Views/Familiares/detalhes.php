<div id="mensagem"></div>
<?php
if (!isset($_SESSION["idUser"]) || $_SESSION["user"] != "funcionario") {
    echo '<script>window.location.href="/Gaan/index.php";</script>';
    exit();

}
// echo "<pre>";
// print_r($this->dados);
if (isset($_SESSION["res"]) && $_SESSION['res']) {

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
    unset($_SESSION["mensagem"]);

}

// print_r($this->dados);
?>

<input type="hidden" hidden value="<?= $this->dados['idUser'] ?>" id="idUser">

<section class="container-fluid p-3 text-center">
    <h1>Área de Familiares</h1>
</section>

<div class="container2">


        <h1>Perfil</h1>
        <section class="section dados-pessoais">
            <h2>Dados Pessoais</h2>
            <section class="groupSection">
                <section class="subGroupSection">
                    <label for="nome" class="required-label">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= $this->dados['nome'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

                <section class="subGroupSection">
                    <label for="apelido" class="required-label">Apelido:</label>
                    <input type="text" id="apelido" name="apelido" value="<?= $this->dados['apelido'] ?>" readonly
                        required ondblclick="toggleEditability(this)">
                </section>

            </section>

            <section class="groupSection">
                <section class="subGroupSection">
                    <label for="estadoCivil">Estado Civil:</label>
                    <input type="text" id="estadoCivil" name="estadoCivil" value="<?= $this->dados['estadoCivil'] ?>"
                        readonly ondblclick="toggleEditability(this)">
                </section>

                <section class="subGroupSection">
                    <label for="dataNascimento">Data de Nascimento:</label>
                    <input type="text" id="dataNascimento" name="dataNascimento"
                        value="<?= $this->dados['dataNascimento'] ?>" readonly ondblclick="toggleEditability(this)">
                </section>

            </section>

            <section class="groupSection">
                <section class="subGroupSection">
                    <label for="identificacao" class="required-label">Identificação:</label>
                    <input type="text" id="identificacao" name="identificacao"
                        value="<?= $this->dados['identificacao'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

                <section class="subGroupSection">
                    <label for="validadeIdentificacao" class="required-label">Validade da Identificação:</label>
                    <input type="text" id="validadeIdentificacao" name="validadeIdentificacao"
                        value="<?= $this->dados['validadeIdentificacao'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

            </section>

            <section class="groupSection">
                <section class="subGroupSection">
                    <label for="naturalidade" class="required-label">Naturalidade:</label>
                    <input type="text" id="naturalidade" name="naturalidade" value="<?= $this->dados['naturalidade'] ?>"
                        readonly required ondblclick="toggleEditability(this)">
                </section>

                <section class="subGroupSection">
                    <label for="nif" class="required-label">Contribuinte:</label>
                    <input type="text" id="nif" name="nif" value="<?= $this->dados['nif'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

            </section>

            <section class="groupSection">

                <section class="subGroupSection">
                    <label for="sns" class="required-label">Número de Utente:</label>
                    <input type="text" id="sns" name="sns" value="<?= $this->dados['sns'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

                <section class="subGroupSection">
                    <label for="ss" class="required-label">Segurança Social:</label>
                    <input type="text" id="ss" name="ss" value="<?= $this->dados['ss'] ?>" readonly required
                        ondblclick="toggleEditability(this)">
                </section>

            </section>

            <section class="buttonSection">
                <button class="atualizar-button" onclick="atualizar('dados-pessoais')">Atualizar Dados Pessoais</button>
            </section>


        </section>

        <section class="section endereco">
            <section>
                <h2>Endereço</h2>


                <section class="groupSection">
                    <section class="subGroupSection">
                        <label for="rua" class="required-label">Rua:</label>
                        <input type="text" id="rua" name="rua" value="<?= $this->dados['rua'] ?>" readonly required
                            ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="numero">Número:</label>
                        <input type="text" id="numero" name="numero" value="<?= $this->dados['numero'] ?>" readonly
                            ondblclick="toggleEditability(this)">
                    </section>

                </section>

                <section class="groupSection">
                    <section class="subGroupSection">
                        <label for="andar">Andar:</label>
                        <input type="text" id="andar" name="andar" value="<?= $this->dados['andar'] ?>" readonly
                            ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="lado">Lado:</label>
                        <input type="text" id="lado" name="lado" value="<?= $this->dados['lado'] ?>" readonly
                            ondblclick="toggleEditability(this)">
                    </section>

                </section>

                <section class="groupSection">
                    <section class="subGroupSection">
                        <label for="cp" class="required-label">Código Postal:</label>
                        <input type="text" id="cp" name="cp" value="<?= $this->dados['cp'] ?>" readonly required
                            ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="localidade" class="required-label">Localidade:</label>
                        <input type="text" id="localidade" name="localidade" value="<?= $this->dados['localidade'] ?>"
                            readonly required ondblclick="toggleEditability(this)">
                    </section>

                </section>

            </section>

            <section>
                <h2>Contato</h2>

                <section class="groupSection">
                    <section class="subGroupSection">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" value="<?= $this->dados['telefone'] ?>"
                            readonly ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="telemovel" class="required-label">Telemóvel:</label>
                        <input type="text" id="telemovel" name="telemovel" value="<?= $this->dados['telemovel'] ?>"
                            readonly required ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="email" class="required-label">Email:</label>
                        <input type="text" id="email" name="email" value="<?= $this->dados['email'] ?>" readonly
                            required ondblclick="toggleEditability(this)">
                    </section>
                </section>
            </section>
            <section class="buttonSection">
                <button class="atualizar-button" onclick="atualizar('endereco')">Atualizar Contatos e Endereço</button>
            </section>
        </section>

    </div>
</div>