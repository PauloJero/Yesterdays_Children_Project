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


<!-- <div class="navigation">
    <button class="section-button active" data-section="primeira-secao">Primeira seção</button>
    <button class="section-button" data-section="segunda-secao">Segunda seção</button>
    <button class="section-button" data-section="terceira-secao">Terceira seção</button>
    <button class="section-button" data-section="quarta-secao">Quarta seção</button>
    <button class="section-button" data-section="quinta-secao">Quinta seção</button>
    <button class="section-button" data-section="sexta-secao">Sexta seção</button>
</div> -->


<?php
if (isset($_SESSION["existeProcesso"])) {
    ?>
    <script>
        const mensagem = document.querySelector('#mensagem');
        // Exibir a mensagem
        mensagem.classList.add('erro');
        var m = "<?= $_SESSION['existeProcesso'] ?>";
        mensagem.textContent = m;
        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-70px';
        }, 3000);
    </script>
    <?php
    unset($_SESSION["existeProcesso"]);
} elseif (isset($_SESSION["sucesso"])) {
    ?>
    <script>
        const mensagem = document.querySelector('#mensagem');
        // Exibir a mensagem
        mensagem.classList.add('sucesso');
        var m = "<?= $_SESSION['sucesso'] ?>";
        mensagem.textContent = m;
        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-70px';
        }, 3000);
    </script>
    <?php
    unset($_SESSION["sucesso"]);
}
?>

<h2>Processo Utente</h2>
<?php
if (!isset($_SESSION["idProcesso"]) || $_SESSION["idProcesso"] == 0) {
    ?>

    <form action="../../idosos/registarProcesso/form/<?= $this->dados['idUserUtente'] ?>" method="POST">
        <!-- PRIMEIRA SEÇÃO -->

        <section class="section active primeira-secao">
            <input type="hidden" name="idUserUtente" id="idUserUtente" value="<?= $this->dados['idUserUtente'] ?>">
            <section class="dados-principais">
                <section>
                    <label for="socioNumero">Sócio número: </label>
                    <input type="number" name="socioNumero" id="socioNumero">
                </section>

                <section>
                    <label for="contratoNumero">Contrato número: </label>
                    <input type="number" name="contratoNumero" id="contratoNumero">
                </section>

                <section>
                    <label for="dataSaida">Data saída: </label>
                    <input type="date" name="dataSaida" id="dataSaida">
                </section>

                <section>
                    <label for="motivoSaida">Motivo saída: </label>
                    <input type="text" name="motivoSaida" id="motivoSaida">
                </section>

                <section>
                    <label for="habilitLiteraria">Habilitação Literária: </label>
                    <input type="text" name="habilitLiteraria" id="habilitLiteraria">
                </section>
            </section>
            <section class="vida-o">
                <section>
                    <label for="historiaVida">História Vida: </label>
                    <textarea name="historiaVida" id="historiaVida" cols="30" rows="10" style="resize: none;"></textarea>
                </section>

                <section>
                    <label for="gostosPessoais">Gostos pessoais: </label>
                    <textarea name="gostosPessoais" id="gostosPessoais" cols="30" rows="10"
                        style="resize: none;"></textarea>
                </section>
            </section>
        </section>

        <input type="submit" value="Inserir">
    </form>

    <?php
} else {


    // print_r($this->dados2);
    ?>


<h1 style="text-align:center;color:red"></h1>PROCESSO JÁ INICIADO, MAS AINDA NÃO ESTÁ DISPONÍVEL PARA CONTINUAÇÃO</h1>
<h1 style="">BREVEMENTE!</h1>
    <!-- <form action="../../idosos/registarProcesso/form/<?= $this->dados['idUserUtente'] ?>/at" method="POST" style="border: 1px solid red"> -->
        <!-- SEGUNDA SEÇÃO -->
        <!-- <section class="section segunda-secao">
            Caracterização social, familiar e habitacional do utente
            <section>
                <label>Indique total de pessoas que pretende adicionar:</label>
                <input type="number" value="1" oninput="adicionarElementos()" id="numeroEl">
                <h3>Com quem Vive: </h3>
                <div id="containerEl">
                    <div>
                        <label for="nome">Nome: </label>
                        <input type="text" name="nome" id="nome">
                        <label for="contato">Contato: </label>
                        <input type="text" name="contato" id="contato">
                    </div>
                </div>
            </section>

            Contexto familiar
            <label>Escolhe quantos queres adicionar:</label>
            <input type="number" oninput="adicionarElementos2()" id="contFam">
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">Nome</th>
                        <th rowspan="2">Morada</th>
                        <th colspan="3" style="text-align:center;">Telefones</th>
                    </tr>
                    <tr>
                        <th>Casa</th>
                        <th>Emprego</th>
                        <th>Telemóvel</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
            <input type="submit" value="Inserir">
        </section>
    </form> -->

<?php

}
?>








<!-- 


    <section class="section terceira-secao"></section>
    <section class="section quarta-secao"></section>
    <section class="section quinta-secao"></section>
    <section class="section sexta-secao"></section> -->



<!-- 
    
 -->