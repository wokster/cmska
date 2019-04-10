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
     *
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionEdit()
    {
        if($name = Yii::$app->request->get('name')){
            if($version = Yii::$app->request->get('version')){
                $model = $this->getModel($name,$version);
            }else{
                $model = $this->getLastModelByName($name);
            }
        }else{
            $model = $this->getLastModel();
        }

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
     * @throws \yii\web\NotFoundHttpException
     */
    private function getLastModel(){
        if($model = Template::find()->orderBy('id DESC')->with('versions')->one()){
            return $model;
        }elseif (!Template::find()->exists()){
            return new Template();
        }
        throw new NotFoundHttpException();
    }

    /**
     * @param $name
     *
     * @return array|\buben\models\Template|null
     * @throws \yii\web\NotFoundHttpException
     */
    private function getLastModelByName($name){
        if($model = Template::find()
            ->andWhere(['name' => $name])
            ->orderBy('id DESC')
            ->with('versions')->one()){
                return $model;
        }
        throw new NotFoundHttpException();
    }

    /**
     * @param $name
     * @param $version
     *
     * @return array|\buben\models\Template|null
     * @throws \yii\web\NotFoundHttpException
     *
     */
    private function getModel($name,$version){
        if($model = Template::find()->andWhere([
            'name' => $name,
            'version' => $version
        ])->with('versions')->one()){
            return $model;
        }
        throw new NotFoundHttpException();
    }
}
