<?php

use app\models\TypePlace;
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../vendor/yiisoft/yii2/Yii.php';
require __DIR__ . '/../../common/config/bootstrap.php';
require __DIR__ . '/../config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../../common/config/main-local.php',
    require __DIR__ . '/../config/main.php',
    require __DIR__ . '/../config/main-local.php'
);

(new yii\web\Application($config))->run();

date_default_timezone_set("Asia/Bangkok");


function DateThai($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear";
}

function DateThaiTime($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
}

function getList($group,$table,$id,$name)
{
	$List = "";
	$arr = array();
	$group = str_replace("[","",$group);
	$group = str_replace("]","",$group);

	$connection=Yii::$app->db;
	$sql = "select $id,$name from $table where $id IN (".$group.");";
	$dataReader=$connection->createCommand($sql)->query();
	$dataReader->bindColumn(1,$id_ls);
	$dataReader->bindColumn(2,$name_ls);
	$i = 0;
	while($dataReader->read()!==false){
		if($i==0) $List = $name_ls;
		else $List = $List.",  ".$name_ls;
		$i++;
	}

	return $List;

}

function getList2($group,$table,$id,$name,$dbname)
{
	$List = "";
	$arr = array();
	$group = str_replace("[","",$group);
	$group = str_replace("]","",$group);
	$group = str_replace('"',"'",$group);

	$connection=Yii::$app->$dbname;
	$sql = "select $id,$name from $table where $id IN (".$group.");";
	$dataReader=$connection->createCommand($sql)->query();
	$dataReader->bindColumn(1,$id_ls);
	$dataReader->bindColumn(2,$name_ls);
	$i = 0;
	while($dataReader->read()!==false){
		if($i==0) $List = $name_ls;
		else $List = $List.", ".$name_ls;
		$i++;
	}

	return $List;

}

function minus_minute($date_start,$date_end,$time_start,$time_end)
{
	$start_date = new DateTime("$date_start $time_start", new DateTimeZone('Asia/Bangkok'));
	$end_date = new DateTime("$date_end $time_end", new DateTimeZone('Asia/Bangkok'));
	$interval = $start_date->diff($end_date);
	$hours = $interval->format('%h');
	$minutes = $interval->format('%i');

	$hours_s = $start_date->format('h');
	$hours_e = $end_date->format('h');
	$total = $hours_s - $hours_e;

	if ($total >= 0) {
		$to_minutes = $minutes;
	}else{
		$to_minutes = -$minutes;
	}

	return $to_minutes;
}


function getTextColour($hex){
    list($red, $green, $blue) = sscanf($hex, "#%02x%02x%02x");
    $luma = ($red + $green + $blue)/3;

    if ($luma < 150){
      $textcolour = "#FFFFFF";
  }else{
    $textcolour = "#000000";
}
return $textcolour;
}

function sksort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}


function titlePlace($type){
//    $arrtitle = array(
// 	   1=>"แหล่งท่องเที่ยวเชิงเกษตร",
// 	   2=>"ร้านอาหาร",
// 	   3=>"ที่พัก",
//    );

   $query = TypePlace::find()
	->where(['id'=>$type])->one();
	return $query->name;
}

function titleNews($type){
   $arrtitle = array(
	   1=>"ข่าวประชาสัมพันธ์",
	   2=>"ข้อควรรู้สำหรับนักท่องเที่ยว (infographic)",
   );
return $arrtitle[$type];
}


function getcolor($v) {
    $color = ["66BB6A","F39C11","26C6DA","963B98","AB3773","77C7BF","BFBAAC","8776AC","382F36","E67F4C","498074",
    "946E63","4F565E","D3BF9A","69758C","5A666A","CAD7DE","3F9E8D","D1D1C2","4E6680","B5C2A1","F2D4B9","E6DEC8","D1CFC2","BCC2BE"];
    return "#".$color[$v];
 }
 
 function getContrastColor($hexcolor) 
 {               
     $r = hexdec(substr($hexcolor, 1, 2));
     $g = hexdec(substr($hexcolor, 3, 2));
     $b = hexdec(substr($hexcolor, 5, 2));
     $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
     return ($yiq >= 200) ? 'black' : 'white';
 }   