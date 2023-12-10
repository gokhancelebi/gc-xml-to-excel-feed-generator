<?php


if ( ! file_exists( __DIR__ . '/feed.xlsx' ) ) {
	echo 'feed.xlsx not found';
	exit;
}

require 'vendor/autoload.php';

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$spreadsheet = $reader->load( __DIR__ . '/feed.xlsx' );
$sheetData   = $spreadsheet->getActiveSheet()->toArray();

// first line is colum names
$columns = $sheetData[0];
$columns = array_filter($columns , function($value) { return $value !== ''; } );
// remove first line
unset( $sheetData[0] );
header( 'Content-type: text/xml' );
// create xml
echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
echo '<items>' . PHP_EOL;

foreach ( $sheetData as $row ) {

	if ($row[0] == ''){
		continue;
	}

	echo '<item>' . PHP_EOL;

	foreach ( $columns as $key => $column_name ) {

		if ($column_name == ''){
			continue;
		}

		echo '<' . $column_name . '>' . PHP_EOL;

		echo '<![CDATA[' . $row[ $key ] . ']]>' . PHP_EOL;
		echo '</' . $column_name . '>' . PHP_EOL;

	}

	echo '</item>' . PHP_EOL;
}
echo '</items>';