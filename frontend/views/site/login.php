<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \common\models\LoginForm */

use common\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-container">
    <div class="h-100">
        <div class="h-100 no-gutters row">
            <div class="d-none d-lg-block col-lg-4">
                <div class="slider-light">
                    <div class="slick-slider">
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('images/fundo_.jpg');"></div>
                                <div class="slider-content">
                                    <img src="images/mafra-logo-branca.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-100 d-flex bg-white justify-content-center align-items-center col-md-12 col-lg-8">
                <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                    <?= Alert::widget(); ?>
                    <div class="app-logo"></div>
                    <h4 class="mb-0">
                        <img src="images/mafra-logo-color.png" alt="">
                    </h4>
<!--                    <h6 class="mt-3">No account? <a href="--><?//= Url::to(['site/signup']) ?><!--" class="text-primary">Sign up now</a></h6>-->
                    <div class="divider row"></div>
                    <div>
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <div class="form-row">
                            <div class="col-md-6">
                                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                        </div>
                        <div class="divider row"></div>
                        <div class="d-flex align-items-center">
                            <div class="ml-auto">
                                <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button', 'style' => 'width: 200px;']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
