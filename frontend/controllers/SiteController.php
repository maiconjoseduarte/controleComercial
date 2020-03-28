<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'index', 'about'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'about'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => YII_DEBUG ? ['get', 'post'] : ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/login']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout = 'login';

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }


    public function actionCreatePermission()
    {
        $auth = Yii::$app->authManager;

        $admin = $auth->createRole('administrador');
        $analista = $auth->createRole('analista');
        $assistente = $auth->createRole('assistente');

        $auth->add($admin);
        $auth->add($analista);
        $auth->add($assistente);

        $viewPost = $auth->createPermission('post-index');
        $addPost = $auth->createPermission('post-create');
        $editPost = $auth->createPermission('post-edit');
        $deletePost = $auth->createPermission('post-delete');

        $auth->add($viewPost);
        $auth->add($addPost);
        $auth->add($editPost);
        $auth->add($deletePost);

        $auth->addChild($admin, $viewPost);
        $auth->addChild($admin, $addPost);
        $auth->addChild($admin, $editPost);
        $auth->addChild($admin, $deletePost);

        $auth->addChild($analista, $viewPost);
        $auth->addChild($analista, $addPost);
        $auth->addChild($analista, $editPost);

        $auth->addChild($assistente, $viewPost);

        $auth->assign($admin, 1);
//        $auth->assign($supervisor, 2);
//        $auth->assign($operador, 3);
    }

    public function actionAddPermission()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAllRoles();
        $auth->removeAllPermissions();
        $auth->removeAllAssignments();
        $auth->removeAllRules();

        $admin = $auth->createRole('administrador');
        $analista = $auth->createRole('analista');
        $assistente = $auth->createRole('assistente');

        $auth->add($admin);
        $auth->add($analista);
        $auth->add($assistente);

        /*
         * COlaborador
         */
        $colaboradorIndex = $auth->createPermission('app/colaborador/index');
        $colaboradorView = $auth->createPermission('app/colaborador/view');
        $colaboradorCreate = $auth->createPermission('app/colaborador/create');
        $colaboradorUpdate = $auth->createPermission('app/colaborador/update');
        $colaboradorDelete = $auth->createPermission('app/colaborador/delete');

        $auth->add($colaboradorIndex);
        $auth->add($colaboradorView);
        $auth->add($colaboradorCreate);
        $auth->add($colaboradorUpdate);
        $auth->add($colaboradorDelete);

        $auth->addChild($admin, $colaboradorIndex);
        $auth->addChild($admin, $colaboradorView);
        $auth->addChild($admin, $colaboradorCreate);
        $auth->addChild($admin, $colaboradorUpdate);
        $auth->addChild($admin, $colaboradorDelete);

        $auth->addChild($analista, $colaboradorIndex);
        $auth->addChild($analista, $colaboradorView);
        $auth->addChild($analista, $colaboradorCreate);
        $auth->addChild($analista, $colaboradorUpdate);
        $auth->addChild($analista, $colaboradorDelete);

        $auth->addChild($assistente, $colaboradorIndex);
        $auth->addChild($assistente, $colaboradorView);
        /*
         * FIM colaborador
         */

        /*
         * Grupo
         */
        $grupoIndex = $auth->createPermission('app/grupo/index');
        $grupoView = $auth->createPermission('app/grupo/view');
        $grupoCreate = $auth->createPermission('app/grupo/create');
        $grupoUpdate = $auth->createPermission('app/grupo/update');
        $grupoDelete = $auth->createPermission('app/grupo/delete');

        $auth->add($grupoIndex);
        $auth->add($grupoView);
        $auth->add($grupoCreate);
        $auth->add($grupoUpdate);
        $auth->add($grupoDelete);

        $auth->addChild($admin, $grupoIndex);
        $auth->addChild($admin, $grupoView);
        $auth->addChild($admin, $grupoCreate);
        $auth->addChild($admin, $grupoUpdate);
        $auth->addChild($admin, $grupoDelete);

        $auth->addChild($analista, $grupoIndex);
        $auth->addChild($analista, $grupoView);
        $auth->addChild($analista, $grupoCreate);
        $auth->addChild($analista, $grupoUpdate);
        $auth->addChild($analista, $grupoDelete);

        $auth->addChild($assistente, $grupoIndex);
        $auth->addChild($assistente, $grupoView);
        /*
         * FIM Grupo
         */

        /*
         * Filiais
         */
        $filialIndex = $auth->createPermission('app/filial/index');
        $filialView = $auth->createPermission('app/filial/view');
        $filialCreate = $auth->createPermission('app/filial/create');
        $filialUpdate = $auth->createPermission('app/filial/update');
        $filialDelete = $auth->createPermission('app/filial/delete');

        $auth->add($filialIndex);
        $auth->add($filialView);
        $auth->add($filialCreate);
        $auth->add($filialUpdate);
        $auth->add($filialDelete);

        $auth->addChild($admin, $filialIndex);
        $auth->addChild($admin, $filialView);
        $auth->addChild($admin, $filialCreate);
        $auth->addChild($admin, $filialUpdate);
        $auth->addChild($admin, $filialDelete);

        $auth->addChild($analista, $filialIndex);
        $auth->addChild($analista, $filialView);
        $auth->addChild($analista, $filialCreate);
        $auth->addChild($analista, $filialUpdate);
        $auth->addChild($analista, $filialDelete);

        $auth->addChild($assistente, $filialIndex);
        $auth->addChild($assistente, $filialView);
        /*
         * FIM Filiais
         */

        /*
         * COntratos
         */
        $contratoIndex = $auth->createPermission('app/contrato/index');
        $contratoView = $auth->createPermission('app/contrato/view');
        $contratoCreate = $auth->createPermission('app/contrato/create');
        $contratoUpdate = $auth->createPermission('app/contrato/update');
        $contratoDelete = $auth->createPermission('app/contrato/delete');

        $auth->add($contratoIndex);
        $auth->add($contratoView);
        $auth->add($contratoCreate);
        $auth->add($contratoUpdate);
        $auth->add($contratoDelete);

        $auth->addChild($admin, $contratoIndex);
        $auth->addChild($admin, $contratoView);
        $auth->addChild($admin, $contratoCreate);
        $auth->addChild($admin, $contratoUpdate);
        $auth->addChild($admin, $contratoDelete);

        $auth->addChild($analista, $contratoIndex);
        $auth->addChild($analista, $contratoView);
        $auth->addChild($analista, $contratoCreate);
        $auth->addChild($analista, $contratoUpdate);
        $auth->addChild($analista, $contratoDelete);

        $auth->addChild($assistente, $contratoIndex);
        $auth->addChild($assistente, $contratoView);
        /*
         * FIM Contratos
         */

        /*
         * Importação
         */
        $importacaoGrupo = $auth->createPermission('app/importacao/importacao-grupo');
        $importacaoFilial = $auth->createPermission('app/importacao/importacao-filial');
        $importacaoContrato = $auth->createPermission('app/importacao/importacao-contrato');
        $importacaoItensContrato = $auth->createPermission('app/importacao/importacao-itens-contrato');

        $auth->add($importacaoGrupo);
        $auth->add($importacaoFilial);
        $auth->add($importacaoContrato);
        $auth->add($importacaoItensContrato);

        $auth->addChild($admin, $importacaoGrupo);
        $auth->addChild($admin, $importacaoFilial);
        $auth->addChild($admin, $importacaoContrato);
        $auth->addChild($admin, $importacaoItensContrato);

        /*
         * FIM Importação
         */

        $auth->assign($admin, 1);
        $auth->assign($admin, 2);
        $auth->assign($analista, 7);
        $auth->assign($assistente, 6);
    }


    public function actionTestPermission($userId)
    {
        $auth = Yii::$app->authManager;

        $ta = Yii::$app->user->can('post-index');

        echo "<p>View: {$auth->checkAccess($userId, 'post-index')}</p>";
        echo "<p>Create: {$auth->checkAccess($userId, 'post-create')}</p>";
        echo "<p>Edit: {$auth->checkAccess($userId, 'post-edit')}</p>";
        echo "<p>Delete: {$auth->checkAccess($userId, 'post-delete')}</p>";

    }
}
