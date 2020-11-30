$(function () {
    var dz = null;

    $(".modal-dialog").draggable();

    $("div.dropzone").dropzone({
        autoProcessQueue: false,
        maxFilesize: 50, // MB
        timeout: 180000,
        uploadMultiple: true,
        url: '../../model/recrutamento/AlterarCurriculo.php',
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
                text: "Seu curriculo foi alterado com sucesso.",
                icon: "success",
                timer: 3000,
                button: false
            }).then(function () {
                window.location.href = 'http://186.209.30.45:8086/view/recrutamento/CurriculoListar.php';
            });
        },
        error: function (file, retorno) {
            retorno = JSON.parse(retorno);
            $('input, select, textarea').removeAttr('disabled');
            $('button').removeAttr('disabled');
            $('button').html('Gravar');

            bugsnagClient.notify(new Error(retorno.message), {
                beforeSend: function (report) {
                    report.updateMetaData('Dados enviados', {
                        "DADOS": $('#formCurriculoAlterar').serializeArray()
                    })
                }
            });

            swal({
                title: "Oopss!",
                text: "Não foi possível alterar o seu curriculo: " + retorno.message,
                icon: "error"
            });

            $.each(dz.files, function (i, file) {
                file.status = Dropzone.QUEUED
            });

        }
    });

    $('#DATANASCIMENTO').mask('00/00/0000');

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

    $('input[name="CELULAR"]').mask(maskBehavior, options);
    $('input[name="TELEFONE"]').mask(maskBehavior, options);

    jQuery(function($) {
      $(document).on('keypress', 'input.only-number', function(e) {
        var $this = $(this);
        var key = (window.event)?event.keyCode:e.which;
        var dataAcceptDot = $this.data('accept-dot');
        var dataAcceptComma = $this.data('accept-comma');
        var acceptDot = (typeof dataAcceptDot !== 'undefined' && (dataAcceptDot == true || dataAcceptDot == 1)?true:false);
        var acceptComma = (typeof dataAcceptComma !== 'undefined' && (dataAcceptComma == true || dataAcceptComma == 1)?true:false);

            if((key > 47 && key < 58)
          || (key == 46 && acceptDot)
          || (key == 44 && acceptComma)) {
            return true;
        } else {
                return (key == 8 || key == 0)?true:false;
            }
      });
    });
});