$(function () {
    var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({
        autoProcessQueue: false,
        uploadMultiple: true,
        maxFilesize: 50, // MB
        timeout: 180000,
        url: '../../model/relacionamento/ResponderRelacionamento.php',
        addRemoveLinks: true,
        init: function () {
            dz = this;
            this.on('sending', function (file, xhr, formData) {
                var data = $('form').serializeArray();

                $.each(data, function (key, el) {
                    formData.append(el.name, el.value);
                });

                $('.modal-content textarea').attr('disabled', "disabled");
                $('.modal-content button').attr('disabled', 'disabled');
                $('.modal-content button.btn-success').html('<i class="fas fa-sync fa-spin"></i>');
            });
        },
        success: function (file, response) {
            swal({
                title: "Sucesso!",
                text: "Sua resposta foi enviada.",
                icon: "success",
                timer: 3000,
                button: false
            }).then(function () {
                location.reload();
            });
        },
        error: function (file, retorno) {
            $('.modal-content textarea').removeAttr('disabled');
            $('.modal-content button').removeAttr('disabled');
            $('.modal-content button.btn-success').html('Enviar');

            bugsnagClient.notify(new Error(retorno), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('form').serializeArray()
                    })
                }
            });

            swal({
                title: "Oopss!",
                text: "Não foi possível enviar a sua resposta:" + retorno,
                icon: "error",
                timer: 3000,
                button: false
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
});