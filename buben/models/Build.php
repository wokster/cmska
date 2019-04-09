<?php

namespace buben\models;

use JSMin\JSMin;
use tubalmartin\CssMin\Minifier;
use yii;

/**
 * This is the model class for table "element".
 * @property string $name
 * @property string $version
 */
class Build extends yii\base\Model
{

    public $name;
    public $version;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','version'], 'string'],
            [['name','version'], 'exist', 'targetClass' => Template::class, 'targetAttribute' => ['name','version']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('buben', 'Name'),
            'version' => Yii::t('buben', 'Version'),
        ];
    }

    /**
     * @return yii\db\ActiveQuery
     */
    public function getTemplateQuery(){
        return Template::find()->where([
            'and',
            ['name' => $this->name],
            ['version' => $this->version],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        if($this->validate()){
            if($template = $this->getTemplateQuery()->one()){
                /* @var $template Template*/
                $jsMin = new JSMin($template->js);
                file_put_contents(Yii::getAlias('@buben/web/front/') . 'main.min.js',$jsMin->min());
                $cssMin = new Minifier();
                file_put_contents(Yii::getAlias('@buben/web/front/') . 'main.min.css',$cssMin->run($template->css));
                $view = new yii\web\View();
                $view->registerCssFile('/main.min.css');
                $view->registerJsFile('/main.min.js');
                $data = $view->render('@buben/views/layouts/front',[
                    'content' => $template->html
                ]);
                if(file_put_contents(Yii::getAlias('@buben/web/front/') . 'index.html',$data)){
                    return true;
                }
            }
        }
        return false;
    }
}
