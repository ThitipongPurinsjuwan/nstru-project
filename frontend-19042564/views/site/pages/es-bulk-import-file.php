<?


    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/

// curl -H "content-type: application/json"  -u elastic:changeme  -XPOST "http://localhost:9200/textxdb/acccess_log/_bulk?pretty" --data-binary "@test-data.json"

//curl -H "content-type: application/json"  -u elastic:changeme  -XPOST "http://119.59.113.234:9200/textxdb/acccess_log/_bulk?pretty" --data-binary "@https://my.api.mockaroo.com/5_access_logs5001-5300data3.json?key=b39012f0"

// https://my.api.mockaroo.com/5_access_logs5001-5300data3.json?key=b39012f0

    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://119.59.113.234:9200/textxdb/acccess_log/_bulk?pretty');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = array(
    'file' => '@' .realpath('test-data.json')
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_USERPWD, 'elastic' . ':' . 'changeme');

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

?>