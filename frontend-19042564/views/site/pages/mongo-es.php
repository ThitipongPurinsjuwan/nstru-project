<?


$data = array("https://my.api.mockaroo.com/5_access_logs5001-5300data3.json");

// https://my.api.mockaroo.com/5_access_logs5001-5300data3.json?key=b39012f0
for($i=0; $i<count($data); $i++){

        // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $data[$i]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


        $headers = array();
        $headers[] = 'X-Api-Key: b39012f0';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        var_dump(json_decode($result, true));
        curl_close($ch);
}

?>

######################### 

http://http://119.59.113.234/:9200/products_slo_development_temp_2/productModel/_bulk
{"index": {"_index": "textxdb", "_id": "975463711"}}
{"RequestedCountry":"slo","Id":1860,"Title":"Stol"} 
{"index": {"_index": "textxdb", "_id": "975463711"}}
{"RequestedCountry":"slo","Id":1860,"Title":"Miza"} 
