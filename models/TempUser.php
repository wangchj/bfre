<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TempUsers".
 *
 * @property integer $userId
 * @property string $email
 * @property string $phash
 * @property string $fname
 * @property string $lname
 * @property string $authKey
 */
class TempUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TempUsers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'phash', 'fname', 'lname', 'authKey'], 'required'],
            [['phash', 'authKey'], 'string'],
            [['email'], 'string', 'max' => 50],
            [['fname', 'lname'], 'string', 'max' => 30],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'email' => 'Email',
            'phash' => 'Password',
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'authKey' => 'Auth Key',
        ];
    }
}
