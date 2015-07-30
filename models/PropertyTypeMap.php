<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PropertyTypeMaps".
 *
 * @property integer $propId
 * @property integer $typeId
 *
 * @property PropertyType $type
 * @property Property $prop
 */
class PropertyTypeMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PropertyTypeMaps';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['propId', 'typeId'], 'required'],
            [['propId', 'typeId'], 'integer'],
            [['propId', 'typeId'], 'unique', 'targetAttribute' => ['propId', 'typeId'], 'message' => 'The combination of Prop ID and Type ID has already been taken.'],
            [['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => PropertyType::className(), 'targetAttribute' => ['typeId' => 'typeId']],
            [['propId'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['propId' => 'propId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'propId' => 'Prop ID',
            'typeId' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(PropertyType::className(), ['typeId' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProp()
    {
        return $this->hasOne(Property::className(), ['propId' => 'propId']);
    }
}