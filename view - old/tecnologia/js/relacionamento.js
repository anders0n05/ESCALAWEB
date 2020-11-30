$(function () {
    var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({
        autoProcessQueue: false,
        maxFilesize: 50, // MB
        timeout: 180000,
        uploadMultiple: true,
        url: '../../model/relacionamento/CriarRelacionamento.php',
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
                text: "Seu ticket foi criado com sucesso.",
                icon: "success",
                timer: 3000,
                button: false
            }).then(function () {
                window.location.href = '/view/relacionamento/RelacionamentoClienteListar.php?atendimento=' + response;
            });
        },
        error: function (file, retorno) {
            retorno = JSON.parse(retorno);
            $('input, select, textarea').removeAttr('disabled');
            $('button').removeAttr('disabled');
            $('button').html('Enviar');

            bugsnagClient.notify(new Error(retorno.message), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('#formRelacionamento').serializeArray()
                    })
                }
            });

            swal({
                title: "Oopss!",
                text: "Não foi possível enviar o seu ticket: " + retorno.message,
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

    var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {
            onKeyPress: function (val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
            }
        };

    $('input[name="TELEFONE"]').mask(maskBehavior, options);
});