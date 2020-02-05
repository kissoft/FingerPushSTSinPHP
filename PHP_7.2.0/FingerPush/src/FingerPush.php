<?php
/**
 * Fingerpush 클래스
 * 
 * @author Qkddn0012(PHP 7.2 이상으로 업그레이드)
 */
class FingerPush {
	/**
	 * @var FingerpushApp
	 */
	protected $app;
	
	/**
	 * @var FingerpushClient
	 */
	protected $client;
	
	/**
	 * @var FingerpushRequest
	 */
	protected $request;
	
	
	/**
	 * Fingpush 오브젝트 인스턴스.
	 * key값을 세팅.
	 * 
	 * @param array $config
	 * @throws \Exception
	 */
	public function __construct(array $config) {
		$this -> app = new FingerPushApp($config);
	}
	
	/**
	 * @return FingerpushApp
	 */
	public function getApp() {
		return $this -> app;
	}
	
	/**
	 * @param array $param
	 */
	public function setParam($param) {
		$this -> client = new FingerPushClient($param);
	}
	
	/**
	 * @return FingerpushClient
	 */
	public function getClient() {
		return $this -> client;
	}
	
	/**
	 * 세팅 된 key값과 param값으로 푸시를 발송
	 */
	public function sendPush() {
		$app = $this -> getApp();
		$client = $this -> getClient();
		$this -> request = new FingerPushRequest($app, $client);
		
		return $this -> request -> request();
	}
}
?>