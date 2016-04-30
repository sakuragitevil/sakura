<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets\sakura;

use Yii;

class AjaxWaiting extends \yii\bootstrap\Widget
{
    public $options = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        parent::run();
        echo $this->render("ajaxWaiting", $this->options);
    }
}
