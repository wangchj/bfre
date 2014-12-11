<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Properties".
 *
 * @property integer $propId
 * @property integer $typeId
 * @property string $address
 * @property string $city
 * @property string $county
 * @property string $state
 * @property string $latlon
 * @property string $bound
 * @property string $headline
 * @property string $descr
 * @property string $features
 * @property string $pictures
 * @property double $acres
 * @property double $price
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Properties';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['typeId', 'county', 'state', 'latlon', 'headline', 'descr', 'acres', 'price'], 'required'],
            [['typeId'], 'integer'],
            [['latlon', 'bound', 'descr', 'features', 'pictures'], 'string'],
            [['acres', 'price'], 'number'],
            [['address'], 'string', 'max' => 40],
            [['city', 'county'], 'string', 'max' => 20],
            [['state'], 'string', 'max' => 2],
            [['headline'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'propId' => 'Prop ID',
            'typeId' => 'Property Type',
            'address' => 'Address',
            'city' => 'City',
            'county' => 'County',
            'state' => 'State',
            'latlon' => 'Latlon',
            'bound' => 'Bound',
            'headline' => 'Headline',
            'descr' => 'Description',
            'features' => 'Special Features',
            'pictures' => 'Pictures',
            'acres' => 'Acres',
            'price' => 'Price',
        ];
    }

    public function getType()
    {
        return $this->hasOne(PropertyType::className(), ['typeId'=>'typeId']);
    }
}
