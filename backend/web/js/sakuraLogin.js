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
                    localStorage.setItem('profileMail', email);
                    localStorage.setItem('profileName', json.data.profileName);
                    localStorage.setItem('profileAvatar', json.data.profileAvatar);
                    $("#second-form div.field-loginform-password").removeClass("has-error");
                    $("#second-form div.field-loginform-password p").empty();
                    $("#first-form").hide();
                    $("#profile-name").text(json.data.profileName);
                    $("#email-display").text(email);
                    $("#profileAvatar").attr('src', json.data.profileAvatar);
                    $("#defaultAvatar").hide();
                    $("#profileAvatar").show();
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
    $("#defaultAvatar").show();
    $("#profileAvatar").hide();
    $("#second-form").hide();
    $("#back-arrow").hide();

    $("#first-form").fadeIn("slow", function () {
        $("#loginform-email").select();
    });
});

$(".site-login-lug li").on("click", function () {
    var language = $(this).text();
    window.waiting.show();
    setTimeout(function () {
        $.ajax({
            type: 'POST',
            url: languageUrl,
            async: false,
            dataType: 'json',
            data: {language: language},
            success: function (json) {
                if (json.status == 'ok') {
                    var href = window.location.href;
                    var oldLang = $.trim($("#language").text());
                    href = href.replace('admin/' + oldLang + '/', 'admin/' + language + '/')
                    window.location.href = href;
                } else {
                    alert(json.message);
                }
            },
            complete: function () {
                window.waiting.hide();
            }
        });
    }, 0);
});


(function () {

    var profileMail = localStorage.getItem('profileMail');
    if (profileMail != null) {
        var profileName = localStorage.getItem('profileName');
        var profileAvatar = localStorage.getItem('profileAvatar');
        if (firstFormDisplay == 'block') {
            $("#first-form").hide();
            $("#second-form").show();
        }
        $("#back-arrow").show();
        $("#defaultAvatar").hide();
        $("#profile-name").text(profileName);
        $("#email-display").text(profileMail);
        $("#loginform-email").val(profileMail);
        $("#profileAvatar").attr('src', profileAvatar);
        $("#profileAvatar").show();
    }
})();