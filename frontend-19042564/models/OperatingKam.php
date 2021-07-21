<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operating_kam".
 *
 * @property int $id
 * @property string $kam
 * @property string $detail
 */
class OperatingKam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operating_kam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kam', 'detail'], 'required'],
            [['kam'], 'string', 'max' => 50],
            [['detail'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'kam' => Yii::t('app', 'พื้นที่เขต'),
            'detail' => Yii::t('app', 'รายละเอียด'),
        ];
    }
}
