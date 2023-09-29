<style>
  .preview{
    height: 600px;
    width: 70%;
    margin: auto;
  }
</style>

<?php
$func = $this->dados["func"];
$idosos = $this->dados["idosos"];
?>
<div id="mensagem"></div>
<div class="container-fluid p-3 text-center">
  <h2>Registar documento</h2>
</div>
<div class="row g-3">

  <div class="row g-3">
    <div class="col">
      <div class="row">
        <p class="col-2">Tipo ficheiro</p>
        <input id="tipo" class="col-5">
      </div>
    </div>

    <div class="col">
      <div class="row">
        <p class="col-2">Idoso</p>
        <select id="idIdoso" class="col-5">
          <?php
          foreach ($idosos as $i) {
            ?>
            <option value="<?= $i['idUser'] ?>"><?= $i['nome'] . " " . $i["apelido"] ?></option>
            </option>
            <?php
          }
          ?>
        </select>
      </div>
    </div>

  </div>


  <div class="row g-3">

    <div class="col">
      <div class="row">
        <p class="col-2">Funcionário</p>
        <select id="idFuncResponsavel" class="col-5">
          <?php
          foreach ($func as $f) {
            ?>
            <option value="<?= $f['idUser'] ?>"><?= $f['nome'] . " " . $f["apelido"] ?></option>
            </option>
            <?php
          }
          ?>
        </select>
      </div>

    </div>


    <div class="col">
      <div class="row">
        <p class="col-2">Origem</p>
        <select id="origem" class="col-5">
          <option value="interno">Interno</option>
          <option value="externo">Externo</option>
        </select>
      </div>

    </div>



  </div>

  <div class="row g-3">
    <div class="row g-3">
      <h1>Selecionar arquivo</h1>
      <form action="upload.php" method="POST" enctype="multipart/form-data">
        <label for="fileInput" class="btn border bg-success text-light">SELECIONAR DOCUMENTO</label>
        <input type="file" id="fileInput" hidden onchange="previewFile()"><br>
      </form>
    </div>
    <div class="row g-3">
      <iframe id="preview" src="" frameborder="0" allowfullscreen></iframe>
    </div>

  </div>


  <div class="row g-3" style="display: flex; justify-content:flex-end;">
    <button onclick="uploadFile()">Registar</button>
  </div>
</div>










<script>
  function previewFile() {
    var fileInput = document.getElementById('fileInput');
    
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf)$/i;

    if (!allowedExtensions.exec(filePath)) {

      alert('Por favor, selecione um arquivo PDF válido');

      fileInput.value = '';

      return false;

    } else {

      var preview = document.querySelector('#preview');
      preview.style.display = 'block';
      if (fileInput.files && fileInput.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
          preview.classList.add('preview');
          preview.setAttribute('src', e.target.result);
        };

        reader.readAsDataURL(fileInput.files[0]);
      }

    }

  }
</script>