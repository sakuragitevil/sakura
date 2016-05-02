<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\sakura;

use Yii;
use yii\helpers\Url;
use yii\helpers\Json;

class Xhr2Upload extends \yii\bootstrap\Widget
{
    public $options = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        $this->options['url'] = Url::to(["filehandler/upload"]);
        $this->registerClientEvents();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        parent::run();
        echo $this->render("xhr2Upload", $this->options);
    }

    public function registerClientEvents()
    {
        //events
        $js = [];
        $options = Json::htmlEncode($this->options);
        $js[] = "jQuery('#" . $this->options['id'] . "').yiiXhr2Upload($options)";

        //register events
        $view = $this->getView();
        $view->registerJs(implode("\n", $js));
    }

}
