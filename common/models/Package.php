<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "package".
 *
 * @property int $id
 * @property string $name
 * @property string $details
 * @property string $date_moment
 * @property string $place
 * @property int $price
 * @property int $status
 * @property string $key_images
 * @property string $date_create
 * @property int $user_create
 */
class Package extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'package';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name', 'details', 'date_moment', 'place', 'price', 'status', 'key_images', 'date_create', 'user_create', 'contact'], 'required'],
      [['details', 'place'], 'string'],
      [['price', 'status', 'user_create'], 'integer'],
      [['name'], 'string', 'max' => 250],
      [['facebook_link', 'line_id', 'phone'], 'string', 'max' => 255],
      [['contact', 'name_img_important'], 'string', 'max' => 150],
      [['date_moment', 'key_images', 'date_create'], 'string', 'max' => 20],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('app', 'ID'),
      'name' => Yii::t('app', 'ชื่อ Package'),
      'details' => Yii::t('app', 'รายละเอียด'),
      'date_moment' => Yii::t('app', 'จำนวนวันสำหรับท่องเที่ยว'),
      'place' => Yii::t('app', 'สถานที่ (แหล่งท่องเที่ยว, ร้านอาหาร, ที่พัก)'),
      'price' => Yii::t('app', 'ราคารวมโดยประมาณ'),
      'status' => Yii::t('app', 'สถานะ'),
      'key_images' => Yii::t('app', 'Key Images'),
      'date_create' => Yii::t('app', 'วันที่บันทึก/แก้ไข'),
      'user_create' => Yii::t('app', 'ผู้บันทึก/แก้ไข'),
      'contact' => Yii::t('app', 'ข้อมูลการติดต่อ'),
      'facebook_link' => Yii::t('app', 'Facebook Link'),
      'line_id' => Yii::t('app', 'Line ID'),
      'phone' => Yii::t('app', 'เบอร์ติดต่อ'),
    ];
  }
}
