<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property integer $position
 * @property integer $publish
 * @property string $create_date
 * @property string $update_date
 *
 * @property Products[] $products
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'position', 'publish'], 'integer'],
            [['name', 'description', 'alias'], 'required'],
            [['description'], 'string'],
            [['create_date', 'update_date'], 'safe'],
            [['name', 'alias'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'description' => 'Description',
            'alias' => 'Alias',
            'position' => 'Position',
            'publish' => 'Publish',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['cat_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getParentParentId( $parent_id )
    {
        return self::find()->where(['id' => $parent_id])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCategories( $parent_id = 0 )
    {
        return self::find()->where(['parent_id' => $parent_id])->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getCategoriesParent( $parent_id = 0 )
    {
        return self::find()->where(['id' => $parent_id])->asArray()->one();
    }

}
