

$(function()
{   

    $("#precio").on("input",function(){
        $("#slider_precio").val($("#precio").val());
    });

    $("#slider_precio").on("input", function () {
        $("#precio").val($("#slider_precio").val());
    });
});