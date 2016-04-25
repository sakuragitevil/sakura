/**
 * Created by VuThuan on 4/17/2016.
 */
(function ($) {
    $.fn.yiiXhr2Upload = function (method) {

        var yiiXhr2UploadView = {
            id: '',
            url: '',
            dlg: 'dlgXhr2Upload',
            curPhoto: null,
            prePhoto: null,
            xhr2Ok:null,
            xhr2Cancel:null,
            init: function (options) {

                yiiXhr2UploadView.id = options.id;
                yiiXhr2UploadView.url = options.url;
                yiiXhr2UploadView.xhr2Ok = $("#xhr2Ok");
                yiiXhr2UploadView.xhr2Cancel = $("#xhr2Cancel");

                $('#' + yiiXhr2UploadView.id).on('click', function () {
                    yiiXhr2UploadView.show_dialog();
                });

                //init tabs events
                yiiXhr2UploadView.init_tab_events();

                //init_photos_events
                yiiXhr2UploadView.init_photos_events();

            },
            show_dialog: function () {
                $('#' + yiiXhr2UploadView.dlg).modal({keyboard: false});
                $('#' + yiiXhr2UploadView.dlg).modal('show');
            },
            init_tab_events: function () {
                $('#' + yiiXhr2UploadView.dlg + ' a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    $(e.target).parent('div').find('div.xhr2-a-li-w').removeClass("xhr2-a-li-w");
                    $(e.target).find("div.xhr2-a-li").addClass("xhr2-a-li-w");
                    $('#' + yiiXhr2UploadView.dlg + ' .xhr2-scroll').nanoScroller();
                    switch ($(e.target).attr("href")) {
                        case "#uploadTab":

                            break;
                        case "#photoTab":
                            if(yiiXhr2UploadView.curPhoto!=null){
                                yiiXhr2UploadView.xhr2Ok.removeClass("disabled");
                            }
                            break;
                    }
                });
            },
            init_photos_events: function () {
                $('#' + yiiXhr2UploadView.dlg + ' div[class="xhr2-hn-xs-oo-tm"]').on('click', function (e) {
                    yiiXhr2UploadView.curPhoto = $(this);
                    if (yiiXhr2UploadView.curPhoto.hasClass("xhr2-active")) {
                        yiiXhr2UploadView.curPhoto.removeClass("xhr2-active");
                        yiiXhr2UploadView.prePhoto = yiiXhr2UploadView.curPhoto = null;
                        yiiXhr2UploadView.xhr2Ok.addClass("disabled");
                    } else {
                        yiiXhr2UploadView.curPhoto.addClass("xhr2-active");
                        if (yiiXhr2UploadView.prePhoto != null) {
                            yiiXhr2UploadView.prePhoto.removeClass("xhr2-active");
                        }
                        yiiXhr2UploadView.prePhoto = yiiXhr2UploadView.curPhoto;
                        yiiXhr2UploadView.xhr2Ok.removeClass("disabled");
                    }
                });
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