
<?php 
if(!isset($_SESSION["idUser"])){
    header('Location: ' . ROOT . '/login');
    exit();
}
?>

<div id="mensagem"></div>
<span id="idUser" hidden><?=$this->dados['idUser']?></span>
<div class="container-fluid p-3 text-center">
    <h2>perfil</h2>
</div>
<div class="container2">

    <div id="form">
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
                <button class="atualizar-button" onclick="atualizar('dados-pessoais')">Atualizar</button>
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
                        <input type="text" id="telefone" name="telefone" value="<?= $this->dados['telefone'] ?>" readonly
                            ondblclick="toggleEditability(this)">
                    </section>

                    <section class="subGroupSection">
                        <label for="telemovel" class="required-label">Telemóvel:</label>
                        <input type="text" id="telemovel" name="telemovel" value="<?= $this->dados['telemovel'] ?>"
                            readonly required ondblclick="toggleEditability(this)">
                    </section>

                </section>


            </section>
            <section class="buttonSection">
                <button class="atualizar-button" onclick="atualizar('endereco')">Atualizar</button>
            </section>
        </section>


        <section class="section senha-perfil">
            <h2>Atualizar dados da conta</h2>

            <section class="groupSection email" style="justify-content:left !important">
                <section class="subGroupSection">
                    <label for="email" class="required-label">Email atual:</label>
                    <input type="email" id="email" name="email" required>
                </section>
                <section class="subGroupSection">
                    <label for="confEmail" class="required-label">Novo email:</label>
                    <input type="email" id="confEmail" name="confEmail" required>
                </section>
            </section>
            <section class="buttonSection">
                <button class="atualizar-button" onclick="atualizar('email')">Atualizar</button>
            </section>

            <section class="groupSection senha">
                <section class="subGroupSection">
                    <label for="senha" class="required-label">Senha atual:</label>
                    <input type="password" id="senha" name="senha" required>
                </section>
                <section class="subGroupSection">
                    <label for="confSenha" class="required-label">Nova senha:</label>
                    <input type="password" id="confSenha" name="confSenha" required>
                </section>
            </section>
            <section class="buttonSection">
                <button class="atualizar-button" onclick="atualizar('senha')">Alterar</button>
            </section>


        </section>


    </div>
</div>