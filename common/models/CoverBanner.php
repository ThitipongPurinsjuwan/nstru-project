<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cover_banner".
 *
 * @property int $id รหัส banner
 * @property string $name ชื่อ
 * @property string $image รูป
 * @property string $image_order
 */
class CoverBanner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cover_banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'image', 'image_order'], 'required'],
            [['image', 'image_order'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัส banner'),
            'name' => Yii::t('app', 'ชื่อ'),
            'image' => Yii::t('app', 'รูป'),
            'image_order' => Yii::t('app', 'Image Order'),
        ];
    }
}
