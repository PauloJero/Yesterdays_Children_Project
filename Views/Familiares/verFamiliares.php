<div id="mensagem"></div>
<div class="container-fluid p-3 text-center">
  <h2>Funcionários</h2>
</div>
<div class="row">
    <div class="row">

        <div class="col-3">
            <div class="row p-3">
                <input id="filt_nome" type="text" class="col form-control" placeholder="Nome" aria-label="Nome">
            </div>
        </div>

        <div class="col-4" style = "display: none">
            <div class="row p-3">
                <input id="filt_apelido" type="text" class="col form-control" placeholder="Apelido" aria-label="Apelido">
            </div>
        </div>
        <div class="col-4">
            <div class="row g-2 p-3">
                <button class="col-3" onclick="filtrar()">Filtrar</button>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>NOME</th>
            <th>APELIDO</th>
            <th>EMAIL</th>
            <th>TELEMÓVEL</th>
            <th>MORADA</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tbody">

    </tbody>
</table>
<span id="span"></span>