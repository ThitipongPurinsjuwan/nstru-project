<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_place".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $images
 * @property string $date_create
 * @property int $user_create
 */
class TypePlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'images', 'date_create', 'user_create'], 'required'],
            [['name', 'images'], 'string'],
            [['status', 'user_create'], 'integer'],
            [['date_create'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'images' => Yii::t('app', 'Images'),
            'date_create' => Yii::t('app', 'Date Create'),
            'user_create' => Yii::t('app', 'User Create'),
        ];
    }
}
