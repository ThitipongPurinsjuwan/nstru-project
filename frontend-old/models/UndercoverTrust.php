<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "undercover_trust".
 *
 * @property int $id รหัสความน่าเชื่อถือ
 * @property string $trust ความน่าเชื่อถือของสายข่าว
 */
class UndercoverTrust extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'undercover_trust';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trust'], 'required'],
            [['trust'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสความน่าเชื่อถือ'),
            'trust' => Yii::t('app', 'ความน่าเชื่อถือของสายข่าว'),
        ];
    }
}
