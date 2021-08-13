<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id รหัสรีวิว
 * @property int $place_id รหัสสถานที่
 * @property string $message ข้อความ
 * @property int $rating คะแนน
 * @property string $created_at วันที่บันทึก/แก้ไข
 * @property int $user_create ผู้บันทึก/แก้ไข	
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_id', 'message', 'rating', 'created_at'], 'required'],
            [['place_id', 'rating', 'user_create'], 'integer'],
            [['created_at'], 'safe'],
            [['message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสรีวิว'),
            'place_id' => Yii::t('app', 'รหัสสถานที่'),
            'message' => Yii::t('app', 'ข้อความ'),
            'rating' => Yii::t('app', 'คะแนน'),
            'created_at' => Yii::t('app', 'วันที่บันทึก/แก้ไข'),
            'user_create' => Yii::t('app', 'ผู้บันทึก/แก้ไข	'),
        ];
    }
}
