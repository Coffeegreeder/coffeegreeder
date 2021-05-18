<?php

namespace app\modules\admin;

class admin extends \yii\base\Module
{
    public $layout = 'main';

    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
    }
}
