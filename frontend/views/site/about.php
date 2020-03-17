<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <?= $this->title; ?>
                </div>
            </div>
            <div class="card-body">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>This is the About page. You may modify the following file to customize its content:</p>

                <code><?= __FILE__ ?></code>
            </div>
        </div>
    </div>
</div>
