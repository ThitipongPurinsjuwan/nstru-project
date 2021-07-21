<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification_type".
 *
 * @property int $id
 * @property string $type
 */
class NotificationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'ประเภทการแจ้งเตือน'),
        ];
    }
}
