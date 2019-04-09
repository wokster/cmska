<?php

namespace buben\models;

/**
 * This is the ActiveQuery class for [[Element]].
 *
 * @see Element
 */
class ElementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Element[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Element|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
