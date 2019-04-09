<?php

namespace buben\models;

use yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "element".
 *
 * @property int $id
 * @property string $key
 * @property string $title
 * @property int $updated_at
 * @property int $cat_id
 * @property int $type
 * @property int $sort
 * @property int $only_webmaster
 * @property string $calue
 */
class Element extends \yii\db\ActiveRecord
{
    const TYPE_STRING = 0;
    const TYPE_INTEGER = 10;
    const TYPE_BOOLEAN = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'element';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['key', 'filter', 'filter' => 'trim'],
            ['key', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['key', 'title'], 'required'],
            [['type', 'sort', 'only_webmaster','cat_id'], 'integer'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['updated_at','safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('buben', 'ID'),
            'key' => Yii::t('buben', 'Key'),
            'title' => Yii::t('buben', 'Title'),
            'cat_id' => Yii::t('buben', 'Category'),
            'updated_at' => Yii::t('buben', 'Updated At'),
            'type' => Yii::t('buben', 'Type'),
            'typeName' => Yii::t('buben', 'Type'),
            'sort' => Yii::t('buben', 'Sort'),
            'only_webmaster' => Yii::t('buben', 'Only Webmaster'),
            'value' => Yii::t('buben', 'Value'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ElementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ElementQuery(get_called_class());
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_STRING => Yii::t('buben', 'string'),
            self::TYPE_BOOLEAN => Yii::t('buben', 'boolean'),
            self::TYPE_INTEGER => Yii::t('buben', 'integer'),
        ];
    }

    public static function getCatList()
    {
        return [
            'null' => 'не отсортированные'
        ];
    }

    public function getTypeName()
    {
        $array = Element::getTypeList();
        return isset($array[$this->type]) ? $array[$this->type] : Yii::t('buben', 'unknown');
    }
}
