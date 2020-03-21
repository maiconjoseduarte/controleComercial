<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-container">
    <div class="h-100">
        <div class="h-100 no-gutters row">
            <div class="h-100 d-md-flex d-sm-block bg-white justify-content-center align-items-center col-md-12 col-lg-7">
                <div class="mx-auto app-login-box col-sm-12 col-md-10 col-lg-9">
                    <div class="app-logo"></div>
                    <h4>
                        <div>Welcome,</div>
                        <span>It only takes a <span class="text-success">few seconds</span> to create your account</span></h4>
                    <div>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'email') ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="mt-4 d-flex align-items-center"><h5 class="mb-0">Already have an account? <a href="<?= Url::to(['site/login']) ?>" class="text-primary">Sign in</a></h5>
                                <div class="ml-auto">
                                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <div class="d-lg-flex d-xs-none col-lg-5">
                <div class="slider-light">
                    <div class="slick-slider slick-initialized">
                        <div>
                            <div class="position-relative h-100 d-flex justify-content-center align-items-center bg-premium-dark" tabindex="-1">
                                <div class="slide-img-bg" style="background-image: url('login/images/citynights.jpg');"></div>
                                <div class="slider-content"><h3>Scalable, Modular, Consistent</h3>
                                    <p>Easily exclude the components you don't require. Lightweight, consistent Bootstrap based styles across all elements and components</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
