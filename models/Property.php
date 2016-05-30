<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Properties".
 *
 * @property integer $propId
 * @property string $address
 * @property string $city
 * @property string $county
 * @property string $state
 * @property string $latlon
 * @property string $bound
 * @property string $headline
 * @property string $descr
 * @property string $features
 * @property string $keywords
 * @property string $pictures
 * @property double $acres
 * @property double $priceAcre
 * @property double $priceTotal
 * @property string $status
 *
 * @property PropertyTypeMap[] $propertyTypeMaps
 * @property PropertyType[] $types
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
            [['county', 'state', 'latlon', 'headline', 'descr', 'acres'], 'required'],
            [['latlon', 'bound', 'descr', 'features', 'keywords', 'pictures', 'priceAcre', 'priceTotal'], 'string'],
            [['address'], 'string', 'max' => 40],
            [['city', 'county', 'status'], 'string', 'max' => 20],
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
            'address' => 'Address',
            'city' => 'City',
            'county' => 'County',
            'state' => 'State',
            'latlon' => 'Latlon',
            'bound' => 'Bound',
            'headline' => 'Headline',
            'descr' => 'Description',
            'features' => 'Special Features',
            'keywords' => 'Keywords',
            'pictures' => 'Pictures',
            'acres' => 'Acreage',
            'priceAcre' => 'Price Per Acre',
            'priceTotal' => 'Total Price',
            'typeList' => 'Property Type',
            'status' => 'Status'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyTypeMaps()
    {
        return $this->hasMany(PropertyTypeMap::className(), ['propId' => 'propId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(PropertyType::className(), ['typeId' => 'typeId'])->viaTable('PropertyTypeMaps', ['propId' => 'propId']);
    }

    public function isType($typeId)
    {
        foreach($this->types as $type)
            if($type->typeId == $typeId)
                return true;
        return false;
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
     * Gets an array of random active Property objects of size $count from the database. If the table size is less
     * than $count, all records are returned.
     * @param integer $count the number of objects to be returned.
     * @return An array
     */
    public static function getRandActiveProps($count)
    {
        $randName = Yii::$app->db->driverName == 'sqlite' ? 'random()' : 'rand()';
        return Property::find()->where(['status'=>'active'])->limit($count)->orderBy($randName)->all();
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

    function getTypeStr()
    {
        $res = '';
        for($i = 0; $i < count($this->types); $i++) {
            $res .= $this->types[$i]->typeName;
            if($i != count($this->types) - 1)
                $res .= ', ';
        }
        return $res;
    }
}
