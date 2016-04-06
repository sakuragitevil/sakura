<?php
$this->title = "Home";
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/home.css');
?>
<div class="home-page">
    <div class="home-page-T-R">
        <div class="home-page-T-J">
            <div class="home-page-ma">
                Hi, <?php echo Yii::$app->user->identity->username; ?>!
                <content class="xjKiLb">
                    <span class="yellow" style="top: 10px;">
                        <?php echo file_get_contents("../web/icons/social/svg/production/ic_sentiment_very_satisfied_48px.svg") ?>
                    </span>
                </content>
            </div>
            <div class="home-page-zr-ma">Get started by mailing or messaging a friend below.</div>
            <ul class="home-page-ul">
                <li class="home-page-li">
                    <div class="home-page-mUbCce">
                        <content class="xjKiLb">
                            <span style="top: -12px" class="white">
                                <?php echo file_get_contents("../web/icons/social/svg/production/ic_notifications_24px.svg") ?>
                            </span>
                        </content>
                    </div>
                    <div class="home-page-zr-ba">NOTIFICATION</div>
                </li>
                <li class="home-page-li">
                    <div class="home-page-mUbCce">
                        <content class="xjKiLb">
                            <span style="top: -12px" class="white">
                                <?php echo file_get_contents("../web/icons/communication/svg/production/ic_email_24px.svg") ?>
                            </span>
                        </content>
                    </div>
                    <div class="home-page-zr-ba">MAIL</div>
                </li>
                <li class="home-page-li">
                    <div class="home-page-mUbCce">
                        <content class="xjKiLb">
                            <span style="top: -12px" class="white">
                                <?php echo file_get_contents("../web/icons/communication/svg/production/ic_message_24px.svg") ?>
                            </span>
                        </content>
                    </div>
                    <div class="home-page-zr-ba">MESSAGE</div>
                </li>
            </ul>
        </div>
    </div>
</div>