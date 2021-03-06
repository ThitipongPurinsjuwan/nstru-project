<?php
use app\models\Setting;
$this->title = 'Timeline';

$url_kibana =  $Setting = Setting::find()->where(['setting_name' => 'url_kibana'])->one()->setting_value;
$url_elasticsearch =  $Setting = Setting::find()->where(['setting_name' => 'url_elasticsearch'])->one()->setting_value;
$index =  $Setting = Setting::find()->where(['setting_name' => 'index'])->one()->setting_value;

$elasticsearch_username =  $Setting = Setting::find()->where(['setting_name' => 'elasticsearch_username'])->one()->setting_value;
$elasticsearch_password =  $Setting = Setting::find()->where(['setting_name' => 'elasticsearch_password'])->one()->setting_value;



$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url_elasticsearch.'/'.$index.'/_search?pretty');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

$query = '{
    "query": {
      "match": {
        "type": "บุคคลเสียชีวิต"
      }
    }
  }';
if(isset($_POST['query'])) $query = $_POST['query'];
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
curl_setopt($ch, CURLOPT_USERPWD, $elasticsearch_username . ':' . $elasticsearch_password);

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
echo ($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>
