<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $id_number
 * @property int $id_role
 * @property int $id_image
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property string $password
 *
 * @property Image $image
 * @property Number $number
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_name', 'username', 'email', 'password'], 'required'],
            [['id_number', 'id_role', 'id_image'], 'integer'],
            [['full_name', 'username'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 140],
            [['password'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['id_role'],'default', 'value' => 1],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['id_image'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['id_image' => 'id']],
            [['id_number'], 'exist', 'skipOnError' => true, 'targetClass' => Number::className(), 'targetAttribute' => ['id_number' => 'id']],
            [['id_role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['id_role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_number' => 'Id Number',
            'id_role' => 'Id Role',
            'id_image' => 'Id Image',
            'full_name' => 'Full Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return  User::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'id_image']);
    }

    /**
     * Gets query for [[Number]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNumber()
    {
        return $this->hasOne(Number::className(), ['id' => 'id_number']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'id_role']);
    }


}
