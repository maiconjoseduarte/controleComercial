<?php

namespace common\widgets;

/**
 * Class Breadcrumbs
 * @package common\widgets
 */
class Breadcrumbs extends \yii\widgets\Breadcrumbs
{

    public $itemTemplate = "<li class=\"breadcrumb-item\">{link}</li>\n";

    public $activeItemTemplate = "<li class=\"breadcrumb-item active\" aria-current=\"page\">{link}</li>\n";

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }
}
