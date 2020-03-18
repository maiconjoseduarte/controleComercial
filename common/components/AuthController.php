<?php

namespace common\components;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Class AuthController
 * @package common
 *
 * Base controller for automatic access control
 */
class AuthController extends Controller {

    public function init(){
        parent::init();

        $this->attachBehavior('access', [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ]);
    }
}
