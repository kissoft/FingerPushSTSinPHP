<?php

namespace FingerPush;

/**
 * API URL을 할당하고 발송하는 클래스
 *
 * @author DK
 *        
 */
class FingerPushRequest {
	
	/**
	 * @const sting 한번 발송되는 최대값
	 */
	const SEND_ONCE_COUNT = 500;
	
	/**
	 * @const string 
	 */
	const SEND_DOMAIN = 'https://api.fingerpush.com';

	///////////////////////////////////////
	/* [PHP 5.6.0 이상에서만 사용하세요.] */
	/* PHP 5.6.0 이하에서는 아래 내용을 주석처리 후 */
	/* PHP 5.6.0 이하 버전용 소스의 주석(//로 숨겨진 라인)을 풀고 사용하세요. */
	///////////////////////////////////////	
	/**
	 * @const string 일괄 발송 API URL
	 */
	const SEND_TARGET_URL = self::SEND_DOMAIN.'/rest/sts/v3/setFingerPush.jsp';
	
	/**
	 * @const string 단일 발송 API URL
	 */
	const SEND_TARGET_ONE_URL = self::SEND_DOMAIN.'/rest/sts/v3/setSTSpush.jsp';
	
	/**
	 * @const string 다수 발송(최대 발송 건수 이하) API URL
	 */
	const SEND_TARGET_UNDER_MAX_URL = self::SEND_DOMAIN.'/rest/sts/v3/setSTSPushs.jsp';
	
	/**
	 * @const string 다수 발송(최대 발송 건수 이상) API URL
	 */
	const SEND_TARGET_OVER_MAX_URL = self::SEND_DOMAIN.'/rest/sts/v3/setSTSPushs.jsp';
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
	// 	return self::SEND_DOMAIN.'/rest/sts/v3/setFingerPush.jsp';
	// }
	 
	/**
	 * @const string 단일 발송 API URL
	 */
	// public function SEND_TARGET_ONE_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v3/setSTSpush.jsp';
	// }
	 
	/**
	 * @const string 다수 발송(최대 발송 건수 이하) API URL
	 */
	// public function SEND_TARGET_UNDER_MAX_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v3/setSTSPushs.jsp';
	// }
	 
	/**
	 * @const string 다수 발송(최대 발송 건수 이상) API URL
	 */
	// public function SEND_TARGET_OVER_MAX_URL() {
	// 	return self::SEND_DOMAIN.'/rest/sts/v3/setSTSPushs.jsp';
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
	// 		return $this->SEND_TARGET_URL();
	// 	} else if (count($identity) < self::SEND_ONCE_COUNT) {
	// 		return $this->SEND_TARGET_UNDER_MAX_URL();
	// 	} else {
	// 		return $this->SEND_TARGET_OVER_MAX_URL();
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
					$item = $this->chgSpCharater($item);
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
	 * @return multitype:string
	 */
	public function setParamImage(){
		$image = $this->client->getImage();
		$paramImage = array();
	
		if ($image){
			$chunkImages = array_chunk ( $image, self::SEND_ONCE_COUNT );
	
			$idx = 0;
			foreach ($chunkImages as $chunkImage){
				$i = 0;
				$count = count($chunkImage);
				$paramImage[$idx] = '';
				foreach ($chunkImage as $item){
					$item = $this->chgSpCharater($item);
					$paramImage[$idx] .= 'prv_attachfname=' . $item;
					if($i < $count - 1){
						$paramImage[$idx] .= '&';
					}
					$i++;
				}
				$idx++;
			}
	
		}
	
		return $paramImage;
	}

	/**
	 *
	 * @return multitype:string
	 */
	public function setParamLink(){
		$link = $this->client->getLink();
		$paramLink = array();
	
		if ($link){
			$chunkLinks = array_chunk ( $link, self::SEND_ONCE_COUNT );
	
			$idx = 0;
			foreach ($chunkLinks as $chunkLink){
				$i = 0;
				$count = count($chunkLink);
				$paramLink[$idx] = '';
				foreach ($chunkLink as $item){
					$item = $this->chgSpCharater($item);
					$paramLink[$idx] .= 'prv_linkurl=' . $item;
					if($i < $count - 1){
						$paramLink[$idx] .= '&';
					}
					$i++;
				}
				$idx++;
			}
	
		}
	
		return $paramLink;
	}

	/**
	 *
	 * @return multitype:string
	 */
	public function setParamTitle(){
		$title = $this->client->getTitle();
		$paramTitle = array();
	
		if ($title){
			$chunkTitles = array_chunk ( $title, self::SEND_ONCE_COUNT );
	
			$idx = 0;
			foreach ($chunkTitles as $chunkTitle){
				$i = 0;
				$count = count($chunkTitle);
				$paramTitle[$idx] = '';
				foreach ($chunkTitle as $item){
					$item = $this->chgSpCharater($item);
					$paramTitle[$idx] .= 'prv_title=' . $item;
					if($i < $count - 1){
						$paramTitle[$idx] .= '&';
					}
					$i++;
				}
				$idx++;
			}
	
		}
	
		return $paramTitle;
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
				$paramImages = $this->setParamImage();
				$paramLinks = $this->setParamLink();
				$paramTitles = $this->setParamTitle();
				
				$i = 0;
				foreach ($paramIdentitys as $paramIdentity){
					$param = http_build_query ( $data, '', '&' );
					$param .= '&' . $paramIdentity;
					
					if($paramMessages && $paramMessages[$i]){ // 다른 메시지 발송
						$param .= '&' . $paramMessages[$i];
					}
					if($paramImages && $paramImages[$i]){ // 다른 이미지 발송
						$param .= '&' . $paramImages[$i];
					}
					if($paramLinks && $paramLinks[$i]){ // 다른 웹링크 발송
						$param .= '&' . $paramLinks[$i];
					}
					if($paramTitles && $paramTitles[$i]){ // 다른 타이틀 발송
						$param .= '&' . $paramTitles[$i];
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
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, false );
		curl_setopt ( $ch, CURLOPT_SSLVERSION, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 30 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
		$res = curl_exec ( $ch );
		/* curl 에러검출 */
		$cErrno = curl_errno($ch);
		if ($cErrno == 0) {
			$response = $res;
		} else {
			echo "Curl Fetch Error : ".$cErrno." - ".curl_error($ch);
			$response = exit;
		}
		curl_close ( $ch );
		return $response;
	}
	
	public function chgSpCharater($strTxt){
		$strTxt = str_replace("%", "%25", $strTxt);
		$strTxt = str_replace("&", "%26", $strTxt);
		return $strTxt;
	}
}
