<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;
/**
 * This is the model class for table "file_list".
 *
 * @property int $id
 * @property string $download_name
 * @property string $file_name
 * @property int $type
 */
class FileList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    // public $upload_foler ='../../deposit_files';
    public static function tableName()
    {
        return 'file_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['download_name','date_create'], 'required'],
            [['type'], 'integer'],
            [['download_name'], 'string', 'max' => 100],
            [['file_name'], 'string', 'max' => 150],
            // [['file_name'], 'file',
            // 'skipOnEmpty' => true,
            // ],
        //     [['cover_images'], 'file',
        //     'skipOnEmpty' => true,
        //     'extensions' => 'png,jpg,jpeg'
        // ],
        [['date_create'], 'string', 'max' => 30],

    ];
}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'download_name' => 'ชื่อลิงค์วิดีโอ',
            'file_name' => 'ลิงค์',
            'type' => 'ประเภท',
            'date_create' => 'วันที่ฝาก',
            // 'cover_images' => 'รูปปกไฟล์'
        ];
    }

//     public function upload($model,$attribute)
//     {
//         $photo  = UploadedFile::getInstance($model, $attribute);
//         $path = $this->getUploadPath();
//         if ($this->validate() && $photo !== null) {

//             $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
//             //$fileName = $photo->baseName . '.' . $photo->extension;
//             if($photo->saveAs($path.$fileName)){
//               return $fileName;
//           }
//       }
//       return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
//   }

//    public function upload_cover($model,$attribute)
//     {
//         $photo  = UploadedFile::getInstance($model, $attribute);
//         $path = $this->getUploadPath();
//         if ($this->validate() && $photo !== null) {

//             $fileName = md5($photo->baseName.time()) . '.' . $photo->extension;
//             //$fileName = $photo->baseName . '.' . $photo->extension;
//             if($photo->saveAs($path.$fileName)){
//               return $fileName;
//           }
//       }
//       return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
//   }

//   public function getUploadPath(){
//       return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
//   }

//   public function getUploadUrl(){
//       return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
//   }
}
