<?php
error_reporting ( E_ALL );
ini_set ( "display_errors", 1 );

require_once ('Fingerpush/autoload.php');

$key = array (
		'appkey' => '발급받은  App key', 							// 발급받은 Appkey
		'appsecret' => '발급받은 AppSecret', 						// 발급받은 AppSecret
		'customerkey' => '발급받은 Customer key' 					// 발급 받은 customer key - Pro 이상의 서비스 사용시
);

$fp = new Fingerpush\Fingerpush ( $key );

/**
 * 500건 이상 발송
 */

$arrayUser = array();
$arrayMessage = array();

for ($i=0; $i<=5000; $i++){
	$arrayUser[$i] = 'user_'.$i;
	$arrayMessage[$i] = $arrayUser[$i].'님 안녕하세요. 핑거푸시입니다.';
}

//$arrayMessage[] .= '에러유발';

$param = array (
		'identity' => $arrayUser,
		'message' => $arrayMessage,
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
	<p>TEST : send Target Over Max</p>
</body>
</html>