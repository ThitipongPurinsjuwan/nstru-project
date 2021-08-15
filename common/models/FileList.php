<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "file_list".
 *
 * @property int $id
 * @property string $download_name
 * @property string $file_name
 * @property int $type
 * @property string $date_create
 * @property string $cover_images
 */
class FileList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'file_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['download_name', 'file_name', 'type', 'date_create', 'cover_images'], 'required'],
            [['type'], 'integer'],
            [['download_name'], 'string', 'max' => 100],
            [['file_name', 'cover_images'], 'string', 'max' => 150],
            [['date_create'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'download_name' => Yii::t('app', 'Download Name'),
            'file_name' => Yii::t('app', 'File Name'),
            'type' => Yii::t('app', 'Type'),
            'date_create' => Yii::t('app', 'Date Create'),
            'cover_images' => Yii::t('app', 'Cover Images'),
        ];
    }
}
