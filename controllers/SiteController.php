<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\AdminEntry;
use app\models\EntryImages;

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

    /**
     * Admin action to handle multiple image uploads.
     */
        
    public function actionAdmin()
    {
        $model = new AdminEntry();
    
        if (Yii::$app->request->isPost) {
            // Load form data into the model
            $model->load(Yii::$app->request->post());
    
            // Handle multiple file uploads
            $model->images = UploadedFile::getInstances($model, 'images');
    
            if ($model->validate()) {
                // Save the main entry
                if ($model->save()) {
                    $uploadDir = Yii::getAlias('@uploads');
                    if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                        Yii::$app->session->setFlash('error', 'Failed to create uploads directory.');
                        return $this->redirect(['site/admin']);
                    }
    
                    foreach ($model->images as $image) {
                        // Generate a unique file name for each image
                        $uniqueFileName = uniqid() . '.' . $image->extension;
                        $filePath = $uploadDir . '/' . $uniqueFileName;
    
                        if ($image->saveAs($filePath)) {
                            // Save the image record in the entry_images table
                            $entryImage = new EntryImages();
                            $entryImage->entry_id = $model->id; // Link to the main entry
                            $entryImage->image_path = str_replace(Yii::getAlias('@webroot/'), '', $filePath);
                            $entryImage->image_url = Yii::getAlias('@web') . '/' . $entryImage->image_path; // Save the full URL
                            $entryImage->save();
                        }
                    }
    
                    // Save the first image path in the admin_entries table as the thumbnail
                    $firstImage = EntryImages::find()->where(['entry_id' => $model->id])->one();
                    if ($firstImage) {
                        $model->image_path = $firstImage->image_path; // Save the first image as the thumbnail
                        $model->save(false); // Save without validation
                    }
    
                    Yii::$app->session->setFlash('success', 'Entry and images uploaded successfully.');
                    return $this->redirect(['site/admin-entries']);
                }
            }
        }
    
        return $this->render('admin', ['model' => $model]);
    }
    /**
     * Fetch admin entries.
     */
    public function actionAdminEntries()
    {
        $entries = AdminEntry::find()->all();

        return $this->render('index', [
            'entries' => $entries,
        ]);
    }

        
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/admin']); // Redirect logged-in users to the admin page
        }
    
        $model = new \app\models\LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/admin']); // Redirect after successful login
        }
    
        $model->password = ''; // Clear the password field after submission
        return $this->render('login', [
            'model' => $model,
        ]);
    }

public function actionRegister()
{
    $model = new \app\models\RegistrationForm();

    if ($model->load(Yii::$app->request->post()) && $model->register()) {
        Yii::$app->session->setFlash('success', 'Registration successful! You can now log in.');
        return $this->redirect(['site/login']); // Redirect to the login page after successful registration
    }

    return $this->render('register', [
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
     * View entry details and related images.
     */
   
public function actionImage($id)
{
    $entry = AdminEntry::findOne($id); // Use $entry instead of $image

    if (!$entry) {
        throw new \yii\web\NotFoundHttpException('The requested entry does not exist.');
    }

    return $this->render('image', [
        'entry' => $entry, // Pass the entry to the view
        'relatedImages' => $entry->relatedImages, // Fetch related images using the relation
    ]);
}
}

