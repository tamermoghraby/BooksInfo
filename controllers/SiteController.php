<?php

namespace app\controllers;

use app\models\Books;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UserForm;
use app\widgets\Alert;

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
     * @return string
     */
    public function actionIndex()
    {
        $books = Books::find()->all();
        $book = new Books();
        $formData = Yii::$app->request->post();
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            if($book->load(Yii::$app->request->post()) && $book->save()) {
                return [
                    'data' => [
                        'success' => true,
                        'book' => $book,
                        'message' => 'Book has been saved'
                    ],
                    'code' => 0,
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'book' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1,
                ];
            }
        }
        return $this->render('index', ['books' => $books, 'book' => $book]);
    }

    public function actionSubmit(){
        $books = Books::find()->all();
        $book = new Books();
        $formData = Yii::$app->request->post();
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            

            if($book->load(Yii::$app->request->post()) && $book->save()) {
                return [
                    'data' => [
                        'success' => true,
                        'book' => $book,
                        'message' => 'Book has been saved'
                    ],
                    'code' => 0,
                ];
            } else {
                return [
                    'data' => [
                        'success' => false,
                        'book' => null,
                        'message' => 'An error occured.',
                    ],
                    'code' => 1,
                ];
            }
        }
    }
    

    public function actionHome(){
        $books = Books::find()->all();
        $book = new Books();
        $formData = Yii::$app->request->post();
        return $this->render('home', ['books' => $books, 'book' => $book]);

    }

    

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionHello(){
        $name = 'John';
        return $this->render('hello', array('name'=>$name));
    }

    public function actionUser(){

        $model = new UserForm();

        if($model->load(Yii::$app->request->post()) && $model->validate()){

            Yii::$app->session->setFlash('success', 'You have entered the data correctly');

        }
    
        return $this->render('userForm', ['model'=>$model]);
        


    }
}

