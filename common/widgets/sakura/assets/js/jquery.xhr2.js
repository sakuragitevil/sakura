/**
 * Created by VuThuan on 4/17/2016.
 */
(function ($) {
    $.fn.yiiXhr2Upload = function (method) {

        var yiiXhr2UploadView = {
            id: '',
            url: '',
            dlg: 'dlgXhr2Upload',
            init: function (options) {

                yiiXhr2UploadView.id = options.id;
                yiiXhr2UploadView.url = options.url;

                $('#' + yiiXhr2UploadView.id).on('click', function () {
                    yiiXhr2UploadView.show_dialog();
                });

            },
            show_dialog: function () {
                $('#' + yiiXhr2UploadView.dlg).modal({keyboard: false});
                $('#' + yiiXhr2UploadView.dlg).modal('show');
            },

        };

        //Call functions
        if (yiiXhr2UploadView[method]) {
            return yiiXhr2UploadView[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return yiiXhr2UploadView.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.yiiXhr2UploadView');
            return false;
        }
    };
})(jQuery);