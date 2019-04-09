<?php

namespace buben\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for table "template".
 *
 * @property int $id
 * @property string $name
 * @property int $updated_at
 * @property string $comment
 * @property string $version
 * @property string $css
 * @property string $html
 * @property string $js
 */
class Template extends \yii\db\ActiveRecord
{

    const VERSION_TYPE_NULL = 0;
    const VERSION_TYPE_MAJOR = 11;
    const VERSION_TYPE_MINOR = 22;
    const VERSION_TYPE_PATCH = 33;

    public $version_type = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','version_type'], 'required'],
            [['updated_at'], 'integer'],
            [['css', 'html', 'js'], 'string'],
            [['name', 'version'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 500],
            [['name','version'], 'unique', 'targetAttribute' => ['name','version']],
            ['version_type', 'in', 'range' => [self::VERSION_TYPE_NULL,self::VERSION_TYPE_MAJOR,self::VERSION_TYPE_MINOR,self::VERSION_TYPE_PATCH]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('buben', 'ID'),
            'name' => Yii::t('buben', 'Name'),
            'updated_at' => Yii::t('buben', 'Updated At'),
            'comment' => Yii::t('buben', 'Comment'),
            'version' => Yii::t('buben', 'Version'),
            'css' => Yii::t('buben', 'Css'),
            'html' => Yii::t('buben', 'Html'),
            'js' => Yii::t('buben', 'Js'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TemplateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TemplateQuery(get_called_class());
    }

    /**
     * @return $this
     */
    public function getVersions(){
        return $this->hasMany(self::class,['name'=>'name'])->orderBy('version');
    }

    /**
     * @return array
     */
    public function getIdVersionList(){
        return ArrayHelper::map($this->versions,'id','version');
    }

    /**
     * @return array
     */
    public function getVersionList(){
        return ArrayHelper::map($this->versions,'version','version');
    }

    /**
     * @return array
     */
    public function getParsedVersion(){
        return self::parseVersion($this->version);
    }

    /** Parse string to array and normalize to Semantic Versioning 2.0
     * @return array
     */
    public static function parseVersion($version){
        $version_array = [0,0,0];
        if(!empty($version)){
            $v = explode('.',$version);
            for ($i=0; $i < 3; $i++){
                $version_array[$i] = isset($v[$i]) ? $v[$i] : 0;
            }
        }
        return $version_array;
    }

    /** Parse array to string and normalize to Semantic Versioning 2.0
     * @return array
     */
    public static function versionToString($version){
        $version_string = '0.0.0';
        Yii::info($version,'herego sss');
        if(is_array($version)){
            array_splice($version, 3);
            $version = array_pad($version, 3, 0);
            $version_string = implode('.', $version);
        }
        return $version_string;
    }

    /**
     * @return array
     */
    public function setNewVersion(){
        $version = self::parseVersion($this->version);
        switch ($this->version_type){
            case self::VERSION_TYPE_PATCH:
                $version[2]++;
                break;
            case self::VERSION_TYPE_MAJOR:
                $version[0]++;
                break;
            case self::VERSION_TYPE_MINOR:
                $version[1]++;
                break;
            default:
                return false;

        }
        return self::versionToString($version);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($new_version = $this->setNewVersion()){
                $model = new self();
                $model->attributes = $this->attributes;
                $model->version = $new_version;
                $model->version_type = self::VERSION_TYPE_NULL;
                if(!$model->save()){
                    Yii::error(
                        'Error while save new version: ' .
                        Json::encode($model->firstErrors));
                }
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
}
