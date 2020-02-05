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
 * 500건 이상 발송
 */
$arrayUser = array();
$arrayMessage = array();
$arrayImage = array();
$arrayLink = array();
$arrayTitle = array();

for ($i = 0; $i <= 5000; $i++) {
	$arrayUser[$i] = 'user_'.$i;
	$arrayMessage[$i] = $arrayUser[$i].'님 안녕하세요. 핑거푸시입니다.';
	// $arrayImage[$i] = 'https://www.fingerpush.com/sample.jpg';
	// $arrayLink[$i] = 'htts://www.fingerpush.com/';
	// $arrayTitle[$i] = $arrayUser[$i].'님을 위한 맞춤 푸시';
}

/* 타겟 발송시 msg, title값은 핑거푸시 발송이력에 보여질 내용입니다, 개별 발송 정보는 arrTitle, arrMessage값으로 발송됩니다. */
$param = array (
	'msg' => '500건 이상 발송 테스트',
	'title' => '500건 이상 발송 테스트',
	'identity' => $arrayUser,
	'message' => $arrayMessage,
	// 'arrImage' => $arrayImage,
	// 'arrLink' => $arrayLink,
	// 'arrTitle' => $arrayTitle,
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
	// 'etiquette_stime' => '20',
	// 'etiquette_etime' => '8',
	// 'and_priority' => 'M',
	// 'optagree' => '1000'
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
	<p>TEST : send Target Over Max</p>
</body>
</html>