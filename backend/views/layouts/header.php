<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 4/4/2016
 * Time: 10:57 AM
 */
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/header.css');
?>

<div class="row-fluid cmhd">
    <div class="col-sm-12 col-md-12 col-lg-12 noLRpadding">
        <div class="row-fluid">
            <div class="col-sm-5 col-md-5 col-lg-5 noLRpadding">
                <div class="div-inline-left" style="min-width: 24px">
                    <content class="xjKiLb">
                    <span class="white" style="top: 16px">
                        <?= file_get_contents("../web/icons/navigation/svg/production/ic_menu_24px.svg") ?>
                    </span>
                    </content>
                </div>
                <div class="div-inline-left pl30" style="min-width: 120px">
                    <content class="xjKiLb">
                    <span style="top: 11px">
                        <span class="cmhd-ft">Sakura Inc.</span>
                    </span>
                    </content>
                </div>
                <div class="clearboth"></div>
            </div>
            <div class="col-sm-7 col-md-7 col-lg-7 noLRpadding">
                <div class="div-inline-right pl20">
                    <content class="xjKiLb">
                        <span style="top: 11px">
                            <div class="cmhd-ac-mk">
                                <canvas class="circle" width="32" height="32"></canvas>
                            </div>
                        </span>

                        <div class="cmhd-gb_db" style="display: none"></div>
                        <div class="cmhd-gb_cb" style="display: none"></div>
                    </content>
                    <div class="cmhd-gb_eb cmhd-gb_ga cmhd-gb_g" style="display: none">
                        <div class="cmhd-gb_tb">
                            <div id="gbpbt">This account is managed by <b>sakura.inc</b>.</div>
                            <a class="cmhd-gb_fb" href="#" target="_blank">Learn more.</a>
                        </div>
                        <div class="cmhd-gb_hb">
                            <a class="cmhd-gb_ib cmhd-gb_kb" href="#">
                                <div class="cmhd-gb_lb cmhd-gbip"></div>
                                <span class="cmhd-gb_mb">Change</span>
                            </a>

                            <div class="cmhd-gb_jb">
                                <div class="cmhd-gb_nb">Vu Van Thuan</div>
                                <div class="cmhd-gb_ob">sakura@gmail.com</div>
                                <div class="cmhd-gb_gb">
                                    <a href="#">Privacy</a>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm">My Account</button>
                            </div>
                        </div>
                        <div class="cmhd-gb_qb" align="right">
                            <button type="button" class="btn btn-default btn-sm">Sign out</button>
                        </div>
                    </div>
                </div>

                <div class="div-inline-right pl20">
                    <content class="xjKiLb">
                        <span style="top: 15px">
                            <div class="cmhd-cr"">
                            <?php echo file_get_contents("../web/icons/social/svg/production/ic_notifications_black_18px.svg") ?>
                </div>
                </span>
                <div class="cmhd-gb_nf" style="display: none"></div>
                <div class="cmhd-gb_nt" style="display: none"></div>
                </content>
                <div class="cmhd-gb_ga cmhd-gb_g cmhd-gb_rc" style="display: none">
                    <div class="cmhd-xQb">Sakura notifications</div>
                    <div class="cmhd-xwb cmhd-kPa">
                        <div class="cmhd-HEAp2c">
                            <div class="cmhd-HZhOCd" style="display: none;"></div>
                            <div class="cmhd-X6Wtlf">
                                <div class="cmhd-CQb">
                                    <div class="cmhd-Kza">All caught up!</div>
                                    <img class="cmhd-m4a" src="../web/icons/notifications_1x.png"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="div-inline-right">
                <content class="xjKiLb">
                        <span class="white" style="top: 15px">
                            <?php echo file_get_contents("../web/icons/navigation/svg/production/ic_apps_24px.svg") ?>
                        </span>

                    <div class="cmhd-gb_vd" style="display: block"></div>
                    <div class="cmhd-gb_vr" style="display: block"></div>
                </content>
                <div class="cmhd-gb_ha cmhd-gb_ga cmhd-gb_g cmhd-gb_ia">
                    <ul class="cmhd-gb_ja">
                        <li class="cmhd-gb_Z">
                            <a class="cmhd-gb_O" href="#">
                                <div class="cmhd-gb_8"></div>
                                <div class="cmhd-gb_9"></div>
                                <div class="cmhd-gb_aa"></div>
                                <div class="cmhd-gb_ba"></div>
                                    <span class="cmhd-gb_3">
                                        <div class="cmhd-ac-mk-48">
                                            <canvas class="circle" width="48" height="48"></canvas>
                                        </div>
                                    </span>
                                <span class="cmhd-gb_4">My Account</span>
                            </a>
                        </li>
                        <li class="cmhd-gb_Z">
                            <a class="cmhd-gb_O" href="#">
                                <div class="cmhd-gb_8"></div>
                                <div class="cmhd-gb_9"></div>
                                <div class="cmhd-gb_aa"></div>
                                <div class="cmhd-gb_ba"></div>
                                    <span class="cmhd-gb_3 blue">
                                        <?= file_get_contents("../web/icons/action/svg/production/ic_settings_48px.svg") ?>
                                    </span>
                                <span class="cmhd-gb_4">Setting</span>
                            </a>
                        </li>
                        <li class="cmhd-gb_Z">
                            <a class="cmhd-gb_O" href="#">
                                <div class="cmhd-gb_8"></div>
                                <div class="cmhd-gb_9"></div>
                                <div class="cmhd-gb_aa"></div>
                                <div class="cmhd-gb_ba"></div>
                                    <span class="cmhd-gb_3 blue">
                                        <?= file_get_contents("../web/icons/action/svg/production/ic_alarm_48px.svg") ?>
                                    </span>
                                <span class="cmhd-gb_4">Time Card</span>
                            </a>
                        </li>
                        <li class="cmhd-gb_Z">
                            <a class="cmhd-gb_O" href="#">
                                <div class="cmhd-gb_8"></div>
                                <div class="cmhd-gb_9"></div>
                                <div class="cmhd-gb_aa"></div>
                                <div class="cmhd-gb_ba"></div>
                                    <span class="cmhd-gb_3 blue">
                                        <?= file_get_contents("../web/icons/communication/svg/production/ic_email_48px.svg") ?>
                                    </span>
                                <span class="cmhd-gb_4">Email</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>

            <div class="div-inline-right pr20">
                <content class="xjKiLb">
                        <span style="top: 16px">
                            <span class="cmhd-ut"><?php echo Yii::$app->user->identity->username; ?></span>
                        </span>
                </content>
            </div>

            <div class="clearboth"></div>
        </div>
    </div>
</div>
