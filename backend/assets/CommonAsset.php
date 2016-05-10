<?php
/**
 * Created by PhpStorm.
 * User: Thuan
 * Date: 4/8/2016
 * Time: 10:28 AM
 */
namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * Asset bundle for the Twitter bootstrap css files.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CommonAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets/sources';
    public $css = [
        'angular-1.5.3/angular-csp.css',
        'nanoscroller/nanoscroller.css',
    ];

    public $js = [
        'angular-1.5.3/angular.min.js',
        'angular-1.5.3/angular-animate.min.js',
        'nanoscroller/jquery.nanoscroller.min.js',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}