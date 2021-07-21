<?
    use app\models\Pages;
    use app\models\Setting;
    $id = isset($_GET['id']) ? $_GET['id'] : '1';

    $customer_iframe = Pages::find()->where(['id' => $id])->one()->iframe;
    $customer_name = Pages::find()->where(['id' => $id])->one()->page_name;

    $customer_iframe = str_replace('{url_kibana}',$Setting = Setting::find()->where(['setting_name' => 'url_kibana'])->one()->setting_value,$customer_iframe);

echo '<h3>'.$customer_name.'</h3>';   
echo '<div class="card  card-maroon "><div class="">'.$customer_iframe.'</div></div>';
?>
