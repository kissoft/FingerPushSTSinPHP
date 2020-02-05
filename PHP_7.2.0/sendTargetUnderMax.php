<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once('FingerPush/autoload.php');

$key = array(
	'appkey' => '발급받은 App key',						// 발급받은 Appkey
	'appsecret' => '발급받은 AppSecret',					// 발급받은 AppSecret
	'customerkey' => '발급받은 Customer key'				// 발급 받은 customer key - Pro 이상의 서비스 사용시
);
 
$fp = new Fingerpush\FingerPush($key);

/**
 * 500건 이하 발송
 */
$param = array(
	'msg' => '500건 이하 발송 테스트',
	'title' => '500건 이하 발송 테스트',
	'identity' => array('user_4000', 'user_333'),
	'message' => array('user_4000 내용', 'user_333 내용'),
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
	// 'fnm' => '',
	// 'link' => '',
	// 'mode' => 'STOS',
	// 'lngt_message' => '',
	// 'send_state' => '0001',
	// 'senddate' => '',
	// 'bgcolor' => '#FFFFFF',
	// 'fcolor' => '#000000',
	// 'lcode' => '',
	// 'isetiquette' => 'Y', 
	// 'etiquette_stime' => '21',
	// 'etiquette_etime' => '8', 
	// 'and_priority' => 'M',
	// 'optagree' => '0000'
);

// 전송할 데이터 세팅
$fp -> setParam($param);

// 푸시 발송
$response = $fp -> sendPush();

// 결과값 프린트
print_r($response);

?>
<html>
<head></head>
<body>
	<p>TEST : send Target Under Max</p>
</body>
</html>