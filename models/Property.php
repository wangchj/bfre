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
 * @property double $priceAcre
 * @property double $priceTotal
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
            [['typeId', 'county', 'state', 'latlon', 'headline', 'descr', 'acres'], 'required'],
            [['typeId'], 'integer'],
            [['latlon', 'bound', 'descr', 'features', 'pictures', 'priceAcre', 'priceTotal'], 'string'],
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
            'acres' => 'Acreage',
            'priceAcre' => 'Price Per Acre',
            'priceTotal' => 'Total Price',
        ];
    }

    public function getType()
    {
        return $this->hasOne(PropertyType::className(), ['typeId'=>'typeId']);
    }

    /**
     * Returns record count of properties table.
     */
    //public static function count()
    //{
    //    $cmd = Yii::$app->db->createCommand('select count(*) from ' . self::tableName());
    //    return $cmd->queryScalar();
    //}

    /**
     * Gets an array of random Property objects of size $count from the database. If the table size is less
     * than $count, all records are returned.
     * @param integer $count the number of objects to be returned.
     * @return An array
     */
    public static function getRandomProperties($count)
    {
        $tbSize = Property::find()->count();
        
        if($tbSize <= $count)
            return Property::find()->all();

        $offset = rand(0, $tbSize - $count);
        return Property::find()->offset($offset)->limit($count)->all();
    }

    /**
     * Gets the url of the first photo of this property.
     * @return string or null if this property does not have photos.
     */
    public function firstPhotoUrl()
    {
        if($this->pictures == null || $this->pictures == '')
            return null;
        $pos = strpos($this->pictures, "\n");
        return substr($this->pictures, 0, $pos);
    }

    /**
     * Gets all photo url as an array of string.
     * @return null if this property does not have photos.
     */
    function allPhotoUrl()
    {
        if($this->pictures == null || $this->pictures == '')
            return null;
        return explode("\n", $this->pictures);
    }
}
