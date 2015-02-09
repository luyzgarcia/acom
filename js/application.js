$(document).ready(function() {
    /************************************/
    /*Efeito clique botao superior direito painel*/
    /************************************/
    $('#menu_header').click(function(e) {
        $(this).children('div').toggle();
    });
    
    /*Para minimizar as janelas*/
   $('.janela .btn_minimizar').click(function(e) {
        //alert('hei');
        //$(this).closest('.janela').find('table').css('opacity','0');
        $(this).closest('.janela').find('.tabela').slideToggle(800);
        $(this).closest('.janela').find('.ocultar').slideToggle(800);
    });
   
   
   /**Efeito nas janelas, para qndo o usuario ativa uma janela */
    $('.janela').click(function() {
       $('.janela').removeClass('ativa');
       $(this).addClass('ativa');
    });
    
    
    /*Pra ocultar as mensagens de erro*/
   $('#bt_message_ok').click(function(e) {
       e.preventDefault();
       $(this).parent('div').fadeOut(500);
       $(this).prev();remove();
       return false;
   })
   $('#bt_erro_atualizar').click(function(e) {
       e.preventDefault();
       location.reload();
   })
   
});


$(document).ready(function() {
   $('.js-ajax').click(function() {
      
      link = $(this); 
      
      url = $(link).attr('href');
      console.log(url);
      
      $.ajax({
          type: "ajax",
          url: url,
          success: function(data) {
              console.log(data.content)
              $('#painel_conteudo').html(data.content);
              window.history.pushState({"pageTitle":''},"", url)
          }, 
          error: function(response) {
              alert('error');
          }
      })
      return false;
   });
   
});



