/**
 * Created by VuThuan on 4/17/2016.
 */
(function ($) {
    $.fn.yiiXhr2Upload = function (method) {

        var yiiXhr2UploadView = {
            id: '',
            uploadUrl: '',
            avatarUrl: '',
            yourPhotoUrl: '',
            uploadMode: '',
            csrfToken: '',
            fileName: '',
            dlg: 'dlgXhr2Upload',
            currentPhoto: null,
            relatedPhoto: null,
            xhr2Message: '',
            xhr2Ok: null,
            cropper: null,
            xhr2Cancel: null,
            isUploadTab: false,
            isYourPhotoTab: false,
            isYourPhotoQuery: false,
            init: function (options) {

                yiiXhr2UploadView.id = options.id;
                yiiXhr2UploadView.avatarUrl = options.avatarUrl;
                yiiXhr2UploadView.uploadUrl = options.uploadUrl;
                yiiXhr2UploadView.uploadMode = options.uploadMode;
                yiiXhr2UploadView.csrfToken = yii.getCsrfToken();
                yiiXhr2UploadView.yourPhotoUrl = options.yourPhotoUrl;

                yiiXhr2UploadView.xhr2Ok = $("#xhr2Ok");
                yiiXhr2UploadView.xhr2Cancel = $("#xhr2Cancel");

                $('#' + yiiXhr2UploadView.id).on('click', function () {
                    yiiXhr2UploadView.show_dialog();
                });

                yiiXhr2UploadView.xhr2Ok.on('click', function () {
                    if (yiiXhr2UploadView.xhr2Ok.hasClass('disabled')) {
                        return false;
                    }

                    if (yiiXhr2UploadView.isUploadTab && yiiXhr2UploadView.cropper != null) {
                        yiiXhr2UploadView.set_profile_photo();
                    } else if (yiiXhr2UploadView.isYourPhotoTab) {
                        yiiXhr2UploadView.query_your_photo();
                    }

                });

                //init tabs events
                yiiXhr2UploadView.init_tab_events();

                //init_upload_events
                yiiXhr2UploadView.init_upload_events();

                //init_crop_form_events
                yiiXhr2UploadView.init_crop_form_events();

            },
            show_dialog: function () {
                yiiXhr2UploadView.reset_form();
                $('#' + yiiXhr2UploadView.dlg).modal({keyboard: false});
                $('#' + yiiXhr2UploadView.dlg).modal('show');
            },
            close_dialog: function () {
                $('#' + yiiXhr2UploadView.dlg).modal('hide');
            },
            reset_form: function () {

                $('#' + yiiXhr2UploadView.dlg + ' div[id="dropTarget"]').show();
                $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadError"]').hide();
                $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]').hide();
                $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Cropper"]').hide();
                yiiXhr2UploadView.xhr2Ok.addClass("disabled");

                $('#' + yiiXhr2UploadView.dlg + ' div[id="photoTab"]').removeClass('active');
                $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadTab"]').addClass('active');

                yiiXhr2UploadView.isUploadTab = true;
                yiiXhr2UploadView.isYourPhotoTab = false;

            },
            init_tab_events: function () {
                $('#' + yiiXhr2UploadView.dlg + ' a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

                    $(e.target).parent('div').find('div.xhr2-a-li-w').removeClass("xhr2-a-li-w");
                    $(e.target).find("div.xhr2-a-li").addClass("xhr2-a-li-w");

                    switch ($(e.target).attr("href")) {
                        case "#uploadTab":
                            yiiXhr2UploadView.isUploadTab = true;
                            yiiXhr2UploadView.isYourPhotoTab = false;
                            break;
                        case "#photoTab":
                            yiiXhr2UploadView.isUploadTab = false;
                            yiiXhr2UploadView.isYourPhotoTab = true;
                            if (yiiXhr2UploadView.currentPhoto != null) {
                                yiiXhr2UploadView.xhr2Ok.removeClass("disabled");
                            }
                            if (!yiiXhr2UploadView.isYourPhotoQuery) {
                                yiiXhr2UploadView.query_your_photo();
                            }
                            break;
                    }
                });
            },
            init_photos_events: function () {
                $('#' + yiiXhr2UploadView.dlg + ' div[class="xhr2-hn-xs-oo-tm"]').on('click', function (e) {
                    yiiXhr2UploadView.currentPhoto = $(this);
                    if (yiiXhr2UploadView.currentPhoto.hasClass("xhr2-active")) {
                        yiiXhr2UploadView.currentPhoto.removeClass("xhr2-active");
                        yiiXhr2UploadView.relatedPhoto = yiiXhr2UploadView.currentPhoto = null;
                        yiiXhr2UploadView.xhr2Ok.addClass("disabled");
                    } else {
                        yiiXhr2UploadView.currentPhoto.addClass("xhr2-active");
                        if (yiiXhr2UploadView.relatedPhoto != null) {
                            yiiXhr2UploadView.relatedPhoto.removeClass("xhr2-active");
                        }
                        yiiXhr2UploadView.relatedPhoto = yiiXhr2UploadView.currentPhoto;
                        yiiXhr2UploadView.xhr2Ok.removeClass("disabled");
                    }
                });
            },
            init_upload_events: function () {

                var xhr2Flow = new Flow({
                    target: yiiXhr2UploadView.uploadUrl,
                    query: {_csrf: yiiXhr2UploadView.csrfToken, uploadMode: yiiXhr2UploadView.uploadMode},
                    singleFile: true,
                    accept: 'image/*',
                    allowDuplicateUploads: true,
                    prioritizeFirstAndLastChunk: true,
                    simultaneousUploads: 1,
                });

                xhr2Flow.assignBrowse(document.getElementById('browseButton'));
                xhr2Flow.assignDrop(document.getElementById('dropTarget'));
                xhr2Flow.on('filesSubmitted', function (file) {
                    xhr2Flow.upload();
                });
                xhr2Flow.on('uploadStart', function () {
                    window.waiting.show();
                    var xhr2Progress = $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]');
                    xhr2Progress.find('div[role="progressbar"]').css({width: '0%'});
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="dropTarget"]').hide();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]').show();
                });
                xhr2Flow.on('fileProgress', function (file) {
                    // Handle progress for both the file and the overall upload
                    var xhr2Progress = $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]');
                    xhr2Progress.find('div[class="xhr2-Pr-Tu"] span').text(Math.floor(file.progress() * 100));
                    xhr2Progress.find('div[role="progressbar"]').css({width: Math.floor(xhr2Flow.progress() * 100) + '%'});
                });
                xhr2Flow.on('fileSuccess', function (file, message) {

                    $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadError"]').hide();
                    yiiXhr2UploadView.xhr2Message = message;

                });
                xhr2Flow.on('complete', function () {

                    setTimeout(function () {

                        $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]').hide();

                        if (yiiXhr2UploadView.xhr2Message != "" && yiiXhr2UploadView.uploadMode == "avatar") {

                            var xhr2MessageObj = JSON.parse(yiiXhr2UploadView.xhr2Message);
                            yiiXhr2UploadView.fileName = xhr2MessageObj.fileName;
                            var cropContainer = yiiXhr2UploadView.cal_crop_container(xhr2MessageObj.width, xhr2MessageObj.height);

                            //init_crop_events
                            yiiXhr2UploadView.init_crop_events(cropContainer, xhr2MessageObj.srcPath);

                            $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Cropper"]').show();
                        } else {
                            $('#' + yiiXhr2UploadView.dlg + ' div[id="dropTarget"]').show();
                        }
                        yiiXhr2UploadView.xhr2Ok.removeClass('disabled');

                        window.waiting.hide();
                    }, 1000);

                });
                xhr2Flow.on('fileError', function (file, message) {

                    $('#' + yiiXhr2UploadView.dlg + ' div[id="dropTarget"]').show();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]').hide();

                    $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadError"]').show();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadError"] span').text(message);
                });
                xhr2Flow.on('catchAll', function () {
                    console.log.apply(console, arguments);
                });

            },
            init_crop_form_events: function () {
                //init cropper back button
                $('#' + yiiXhr2UploadView.dlg + ' div[id="cropBack"]').on('click', function () {
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="dropTarget"]').show();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="uploadError"]').hide();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Progress"]').hide();
                    $('#' + yiiXhr2UploadView.dlg + ' div[id="xhr2Cropper"]').hide();
                    yiiXhr2UploadView.xhr2Ok.addClass("disabled");
                });

                $('#' + yiiXhr2UploadView.dlg + ' div[id="cropRotateLeft"]').on('click', function () {
                    if (yiiXhr2UploadView.cropper != null) {
                        yiiXhr2UploadView.cropper.rotate(-90);
                    }
                });

                $('#' + yiiXhr2UploadView.dlg + ' div[id="cropRotateRight"]').on('click', function () {
                    if (yiiXhr2UploadView.cropper != null) {
                        yiiXhr2UploadView.cropper.rotate(90);
                    }
                });
            },
            init_crop_events: function (cropContainer, srcPath) {
                var Cropper = window.Cropper;
                var container = document.querySelector('.img-container');
                $(container).css({width: cropContainer.width, height: cropContainer.height});
                var image = container.getElementsByTagName('img').item(0);
                $(image).css({width: cropContainer.width, height: cropContainer.height});
                $(image).attr("src", srcPath);
                var options = {
                    aspectRatio: 1 / 1,
                    viewMode: 3,
                    zoomable: false
                };
                if (yiiXhr2UploadView.cropper != null) {
                    yiiXhr2UploadView.cropper.destroy();
                }
                yiiXhr2UploadView.cropper = new Cropper(image, options);
            },
            cal_crop_container: function (imgWidth, imgHeight) {
                var maxImgSize = 300;
                var newImgSize = {width: 0, height: 0};

                if (imgWidth <= maxImgSize && imgHeight <= maxImgSize) {
                    newImgSize.width = imgWidth;
                    newImgSize.height = imgHeight;
                    return newImgSize;
                }

                if (imgWidth >= imgHeight) {
                    newImgSize.width = maxImgSize;
                    newImgSize.height = Math.ceil(maxImgSize * (imgHeight / imgWidth));
                } else {
                    newImgSize.height = maxImgSize;
                    newImgSize.width = Math.ceil(maxImgSize * (imgWidth / imgHeight));
                }

                //optimize img size
                if (newImgSize.height < maxImgSize) {
                    newImgSize.height = maxImgSize;
                    newImgSize.width = Math.ceil(maxImgSize * (imgWidth / imgHeight));
                }

                return newImgSize;
            },
            set_profile_photo: function (avatarMode) {
                window.waiting.show();

                var url = "";
                var data = {};
                if (avatarMode == 1) {//set your avatar with image which you crop from image are uploaded

                    var cropData = yiiXhr2UploadView.cropper.getData();
                    var cropBoxData = yiiXhr2UploadView.cropper.getCropBoxData();

                    var imgData = yiiXhr2UploadView.cropper.getImageData();
                    imgData.fileName = yiiXhr2UploadView.fileName;
                    imgData.oldFileName = $(".cmhd-ac-mk img").attr('src').replace(/\\/g, '/').replace(/.*\//, '');
                    data = {avatarMode: avatarMode, cropData: cropData, cropBoxData: cropBoxData, imgData: imgData}

                } else if (avatarMode == 2) {//set your avatar with image which you choose from your image

                    var fileName = yiiXhr2UploadView.currentPhoto.find('img').attr('src').replace(/\\/g, '/').replace(/.*\//, '');
                    var oldFileName = $(".cmhd-ac-mk img").attr('src').replace(/\\/g, '/').replace(/.*\//, '');
                    data = {avatarMode: avatarMode, fileName: filename, oldFileName: oldFileName};
                }

                setTimeout(function () {
                    $.ajax({
                        type: 'POST',
                        url: yiiXhr2UploadView.avatarUrl,
                        async: false,
                        dataType: 'json',
                        data: data,
                        success: function (json) {
                            if (json.status == 'ok') {
                                $(".cmhd-ac-mk img").attr('src', json.data.avatarUrl);
                                $(".cmhd-gb_lb img").attr('src', json.data.avatarUrl);
                                yiiXhr2UploadView.close_dialog();
                                yiiXhr2UploadView.isYourPhotoQuery = false;
                            } else {

                            }
                        },
                        complete: function () {
                            window.waiting.hide();
                        }
                    });
                }, 0);
            },
            query_your_photo: function () {

                window.waiting.show();
                setTimeout(function () {
                    $.ajax({
                        type: 'POST',
                        url: yiiXhr2UploadView.yourPhotoUrl,
                        async: false,
                        dataType: 'json',
                        success: function (json) {
                            if (json.status == 'ok') {
                                if (json.data.length > 0) {
                                    yiiXhr2UploadView.show_your_photo(json.data);
                                    yiiXhr2UploadView.init_photos_events();
                                    $('#' + yiiXhr2UploadView.dlg + ' .xhr2-scroll').nanoScroller();
                                }
                                yiiXhr2UploadView.isYourPhotoQuery = true;
                            } else {

                            }
                        },
                        complete: function () {
                            window.waiting.hide();
                        }
                    });
                }, 0);
            },
            show_your_photo: function (yourPhoto) {
                var yourPhotoContent = $('#' + yiiXhr2UploadView.dlg + ' div[id="yourPhotoContent"]');
                yourPhotoContent.empty();

                $.each(yourPhoto, function (index, value) {
                    var div = $(document.createElement('div'));
                    div.addClass('xhr2-hn-xs-oo-en').html('<div class="xhr2-hn-xs-oo-tm"><div class="xhr2-hn-xs-oo-yj"> <i class="material-icons md-26 md-light">brightness_1</i> <i class="material-icons md-24 md_green">check_circle</i> </div> <img class="xhr2-hn-xs-oo-hm" src="' + value + '"/> </div>');
                    yourPhotoContent.append(div);
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