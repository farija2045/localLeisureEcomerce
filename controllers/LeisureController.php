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
use app\models\PasswordResetRequestForm;
    

Yii::setAlias('@uploads', Yii::getAlias('@webroot/uploads'));

class LeisureController extends Controller
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
        $entries = AdminEntry::find()->all();
        return $this->render('index', [
            'entries' => $entries,
        ]);
    }

    /**
     * Admin action to handle multiple image uploads.
     */
    public function actionAdmin()
    {
        $model = new AdminEntry();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->images = UploadedFile::getInstances($model, 'images');
            $model->user_id = Yii::$app->user->id; // Set the user ID from the logged-in user

            if ($model->validate()) {
                if ($model->save()) {
                    $uploadDir = Yii::getAlias('@uploads');
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    foreach ($model->images as $image) {
                        $uniqueFileName = uniqid() . '.' . $image->extension;
                        $filePath = $uploadDir . '/' . $uniqueFileName;

                        if ($image->saveAs($filePath)) {
                            $entryImage = new EntryImages();
                            $entryImage->entry_id = $model->id;
                            $entryImage->image_path = str_replace(Yii::getAlias('@webroot/'), '', $filePath);
                            $entryImage->image_url = Yii::getAlias('@web') . '/' . $entryImage->image_path;
                            $entryImage->save();
                        }
                    }

                    $firstImage = EntryImages::find()->where(['entry_id' => $model->id])->one();
                    if ($firstImage) {
                        $model->image_path = $firstImage->image_path;
                        $model->save(false);
                    }

                    Yii::$app->session->setFlash('success', 'Entry and images uploaded successfully.');
                    return $this->redirect(['leisure/admin-entries']);
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
        $entries = AdminEntry::find()->where(['user_id' => Yii::$app->user->id])->all();
         return $this->render('index', [
            'entries' => $entries,
        ]);
    }

    /**
     * Login action.
     */
   public function actionLogin()
{
    if (!Yii::$app->user->isGuest) {
        return $this->redirectAfterLogin(); // check user role
    }

    $model = new \app\models\LoginForm();

    if ($model->load(Yii::$app->request->post()) && $model->login()) {
        return $this->redirectAfterLogin(); // check user role after login
    }

    $model->password = '';
    return $this->render('login', ['model' => $model]);
}

private function redirectAfterLogin()
{
    $user = Yii::$app->user->identity;

    if ($user->role === 'admin') {
        return $this->redirect(['leisure/admin-choice']); // page with two choices
    }

    return $this->redirect(['leisure/admin']); // regular user
}


    /**
     * Register action.
     */
    public function actionRegister()
    {
        $model = new \app\models\RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('success', 'Registration successful! You can now log in.');
            return $this->redirect(['/leisure/login']);
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
        $entry = AdminEntry::findOne($id);

        if (!$entry) {
            throw new \yii\web\NotFoundHttpException('The requested entry does not exist.');
        }

        return $this->render('image', [
            'entry' => $entry,
            'relatedImages' => $entry->relatedImages,
        ]);
    }
        
   
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['leisure/reset-password']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionAboutUs()
   {
    return $this->render('aboutUs');
   }
  
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


public function actionAdminChoice()
{
    
    if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'admin') {
        return $this->goHome();
    }

    return $this->render('admin-choice');
}

    

}

