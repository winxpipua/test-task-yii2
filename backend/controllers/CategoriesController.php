<?php

namespace backend\controllers;

use Yii;
use common\models\Categories;
use common\models\SearchCategories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($event)
    {
        if (\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return parent::beforeAction($event);
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent_id' => 0,
            'back' => Categories::getParentParentId(0),
        ]);
    }

    /**
     * Lists all Categories models.
     * @return mixed
     */
    public function actionSubcat()
    {
        $searchModel = new SearchCategories();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'parent_id' => Yii::$app->request->queryParams["SearchCategories"]["parent_id"],
            'back' => Categories::getParentParentId(Yii::$app->request->queryParams["SearchCategories"]["parent_id"]),
        ]);
    }

    /**
     * Displays a single Categories model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->parent_id > 0) {
                return $this->redirect(['subcat', 'SearchCategories[parent_id]' => $model->parent_id]);
            } else {
                return $this->redirect(['/categories']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'parent_id' => Yii::$app->request->queryParams["parent_id"],
            ]);
        }
    }

    /**
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->parent_id > 0) {
                return $this->redirect(['subcat', 'SearchCategories[parent_id]' => $model->parent_id]);
            } else {
                return $this->redirect(['/categories']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'parent_id' => $model->parent_id,
            ]);
        }
    }

    /**
     * Deletes an existing Categories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $this->findModel($id)->delete();

        if($model->parent_id > 0) {
            return $this->redirect(['subcat', 'SearchCategories[parent_id]' => $model->parent_id]);
        } else {
            return $this->redirect(['/categories']);
        }
    }

    /**
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
