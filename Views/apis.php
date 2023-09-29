<div class="container-fluid p-3">
    <div class="container p-5">
        <h1>API'S</h1>
        <p>Para utilizar as nossas APIs basta introduzir na URL após o <b>index.php</b>, o termo <b>/api</b> para receber uma resposta da informação desejada em JSON.<br>Confira os exemplos de utilização de cada API abaixo:</p>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="apibox p-3">
            <h3>Elderly</h3>
            <p>
                <i><strong>Ver todos os idosos:</strong></i><br>
                <div class="apidiv">
                    <a class="apilink" href="<?=ROOT?>/api/idosos/ver-idosos" target="_blank">
                    localhost/Gaan/index.php/api/idosos/ver-idosos
                    </a>
                </div>
                <i><strong>Para ver um idoso passa-se o id do idoso:</strong></i><br>
                <p>/api/idosos/ver-idosos/1</p>
            </p>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="apibox p-3">
            <h3>Employees</h3>
            <p>
                <i><strong>Ver todos os funcionários:</strong></i><br>
                <div class="apidiv">
                    <a class="apilink" href="<?=ROOT?>/api/funcionarios/ver-funcionarios" target="_blank">
                    localhost/Gaan/index.php/api/funcionarios/ver-funcionarios
                    </a>
                </div>
                <i><strong>Para ver um funcionário passa-se o id do funcionário:</strong></i><br>
                <p>/api/funcionarios/ver-funcionarios/1</p>
            </p>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="apibox p-3">
            <h3>Families</h3>
            <p>
                <i><strong>Ver todas os familiares:</strong></i><br>
                <div class="apidiv">
                    <a class="apilink" href="<?=ROOT?>/api/familiares/ver-familiares" target="_blank">
                    localhost/Gaan/index.php/api/familiares/ver-familiares
                    </a>
                </div>
                <i><strong>Para ver um familiar passa-se o id do familiar:</strong></i><br>
                <p>/api/familiares/ver-familiares/1</p>
            </p>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="apibox p-3">
            <h3>Documentos</h3>
            <p>
                <i><strong>Ver todos os documentos:</strong></i><br>
                <div class="apidiv">
                    <a class="apilink" href="<?=ROOT?>/api/familiares/ver-familiares" target="_blank">
                    localhost/Gaan/index.php/api/familiares/ver-documentos
                    </a>
                </div>
                <i><strong>Para ver um documento passa-se o id do documento:</strong></i><br>
                <p>/api/documentos/ver-documento/1</p>
            </p>
        </div>
    </div>
</div>