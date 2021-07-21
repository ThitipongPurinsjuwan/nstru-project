<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property int $notification_type
 * @property string $topic
 * @property string $content
 * @property string $date_time
 * @property string $user
 * @property string $user_accept
 * @property int $read_news
 * @property string $link
 * @property int $notification_by
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_type', 'topic', 'content', 'date_time', 'user', 'user_accept', 'link', 'notification_by'], 'required'],
            [['notification_type', 'notification_by'], 'integer'],
            [['date_time'], 'safe'],
            [['topic'], 'string', 'max' => 150],
            [['content'], 'string', 'max' => 400],
            [['read_news', 'user' ,'user_accept'], 'string'],
            [['link'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'notification_type' => Yii::t('app', 'ประเภท'),
            'topic' => Yii::t('app', 'หัวข้อ'),
            'content' => Yii::t('app', 'เนื้อหา'),
            'date_time' => Yii::t('app', 'วันเวลาที่ส่ง'),
            'user' => Yii::t('app', 'ผู้รับ'),
            'user_accept' => Yii::t('app', 'ผู้รับทราบแล้ว'),
            'read_news' => Yii::t('app', 'ผู้รับอ่านแล้ว'),
            'link' => Yii::t('app', 'ลิงค์'),
            'notification_by' => Yii::t('app', 'แจ้งเตือนจาก'),
        ];
    }
}
