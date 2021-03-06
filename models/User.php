<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Users".
 *
 * @property integer $userId
 * @property string $email
 * @property string $phash
 * @property string $fname
 * @property string $lname
 * @property string $authKey
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Users';
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne(['userId'=>$id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
