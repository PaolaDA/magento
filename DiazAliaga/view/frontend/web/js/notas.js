define(['jquery'], function($) {
    return function(config, element) {

        $(element).on('click','#boton_notas',function (){
            if( $(".notas").is(":visible")){
                $(element).find(".notas").hide();
            }else{
                $(element).find(".notas").show();
            }

        });

        $(element).on('click','#boton_alta',function (){
            alert("La nota mas alta es: "+config.notaAlta);
        });
    }
});
