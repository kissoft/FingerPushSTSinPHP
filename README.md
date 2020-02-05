# FingerPushSTSinPHP
=======
PHP에서 Fingerpush Server to Server API를 쉽게 사용하기위한 Class.


## 설치하기
소스를 다운받아 압축을 풀어 Fingerpush폴더를 적당한 곳에 위치하고 자신의 소스에 포함시킵니다.

## Example
``` php
require_once ('Fingerpush/autoload.php');
```

## ※PHP 5.3.0 이하 버전
PHP_5.3.0 폴더 안에 파일을 사용해 주세요. (PHP 5.2.12 버전까지 호환 확인)

## ※PHP 5.6.0 버전
PHP_5.6.0 폴더 안에 파일을 사용해 주세요. (PHP 5.6.40 버전까지 호환 확인)

## ※PHP 7.2.0 이상 버전
PHP_7.2.0 폴더 안에 파일을 사용해 주세요. (PHP 7.3.13 버전까지 호환 확인)

### 각 버전에 맞는 폴더를 적용 하시면 됩니다.


## 사용하기
###기본 설정

기본 앱 정보를 세팅하고 사용을 위해 클레스를 선언합니다.

+ `appkey` 발급받은 Appkey
+ `appsecret` 발급받은 AppSecret
+ `customerkey` 발급 받은 customer key

각 키는 [핑거푸시홈페이지](https://www.fingerpush.com/)에서 발급가능하며, `customerkey`는 Pro이상의 서비스에 가입하여야 발급가능합니다.

## Example
``` php
$key = array (
	'appkey' => '발급받은 App key',
	'appsecret' => '발급받은 AppSecret',
	'customerkey' => '발급받은 Customer key'
);

$fp = new Fingerpush\Fingerpush ( $key );
```


## 옵션 설정

발송을 위한 옵션을 세팅합니다.
필요한 옵션을 세팅하고 배열로 담아 `setParam`함수에 전달합니다.

Option | Type | Default | Description
------ | ---- | ------- | -----------
msg | string |  | 발송할 푸시 메시지
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
link | string | | 링크 URL 
fnm | string | | 첨부이미지 파일 링크 URL
mode | string | DEFT | DEFT : 일반 푸시 메시지 / LNGT : 내용이 많은 long text push
lngt_message | string | | long text message
send_state | string | 0001 | 0001 : 바로 발송 / 0002 : 예약발송
senddate | integer | | 예약발송인 경우 예약 발송일. ex) yyyymmdd24hmin -> 201409172113
tag | string | | 발송 tag. 쉼표(,  ) 로 구분. ex) 서울,대전,대구,부산
beschmode | string | 0001 | 태그 발송 시 조건. 0001 : or / 0002 : and
title | string | | 푸시 수신 시 메시지 용 제목
lcode | string | | 라벨 코드
bgcolor | string | | 배경색 ex) #FFFFFF
fcolor | string | | 폰트색상 ex) #000000
isetiquette | string | Y | 에티켓 시간 적용 여부 (Y – 적용 (Default), N- 적용안함)
etiquette_stime | integer | 21 | 에티켓 적용 시작시간 (Number type (1~ 24 : default 21))
etiquette_etime | integer | 8 | 에티켓 적용 종료시간 (Number type (1~24 : default 8))
and_priority | string | M | 안드로이드용 메시지 우선순위 (H : 높음, M 중간(default))
optagree | string | 0000 | 0000 : default, 광고 수신 동의 여부에 관계없이 푸시 수신자 모두에게 발송. 1000 : 광고수신 동의한 디바이스에만 메시지 발송


## 일괄 발송
앱을 사용하는 모든 사용자에게 동일한 메시지를 발송합니다. 발송하고자 하는 메시지를 `msg`에 담아 전달합니다.
###Example
``` php
$param = array (
	'msg' => '일괄발송 테스트',
	// 'title' => '', 
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
	// 'mode' => 'DEFT',
	// 'lngt_message' => '',
	// 'send_state' => '',
	// 'senddate' => '',
	// 'tag' => '',
	// 'beschmode' => '0001',
	// 'bgcolor' => '#ffffff',
	// 'fcolor' => '#000000',
	// 'lcode' => '',
	// 'isetiquette' => 'Y',
	// 'etiquette_stime' => '21',
	// 'etiquette_etime' => '8',
	// 'and_priority' => 'M',
	// 'optagree' => '0000'
);

$fp -> setParam($param);
```

## 다수의 대상자 발송
다수의 사용자에게 메시지를 전송할 경우, 데이터 베이스나 리스트의 사용자 목록을 `identity`에 배열로 담아 전달합니다.
사용자에게 가기 다른 메시지를 전달하고자 할 경우, `identity`배열과 동일한 크기로 배열에 담아 `message`에 전달합니다.
`message`의 값이 없는 경우, `msg`의 값으로 모두 동일한 메시지가 전송됩니다.
### Example
``` php
$arrayUser = array();
$arrayMessage = array();

for ($i=0; $i<=5000; $i++){
	$arrayUser[$i] = 'user_'.$i;
	$arrayMessage[$i] = $arrayUser[$i].'님 안녕하세요. 핑거푸시입니다.';
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

$fp->setParam ( $param );
```


## 발송 하기
간단히 `sendPush`함수만으로 발송할 수 있습니다.

### Example
``` php
$response = $fp->sendPush ();
```


## 발송 결과
발송을 완료하면 JSON으로 결과를 받을 수 있습니다.

Response Key | Description
------------ | ----------- 
result | 결과 코드
msgIdx | 메시지 번호
processCode | 메시지 처리 단계
Message | 결과 메시지

## result code
코드 | 내용 | 비고
---- | ---- | ----
200 | 정상처리 됨 | 
503 | 필수 값이 누락됨 | Message 에 누락된 필수값 표시 됨
4031 | 유효하지 않은 appkey 혹은 appsecret | 
4032 | 서비스 이용권한 없음 | 
500 | 서버에러 | 
504 | 발송 대상 처리 중 에러 | 발송 대상 데이터 확인

## processCode code
코드 | 내용 | 비고
---- | ---- | ----
20001 | 푸시 메시지 등록 정상 처리 | 메시지 아이디가 반환됨.
20002 | 발송대상자 등록 정상 처리 | 
20003 | 푸시 메시지 등록 완료 | 

## Example
```js
{“result” : “200”, “msgIdx” :  “A1DS33DDSQ2321”, “processCode” : “20001”, “message” : “메시지 등록이 처리되었습니다. 발급받은 메시지 아이디로 대상자 등록을 시작해 주세요.”}
```


