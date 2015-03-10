$(document).ready(function() {
    $('.painel_cliente_menu a').click(function() {
        var link = $(this).attr('href');        
        
        $('.painel_cliente_tab').hide();
        
        $('#'+link).show();
        
        return false;
    })
    //Mostrar a primeira tab
    //$('#painel_cliente_tabs > div').hide();
    $('.painel_cliente_tabs div:first-child').show();
    //Oculta a listagem dos arquivos enviados para o cliente
    $('#arquivos_enviados_recebidos .recebidos').hide();
    //Filtra a listagem da tabela 
    $('#select_arquivos').change(function(element) {
        console.log(this.value);
        $('#arquivos_enviados_recebidos tbody tr').hide();
        $('#arquivos_enviados_recebidos tr.'+this.value).show();
    })
    
    /*
     * Quando o usuario clica em uma linha da tabela, ele vai buscar no servidor
     * os dados desse arquivo e monta o html no local especifico 
     */    
    $('#arquivos_enviados_recebidos tbody tr').click(function() {
       $.ajax({
          type: "POST",
          url: '/Arquivos/detalhe_arquivo',
          data: {id: this.id},
          success: function(data) {
              //console.log(data)
              $('#detalhe_arquivo').html(data.content);
          }, 
          error: function(response) {
              alert('error');
          }
      })
    });
    
    
    $('#excluir_arquivo').click(function () {
        
    });
    
});


function excluir_arquivo(e) {
    //this.preventDefault();
    event.preventDefault();
    var r = confirm("Tem certeza?");
    if (r == true) {
        //alert($(this.attr('href'));
        $.ajax({
          type: "POST",
          url: $(e).attr('href'),
          data: {id: this.id},
          success: function(data) {
              console.log(data);
              id = $(e).data('id');
              $('.file_upload_'+id).hide('slow', function() {
                  $(this).remove();
              });
              $('#detalhe_arquivo > div').fadeOut(400,function() {
                 $(this).remove(); 
              });
          }, 
          error: function(response) {
              alert('error');
          }
      });
    }
    return false;
}
