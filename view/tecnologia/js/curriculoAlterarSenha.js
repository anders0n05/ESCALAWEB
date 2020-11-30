$(function () {

    var senhaAtual          = document.getElementById("SENHAATUAL");
    var senhaNova           = document.getElementById("SENHAWEB");
    var confirmarNovaSenha  = document.getElementById("NOVASENHACONFIRMACAO");

    function validaSenhaIgual() {
        if(senhaAtual.value == senhaNova.value) {
            senhaNova.setCustomValidity("A senha digita é igual a senha atual!");
        } else {
            senhaNova.setCustomValidity('');
        }
    }

    senhaAtual.onchange = validaSenhaIgual;
    senhaNova.onkeyup = validaSenhaIgual;


    function validaSenhaDigitada() {
      if(senhaNova.value != confirmarNovaSenha.value) {
        confirmarNovaSenha.setCustomValidity("A senha de confirmação é diferente da nova senha!");
      } else {
        confirmarNovaSenha.setCustomValidity('');
      }
    }

    senhaNova.onchange = validaSenhaDigitada;
    confirmarNovaSenha.onkeyup = validaSenhaDigitada;

//INICIA ENVIO DE DADOS PARA O WEB SERVICE DA ESCALASOFT

    var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({
        autoProcessQueue: false,
        maxFilesize: 50, // MB
        timeout: 180000,
        uploadMultiple: true,
        url: '../../model/recrutamento/AlterarCurriculoSenha.php',
        addRemoveLinks: true,
        init: function () {
            dz = this;
            this.on('sending', function (file, xhr, formData) {
                var data = $('form').serializeArray();

                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });

                $('input, select, textarea').attr('disabled', "disabled");
                $('button').attr('disabled', "disabled");
                $('button').html('<i class="fas fa-sync fa-spin"></i>');
            });
        },
        success: function (file, response) {
            swal({
                title: "Sucesso!",
                text: "Sua senha de acesso foi alterada com sucesso!",
                icon: "success",
                timer: 3000,
                button: false
            }).then(function () {
                window.location.href = 'http://186.209.30.45:8086/view/recrutamento/CurriculoListar.php';
            });
        },
        error: function (file, retorno) {
            swal({
                title: "Oopss!",
                text: "A senha atual é diferente da cadsatrada!",
                icon: "error",
                timer: 3000,
                button: false
            }).then(function () {
                window.location.href = 'http://186.209.30.45:8086/view/recrutamento/CurriculoListar.php';
            });
            retorno = JSON.parse(retorno);
            $('input, select, textarea').removeAttr('disabled');
            $('button').removeAttr('disabled');
            $('button').html('Enviar');

            bugsnagClient.notify(new Error(retorno.message), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('#formCurriculoAlterarSenha').serializeArray()
                    })
                }
            });

           // swal({
           //     title: "Oopss!",
           //     text: "Não foi possível alterar a senha de acesso. " + retorno.message,
           //     icon: "error"
           // });

            $.each(dz.files, function (i, file) {
                file.status = Dropzone.QUEUED
            });

        }
    });

    $('form').on('submit', function () {
        if (dz.getQueuedFiles().length === 0) {
            var blob = new Blob();
            blob.upload = {
                'chunked': dz.defaultOptions.chunking
            };
            dz.uploadFile(blob);
        } else {
            dz.processQueue();
        }
        return false;
    });
});