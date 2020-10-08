<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "number".
 *
 * @property int $id
 * @property int $id_category
 * @property string $phone
 * @property int $balance
 * @property int $dept
 * @property string $commit
 *
 * @property Category $category
 * @property User[] $users
 */
class Number extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_category', 'phone', 'balance', 'dept', 'commit'], 'required'],
            [['id_category', 'balance', 'dept'], 'integer'],
            [['commit'], 'string'],
            [['phone'], 'string', 'max' => 12],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['id_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_category' => 'Id Category',
            'phone' => 'Phone',
            'balance' => 'Balance',
            'dept' => 'Dept',
            'commit' => 'Commit',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'id_category']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id_number' => 'id']);
    }
}
