<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\User;
use app\models\Booking;
use app\models\Promotion;
use app\models\ContactMessage;

/**
 * AdminController handles admin functionalities such as managing users, bookings, promotions, and messages.
 */
class AdminController extends Controller
{
    public $layout = 'main-admin';

    /**
     * Only allow admins to access this controller.
     */
    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role !== 'admin') {
            throw new ForbiddenHttpException('You are not allowed to access this page.');
        }
        return parent::beforeAction($action);
    }

    /**
     * Admin dashboard view showing users and image count.
     */
    public function actionIndex()
    {
        $search = Yii::$app->request->get('search');
        $query = User::find()->with(['entries.entryImages']);

        if (!empty($search)) {
            $query->andFilterWhere(['or',
                ['like', 'username', $search],
                ['like', 'email', $search]
            ]);
        }

        $users = $query->all();

        return $this->render('index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Alternative method to show users with image count using raw SQL joins.
     */
    public function actionUsersImageCount()
    {
        $query = (new Query())
            ->select(['u.id', 'u.username', 'u.email', 'COUNT(ie.image_id) AS image_count'])
            ->from(['u' => 'user'])
            ->leftJoin(['ae' => 'admin_entries'], 'ae.user_id = u.id')
            ->leftJoin(['ie' => 'entry_images'], 'ie.entry_id = ae.id')
            ->groupBy(['u.id', 'u.username', 'u.email'])
            ->orderBy(['u.id' => SORT_ASC]);

        $users = $query->all();

        return $this->render('users-image-count', ['users' => $users]);
    }

    /**
     * View user details.
     */
    public function actionViewUser($id)
    {
        $model = User::findOne($id);
        if (!$model) throw new NotFoundHttpException('User not found.');

        return $this->render('users/view', ['model' => $model]);
    }

    /**
     * Update user info.
     */
    public function actionUpdateUser($id)
    {
        $model = User::findOne($id);
        if (!$model) throw new NotFoundHttpException('User not found.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User updated successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('users/update', ['model' => $model]);
    }

    /**
     * Delete user.
     */
    public function actionDeleteUser($id)
    {
        $model = User::findOne($id);
        if ($model && $model->role !== 'admin') {
            $model->delete();
            Yii::$app->session->setFlash('success', 'User deleted.');
        } else {
            Yii::$app->session->setFlash('error', 'Admin user cannot be deleted.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Manage all bookings.
     */
    public function actionBookings()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Booking::find()->with(['entry', 'user'])->orderBy(['created_at' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('bookings/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Update a booking.
     */
    public function actionUpdateBooking($id)
    {
        $model = Booking::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Booking not found.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Booking updated successfully.');
            return $this->redirect(['bookings']);
        }

        return $this->render('bookings/update', [
            'model' => $model,
        ]);
    }

    /**
     * Delete a booking.
     */
    public function actionDeleteBooking($id)
    {
        $model = Booking::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Booking not found.');
        }

        $model->delete();
        Yii::$app->session->setFlash('success', 'Booking deleted successfully.');
        return $this->redirect(['bookings']);
    }

    /**
     * List all promotions.
     */
    public function actionPromotions()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Promotion::find()->orderBy(['created_at' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('promotions/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Create a promotion.
     */
    public function actionCreatePromotion()
    {
        $model = new Promotion();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Promotion created.');
            return $this->redirect(['promotions']);
        }

        return $this->render('promotions/create', ['model' => $model]);
    }

    /**
     * Delete a promotion.
     */
    public function actionDeletePromotion($id)
    {
        $model = Promotion::findOne($id);
        if ($model !== null) {
            $model->delete();
        }

        Yii::$app->session->setFlash('success', 'Promotion deleted.');
        return $this->redirect(['promotions']);
    }

    /**
     * View all contact messages.
     */
    public function actionContactMessages()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContactMessage::find()->orderBy(['created_at' => SORT_DESC]),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('contact-messages/index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
