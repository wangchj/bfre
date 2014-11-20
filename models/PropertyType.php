<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "PropertyTypes".
 *
 * @property integer $typeId
 * @property string $typeName
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
}
