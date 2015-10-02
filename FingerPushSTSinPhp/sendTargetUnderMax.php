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
 * 500건 이하 발송
 */

$param = array (
		'msg' => '500건 이하 발송 테스트',
		'identity' => array (
				'user_4000',
				'user_333'
		),
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
);

$fp->setParam ( $param );

$response = $fp->sendPush ();
print_r ( $response );

?>
<html>
<head></head>
<body>
	<p>TEST : send Target Under Max</p>
</body>
</html>