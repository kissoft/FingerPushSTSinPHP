<?php
/**
 * Fingerpush 인증 관리 클래스
 * 
 * @author Qkddn0012(PHP 7.2 이상으로 업그레이드)
 */
class FingerPushApp implements Serializable {
	/**
	 * @var string Application key
	 */
	protected $appkey;
	
	/**
	 * @var string Application Secret
	 */
	protected $appsecret;
	
	/**
	 * @var string Application Customerkey
	 */
	protected $customerkey;
	
	
	/**
	 * FingpushApp 오브젝트 인스턴스
	 * @param string $appkey
	 * @param string $appsecret
	 * @param string $customerkey
	 */
	public function __construct($config) {
		$this -> appkey = $config['appkey'] ?? '';
		if (!$this -> appkey) {
			throw new Exception ('필수값이 없습니다. : appkey');
		}
		
		$this -> appsecret = $config['appsecret'] ?? '';
		if (!$this -> appsecret) {
			throw new Exception ('필수값이 없습니다. : appsecret');
		}
		
		$this -> customerkey = $config['customerkey'] ?? '';
		if (!$this -> customerkey) {
			throw new Exception ('필수값이 없습니다. : customerkey');
		}
	}
	
	/**
	 * Application key 반환
	 * @return string
	 */
	public function getAppkey() {
		return $this -> appkey;
	}
	
	/**
	 * Application Secret 반환
	 * @return string
	 */
	public function getAppsecret() {
		return $this -> appsecret;
	}
	
	/**
	 * Application Customerkey 반환
	 * @return string
	 */
	public function getCustomerkey() {
		return $this -> customerkey;
	}
	
	/**
	 * Application Key 배열 반환
	 * @return array
	 */
	public function getkey() {
		return array(
			'appkey' => $this -> appkey,
			'appsecret' => $this -> appsecret,
			'customerkey' => $this -> customerkey
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Serializable::serialize()
	 */
	public function serialize() {
		return serialize(
			$this -> appkey,
			$this -> appsecret,
			$this -> customerkey
		);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Serializable::unserialize()
	 */
	public function unserialize($serialized) {
		list($appkey, $appsecret, $customerkey) = unserialize($serialized);
		$this -> __construct($appkey, $appsecret, $customerkey);
	}
}
?>