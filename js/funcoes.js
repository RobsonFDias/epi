$(document).ready(function ($) {
    $("#divCarregando").show();
    $(window).load(function () {
        $('#divCarregando').fadeOut('slow');
    });

    $("#novo-cad").click(function () {
        location.href = '?pg=' + $('#area').val();
    });

    $("#formulario").submit(function (event) {
        event.preventDefault();

        $("#divCarregando").show();
        var formData = new FormData($(this)[0]);
        var caminho = $("#area").val();

        $.ajax({
            url: 'view/' + caminho + '/salvar.php',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#divCarregando').fadeOut('slow');
                if (data != '0') {
                    window.location.href = "?pg=" + caminho;
                } else {

                }
            }
        });
    });

});


