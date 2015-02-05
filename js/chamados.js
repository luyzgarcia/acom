$(document).ready(function() {
    $('.link_encerrar_chamado').click(function(e) {
        e.preventDefault();
        
        var elemento = $(this);
        
        $(this).css('opacity',0);
        $(this).parent().addClass('loading');
        
        var url = $(this).attr('href');
        $.ajax({
            type: 'POST',
            url:url,
            data: {id: this.id},
            success: function (res) {
               var obj = $.parseJSON(res);
               $($(elemento).parents('tr')).find('.status').html(obj['status']);
               $(elemento).parent().removeClass('loading');
               $(elemento).remove();
            },
            error: function( jqXHR, textStatus, errorThrown ) {
               alert("Houve algum erro, tente novamente por favor!");
               $(elemento).parent().removeClass('loading');
               $(elemento).css('opacity',1);
            }
        });
        
        return false;
    });
    
    $('#ChamadoNovoChamadoForm').submit(function(e) {
        e.preventDefault();
        var formulario = $(this);
        
        var url = formulario.attr('action');
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: 'POST',
            url:url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
               $('#ChamadoNovoChamadoForm .janela_enviando').hide();
               $('#ChamadoNovoChamadoForm input[type="hidden"]').val("");
               $('#ChamadoNovoChamadoForm').trigger("reset");
               
               $('#ChamadoNovoChamadoForm .enviado_sucesso').show();
               $('#ChamadoNovoChamadoForm .enviado_sucesso a').click( function(e) {
                       e.preventDefault();
                       $(this).parent().hide();
                       return false;
               });
               
               var obj = $.parseJSON(res);
               $('#tabela_registros_chamados > tbody > tr:first').before(
                    "<tr id='chamado_"+obj['id']+"' class='item' style='opacity:0'>\
                        <td><a href='/Chamados/visualizar/'"+obj['id']+" class='texto_azul link_detalhe_chamado'>"+obj['id']+"</a></td>\
                        <td class='status'>"+obj['status']+"</td>\
                        <td>"+obj['departamento_destino']+"</td>\
                        <td>"+obj['modified']+"</td>\
                        <td>\
                            <a href='/Chamados/encerrar_chamado' id='"+obj['id']+"' class='btn_vermelho link_encerrar_chamado'>Encerrar</a>\
                        </td>\
                    </tr>");
                
                $('#chamado_'+obj['id']).animate({
                    opacity: 1
                  }, 800);
            },
            error: function( e, textStatus, errorThrown ) {
                $('#ChamadoNovoChamadoForm .janela_enviando').hide();
                var obj = $.parseJSON(e.responseText);
                alert(obj['message']);
            }
        });
       
        return false;
    });
});
