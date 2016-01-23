<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property integer $position
 * @property integer $publish
 * @property string $create_date
 * @property string $update_date
 *
 * @property Categories $cat
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'position', 'publish'], 'integer'],
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
            'cat_id' => 'Cat ID',
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
    public function getCat()
    {
        return $this->hasOne(Categories::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getProductByCatId($cat_id)
    {
        return self::find()->where(['cat_id' => $cat_id])->asArray()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getProductById($id)
    {
        return self::find()->where(['id' => $id])->asArray()->one();
    }
}
