<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property int $id
 * @property string $name
 * @property string $details
 * @property string $date_moment
 * @property string $place
 * @property int $price
 * @property int $status
 * @property string $key_images
 * @property string $date_create
 * @property int $user_create
 */
class Package_old extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'package';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'details', 'date_moment', 'place', 'price', 'status', 'key_images', 'date_create', 'user_create'], 'required'],
            [['details', 'place'], 'string'],
            [['price', 'status', 'user_create'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['date_moment', 'key_images', 'date_create'], 'string', 'max' => 20],
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
            'details' => Yii::t('app', 'Details'),
            'date_moment' => Yii::t('app', 'Date Moment'),
            'place' => Yii::t('app', 'Place'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'key_images' => Yii::t('app', 'Key Images'),
            'date_create' => Yii::t('app', 'Date Create'),
            'user_create' => Yii::t('app', 'User Create'),
        ];
    }
}
