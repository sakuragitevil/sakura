<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 4/4/2016
 * Time: 10:57 AM
 */
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/header.css');
?>

<div class="row-fluid common-header">
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
                        <span class="common-header-ft">Sakura Inc.</span>
                    </span>
                    </content>
                </div>
                <div class="clearboth"></div>
            </div>
            <div class="col-sm-7 col-md-7 col-lg-7 noLRpadding">
                <div class="div-inline-right pl20">
                    <content class="xjKiLb">
                    <span style="top: 11px">
                        <div class="common-header-ac-mk">
                            <canvas class="circle" width="32" height="32"></canvas>
                        </div>
                    </span>
                    </content>
                </div>

                <div class="div-inline-right pl20">
                    <content class="xjKiLb">
                        <span style="top: 15px">
                            <div class="common-header-cr"">
                                <?php echo file_get_contents("../web/icons/social/svg/production/ic_notifications_black_18px.svg") ?>
                            </div>
                        </span>
                    </content>
                </div>

                <div class="div-inline-right">
                    <content class="xjKiLb">
                        <span class="white" style="top: 15px">
                            <?php echo file_get_contents("../web/icons/navigation/svg/production/ic_apps_24px.svg") ?>
                        </span>
                    </content>
                </div>

                <div class="div-inline-right pr20">
                    <content class="xjKiLb">
                        <span style="top: 16px">
                            <span class="common-header-ut"><?php echo Yii::$app->user->identity->username; ?></span>
                        </span>
                    </content>
                </div>

                <div class="clearboth"></div>
            </div>
        </div>
    </div>
</div>
