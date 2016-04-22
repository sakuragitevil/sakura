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

                //init tabs events
                $('#'+yiiXhr2UploadView.dlg + ' a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                    $(e.target).parent('div').find('div.xhr2-a-li-w').removeClass("xhr2-a-li-w");
                    $(e.target).find("div.xhr2-a-li").addClass("xhr2-a-li-w");

                    $('#' + yiiXhr2UploadView.dlg +' .xhr2-scroll').nanoScroller();
                });

                //init scroll
                //$('#' + yiiXhr2UploadView.dlg +' .xhr2-scroll').nanoScroller();

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