/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(inicializar);
function inicializar() {
    $("#dialogo").dialog();
    $("#listaTemas").selectmenu();
    $("#miPerfil").button();
    $("#cerrarSesion").button();
    $(".boton").button();
    $(".cambiarNombre").hide();
    $("#subida").hide();
    $("#subir").click(function(){
        $("#subida").show();
    });
    $(".idNombre").click(function(){
        $(".cambiarNombre").show();
    });

}

