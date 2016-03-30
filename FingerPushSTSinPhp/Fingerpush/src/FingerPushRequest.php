<?php

namespace Fingerpush;

/**
 * API URL을 할당하고 발송하는 클래스
 *
 * @author DK
 *        
 */
class FingerpushRequest {
	
	/**
	 * @const sting 한번 발송되는 최대값
	 */
	const SEND_ONCE_COUNT = 500;
	
	/**
	 * @const string 
	 */
	const SEND_DOMAIN = 'https://fingerpush2.kissoft.biz:10443'; // test
	//const SEND_DOMAIN = 'https://www.fingerpush.com'; // live
	
	///////////////////////////////////////
	/* [PHP 5.6.0 이상에서만 사용하세요.] */
	/* PHP 5.6.0 이하에서는 아래 내용을 주석처리 후 */
	/* PHP 5.6.0 이하 버전용 소스의 주석(//로 숨겨진 라인)을 풀고 사용하세요. */
	///////////////////////////////////////
	/**
	 * @const string 일괄 발송 API URL
	 */
	const SEND_TARGET_URL = self::SEND_DOMAIN.'/rest/sts/v1/setFingerPush.jsp';
	
	/**
	 * @const string 단일 발송 API URL
	 */
	const SEND_TARGET_ONE_URL = self::SEND_DOMAIN.'/rest/sts/v1/setSTSpush.jsp';
	
	/**
	 * @const string 다수 발송(최대 발송 건수 이하) API URL
	 */
	const SEND_TARGET_UNDER_MAX_URL = self::SEND_DOMAIN.'/rest/sts/v1/setSTSPushs.jsp';
	
	/**
	 * @const string 다수 발송(최대 발송 건수 이상) API URL
	 */
	const SEND_TARGET_OVER_MAX_URL = self::SEND_DOMAIN.'/rest/sts/v1/setSTSPushs.jsp';
	///////////////////////////////////////
	
	///////////////////////////////////////
	/* [PHP 5.6.0 이하에서만 사용하세요.] */
	/* PHP v5.6.0 이하에서는 위의 내용을 주석처리 후 */
	/* 아래 주석(//로 숨겨진 라인)을 풀고 사용하세요. */
	///////////////////////////////////////
	/**
	 * @const string 일괄 발송 API URL
	 */
	// public function SEND_TARGET_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v1/setFingerPush.jsp';
	// }
	 
	/**
	 * @const string 단일 발송 API URL
	 */
	// public function SEND_TARGET_ONE_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v1/setSTSpush.jsp';
	// }
	 
	/**
	 * @const string 다수 발송(최대 발송 건수 이하) API URL
	 */
	// public function SEND_TARGET_UNDER_MAX_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v1/setSTSPushs.jsp';
	// }
	 
	/**
	 * @const string 다수 발송(최대 발송 건수 이상) API URL
	 */
	// public function SEND_TARGET_OVER_MAX_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v1/setSTSPushs.jsp';
	// }
	///////////////////////////////////////
	
	/**
	 *
	 * @var FingerpushApp
	 */
	protected $app;
	
	/**
	 *
	 * @var FingerpushClient
	 */
	protected $client;
	
	/**
	 *
	 * @var string 발송 종료
	 */
	protected $isfinish;
	
	/**
	 *
	 * @var string
	 */
	protected $apiUrl;
	
	/**
	 *
	 * @param FingerpushApp $app        	
	 * @param FingerpushClient $client        	
	 *
	 * @return string
	 */
	public function __construct(FingerpushApp $app, FingerpushClient $client) {
		$this->app = $app;
		$this->client = $client;
		$this->apiUrl = $this->getApiUrl ();
	}
	
	///////////////////////////////////////
	/* [PHP 5.6.0 이상에서만 사용하세요.] */
	/* PHP 5.6.0 이하에서는 아래 내용을 주석처리 후 */
	/* PHP 5.6.0 이하 버전용 소스의 주석(//로 숨겨진 라인)을 풀고 사용하세요. */
	///////////////////////////////////////
	/**
	 * itentity의 개수에 따라 URL 할당
	 *
	 * @param FingerpushClient $client        	
	 * @return string
	 */
	public function getApiUrl() {
		$identity = $this->client->getIdentity ();
		if (! count($identity) ) {
			return static::SEND_TARGET_URL;
		} else if (count($identity) < self::SEND_ONCE_COUNT) {
			return static::SEND_TARGET_UNDER_MAX_URL;
		} else {
			return static::SEND_TARGET_OVER_MAX_URL;
		}
	}
	///////////////////////////////////////
	
	///////////////////////////////////////
	/* [PHP 5.6.0 이하에서만 사용하세요.] */
	/* PHP v5.6.0 이하에서는 위의 내용을 주석처리 후 */
	/* 아래 주석(//로 숨겨진 라인)을 풀고 사용하세요. */
	///////////////////////////////////////	
	/**
	 * itentity의 개수에 따라 URL 할당
	 *
	 * @param FingerpushClient $client        	
	 * @return string
	 */
	// public function getApiUrl() {
	// 	$identity = $this->client->getIdentity ();
	// 	if (! count($identity) ) {
	// 		return static::SEND_TARGET_URL();
	// 	} else if (count($identity) < self::SEND_ONCE_COUNT) {
	// 		return static::SEND_TARGET_UNDER_MAX_URL();
	// 	} else {
	// 		return static::SEND_TARGET_OVER_MAX_URL();
	// 	}
	// }
	///////////////////////////////////////
	
	/**
	 *
	 * @return multitype:string
	 */
	public function setParamIdentity(){
		$identity = $this->client->getIdentity();
		$paramIdentity = array();
	
		if ($identity){
			$chunkIdentitys = array_chunk ( $identity, self::SEND_ONCE_COUNT );
	
			$idx = 0;
			foreach ($chunkIdentitys as $chunkIdentity){
				$i = 0;
				$count = count($chunkIdentity);
				$paramIdentity[$idx] = '';
				foreach ($chunkIdentity as $item){
					$paramIdentity[$idx] .= 'identity=' . $item;
					if($i < $count - 1){
						$paramIdentity[$idx] .= '&';
					}
					$i++;
				}
				$idx++;
			}
	
		}
	
		return $paramIdentity;
	}
	
	/**
	 *
	 * @return multitype:string
	 */
	public function setParamMessage(){
		$message = $this->client->getMessage();
		$paramMessage = array();
	
		if ($message){
			$chunkMessages = array_chunk ( $message, self::SEND_ONCE_COUNT );
	
			$idx = 0;
			foreach ($chunkMessages as $chunkMessage){
				$i = 0;
				$count = count($chunkMessage);
				$paramMessage[$idx] = '';
				foreach ($chunkMessage as $item){
					$paramMessage[$idx] .= 'message=' . $item;
					if($i < $count - 1){
						$paramMessage[$idx] .= '&';
					}
					$i++;
				}
				$idx++;
			}
	
		}
	
		return $paramMessage;
	}
	
	/**
	 *
	 * @return string|mixed
	 */
	public function request() {
		$identity = $this->client->getIdentity ();
		$message = $this->client->getMessage();
		$key = $this->app->getkey ();
		$msg = array('msg' => $this->client->getMsg()); // msg 세팅
		$options = $this->client->getOptions (); // 기타옵션 세팅
		$url = $this->apiUrl;
		
		if (! count($identity)) { // 일괄발송
			$data = array_merge ( $key, $msg, $options ); // 세팅 데이터 합치기
			$param = http_build_query ( $data, '', '&' ); // 파라메터 생성
			
			$response = $this->curl ( $url, $param ); // url 전달
			$result = json_decode ( $response, true );
			
			$return = array_merge ( $result, array( 'param'=>$data )); //test
			
		} else { // 타겟발송 (동일 메시지, 다른 메시지)
			
			// step 01 : msg 전달하고 msgidx 받아오기
			$data = array_merge ( $key, $msg, $options ); // 세팅 데이터 합치기
			$param = http_build_query ( $data, '', '&' ); // 파라메터 생성
			
			$response = $this->curl ( $url, $param ); // url 전달
			$result = json_decode ( $response, true );
			$msgidx = $result['msgIdx'];
 
			$return['step01'] = array_merge ( $result, array( 'param'=>$param )); //test
			
			
			// step 02 : identity와 message 전달
			if ($result['result'] == 200 && $result['processCode'] == 20001) {
				$data = array_merge ( $key, array('msgidx' => $msgidx) );
				$paramIdentitys = $this->setParamIdentity();
				$paramMessages = $this->setParamMessage();
				
				$i = 0;
				foreach ($paramIdentitys as $paramIdentity){
					$param = http_build_query ( $data, '', '&' );
					$param .= '&' . $paramIdentity;
					
					if($paramMessages && $paramMessages[$i]){ // 다른 메시지 발송
						$param .= '&' . $paramMessages[$i];
					}
					
					$response = $this->curl ( $url, $param ); // url 전달
					$result = json_decode ( $response, true );
					
					$return['step02'][$i] = array_merge ( $result, array( 'param'=>$param )); //test
					$i++;
				}

			}
			
			// step 03 : isfinish 전달
			if ($result['result'] == 200 && $result['processCode'] == 20002) {
				$data = array_merge ( $key, array('msgidx' => $msgidx, 'isfinish' => 'Y') );
				$param = http_build_query ( $data, '', '&' );
				
				$response = $this->curl ( $url, $param ); // url 전달
				$result = json_decode ( $response, true );
				
				$return['step03'] = array_merge ( $result, array( 'param'=>$param )); //test
			}
			
		}
		
		return $return;
	}
	
	/**
	 *
	 * @param string $url        	      	
	 * @param string $param        	
	 *
	 * @return string|mixed
	 */
	public function curl($url, $param) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt ( $ch, CURLOPT_SSLVERSION, 3 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		return $response;
	}
}
