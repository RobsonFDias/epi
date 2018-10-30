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

        var form = $(this);
        var formData = new FormData(form);
        var caminho = $("#area").val();

        $.ajax({
            beforeSend: function () {
                $('#divCarregando').fadeIn();
            },
            url: form.attr('action'),
            type: form.attr('method'),
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#divCarregando').fadeOut('slow');
                //alert(data);
                if (data != '0') {
                    window.location.href = "?pg=" + caminho;
                } else {

                }
            }, error: function (request, status, error) {
                alert(request.responseText);
                $('#divCarregando').fadeOut('slow');
                $('#msg-error').fadeIn('slow');
                $('#msg-error').fadeOut(2000, "linear");
            }
        });
        return false;
    });
});


