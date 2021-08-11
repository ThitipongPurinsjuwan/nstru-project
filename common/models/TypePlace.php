<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "type_place".
 *
 * @property int $id รหัสประเภทสถานที่
 * @property string $name ชื่อประเภทสถานที่ (ไทย)
 * @property string $name_eng ชื่อประเภทสถานที่ (Eng)
 * @property string $m_icon
 * @property int $status สถานะ
 * @property string $images Icon marker
 * @property string $key_images รหัสเชื่อมโยงรูปภาพกับข้อมูล	
 * @property string|null $name_img_important ชื่อรูปปก
 * @property string $date_create วันที่บันทึก/แก้ไข
 * @property int $user_create ผู้บันทึก/แก้ไข
 */
class TypePlace extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public $upload_foler = 'images/image_maker';
  public static function tableName()
  {
    return 'type_place';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['name', 'status', 'date_create', 'user_create'], 'required'],
      [['status', 'user_create'], 'integer'],
      [['images'], 'string'],
      [['name', 'name_eng'], 'string', 'max' => 255],
      [['m_icon'], 'string', 'max' => 50],
      [['key_images', 'date_create'], 'string', 'max' => 20],
      [['name_img_important'], 'string', 'max' => 150],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => Yii::t('app', 'รหัสประเภทสถานที่'),
      'name' => Yii::t('app', 'ชื่อประเภทสถานที่ (ไทย)'),
      'name_eng' => Yii::t('app', 'ชื่อประเภทสถานที่ (Eng)'),
      'm_icon' => Yii::t('app', 'M Icon'),
      'status' => Yii::t('app', 'สถานะ'),
      'images' => Yii::t('app', 'Icon marker'),
      'key_images' => Yii::t('app', 'รหัสเชื่อมโยงรูปภาพกับข้อมูล	'),
      'name_img_important' => Yii::t('app', 'ชื่อรูปปก'),
      'date_create' => Yii::t('app', 'วันที่บันทึก/แก้ไข'),
      'user_create' => Yii::t('app', 'ผู้บันทึก/แก้ไข'),
    ];
  }

  public function upload($model, $attribute)
  {
    //  var_dump($model);
    $photo  = UploadedFile::getInstance($model, $attribute);
    $path = $this->getUploadPath();
    if ($this->validate() && $photo !== null) {

      $fileName = md5($photo->baseName . time()) . '.' . $photo->extension;
      //$fileName = $photo->baseName . '.' . $photo->extension;
      if ($photo->saveAs($path . $fileName)) {
        return $fileName;
      }
    }
    return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
  }

  public function getUploadPath()
  {
    //   return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
    return '../../images/image_maker/';
  }

  public function getUploadUrl()
  {
    //   return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
    return '../../images/image_maker/';
  }

  public function getPhotoViewer()
  {
    return empty($this->images) ? Yii::getAlias('@web') . '/img/none.png' : $this->getUploadUrl() . $this->images;
  }
}
