<?php

/* @var $this \yii\web\View */
/* @var $processamentosSucesso */
/* @var $processamentosErro */

?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title">
                    <?= $this->title; ?>
                </div>

                <ul class="nav">
                    <li class="nav-item">
                    </li>
                </ul>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3><?= $processamentosSucesso; ?></h3>
                                <p>Processamento(s) efetuados com sucesso.</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3><?= $processamentosErro; ?></h3>
                                <p>Processamento(s) possui(em) erro(s).</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
