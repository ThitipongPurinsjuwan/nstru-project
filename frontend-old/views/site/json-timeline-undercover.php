<?php 
use app\models\Unit;
use app\models\undercover;
use app\models\EformTemplate;
use app\models\EformData;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, x-xsrf-token');
header('Content-Type: application/json');


$id = $_GET['id'];

$i=1;

 $history = array();
                     $eform_template =  EformTemplate::find()->where(["disable" => '0' ,'approve_type' => [1, 2]])->All(); 
                                $showeform_template = '';
                                foreach ($eform_template as $value) {
                                   
                             
                                $eform_data =  EformData::find()->where(["eform_id" => $value['id']])->All(); 
                                // $showeform_template = '';
                                foreach ($eform_data as $row) {
                                    $data_edata = @json_decode($row['data_json'],TRUE);
                                    $val_eform = $data_edata[0];
                                    // var_dump($val_eform);
                                    // if ($val_eform['undercover_name'] == $id ) :
                               
                                   
                           
                        
                                   

                                    // foreach ($val_eform as $hit) {

                                        $undercover = undercover::find()->where(["name" => $id])->One();
                                        $unit = Yii::$app->db->createCommand("SELECT * FROM `unit` WHERE unit_id = '".$undercover['unitid']."'")->queryOne();

                                        $history[] = array(
                                            "date_time" => "".$val_eform['date_record']."",
                                            "user_view" => "".$undercover['name']."",
                                            "unit_name" => "".$unit['unit_name']."",
                                            "action" => "".$val_eform['topic']."",
                                            "img_user" => "../../frontend/web/uploads/".$undercover['images']."",
                                            "date_thai" => "".dateThai($val_eform['date_record']).""
                                        );
                                    // }

                                    $i++;
                                    // else  :
                                    //     echo  'ไม่มีข้อมูล';
                                    // endif
                                  }  
                                }

	
	//var_dump($history);

 	echo $someJSON = json_encode($history);



?>