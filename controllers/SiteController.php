<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\users\models\PasswordResetRequestForm;
use app\modules\users\models\ResetPasswordForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\modules\users\models\Designation;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 't1' : null,
            ],
        ];
    }
public function actionIndex1()
    {
    
     $x=$this->renderPartial('frontrow',['title'=>'मुख्यमंत्री जल बचाओ अभियान','photourl'=>'https://farm1.staticflickr.com/315/18927793683_b69917d910_s.jpg']);
      Yii::$app->view->params['rows']=[$x];
   // return $this->render('../../modules/mnrega/views/pond/mainpage');
   return $this->renderContent("");
    }
    public function actionIndex()
    {
     if (!\Yii::$app->user->isGuest) {
        $designation=Designation::getDesignationByUser(Yii::$app->user->id,true);
        if ($designation->profileEmpty())
          return $this->redirect(['/users/designation/updateprofile?id='.$designation->id]);
       else
       return $this->redirect(['/taxonomy?t=mjba']);
     } else 
     {
       $this->layout="//complaint";
        $model = new \app\modules\users\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
     }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new \app\modules\users\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionMain()
    {
    //$this->layout="//print";
       return $this->render('homepage');
    }

    
}
