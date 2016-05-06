<div id="dlgXhr2Upload" class="modal fade xhr2Upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     xmlns="http://www.w3.org/1999/html">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select Profile Photo</h4>
            </div>
            <div class="modal-body">
                <div class="xhr2-hn-Pn-eb">
                    <div class="xhr2-hn-Pn-hc xhr2-hn-On-Zb-Nd">
                        <div class="xhr2-hn-On-Zb-li-Yb-en">
                            <div class="xhr2-a-li-Yb" role="tablist" id="xhr2tab">
                                <a href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">
                                    <div class="xhr2-a-li xhr2-a-li-w">
                                        <div class="xhr2-hn-On-Zb-bp">Upload photos</div>
                                    </div>
                                </a>
                                <a href="#photoTab" aria-controls="photoTab" role="tab" data-toggle="tab">
                                    <div class="xhr2-a-li">
                                        <div class="xhr2-hn-On-Zb-bp">Your photos</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                    <div class="tab-content">
                        <div id="uploadTab" role="tabpanel" class="xhr2-hn-On-Zb-eb tab-pane fade in active">
                            <div id="dropTarget" class="xhr2-hn-Rn-Qn" style="display: block">
                                <div id="uploadError" class="xhr2-alert alert alert-danger" role="alert" style="display: none">
                                    <strong>There was an upload error.</strong><br>
                                    <span></span>
                                </div>
                                <div class="xhr2-hn-eb">
                                    <div class="xhr2-hn-Vt">
                                        <div class="xhr2-hn-Vt-nu">
                                            <div class="xhr2-hn-Eo-vq-wk-dm">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </div>
                                            <div class="xhr2-hn-Vt-tc">Drag a profile photo here</div>
                                            <div class="xhr2-hn-Vt-qu">
                                                <div class="xhr2-hn-Vt-ru">— or —</div>
                                            </div>
                                            <button id="browseButton" type="button" class="btn btn-default btn-sm">
                                                Select a photo from your computer
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="xhr2Progress" class="xhr2-hn-Rn-Pr" style="display: none">
                                <div class="xhr2-Pr">
                                    <div class="xhr2-Pr-Tu">Uploading...<span>0</span>%</div>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="xhr2Cropper" class="xhr2-crImg" style="display: none">
                                <div class="row-fluid">
                                    <div class="col-sm-1 col-md-1 col-xs-1" align="left">
                                        <div id="cropBack" class="xhr2-crBk">
                                            <i class="material-icons">arrow_back</i>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-md-8 col-xs-8" align="right">
                                        <div class="img-container">
                                            <img src="" alt="Picture">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-xs-3" align="left">
                                        <div id="cropRotateLeft" class="xhr2-iL">
                                            <div class="xhr2-iLi"><i class="material-icons">undo</i></div>
                                            <div class="xhr2-iLs">LEFT</div>
                                        </div>
                                        <div id="cropRotateRight" class="xhr2-iR">
                                            <div class="xhr2-iRi"><i class="material-icons">redo</i></div>
                                            <div class="xhr2-iRs">RIGHT</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearboth"></div>
                        <div id="photoTab" role="tabpanel" class="xhr2-hn-On-Zb-eb tab-pane fade">
                            <div class="xhr2-hn-Rn-Qn">
                                <div class="nano xhr2-scroll" id="authvv">
                                    <div class="nano-content">
                                        <div class="xhr2-hn-eb-up">
                                            <div class="xhr2-hn-xs-oo-en">
                                                <div class="xhr2-hn-xs-oo-tm">
                                                    <div class="xhr2-hn-xs-oo-yj">
                                                        <i class="material-icons md-26 md-light">brightness_1</i>
                                                        <i class="material-icons md-24 md_green">check_circle</i>
                                                    </div>
                                                    <img class="xhr2-hn-xs-oo-hm" src=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="xhr2Cancel" type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                <button id="xhr2Ok" type="button" class="btn btn-primary btn-sm disabled">Set as profile photo</button>
            </div>
        </div>
    </div>
</div>