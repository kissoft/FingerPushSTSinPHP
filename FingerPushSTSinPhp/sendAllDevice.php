<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", 1 );

require_once ('Fingerpush/autoload.php');

// test
$key = array (
		'appkey' => 'RY4RJM8F9P1WPVF27JO9DW3ZQ9PWZNKS',
		'appsecret' => 'MFU8UzRyLYvooSKkJbHZ3thyoF2auv5P',
		'customerkey' => 'y6LMqQhqSpSS'
);

// live
/*
 $key = array (
 'appkey' => 'DOWEE8ONK9DVTSSBPLTIM5YAT1DH4B62',
 'appsecret' => 'cxWahgzl8oQ6p0fWVnqcnGtsFUIQXwcE',
 'customerkey' => 'rbR4mOl7mFQ9'
 );
*/

$fp = new Fingerpush\Fingerpush ( $key );

/**
 * 일괄발송
 */

$param = array (
		'msg' => '일괄발송 테스트',
		// 'isa' => '',
		// 'abdg' => '',
		// 'asnd' => '',
		// 'isi' => '',
		// 'ibdg' => '',
		// 'isnd' => '',
		// 'ck1' => '',
		// 'ck2' => '',
		// 'ck3' => '',
		// 'cv1' => '',
		// 'cv2' => '',
		// 'cv3' => '',
		// 'fnm' => ''
		//'link' => '',
		//'fnm' => '',
		//'mode' => '',
		//'lngt_message' => '',
		//'send_state' => '',
		//'senddate' => '',
		//'tag' => ''
);

$fp->setParam ( $param );

$response = $fp->sendPush ();
print_r ( $response );


?>
<html>
<head></head>
<body>
	<p>TEST : send All Device</p>
</body>
</html>