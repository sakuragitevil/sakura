<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 4/8/2016
 * Time: 10:28 AM
 */
namespace yii\web;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AngularAsset extends AssetBundle
{
    public $sourcePath = '@bower/angular-1.5.3';
    public $css = [
        'angular-csp.css',
    ];

    public $js = [
        'angular.min.js',
        'angular-animate.min.js'
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}