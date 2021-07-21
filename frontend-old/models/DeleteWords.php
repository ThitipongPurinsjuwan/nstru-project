<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delete_words".
 *
 * @property int $id รหัสรายการ
 * @property string $word คำที่ลบ
 * @property string $tag Tag ของคำที่ลบ
 */
class DeleteWords extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delete_words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word', 'tag'], 'required'],
            [['word', 'tag'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสรายการ'),
            'word' => Yii::t('app', 'คำที่ลบ'),
            'tag' => Yii::t('app', 'Tag ของคำที่ลบ'),
        ];
    }
}
