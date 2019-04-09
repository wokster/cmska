<?php

namespace buben\controllers;

use buben\models\Build;
use Yii;
use buben\models\Template;
use buben\models\TemplateSearch;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TemplateController implements the CRUD actions for Template model.
 */
class TemplateController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Template models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Template model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param null $id
     *
     * @return \yii\web\Response
     * @throws \yii\base\ErrorException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionEdit($id = null)
    {
        $model = $id ? $this->getModelById($id) : $this->getLastModel();
        if($model){
            if ($model->load(Yii::$app->request->post())) {
                if(!$model->save()){
                    Yii::error(Json::encode($model->firstErrors));
                }
                return $this->redirect(['edit']);
            }else{
                $build = new Build();
                $build->name = $model->name;
                $build->version = $model->version;
                return $this->render('edit',[
                    'model' => $model,
                    'names' => $this->getNames(),
                    'build' => $build
                ]);
            }
        }
        throw new ErrorException("X3 ERROR");
    }

    public function actionBuild(){
        $build = new Build();
        if($build->load(Yii::$app->request->post()) and $build->build()){
            Yii::$app->session->addFlash('success','<strong>Build</strong> success');
            return $this->redirect('edit');
        }
        throw new ErrorException();
    }

    /**
     * @return array|\buben\models\Template|null
     */
    private function getNames(){
        $names_array = [];
        if($names = Template::find()->orderBy('name ASC')->groupBy('name')->asArray()->all()){
            $names_array = ArrayHelper::map($names,'name','name');
        }
        return $names_array;
    }

    /**
     * @return array|\buben\models\Template|null
     */
    private function getLastModel(){
        $model = Template::find()->orderBy('id DESC')->with('versions')->one();
        return $model ? $model : new Template();
    }

    /**
     * @param $id
     *
     * @return array|\buben\models\Template|null
     * @throws \yii\web\NotFoundHttpException
     */
    private function getModelById($id){
        if($model = Template::find()->andWhere(['id'=>$id])->with('versions')->one()){
            return $model;
        }
        throw new NotFoundHttpException();
    }
}
