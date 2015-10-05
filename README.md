FingerPushSTSinPHP
=======
PHP에서 Fingerpush Server to Server API를 쉽게 사용하기위한 Class.


##설치하기
소스를 다운받아 압축을 풀어 원하는곳에 위치하고 소스에 포함시킵니다

#####Example
``` php
require_once ('Fingerpush/autoload.php');
```


##사용하기
###기본 설정
기본 앱정보를 설정합니다.

+ `appkey` 발급받은 Appkey
+ `appsecret` 발급받은 AppSecret
+ `customerkey` 발급 받은 customer key

각 키는 [핑거푸시홈페이지](https://www.fingerpush.com/)에서 발급가능하며, `customerkey`는 Pro이상의 서비스에 가입하여야 발급가능합니다.

#####Example
``` php
$key = array (
		'appkey' => '발급받은 App key',
		'appsecret' => '발급받은 AppSecret',
		'customerkey' => '발급받은 Customer key'
);

$fp = new Fingerpush\Fingerpush ( $key );
```


###옵션 설정

Option | Type | Default | Description
------ | ---- | ------- | -----------
msg | string | Y | 발송할 푸시 메시지
identity | array |  | 푸시 메시지 수신 대상. 값이 없으면 일괄 발송
Massage | array |  | 발송할 푸시 메시지. identity와 동일한 크기여야하며, 값이 없으면 msg로 발송
isa | string | Y | 안드로이드를 사용하는 대상폰 발송
abdg | string | | 푸시 수신 안드로이 사운드
asnd | string | | 안드로이드 푸시 배지 처리 파라미터
isi | string | Y | IOS를 사용하는 대상폰 발송
ibdg | string | | IOS 푸시 배지 처리 파라미터
isnd | string | | IOS 푸시 사운드 처리 파라미터
ck1 | string | | 커스텀 키 1 (App 개발 시 반영 된 값)
ck2 | string | | 커스텀 키 2 (App 개발 시 반영 된 값)
ck3 | string | | 커스텀 키 3 (App 개발 시 반영 된 값)
cv1 | string | | 커스텀 값 1 (App 개발 시 반영 된 값)
cv2 | string | | 커스텀 값 2 (App 개발 시 반영 된 값)
cv3 | string | | 커스텀 값 3 (App 개발 시 반영 된 값)
link | string | | web link URL
fnm | string | | 첨부이미지 파일 링크 URL
mode | string | DEFT | DEFT 일반 푸시 메시지 / LNGT 내용이 많은 long text push
lngt_message | string | | long text message
send_state | string | 0001 | 0001 바로 발송 / 0002 예약발송
senddate | string | | 예약발송인 경우 예약 발송일 ex) yyyymmdd24hmin -> 201409172113
tag | string | | 메시지 발송 tag

####일괄 발송
앱을 사용하는 모든 사용자에게 동일한 메시지를 발송합니다. 발송하고자 하는 메시지를 `msg`에 담아 전달합니다.
#####Example
``` php
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
```
####다수의 대상자 발송
다수의 사용자에게 메시지를 전송할 경우, 데이터 베이스나 리스트의 사용자 목록을 `identity`에 배열로 담아 전달합니다.
사용자에게 가기 다른 메시지를 전달하고자 할 경우, `identity`배열과 동일한 크기로 배열에 담아 `message`에 전달합니다.
`message`의 값이 없는 경우, `msg`의 값으로 모두 동일한 메시지가 전송됩니다.
#####Example
``` php
$arrayUser = array();
$arrayMessage = array();

for ($i=0; $i<=5000; $i++){
	$arrayUser[$i] = 'user_'.$i;
	$arrayMessage[$i] = $arrayUser[$i].'님 안녕하세요. 핑거푸시입니다.';
}

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
```


###발송 하기
간단히 `sendPush`함수만으로 발송할 수 있습니다.

#####Example
``` php
$response = $fp->sendPush ();
```


###발송 결과
발송을 완료하면 JSON으로 결과를 받을 수 있습니다.
Response Key | Description
------------ | ----------- 
result | 결과 코드
msgIdx | 메시지 번호
processCode | 메시지 처리 단계
Message | 결과 메시지

#####Example
```js
{“result” : “200”, “msgIdx” :  “A1DS33DDSQ2321”, “processCode” : “20001”, “message” : “메시지 등록이 처리되었습니다. 발급받은 메시지 아이디로 대상자 등록을 시작해 주세요.”}
```

####result code
코드 | 내용 | 비고
---- | ---- | ----
200 | 정상처리 됨 | 
503 | 필수 값이 누락됨 | Message 에 누락된 필수값 표시 됨
4031 | 유효하지 않은 appkey 혹은 appsecret | 
4032 | 서비스 이용권한 없음 | 
500 | 서버에러 | 
504 | 발송 대상 처리 중 에러 | 발송 대상 데이터 확인

####processCode code
코드 | 내용 | 비고
---- | ---- | ----
20001 | 푸시 메시지 등록 정상 처리 | 메시지 아이디가 반환됨.
20002 | 발송대상자 등록 정상 처리 | 
20003 | 푸시 메시지 등록 완료 | 
