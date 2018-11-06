var caminho = "";

$(document).ready(function ($) {
    $("#divCarregando").show();
    $(window).load(function () {
        $('#divCarregando').fadeOut('slow');
    });

    //Chamar pagina novo cadastro
    $("#novo-cad").click(function () {
        location.href = '?pg=' + $('#area').val();
    });

    //Voltar da pagina de novo cadastro
    $("#voltar").click(function () {
        location.href = '?pg=' + $('#area').val();
    });

    //Enviar formulario para novo cadastro
    $("#formulario").submit(function (event) {
        event.preventDefault();

        var form = $(this);
        var formData = new FormData(form[0]);

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
                if (data !== 'erro') {
                    msgSucess();
                    window.location.href = "?pg=" + $("#area").val();
                } else {
                    msgError();
                }
            }, error: function (request, status, error) {
                var err = eval("(" + request.responseText + ")");
                $('#divCarregando').fadeOut('slow');
                msgError();
            }
        });
        return false;
    });

    //Clicar na linha tabela e chamar para alteração
    var timer = 0;
    var delay = 200;
    var prevent = false;

    $("table tbody tr")
            .on("click", function () {
                var tr = $(this);
                timer = setTimeout(function () {
                    if (!prevent) {
                        selecionar(tr.find("td:eq(0)").html(), tr);
                    }
                    prevent = false;
                }, delay);
            })
            .on("dblclick", function () {
                var tr = $(this);
                clearTimeout(timer);
                prevent = true;
                var id = tr.find("td:eq(0)").html();
                window.location.href = "?pg=" + $("#area").val() + '&id=' + id;
            });

    //Chamar Alterar dados
    $("#btn-alterar").click(function () {
        if (arrayId.length > 1) {
            $("#mi-modal-alterar").modal('show');
            return;
        } else {
            window.location.href = "?pg=" + $("#area").val() + '&id=' + arrayId[0];
        }
    });

    // Chamar confirm Excluir item 
    var modalConfirm = function (callback) {

        $("#btn-confirm").on("click", function () {
            $("#mi-modal").modal('show');
        });

        $("#modal-btn-si").on("click", function () {
            callback(true);
            $("#mi-modal").modal('hide');
        });

        $("#modal-btn-no").on("click", function () {
            callback(false);
            $("#mi-modal").modal('hide');
        });
    };

    // Result confirm Excluir item
    modalConfirm(function (confirm) {
        if (confirm) {
            //Acciones si el usuario confirma
            alert("CONFIRMADO");
        } else {
            //Acciones si el usuario no confirma
            alert("NO CONFIRMADO");
        }
    });

});

function msgSucess() {
    $('#msg-sucess').fadeIn('slow');
    $('#msg-sucess').fadeOut(2000, "linear");
}

function msgError() {
    $('#msg-error').fadeIn('slow');
    $('#msg-error').fadeOut(2000, "linear");
}

//selecionar e linhas para excluir e alterar
var arrayId = [];
function selecionar(id, tr) {
    if ($.inArray(id, arrayId) !== -1) {
        if (arrayId.indexOf(id) !== -1) {
            arrayId.splice(arrayId.indexOf(id), 1);
        }
        tr.css('background', "#fff");
    } else {
        arrayId.push(id);
        tr.css('background', "#000000");
    }

    if (arrayId.length === 0) {
        $('#btn-alterar').hide();
        $('#btn-confirm').hide();
    } else {
        $('#btn-alterar').show();
        $('#btn-confirm').show();
    }
}

