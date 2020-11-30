$(document).ready(function () {
    $('#reqtablenew td').dblclick(function () {

        $('#reqtablenew td').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);

        $('input:radio').each(function () {
            if ($(this).is(':checked')) {
                window.location.href = '../../view/rastreamento/VisualizarRastreioPedido.php?pedido=' + parseInt($(this).val());
            }
        });
    });
    
    $.getJSON('../../controller/administracao/retornaFilialFiltro.php', function (return_data) {
        
        var arrayValue = [];

        $('#filial > option:selected').each(function () {
            arrayValue.push($(this).val());
        });

        $('#filial').empty();
        
        $.each(return_data.data, function (key, value) {
            $("#filial").append("<option value='" + value.HANDLE + ";" + value.NOME + "'>" + value.NOME + "</option>");
        });

        arrayValue.forEach(function (value) {
            $('#filial option[value="' + value + '"]').attr('selected','selected');
        });
    });
    
    $.getJSON('../../controller/rastreamento/retornaTipoPedidoFiltro.php', function (data) {
        
        var arrayValue = [];

        $('#tipo > option:selected').each(function () {
            arrayValue.push($(this).val());
        });

        $('#tipo').empty();
        
        $.each(data, function (key, value) {
            $("#tipo").append("<option value='" + value.HANDLE + ";" + value.NOME + "'>" + value.NOME + "</option>");
        });

        arrayValue.forEach(function (value) {
            $('#tipo option[value="' + value + '"]').attr('selected','selected');
        });
    });

    $.getJSON('../../controller/rastreamento/retornaEtapaPedidoFiltro.php', function (data) {
        
        var arrayValue = [];

        $('#situacao > option:selected').each(function () {
            arrayValue.push($(this).val());
        });

        $('#situacao').empty();
        
        $.each(data, function (key, value) {
            $("#situacao").append("<option value='" + value.HANDLE + ";" + value.NOME + "'>" + value.NOME + "</option>");
        });

        arrayValue.forEach(function (value) {
            $('#situacao option[value="' + value + '"]').attr('selected','selected');
        });
    });

    $.getJSON('../../controller/rastreamento/retornaPessoaPedidoFiltro.php', function (data) {
        
        var arrayValue = [];

        $('#cliente > option:selected').each(function () {
            arrayValue.push($(this).val());
        });

        $('#cliente').empty();
        
        $.each(data, function (key, value) {
            $("#cliente").append("<option value='" + value.HANDLE + ";" + value.NOME + "'>" + value.NOME + "</option>");
        });

        arrayValue.forEach(function (value) {
            $('#cliente option[value="' + value + '"]').attr('selected','selected');
        });
    });    
});

function limpaform() {
    $('input').val('');

    $('option').removeAttr('selected');
    $('button#btnMultiselect').text("   ").attr({title: "Limpou"});
}

function multiselection() {
    $('#filial').multiselect({
        columns: 1,
        search: true
    });

    $('#tipo').multiselect({
        columns: 1,
        search: true
    });

    $('#situacao').multiselect({
        columns: 1,
        search: true
    });

    $('#cliente').multiselect({
        columns: 1,
        search: true
    });

    $('#unidadenegocio').multiselect({
        columns: 1,
        search: true
    });    
}

function exportarOnHandler() {
    downloadCSV({ filename: "Rastreio de pedido.csv", stockData: retornoJson });
}

function getUnidadeNegocio(sel)
{
    $.ajax({
        method: "post",
        url: "../../controller/rastreamento/retornaUnidadeNegocioPedidoFiltro.php",
        data: {cliente: sel.value},
        success:function(data) {
            data = $.parseJSON(data);

            var arrayValue = [];

            $('#unidadenegocio > option:selected').each(function () {
                arrayValue.push($(this).val());
            });
    
            $('#unidadenegocio').empty();
            
            $.each(data, function (key, value) {
                $("#unidadenegocio").append("<option value='" + value.HANDLE + ";" + value.NOME + "'>" + value.NOME + "</option>");
            });
    
            arrayValue.forEach(function (value) {
                $('#unidadenegocio option[value="' + value + '"]').attr('selected','selected');
            });

            $('#unidadenegocio').multiselect('reload');
          }
    });   
}