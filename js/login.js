$(document).ready(function() {
    var eT=0;
    $(".login_proiz ul li").each(function(index) {
        /*$(this).delay(eT).fadeIn('slow');
        
        eT += 3000;
        $(this).delay(eT-1000).fadeOut(700);
        */
    });
    InOut( $('.login_proiz ul li:first') );
});


function InOut( elem )
{
 elem.delay()
     .fadeIn('slow')
     .delay(4000)
     .fadeOut('slow', 
               function(){ 
                   if(elem.next().length > 0) {
                       InOut( elem.next() );
                   } else {
                       InOut( elem.siblings(':first'));
                   }     
                 }
             );
}