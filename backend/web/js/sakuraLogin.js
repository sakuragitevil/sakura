/**
 * Created by Sarm_Brights on 3/31/2016.
 */
function validateEmail(email) {
    var _csrf = $("input[name=_csrf]").val();
    var _data = {'_csrf': _csrf, 'email': email};
    $.ajax({
        type: 'POST',
        url: validateEmailUrl,
        async: false,
        dataType: 'json',
        data: _data,
        beforeSend: function () {

        },
        success: function (json) {
            if(json.status == 'ok')
            {
                event.preventDefault();
                $("#second-form div.field-loginform-password").removeClass("has-error");
                $("#second-form div.field-loginform-password p").empty();
                $("#first-form").hide();
                $("#back-arrow").fadeIn("slow");
                $("#second-form").fadeIn("slow", function () {
                    $("#back-arrow").fadeIn("slow");
                    $("#loginform-password").focus();
                });
            }
        },
        complete: function () {

        }
    });
}
$("#next").on("click", function (event) {
    var email = $.trim($("#loginform-email").val());
    if (email != "") {
        validateEmail(email);
    }
});

$("#back-arrow").on("click", function () {
    event.preventDefault();
    $("#first-form div.field-loginform-email").removeClass("has-error");
    $("#first-form div.field-loginform-email p").empty();
    $("#second-form").hide();
    $("#back-arrow").hide();
    $("#first-form").fadeIn("slow", function () {
        $("#loginform-email").select();
    });
});

