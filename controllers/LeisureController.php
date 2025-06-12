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
use app\models\PasswordResetRequestFor;
use app\models\ContactMessage;
use app\models\Booking;
use yii\web\NotFoundHttpException;

Yii::setAlias('@uploads', Yii::getAlias('@webroot/uploads'));

class LeisureController extends Controller
{
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

    public function actionIndex()
    {
        $entries = AdminEntry::find()->all();
        return $this->render('index', [
            'entries' => $entries,
        ]);
    }

    public function actionAdmin()
    {
        $model = new AdminEntry();

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            $model->images = UploadedFile::getInstances($model, 'images');
            $model->user_id = Yii::$app->user->id;

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

    public function actionAdminEntries()
    {
        $entries = AdminEntry::find()->where(['user_id' => Yii::$app->user->id])->all();
        return $this->render('index', [
            'entries' => $entries,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirectAfterLogin();
        }

        $model = new \app\models\LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirectAfterLogin();
        }

        $model->password = '';
        return $this->render('login', ['model' => $model]);
    }

    private function redirectAfterLogin()
    {
        $user = Yii::$app->user->identity;

        if ($user->role === 'admin') {
            return $this->redirect(['leisure/admin-choice']);
        }

        return $this->redirect(['leisure/admin']);
    }

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

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionImage($id)
    {
        $entry = AdminEntry::findOne($id);

        if (!$entry) {
            throw new NotFoundHttpException('The requested entry does not exist.');
        }

        return $this->render('image', [
            'entry' => $entry,
            'relatedImages' => $entry->relatedImages,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestFor();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['leisure/reset-password']);
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset the password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new \app\models\ResetPasswordForm($token);
        } catch (\yii\base\InvalidArgumentException $e) {
            throw new \yii\web\BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionAboutUs()
    {
        return $this->render('aboutUs');
    }

    public function actionAdminChoice()
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'admin') {
            return $this->goHome();
        }

        return $this->render('admin-choice');
    }

    public function actionContactSeller($entry_id)
    {
        $model = new ContactMessage();
        $model->entry_id = $entry_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Message sent to seller!');
            return $this->redirect(['leisure/view', 'id' => $entry_id]);
        }

        return $this->render('contact-seller', [
            'model' => $model,
            'entry_id' => $entry_id,
        ]);
    }

    public function actionBook($entry_id)
{
    $entry = AdminEntry::findOne($entry_id);
    if (!$entry) {
        throw new NotFoundHttpException('Entry not found.');
    }

    $model = new Booking();
    $model->entry_id = $entry_id;
    // If user is guest, set user_id to null; else set logged in user ID
    $model->user_id = Yii::$app->user->isGuest ? null : Yii::$app->user->id;

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
        Yii::$app->session->setFlash('success', 'Booking successful!');
        return $this->redirect(['leisure/index', 'id' => $entry_id]);
    }

    return $this->render('booking-form', ['model' => $model, 'entry_id' => $entry->id]);
}

  public function actionBookingForm($entry_id)
{
    $model = new Booking();
    $model->entry_id = $entry_id;

    // 👇 Set user_id from currently logged in user
    if (!Yii::$app->user->isGuest) {
        $model->user_id = Yii::$app->user->id;
    }

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Booking submitted successfully.');
                return $this->redirect(['leisure/index', 'id' => $entry_id]);
            }
        } else {
            Yii::$app->session->setFlash('error', json_encode($model->getErrors()));
        }
    }

    return $this->render('booking-form', [
        'model' => $model,
        'entry_id' => $entry_id,
    ]);
}
public function actionView($id)
{
    $model = AdminEntry::findOne($id); 
    if (!$model) {
        throw new \yii\web\NotFoundHttpException('Leisure entry not found.');
    }

    return $this->render('view', [
        'model' => $model,
    ]);
}


}
