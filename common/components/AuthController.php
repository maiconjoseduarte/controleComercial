<?php

namespace common\components;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

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
                    'matchCallback' => function () {
                        if (! \Yii::$app->user->can(\Yii::$app->controller->route))
                            throw new ForbiddenHttpException('Você não está autorizado a realizar essa ação. ');
                        return true;
                    }
                ],
            ],
        ]);
    }
}
