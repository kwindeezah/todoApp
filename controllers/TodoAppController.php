<?php

namespace app\controllers;

use yii;
use app\models\TodoApp;
use yii\filters\AccessControl;
use app\models\TodoAppSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\data\ActiveDataProvider;

/**
 * TodoAppController implements the CRUD actions for TodoApp model.
 */
class TodoAppController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'logout'],
                    'rules' => [
                        [
                            'actions' => ['index', 'logout'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all TodoApp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $searchModel = new TodoAppSearch();
        $userId = Yii::$app->user->identity->id;
        $dataProvider = new ActiveDataProvider([
            'query' => TodoApp::find()->where(['user_id' => $userId])->all()
        ]); 
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    // public function actionIndex()
    // {
    //     $model = TodoApp::find()->asArray()->all();
    //     $searchModel = new TodoAppSearch();
    //     $dataProvider = $searchModel->search($this->request->queryParams);

        
    //     return $this->render('index', [
    //                 'searchModel' => $searchModel,
    //                 'dataProvider' => $dataProvider,
    //                 'model' => $model
    //             ]);
    // }

    /**
     * Displays a single TodoApp model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TodoApp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        $model = new TodoApp();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = \Yii::$app->user->identity->id; 
            $model->save();
            return $this->redirect(['view', 'id' => $model->id
            ]);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TodoApp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TodoApp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TodoApp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TodoApp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TodoApp::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function accessRules()
    {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => ['toggle'],
                'users' => ['@'],
            ),
            array('deny', // deny all users
                'users' => array('*'),

            ),

        );

    }
}
