/**
 * Created with JetBrains PhpStorm.
 * User: Cleriston Dantas
 * Date: 30/03/13
 * Time: 16:43
 * To change this template use File | Settings | File Templates.
 */

$(function() {
    $( "#tabs" ).tabs();

    $('.editCargo').editable('geral/atualizarCargo', {
        indicator : "<img src='views/geral/img/indicator.gif'>",
        tooltip   : 'Clique para editar...',
        submitdata : function() {
            document.location.reload();
        }
    });



    $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 200,
        width: 350,
        modal: true,
        buttons: {
            "Inserir": function() {
                var cargof = $( "#cargof").val();
                $.post('/projetoelida/geral/inserirCargo','cargo=' + cargof);
                document.location.reload();
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
        }
    });

    $( "#insert-cargo" )
        .button()
        .click(function() {
            $( "#dialog-form" ).dialog( "open" );
        });

});
// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
    function() {
        $( this ).addClass( "ui-state-hover" );
    },
    function() {
        $( this ).removeClass( "ui-state-hover" );
    }
);

function excluiCargo(url){
    $( "#dialog-confirm" ).dialog({
        resizable: false,
        height:140,
        modal: true,
        buttons: {
            "Ok, excluir": function() {
                $.post('/projetoelida/geral/excluiCargo','cargo=' + url);
                document.location.reload();
            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });
}

