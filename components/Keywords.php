<?php

namespace app\components;

use yii\base\Component;
use app\models\Property;
use app\models\PropertyType;
use app\components\geonames\UsStates;

class Keywords extends Component {
    /**
     * @param $props Property[] A Property model objects.
     * @return An array of keyword strings.
     */
    public static function arrayForProp($prop) {
        $res = [];
        $stateName = UsStates::cton($prop->state);
        $res[] = "$prop->acres acre $prop->headline for sale in $prop->city $prop->county county $stateName";
        $res = array_merge($res, explode(',', $prop->keywords));
        if($prop->city) $res[] = $prop->city;
        $res[] = $prop->county;
        $res[] = UsStates::cton($prop->state);
        $res[] = $prop->state;
        return array_unique($res);
    }

    public static function forProp($prop) {
        return implode(',', self::arrayForProp($prop));
    }

    /**
     * @param $props Property[] An array of Property model objects.
     * @return An array of keyword strings.
     */
    public static function arrayForProps($props) {
        $res = [];

        //Add headlines
        foreach($props as $prop) {
            $stateName = UsStates::cton($prop->state);
            $res[] = "$prop->acres acre $prop->headline for sale in $prop->city $prop->county county $stateName";
        }

        //Add property keywords
        foreach($props as $prop) {
            $a = explode(',', $prop->keywords);
            $res = array_merge($res, $a);
        }

        //Add city, county, and state
        foreach($props as $prop) {
            if($prop->city)
                $res[] = $prop->city;
            $res[] = $prop->county;
            $res[] = UsStates::cton($prop->state);
            $res[] = $prop->state;
        }

        return array_unique($res);
    }

    /**
     * @param $props Property[] An array of Property model objects.
     * @return A string of keywords.
     */
    public static function forProps($props) {
        return implode(',', self::arrayForProps($props));
    }

    /**
     * @return A string of keywords.
     */
    public static function forAllProps(){
        $props = Property::find()->all();
        return self::forProps($props);
    }

    /**
     * @param $code The short code of an US state; for example: AL, GA
     * @return A string of keywords.
     */
    public static function forStateC($code) {
        $props = Property::find()->where(['state'=>$code])->all();
        return self::forProps($props);
    }

    /**
     * @param $stateName The name of an US state; for example: Alabama, Georgia
     * @return A string of keywords.
     */
    public static function forState($stateName) {
        return self::forStateC(UsStates::ntoc($stateName));
    }

    /**
     * @param $stateName A property type name, for example Commercial.
     * @return A string of keywords.
     */
    public static function forType($typeName) {
        $typeId = PropertyType::findOne(['typeName'=>$typeName])->typeId;
        $props = Property::find()->innerJoinWith('propertyTypeMaps')->where(['typeId'=>$typeId])->all();
        return self::forProps($props);
    }
}