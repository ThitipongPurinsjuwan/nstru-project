<?php

namespace common\models;

use Yii;
use \yii\web\UploadedFile;

/**
 * This is the model class for table "type_place".
 *
 * @property int $id
 * @property string $name
 * @property int $status
 * @property string $images
 * @property string $date_create
 * @property int $user_create
 */
class TypePlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
     public $upload_foler ='uploads';
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
            [['images'], 'string'],
             [['name','name_eng'], 'string', 'max' => 255],
            [['status', 'user_create'], 'integer'],
            [['date_create'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'ชื่อประเภท'),
             'name_eng' => Yii::t('app', 'ชื่อประเภท (ภาษาอังกฤษ)'),
            'status' => Yii::t('app', 'สถานะ'),
            'images' => Yii::t('app', 'Icon marker'),
            'date_create' => Yii::t('app', 'วันที่บันทึก/แก้ไข'),
            'user_create' => Yii::t('app', 'ผู้บันทึก/แก้ไข'),
            
            
        ];
    }

      public function upload($model,$attribute)
    {
        //  var_dump($model);
        $photo  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($this->validate() && $photo !== null) {

            $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if($photo->saveAs($path.$fileName)){
              return $fileName;
          }
      }
      return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
  }

  public function getUploadPath(){
      return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
  }

  public function getUploadUrl(){
      return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
  }

  public function getPhotoViewer(){
      return empty($this->images) ? Yii::getAlias('@web').'/img/none.png' : $this->getUploadUrl().$this->images;
  }
}
