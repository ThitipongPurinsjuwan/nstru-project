<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';

echo '<h1>Parse Jane.xlsx</h1><pre>';
if ( $xlsx = SimpleXLSX::parse('Jane.xlsx') ) {
	print_r( $xlsx->rows());

	// foreach ($xlsx as $i => $row) {
	// 	if ($row[0] and $i > 0) {
	// 		$xlsx[$i][0] = $this->ExcelToPHPObject($row[0])->format('Y-m-d H:i:s');
	// 	}
	// }

} else {
	echo SimpleXLSX::parseError();
}
echo '<pre>';