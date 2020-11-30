new WOW().init();

var columnsToHide = [];

$(function () {
    adicionarOnClickConsulta();

    $('.table').tablesorter({
        widgets: ['zebra', 'columns'],
        usNumberFormat: false,
        dateFormat: 'pt'
    });

    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
    };
    
    $('.modal').on('show.bs.modal', reposition);
    
    $(window).on('resize', function () {
        $('.modal:visible').each(reposition);
    });

    $('.list-group.checked-list-box .list-group-item').each(function () {
        var $widget = $(this),
        $checkbox = $('<input type="checkbox" class="hidden" />'),
        color = ($widget.data('color') ? $widget.data('color') : "primary"),
        style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
        settings = {
            on: {
                icon: 'glyphicon glyphicon-check'
            },
            off: {
                icon: 'glyphicon glyphicon-unchecked'
            }
        };

        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });

        $checkbox.on('change', function () {
            updateDisplay();
        });

        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');
            
            $widget.data('state', (isChecked) ? "on" : "off");
            $widget.find('.state-icon').removeClass().addClass('state-icon ' + settings[$widget.data('state')].icon);

            if(isChecked) {
                $widget.addClass(style + color + ' active');
            } 
            else {
                $widget.removeClass(style + color + ' active');
            }
        };

        function init() {
            if($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();
            
            if($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        };
        init();
    });

    $('#get-checked-data').on('click', function (event) {
        event.preventDefault();
        var checkedItems = {}, counter = 0;
        $("#check-list-box li.active").each(function (idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
        });
        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });

    $('.keep-open li.list-group-item').on({
        "click": function() {
            return false;
        }
    });

    $('li.list-group-item').click(function () {
        var ind = $(this).attr('ind-column');
        
        if(!$(this).hasClass('active')) {
            columnsToHide.push(ind);
            $('.table td:nth-child(' + ind + '),.table th:nth-child(' + ind + ')').hide();            
        } 
        else {
            for(var i in columnsToHide) {
                if(columnsToHide[i] == ind) {
                   columnsToHide.splice(i, 1); 
                }
            };
            $('.table td:nth-child(' + ind + '),.table th:nth-child(' + ind + ')').show();
        }        
    });    
    
    limparColunasExibir();
    
});

function multiselection() {
    $('#produto,#cliente,#naturezamercadoria').multiselect({
        columns: 1,
        search: true
    });
};

function adicionarOnClickConsulta(){
    $('#tableEstoqueArmazem td').dblclick(function () {
        $('#tableEstoqueArmazem td').removeClass("activetr");
        $(this).addClass("activetr");
        $(this).parent('tr').find('[name="check[]"]').prop('checked', true);
    
        $('input:radio').each(function () {
            if ($(this).is(':checked')) {
                window.location.href = '../../view/armazenagem/EstoqueDetalheView.php?saldoEstoque=' + parseInt($(this).val());
            }
        });   
        
    });   
};

function ocultaColunas() {
    for(var i in columnsToHide) {    
        $('.table td:nth-child(' + columnsToHide[i] + '),.table th:nth-child(' + columnsToHide[i] + ')').hide();
    } 
};

function limparColunasExibir(e) {
    if(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    ocultaColunas();

    $('li.list-group-item').each(function () {
        if($(this).hasClass('active')) {
            $(this).click();
        }
    });
};

function limparFiltro() {
    $('.btn-multiselect').text('');
    $('.ms-options li.selected label').click();
    $('.ms-options li.selected').removeClass('selected');
    $('#produto,#cliente,#naturezamercadoria').val('');
    $('#nrpedido,#lote,#validade').val('');
    $('#notafiscal,#emissao').val('');
}

function aplicarFiltro() {  
    $('#FiltroModal').modal('hide');
    $('#loader').show();
    $('#tableEstoqueArmazem tbody').empty();
    $('#registroNaoEncontrato').hide();
    
    $.post('/controller/armazenagem/EstoqueArmazemRequest.php', { 
        'REQUEST' : 'getRegistro', 
        'FILTRO' : { 
            'PRODUTO' : $('#produto').val(),
            'NATUREZAMERCADORIA' : $('#naturezamercadoria').val(),
            'CLIENTE' : $('#cliente').val(),
            'NRPEDIDO' : $('#nrpedido').val(),
            'LOTE' : $('#lote').val(),
            'VALIDADE' : $('#validade').val(),
            'NOTAFISCAL' : $('#notafiscal').val(),
            'EMISSAO' : $('#emissao').val()                
        } 
    }, function(res) {
        if(res) {                
            if(res.DADOS.length > 0) {                
                $('#tableEstoqueArmazem tbody').html(res.DADOS.join(''));           
            }
            else {
                $('#registroNaoEncontrato').show();
            }
        }      
        else {
            $('#registroNaoEncontrato').show();
        }        
        $('#loader').hide();    
        
        $('.table').trigger("update");    
        
        adicionarOnClickConsulta();    
        
        setTimeout(function() {      
            ocultaColunas();        
        }, 100);
    }, 'json');       
};

