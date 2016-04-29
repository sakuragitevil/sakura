/**
 * @license MIT
 */
(function (window, document, undefined) {
    var waiting = {
        id: 'ajaxWaiting',
        init: function () {
            $("#" + waiting.id).on('click', function () {
                return false;
            });
        },
        show: function (mode) {
            $("#" + waiting.id).show();
        },
        hide: function () {
            $("#" + waiting.id).hide();
        }
    }
    window.waiting = waiting;
})(window, document)