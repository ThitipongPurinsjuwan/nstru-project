<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $details
 * @property string $activity
 * @property int $price
 * @property string $contact
 * @property string $business_hours
 * @property string $key_images
 * @property int $amphure
 * @property int $district
 * @property int $province
 * @property string $latitude
 * @property string $longitude
 * @property int $status
 * @property string $date_create
 * @property int $user_create
 */
class Place extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'place';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['type', 'name', 'details', 'activity', 'price', 'contact', 'business_day', 'business_hours',  'amphure', 'district', 'province', 'latitude', 'longitude', 'status', 'date_create', 'user_create'], 'required'],
      [['type', 'price', 'amphure', 'district', 'province', 'status', 'user_create'], 'integer'],
      [['name', 'details', 'activity', 'key_images',], 'string'],
      [['business_day'], 'string', 'max' => 100],
      [['facebook_link', 'line_id', 'phone'], 'string', 'max' => 255],
      [['phone'], 'string', 'max' => 15],
      [['contact', 'business_hours', 'name_img_important'], 'string', 'max' => 150],
      [['latitude', 'longitude', 'date_create'], 'string', 'max' => 20],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('app', 'ID'),
      'type' => Yii::t('app', 'ประเภท'),
      'name' => Yii::t('app', 'ชื่อสถานที่'),
      'details' => Yii::t('app', 'รายละเอียด'),
      'activity' => Yii::t('app', 'กิจกรรม'),
      'price' => Yii::t('app', 'ราคาเริ่มต้น (โดยประมาณ)'),
      'contact' => Yii::t('app', 'ข้อมูลการติดต่อ'),
      'facebook_link' => Yii::t('app', 'Facebook Link'),
      'line_id' => Yii::t('app', 'Line ID'),
      'phone' => Yii::t('app', 'เบอร์ติดต่อ'),
      'business_day' => Yii::t('app', 'วันทำการ'),
      'business_hours' => Yii::t('app', 'เวลาทำการ'),
      'key_images' => Yii::t('app', 'Key Images'),
      'amphure' => Yii::t('app', 'อำเภอ'),
      'district' => Yii::t('app', 'ตำบล'),
      'province' => Yii::t('app', 'จังหวัด'),
      'latitude' => Yii::t('app', 'ละติจูด'),
      'longitude' => Yii::t('app', 'ลองจิจูด'),
      'status' => Yii::t('app', 'สถานะ'),
      'date_create' => Yii::t('app', 'วันที่บันทึก/แก้ไข'),
      'user_create' => Yii::t('app', 'ผู้บันทึก/แก้ไข'),
    ];
  }

  public static function customizePhoneCall($phone)
  {
    $call = substr($phone, 1);

    return '+66' . $call;
  }

  public static function showLess($content)
  {
    $text = strip_tags($content);

    if (strlen($text) > 80) {
      $text = mb_substr($text, 0, 80, 'UTF-8') . "...";
    }

    return $text;
  }

  public static function randomImg()
  {
    $rand = rand(1, 15);
    $name = $rand > 9 ? $rand : '0' . $rand;

    return '../../themes/template/assets/images/avatar/' . $name . '.jpg';
  }

  public static function getOpenDay($day)
  {
    $result = null;
    $workDay = ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์'];
    $weekDay = ['เสาร์', 'อาทิตย์'];

    if (strpos($day, '-')) {

      switch ($day) {
        case 'จ-ศ':
          $result = $workDay;
          break;
        case 'จ-ส':
          $result = array_merge($workDay, $weekDay[0]);
          break;
        case 'ส-อา':
          $result = $weekDay;
          break;

        default:
          break;
      }
    } elseif (strpos($day, ',')) {
      $result = explode(",", $day);
    } elseif ($day == 'ทุกวัน') {
      $result = array_merge($workDay, $weekDay);
    }

    return $result;
  }

  public function getMatchingDay($shortDay, $arrOfDay)
  {
  }

  public static function getOpenHour($hour)
  {
    $text = explode(",", $hour);
    return $text[0] . ' - ' . $text[1] . ' น.';
  }
}
