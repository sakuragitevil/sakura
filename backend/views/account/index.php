<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 12/04/2016
 * Time: 3:49 PM
 */
$this->registerCssFile(Yii::$app->request->baseUrl . '/css/account.css');
$this->registerJsFile(Yii::$app->request->baseUrl . '/js/sakuraAccount.js', ['depends' => [backend\assets\CommonAsset::className()], 'position' => $this::POS_END]);
$this->title = "My Account";
?>
<div ng-app="sakuraAccount" class="acc_kgwWAf">
    <div ng-controller="accountController as skAccount" class="acc_ibIQPb acc_op62rc acc_xFG3Re">
        <div class="acc_FuZuF">
            <div class="acc_Yo">
                <div class="acc_aJ">
                    <content>
                        <div class="row-fluid">
                            <div class="acc_uHitK col-sm-2 col-md-2 col-lg-2">
                                <div>Welcome</div>
                            </div>
                            <div class="acc_mRrEd col-sm-10 col-md-10 col-lg-10">
                                <h1>Sign-in & security</h1>
                            </div>
                        </div>
                    </content>
                    <content>
                        <div class="row-fluid">
                            <div class="acc_zkJiu col-sm-2 col-md-2 col-lg-2">
                                <div class="acc_lg_5">
                                    <a class="acc_nh Vr" href="#" ng-click="signInItem()">Sign-in & security</a>
                                </div>
                                <div class="acc_lg_30">
                                    <a class="acc_nh" href="#">Personal info & language</a>

                                    <div class="acc_Vq">
                                        <a class="nh" href="#">Personal info</a>
                                        <a class="nh" href="#">Language</a>
                                    </div>
                                </div>
                            </div>
                            <div class="acc_pUstR col-sm-10 col-md-10 col-lg-10 nano acc-scroll">
                                <div class="nano-content">
                                    <div class="acc_Ti_nE_Jl">
                                        <h3 class="acc_ah" id="personalinfo" tabindex="-1">Your personal info</h3>
                                        <div class="acc_dN">
                                            <div class="acc_Wx">
                                                <div class="acc_wt">
                                                    Manage this basic information — your name, email, and phone
                                                    number —
                                                    to
                                                    help others find you on Google products like Hangouts, Gmail,
                                                    and
                                                    Maps,
                                                    and make it easier to get in touch.
                                                </div>
                                            </div>
                                            <div class="acc_zt">
                                                <div class="acc_LptvFf acc_HXWVj">
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">Name</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna">
                                                                            <?php echo Yii::$app->user->identity->firstname . " " . Yii::$app->user->identity->lastname; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">Email</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna">
                                                                            <?php echo Yii::$app->user->identity->email; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">Phone</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna">
                                                                            <?php echo Yii::$app->user->identity->phone; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">Address</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">About you</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearboth"></div>
                                    <div class="acc_Ti_nE_Jl">
                                        <h3 class="acc_ah" id="personalinfo" tabindex="-1">Language</h3>
                                        <div class="acc_dN">
                                            <div class="acc_Wx">
                                                <div class="acc_wt">
                                                    Set Sakura services on the web to work in the language of your choice.
                                                </div>
                                            </div>
                                            <div class="acc_zt">
                                                <div class="acc_LptvFf acc_HXWVj">
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_O5Nvec">
                                                            <img src="../web/icons/language_2x.png">
                                                        </div>
                                                    </div>
                                                    <div class="acc_S4Qdid">
                                                        <div class="acc_fIKlOc">
                                                            <div class="acc_UNioge"></div>
                                                            <div class="acc_s7GJtb">
                                                                <div class="acc_iXbi7e">
                                                                    <div class="acc_vbekj">
                                                                        <h5 class="acc_upRLX">Language</h5>
                                                                    </div>
                                                                    <div class="acc_yiTjAe">
                                                                        <div class="acc_Dna">English (United States)</div>
                                                                    </div>
                                                                </div>
                                                                <div class="acc_L5ZFod">
                                                                    <i class="material-icons md-24 md-dark">navigate_next</i>
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
                        </div>
                    </content>
                </div>
            </div>
        </div>
    </div>
</div>
