<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AdminAsset;
use yii\helpers\Html;
use common\widgets\Breadcrumbs;
use common\widgets\Alert;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

    <?php include 'topo.php'; ?>
    <div class="app-main">
        <?php include 'left.php'; ?>

        <div class="app-main__outer">
            <div class="app-main__inner">

                <div class="app-page-title app-page-title-simple">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div>
                                <div class="page-title-head center-elem">
                                        <span class="d-inline-block pr-2 font-size-xlg">
                                            <i class="pe-7s-angle-right-circle opacity-6"></i>
                                        </span>
                                    <span class="d-inline-block"><?= $this->title; ?></span>
                                </div>
                                <div class="page-title-subheading opacity-10">
                                    <?= Breadcrumbs::widget([
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?= Alert::widget() ?>
                <?= $content ?>

            </div>
        </div>
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
