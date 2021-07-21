<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property int $id
 * @property string $name
 * @property string $date_create
 * @property string $key_images
 * @property int $important
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'key_images', 'important'], 'required'],
            [['name'], 'string'],
            [['important'], 'integer'],
            [['date_create', 'key_images'], 'string', 'max' => 20],
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
            'date_create' => Yii::t('app', 'Date Create'),
            'key_images' => Yii::t('app', 'Key Images'),
            'important' => Yii::t('app', 'Important'),
        ];
    }
}
