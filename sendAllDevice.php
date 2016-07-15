<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", 1 );

require_once ('Fingerpush/autoload.php');

$key = array (
		'appkey' => '발급받은  App key', 							// 발급받은 Appkey
		'appsecret' => '발급받은 AppSecret', 						// 발급받은 AppSecret
		'customerkey' => '발급받은 Customer key' 					// 발급 받은 customer key - Pro 이상의 서비스 사용시
);

$fp = new FingerPush\FingerPush ( $key );

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
		// 'link' => '',
		// 'fnm' => '',
		// 'mode' => '',
		// 'lngt_message' => '',
		// 'send_state' => '',
		// 'senddate' => '',
		// 'tag' => ''
		// 'beschmode' => '0001'
	    // 'title' => '',
	    // 'bgcolor' => '#ffffff',
	    // 'fcolor' => '#000000',
	    // 'lcode' => '',
	    // 'isetiquette' => 'Y',
	    // 'etiquette_stime' => '21',
	    // 'etiquette_etime' => '8',
	    // 'and_priority' => 'M',
	    // 'optagree' => '0000',
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
