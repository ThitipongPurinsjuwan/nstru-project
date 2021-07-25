<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "public_relations".
 *
 * @property int $id
 * @property string $topic
 * @property string $details
 * @property int $status
 * @property string $date_imparting
 * @property string $key_images
 * @property string $date_create
 * @property int $user_create
 */
class PublicRelations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'public_relations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topic', 'details', 'status', 'date_imparting', 'key_images', 'date_create', 'user_create','type'], 'required'],
            [['details'], 'string'],
            [['status', 'user_create'], 'integer'],
            [['type'], 'string', 'max' => 1],
            [['topic'], 'string', 'max' => 255],
            [['date_imparting', 'key_images', 'date_create'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'type'),
            'topic' => Yii::t('app', 'หัวข้อ'),
            'details' => Yii::t('app', 'รายละเอียด'),
            'status' => Yii::t('app', 'Status'),
            'date_imparting' => Yii::t('app', 'วันที่ประกาศ'),
            'key_images' => Yii::t('app', 'Key Images'),
            'date_create' => Yii::t('app', 'วันที่บันทีึก/แก้ไข'),
            'user_create' => Yii::t('app', 'ผู้บันทีึก/แก้ไข'),
        ];
    }
}
