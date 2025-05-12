<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;
use app\models\AdminForm;
// Set alias at the beginning of the controller
Yii::setAlias('@uploads', Yii::getAlias('@webroot/uploads'));
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
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
        return $this->render('index');
    }

   // public function actionAdmin()
   // {
       // return $this->render('admin');
   // }
// filepath: c:\xampp\htdocs\basic\controllers\SiteController.php
public function actionAdmin()
{
    $model = new \app\models\AdminForm();

    if (Yii::$app->request->isPost) {
        // Load form data into the model
        $model->load(Yii::$app->request->post());

        // Handle file upload
        $model->imageFile = \yii\web\UploadedFile::getInstance($model, 'imageFile');

        if ($model->validate()) {
            // Ensure uploads directory exists
            $uploadDir = Yii::getAlias('@uploads');
            

            // Define the correct file path
            $filePath = $uploadDir .'/'. $model->imageFile->baseName . '.' . $model->imageFile->extension;

            // Save uploaded file if provided
            if ($model->imageFile) {
                if ($model->imageFile->saveAs($filePath)) {
                    // Store the correct file path (relative for web use)
                    $model->imagePath =str_replace(Yii::getAlias('@webroot/'),'',$filePath);
                } else {
                    Yii::$app->session->setFlash('error', 'File upload failed!');
                return false;
                }
            }

            // Save data to the database
            Yii::$app->postDb->createCommand()->insert('admin_entries', [
                'title' => $model->title,
                'description' => $model->description,
                'type' => $model->type,
                'date' => $model->date,
                'location' => $model->location,
                'image_path' => $model->imagePath, // Store the file path
                'image_url' => $model->imageUrl,   // Store the URL provided in the form

            ])->execute();

            Yii::$app->session->setFlash('success', 'Data saved successfully.');
            return $this->redirect(['site/admin']);
        }
    }

    return $this->render('admin', ['model' => $model]); // Ensure the form renders if validation fails
}
    
   
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['admin']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['admin']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
     public function actionAdminEntries()
     {
        // fetch all records from the admin_entries table
        $entries =\app\models\AdminEntry::find()->all();
        // pass the records from the admin_entries table
    
        return $this->render('index', [
            'entries' => $entries,
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

   
}
// Test database connection and query
// $connection = Yii::$app->postDb;
// $command = $connection->createCommand('SELECT * FROM admin_entries');
// $rows = $command->queryAll();
// var_dump($rows);
// die();