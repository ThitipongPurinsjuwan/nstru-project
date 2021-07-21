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
            [['type', 'name', 'details', 'activity', 'price', 'contact','business_day', 'business_hours',  'amphure', 'district', 'province', 'latitude', 'longitude', 'status', 'date_create', 'user_create'], 'required'],
            [['type', 'price', 'amphure', 'district', 'province', 'status', 'user_create'], 'integer'],
            [['name', 'details', 'activity', 'key_images',], 'string'],
              [['business_day'], 'string', 'max' => 100],
            [['contact', 'business_hours'], 'string', 'max' => 150],
            [[ 'latitude', 'longitude', 'date_create'], 'string', 'max' => 20],
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
            'name' => Yii::t('app', 'ชื่อ'),
            'details' => Yii::t('app', 'รายละเอียด'),
            'activity' => Yii::t('app', 'กิจกรรม'),
            'price' => Yii::t('app', 'ราคาเริ่มต้น (โดยประมาณ)'),
            'contact' => Yii::t('app', 'ข้อมูลการติดต่อ'),
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
}
