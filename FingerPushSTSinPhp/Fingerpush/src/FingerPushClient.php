<?php

namespace Fingerpush;

/**
 * Fingerpush parameter 클래스
 *
 * @author DK
 *        
 */
class FingerpushClient {
	
	/**
	 * @const sting 한번 발송되는 최대값
	 */
	const SEND_ONCE_COUNT = 500;
	
	/**
	 *
	 * @var string 보낼 푸시 메시지
	 */
	protected $msg;
	
	/**
	 *
	 * @var array 대상자 식별자 값
	 */
	protected $identity;

	/**
	 * 
	 * @var string identity 전체 개수
	 */
	protected $lenIdentity;
	
	/**
	 *
	 * @var array 대상자에게 보내는 각기 다른 메시지
	 */
	protected $message;

	/**
	 * 
	 * @var string message 전체 개수
	 */
	protected $lenMessage;
	
	/**
	 *
	 * @var string 안드로이드를 사용하는 대상폰 발송 Default : Y
	 */
	protected $isa = 'Y';
	
	/**
	 *
	 * @var string 안드로이드 푸시 배지 처리 파라미터
	 */
	protected $abdg;
	
	/**
	 *
	 * @var string 푸시 수신 안드로이 사운드
	 */
	protected $asnd;
	
	/**
	 *
	 * @var string IOS를 사용하는 대상폰 발송 Default : Y
	 */
	protected $isi = 'Y';
	
	/**
	 *
	 * @var string IOS 푸시 배지 처리 파라미터
	 */
	protected $ibdg;
	
	/**
	 *
	 * @var string IOS 푸시 사운드 처리 파라미터
	 */
	protected $isnd;
	
	/**
	 *
	 * @var string 커스텀 키 1 (App 개발 시 반영 된 값)
	 */
	protected $ck1;
	
	/**
	 *
	 * @var string 커스텀 키 2 (App 개발 시 반영 된 값)
	 */
	protected $ck2;
	
	/**
	 *
	 * @var string 커스텀 키 3 (App 개발 시 반영 된 값)
	 */
	protected $ck3;
	
	/**
	 *
	 * @var string 커스텀 값 1 (App 개발 시 반영 된 값)
	 */
	protected $cv1;
	
	/**
	 *
	 * @var string 커스텀 값 2 (App 개발 시 반영 된 값)
	 */
	protected $cv2;
	
	/**
	 *
	 * @var string 커스텀 값 3 (App 개발 시 반영 된 값)
	 */
	protected $cv3;
	
	/**
	 *
	 * @var string 첨부이미지 파일 링크 경로
	 */
	protected $fnm;

	
	/**
	 * FingerpushClient 오브젝트 인스턴스
	 *
	 * @param array $param        	
	 * @throws \Exception
	 */
	public function __construct($param) {
		$this->msg = isset ( $param ['msg'] ) ? $param ['msg'] : '';
		$this->identity = isset ( $param ['identity'] ) ? $param ['identity'] : NULL;
		$this->message = isset ( $param ['message'] ) ? $param ['message'] : NULL;
		
		if(!$this->msg && $this->message){
			$this->msg = 'temp message';
		}
		
		if ($this->message) { // message가 존재하면 identity의 개수와 message의 개수를 비교
			if (count ( $this->message ) != count ( $this->identity )) {
				throw new \Exception ( '수신자의 수와 메시지의 수가 다릅니다. : message' );
			}
		}
		
		$this->isa = isset ( $param ['isa'] ) ? $param ['isa'] : 'Y';
		$this->abdg = isset ( $param ['abdg'] ) ? $param ['abdg'] : '';
		$this->asnd = isset ( $param ['asnd'] ) ? $param ['asnd'] : '';
		$this->isi = isset ( $param ['isi'] ) ? $param ['isi'] : 'Y';
		$this->ibdg = isset ( $param ['ibdg'] ) ? $param ['ibdg'] : '';
		$this->isnd = isset ( $param ['isnd'] ) ? $param ['isnd'] : '';
		$this->ck1 = isset ( $param ['ck1'] ) ? $param ['ck1'] : '';
		$this->ck2 = isset ( $param ['ck2'] ) ? $param ['ck2'] : '';
		$this->ck3 = isset ( $param ['ck3'] ) ? $param ['ck3'] : '';
		$this->cv1 = isset ( $param ['cv1'] ) ? $param ['cv1'] : '';
		$this->cv2 = isset ( $param ['cv2'] ) ? $param ['cv2'] : '';
		$this->cv3 = isset ( $param ['cv3'] ) ? $param ['cv3'] : '';
		$this->link = isset ( $param ['link'] ) ? $param ['link'] : '';
		$this->fnm = isset ( $param ['fnm'] ) ? $param ['fnm'] : '';
		$this->mode = isset ( $param ['mode'] ) ? $param ['mode'] : '';
		$this->lngt_message = isset ( $param ['lngt_message'] ) ? $param ['lngt_message'] : '';
		$this->send_state = isset ( $param ['send_state'] ) ? $param ['send_state'] : '';
		$this->senddate = isset ( $param ['senddate'] ) ? $param ['senddate'] : '';
		$this->tag = isset ( $param ['tag'] ) ? $param ['tag'] : '';
	}
		
	/**
	 * 옵션 배열 리턴
	 *
	 * @return array
	 */
	public function getOptions() {
	
		$param = array (
				'isa' => $this->isa,
				'abdg' => $this->abdg,
				'asnd' => $this->asnd,
				'isi' => $this->isi,
				'ibdg' => $this->ibdg,
				'isnd' => $this->isnd,
				'ck1' => $this->ck1,
				'ck2' => $this->ck2,
				'ck3' => $this->ck3,
				'cv1' => $this->cv1,
				'cv2' => $this->cv2,
				'cv3' => $this->cv3,
				'link' => $this->link,
				'fnm' => $this->fnm,
				'mode' => $this->mode,
				'lngt_message' => $this->lngt_message,
				'send_state' => $this->send_state,
				'senddate' => $this->senddate,
				'tag' => $this->tag
		);
			
		return $param;
	}
	
	/**
	 * identity 값 리턴
	 * 
	 * @return array
	 */
	public function getMsg() {
		return $this->msg;
	}
	
	/**
	 * identity 값 리턴
	 *
	 * @return array
	 */
	public function getIdentity() {
		return $this->identity;
	}

	/**
	 *
	 * @return array
	 */
	public function getMessage() {
		return $this->message;
	}
}