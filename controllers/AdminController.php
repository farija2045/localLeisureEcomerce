<?php

namespace app\controllers;

use app\models\User;
use yii\db\Query;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

class AdminController extends Controller
{
    public $layout = 'main-admin'; // Use the admin layout

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }
        return parent::beforeAction($action);
    }

   public function actionIndex()
{
    $users = User::find()->with(['entries.entryImages'])->all();

    return $this->render('index', [
        'users' => $users,
    ]);
}






    public function actionUsersImageCount()
    {
        $query = (new Query())
            ->select(['u.id', 'u.username', 'u.email', 'COUNT(ie.image_id) AS image_count'])
            ->from(['u' => 'user'])
            ->leftJoin(['ae' => 'admin_entries'], 'ae.user_id = u.id')
            ->leftJoin(['ie' => 'image_entries'], 'ie.entry_id = ae.id')
            ->groupBy(['u.id', 'u.username', 'u.email'])
            ->orderBy(['u.id' => SORT_ASC]);

        $users = $query->all();

        return $this->render('users-image-count', [
            'users' => $users,
        ]);
    }
}


