<?php
/**
 * Fingerpush parameter 클래스
 *
 * @author Qkddn0012(PHP 7.2 이상으로 업그레이드)
 */
class FingerPushClient {
	/**
	 * @const sting 한번 발송되는 최대값
	 */
	const SEND_ONCE_COUNT = 500;
	
	/**
	 * @var string 보낼 푸시 메시지
	 */
	protected $msg;
	
	/**
	 * @var array 대상자 식별자 값
	 */
	protected $identity;
	
	/**
	 * @var string identity 전체 개수
	 */
	protected $lenIdentity;
	
	/**
	 * @var array 대상자에게 보내는 각기 다른 메시지
	 */
	protected $message;
	
	/**
	 * @var string message 전체 개수
	 */
	protected $lenMessage;
	
	/**
	 * @var array 대상자에게 보내는 각기 다른 이미지
	 */
	protected $arrImage;
	
	/**
	 * @var string 이미지 전체 개수
	 */
	protected $lenImage;
	
	/**
	 * @var array 대상자에게 보내는 각기 다른 웹링크
	 */
	protected $arrLink;
	
	/**
	 * @var string 웹링크 전체 개수
	 */
	protected $lenLink;
	
	/**
	 * @var array 대상자에게 보내는 각기 다른 타이틀
	 */
	protected $arrTitle;
	
	/**
	 * @var string 타이틀 전체 개수
	 */
	protected $lenTitle;
	
	
	/**
	 * @var string 안드로이드를 사용하는 대상폰 발송 Default : Y
	 */
	protected $isa = 'Y';
	
	/**
	 * @var string 안드로이드 푸시 배지 처리 파라미터
	 */
	protected $abdg;
	
	/**
	 * @var string 푸시 수신 안드로이 사운드
	 */
	protected $asnd;
	
	/**
	 * @var string IOS를 사용하는 대상폰 발송 Default : Y
	 */
	protected $isi = 'Y';
	
	/**
	 * @var string IOS 푸시 배지 처리 파라미터
	 */
	protected $ibdg;
	
	/**
	 * @var string IOS 푸시 사운드 처리 파라미터
	 */
	protected $isnd;
	
	/**
	 * @var string 커스텀 키 1 (App 개발 시 반영 된 값)
	 */
	protected $ck1;
	
	/**
	 * @var string 커스텀 키 2 (App 개발 시 반영 된 값)
	 */
	protected $ck2;
	
	/**
	 * @var string 커스텀 키 3 (App 개발 시 반영 된 값)
	 */
	protected $ck3;
	
	/**
	 * @var string 커스텀 값 1 (App 개발 시 반영 된 값)
	 */
	protected $cv1;
	
	/**
	 * @var string 커스텀 값 2 (App 개발 시 반영 된 값)
	 */
	protected $cv2;
	
	/**
	 * @var string 커스텀 값 3 (App 개발 시 반영 된 값)
	 */
	protected $cv3;
	
	/**
	 * @var string 첨부이미지 파일 링크 경로
	 */
	protected $fnm;
	
	/**
	 * @var string 타이틀
	 */
	protected $title;
	
	/**
	 * @var string 라벨코드
	 */
	protected $lcode;
	
	/**
	 * @var string 배경색상
	 */
	protected $bgcolor;
	
	/**
	 * @var string 폰트색상
	 */
	protected $fcolor;
	
	/**
	 * @var string 에티켓시간 사용 여부
	 */
	protected $isetiquette;
	
	/**
	 * @var string 에티켓 적용 시작시간
	 */
	protected $etiquette_stime;
	
	/**
	 * @var string 에티켓 적용 종료시간
	 */
	protected $etiqutte_etime;
	
	/**
	 * @var string 안드로이드 용 메시지 우선순위
	 */
	protected $and_priority;
	
	/**
	 * @var string 광고 수신 동의 여부에 따른 메시지 발송 여부 (매뉴얼 참조)
	 */
	protected $optagree;
	
	
	/**
	 * FingerpushClient 오브젝트 인스턴스
	 *
	 * @param array $param
	 * @throws \Exception
	 */
	public function __construct($param) {
		$this -> msg = $param['msg'] ?? '';
		$this -> identity = $param['identity'] ?? NULL;
		$this -> message = $param['message'] ?? NULL;
		$this -> arrImage = $param['arrImage'] ?? NULL;
		$this -> arrLink = $param['arrLink'] ?? NULL;
		$this -> arrTitle = $param['arrTitle'] ?? NULL;
		
		// 타겟팅 푸시 msg가 없는경우 msg = 0번째 message로 설정
		if (!$this -> msg && $this -> message) {
			$this -> msg = $this -> message[0];
		}
		
		// 타겟팅 푸시 일 경우 검증
		if ($this -> message || $this -> arrImage || $this -> arrLink || $this -> arrTitle) {
			// identity 값 확인
			if (is_null($this -> identity)) {
				throw new Exception ('수신자가 없습니다. : identity');
			} else {
				// message가 존재하면 identity의 개수와 message의 개수를 비교
				if ($this -> message && (count($this -> message) != count($this -> identity))) {
					throw new Exception ('수신자의 수와 메시지의 수가 다릅니다. : message');
				}
				// arrImage가 존재하면 identity의 개수와 arrImage의 개수를 비교
				if ($this -> arrImage && (count($this -> arrImage) != count($this -> identity))) {
					throw new Exception ('수신자의 수와 이미지 수가 다릅니다. : arrImage');
				}
				// arrLink가 존재하면 identity의 개수와 arrLink의 개수를 비교
				if ($this -> arrLink && (count($this -> arrLink) != count($this -> identity))) {
					throw new Exception ('수신자의 수와 웹링크 수가 다릅니다. : arrLink');
				}
				// arrTitle이 존재하면 identity의 개수와 arrTitl의 개수를 비교
				if ($this -> arrTitle && (count($this -> arrTitle) != count($this -> identity))) {
					throw new Exception ('수신자의 수와 타이틀 수가 다릅니다. : arrTitle');
				}
			}
		}
		
		$this -> isa = $param['isa'] ?? 'Y';
		$this -> abdg = $param['abdg'] ?? '';
		$this -> asnd = $param['asnd'] ?? '';
		$this -> isi = $param['isi'] ?? 'Y';
		$this -> ibdg = $param['ibdg'] ?? '';
		$this -> isnd = $param['isnd'] ?? '';
		$this -> ck1 = $param['ck1'] ?? '';
		$this -> ck2 = $param['ck2'] ?? '';
		$this -> ck3 = $param['ck3'] ?? '';
		$this -> cv1 = $param['cv1'] ?? '';
		$this -> cv2 = $param['cv2'] ?? '';
		$this -> cv3 = $param['cv3'] ?? '';
		$this -> link = $param['link'] ?? '';
		$this -> fnm = $param['fnm'] ?? '';
		$this -> mode = $param['mode'] ?? '';
		$this -> lngt_message = $param['lngt_message'] ?? '';
		$this -> send_state = $param['send_state'] ?? '';
		$this -> senddate = $param['senddate'] ?? '';
		$this -> tag = $param['tag'] ?? '';
		$this -> title = $param['title'] ?? '';
		$this -> lcode = $param['lcode'] ?? '';
		$this -> bgcolor = $param['bgcolor'] ?? '';
		$this -> fcolor = $param['fcolor'] ?? '';
		$this -> isetiquette = $param['isetiquette'] ?? '';
		$this -> etiquette_stime = $param['etiquette_stime'] ?? '';
		$this -> etiquette_etime = $param['etiquette_etime'] ?? '';
		$this -> and_priority = $param['and_priority'] ?? '';
		$this -> optagree = $param['optagree'] ?? '';
	}
	
	/**
	 * 옵션 배열 리턴
	 *
	 * @return array
	 */
	public function getOptions() {
		$param = array (
			'isa' => $this -> isa,
			'abdg' => $this -> abdg,
			'asnd' => $this -> asnd,
			'isi' => $this -> isi,
			'ibdg' => $this -> ibdg,
			'isnd' => $this -> isnd,
			'ck1' => $this -> ck1,
			'ck2' => $this -> ck2,
			'ck3' => $this -> ck3,
			'cv1' => $this -> cv1,
			'cv2' => $this -> cv2,
			'cv3' => $this -> cv3,
			'link' => $this -> link,
			'fnm' => $this -> fnm,
			'mode' => $this -> mode,
			'lngt_message' => $this -> lngt_message,
			'send_state' => $this -> send_state,
			'senddate' => $this -> senddate,
			'tag' => $this -> tag,
			'title' => $this -> title,
			'lcode' => $this -> lcode,
			'bgcolor' => $this -> bgcolor,
			'fcolor' => $this -> fcolor,
			'isetiquette' => $this -> isetiquette,
			'etiquette_stime' => $this -> etiquette_stime,
			'etiquette_etime' => $this -> etiquette_etime,
			'and_priority' => $this -> and_priority,
			'optagree' => $this -> optagree
		);
		
		return $param;
	}
	
	/**
	 * identity 값 리턴
	 * 
	 * @return array
	 */
	public function getMsg() {
		return $this -> msg;
	}
	
	/**
	 * identity 값 리턴
	 *
	 * @return array
	 */
	public function getIdentity() {
		return $this -> identity;
	}
	
	/**
	 * message array 리턴
	 *
	 * @return array
	 */
	public function getMessage() {
		return $this -> message;
	}
	
	/**
	 * arrImage array 리턴
	 *
	 * @return array
	 */
	public function getImage() {
		return $this -> arrImage;
	}
	
	/**
	 * arrLink array 리턴
	 *
	 * @return array
	 */
	public function getLink() {
		return $this -> arrLink;
	}
	
	/**
	 * arrTitle array 리턴
	 *
	 * @return array
	 */
	public function getTitle() {
		return $this -> arrTitle;
	}
}
?>