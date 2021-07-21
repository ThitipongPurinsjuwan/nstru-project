<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "remember_words".
 *
 * @property int $id รหัสรายการ
 * @property string $keyword คำที่จำไว้
 * @property string $tag tag ของคำที่จำได้
 */
class RememberWords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'remember_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keyword', 'tag'], 'required'],
            [['keyword', 'tag'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสรายการ'),
            'keyword' => Yii::t('app', 'คำที่จำไว้'),
            'tag' => Yii::t('app', 'tag ของคำที่จำได้'),
        ];
    }
}
