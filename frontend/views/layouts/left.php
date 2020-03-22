<?php

use yii\helpers\Url;

$link = $_GET['r'] ?? null;
?>
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>    <div class="scrollbar-sidebar">
        <div id="menu-lateral" class="app-sidebar__inner">
            <ul  class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="<?= Url::to(['/site/index']) ?>" class="<?= (strstr($link,'site/index') || $link == null) ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading">Sistema</li>
                <li>
                    <a href="<?= Url::to(['/site/about']) ?>" class="<?= $link == 'site/about' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>About
                    </a>
                </li>
                <li>
                    <a href="<?= Url::to(['/site/contact']) ?>" class="<?= strstr($link,'site/contact') ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Client
                    </a>
                </li>

                <?php if (Yii::$app->user->can('app/colaborador/index')) : ?>
                    <li>
                        <a href="<?= Url::to(['/app/colaborador/index']) ?>" class="<?= strstr($link,'app/colaborador') ? 'mm-active' : ''; ?>">
                            <i class="metismenu-icon pe-7s-mouse">
                            </i>Colaboradores
                        </a>
                    </li>
                <?php  endif; ?>

                <?php if (Yii::$app->user->can('app/grupo/index')) : ?>
                <li>
                    <a href="<?= Url::to(['/app/grupo/index']) ?>" class="<?= strstr($link,'app/grupo') ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Grupo
                    </a>
                </li>
                <?php  endif; ?>

                <?php if (Yii::$app->user->can('app/filial/index')) : ?>
                <li>
                    <a href="<?= Url::to(['/app/filial/index']) ?>" class="<?= strstr($link,'app/filial') ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Filial
                    </a>
                </li>
                <?php  endif; ?>

                <?php if (Yii::$app->user->can('app/contrato/index')) : ?>
                <li>
                    <a href="<?= Url::to(['/app/contrato/index']) ?>" class="<?= strstr($link,'app/contrato') ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-mouse">
                        </i>Contratos
                    </a>
                </li>
                <?php  endif; ?>

                <!--                <li class="app-sidebar__heading">UI Components</li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-diamond"></i>-->
<!--                        Elements-->
<!--                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>-->
<!--                    </a>-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon"></i>-->
<!--                                Buttons-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Dropdowns-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Icons-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Badges-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Cards-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>List Groups-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Navigation Menus-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Utilities-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-car"></i>-->
<!--                        Components-->
<!--                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>-->
<!--                    </a>-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Tabs-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Accordions-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Notifications-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Modals-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Progress Bar-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Tooltips &amp; Popovers-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Carousel-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Calendar-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Pagination-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Scrollable-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a href="#">-->
<!--                                <i class="metismenu-icon">-->
<!--                                </i>Maps-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li >-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-display2"></i>-->
<!--                        Tables-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="app-sidebar__heading">Widgets</li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-display2"></i>-->
<!--                        Dashboard Boxes-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="app-sidebar__heading">Forms</li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-mouse">-->
<!--                        </i>Forms Controls-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-eyedropper">-->
<!--                        </i>Forms Layouts-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#">-->
<!--                        <i class="metismenu-icon pe-7s-pendrive">-->
<!--                        </i>Forms Validation-->
<!--                    </a>-->
<!--                </li>-->
                <li class="app-sidebar__heading">Charts</li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>ChartJS
                    </a>
                </li>
                <li class="app-sidebar__heading">PRO Version</li>
                <li>
                    <a href="https://dashboardpack.com/theme-details/architectui-dashboard-html-pro/" target="_blank">
                        <i class="metismenu-icon pe-7s-graph2">
                        </i>
                        Upgrade to PRO
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>