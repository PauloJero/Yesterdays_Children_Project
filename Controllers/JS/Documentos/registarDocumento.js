function uploadFile() {

    let fileInput = document.getElementById('fileInput');
    let preview = document.getElementById('preview');
    if(fileInput.files[0]){

        var file = fileInput.files[0];
    }else{
        var file = "";
    }
    var formData = new FormData();
    formData.append('file', file);
    formData.append('tipo', document.getElementById('tipo').value);
    formData.append('origem', document.getElementById('origem').value);
    formData.append('idIdoso', document.getElementById('idIdoso').value);
    formData.append('idFuncResponsavel', document.getElementById('idFuncResponsavel').value);

   
    const browserEscondido = new XMLHttpRequest();
    browserEscondido.onload = function () {
        const mensagem = document.querySelector('#mensagem');
        mensagem.classList.remove('sucesso', 'erro');
        res = JSON.parse(this.responseText);

        if (res == "sucesso") {
            fileInput.value = '';
            preview.classList.remove('preview')
            preview.style.display = 'none';
            mensagem.textContent = 'Documento registado com sucesso';
            mensagem.classList.add('sucesso');

        } else if (res == "insucesso") {
            mensagem.textContent = 'Houve um erro';
            mensagem.classList.add('erro');

        } else if (res == "existe") {

            mensagem.textContent = "Existe um documento igual!";
            mensagem.classList.add('erro');

        } else {
            mensagem.textContent = "Não foi possível fazer o User!";
            mensagem.classList.add('erro');
        }

        mensagem.style.top = '0';
        setTimeout(() => {
            mensagem.style.top = '-50px';
        }, 3000);

    }

    if (file == "") {
        alert("Nenhum documento carregado!")


    } else {

        browserEscondido.open("POST", "../../Controllers/API/documentos.api.php");
        browserEscondido.send(formData);
    }
}