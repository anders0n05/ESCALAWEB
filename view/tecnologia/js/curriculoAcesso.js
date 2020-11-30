$(function () {
    var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({
        autoProcessQueue: false,
        maxFilesize: 50, // MB
        timeout: 180000,
        uploadMultiple: true,
        url: '../../model/recrutamento/CriarAcesso.php',
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
            console.log(response);
            swal({
                title: "Sucesso!",
                text: "Seu acesso foi criado com sucesso.",
                icon: "success",
                timer: 3000,
                button: false
            }).then(function () {
                window.location.href = 'http://186.209.30.45:8086/view/estrutura/acesso.php';
            });
        },
        error: function (file, retorno) {
            swal({
                title: "Oopss!",
                text: "O CPF já está cadastrado! Altere sua senha ou contate o setor administrativo da Escalasoft.",
                icon: "error"
            }).then(function () {
                window.location.href = 'http://186.209.30.45:8086/view/estrutura/acesso.php';
            });
            retorno = JSON.parse(retorno);
            $('input, select, textarea').removeAttr('disabled');
            $('button').removeAttr('disabled');
            $('button').html('Cadastrar');

            bugsnagClient.notify(new Error(retorno.message), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('#formCurriculoAcesso').serializeArray()
                    })
                }
            });

            swal({
                title: "Oopss!",
                text: "Ocorreu erros ao cadastrar seu acesso: " + retorno.message,
                icon: "error"
            });

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

    var maskBehaviorCPF = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '000.000.000-00' : '000.000.000-00';
        },
        options = {
            onKeyPress: function (val, e, field, options) {
                field.mask(maskBehaviorCPF.apply({}, arguments), options);
            }
        };

    $('input[name="CPF"]').mask(maskBehaviorCPF, options);

    $('button#voltarAcesso').click(function() {
         window.location.href = 'acesso.php';
   });
});

/*----------------------------------------------------------------------------------*/