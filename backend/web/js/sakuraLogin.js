/**
 * Created by Sarm_Brights on 3/31/2016.
 */

function validateEmail(email) {
    var _data = {
        'LoginForm[email]': email,
        'action': 'validateEmail'
    };
    window.waiting.show();
    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: validateEmailUrl,
            async: false,
            dataType: 'json',
            data: _data,
            success: function (json) {
                if (json.status == 'ok') {
                    $("#second-form div.field-loginform-password").removeClass("has-error");
                    $("#second-form div.field-loginform-password p").empty();
                    $("#first-form").hide();
                    $("#email-display").text(email);
                    $("#back-arrow").fadeIn("slow");
                    $("#second-form").fadeIn("slow", function () {
                        $("#back-arrow").fadeIn("slow");
                        $("#loginform-password").focus();
                    });
                } else {
                    $("#first-form div.field-loginform-email").addClass("has-error");
                    $("#first-form div.field-loginform-email p").text(json.message);
                }
            },
            complete: function () {
                window.waiting.hide();
            }
        });
    }, 0);
}
$("#next").on("click", function (event) {
    var email = $.trim($("#loginform-email").val());
    if (email != "") {
        event.preventDefault();
        validateEmail(email);
    }
});
$("#login-form").on("submit", function (event) {
    if (!yii.validation.isEmpty($.trim($("#loginform-password").val()))) {
        window.waiting.show();
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

