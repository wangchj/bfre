<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PropertyTypes".
 *
 * @property integer $typeId
 * @property string $typeName
 *
 * @property PropertyTypeMap[] $propertyTypeMaps 
 * @property Property[] $props 
 */
class PropertyType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'PropertyTypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeName'], 'required'],
            [['typeName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeId' => 'Type ID',
            'typeName' => 'Type Name',
        ];
    }

     /** 
    * @return \yii\db\ActiveQuery 
    */ 
    public function getPropertyTypeMaps() 
    { 
        return $this->hasMany(PropertyTypeMap::className(), ['typeId' => 'typeId']); 
    } 
 
    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getProperties() 
    { 
        return $this->hasMany(Property::className(), ['propId' => 'propId'])->viaTable('PropertyTypeMaps', ['typeId' => 'typeId']); 
    } 
}
