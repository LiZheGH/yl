<?php

require_once 'lib/CommonFuncs.php';
require_once 'lib/PDOMysql.php';

/**
 * 短信验证码
 *
 * @author mxj
 *
 */
class SmsCode {

	/**
	 * Db
	 *
	 * @var PDOMysql
	 */
	protected $db = NULL;


	/**
	 * Mc
	 *
	 * @var Mc
	 */
	protected $mc = NULL;

	/**
	 * config
	 *
	 * @var Config
	 */
	protected $config = NULL;


	/**
	 * Instance
	 *
	 * @var SmsCode
	 */
	private static $instance = NULL;

	private static $table = 'ymg_stob_sms_code';


	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;


	public function __construct(){
		$this->db = new PDOMysql();
	}

	/**
	 * Get instance
	 *
	 * @param boolean $cli
	 * @return SmsCode
	 */
	public static function getInstance($cli = false)
	{
		if (empty(self::$instance)) {
			self::$instance = new self($cli);
		}
		return self::$instance;
	}


	/**
	 * 一个IP一天发的条数
	 * @param unknown $ip
	 */
	public function getTodayCountByIP($ip) {
		return $this->db->getRowCount("select * from " . self::$table . " where ip='" . $ip . "' and cdate > '" . date('Y-m-d') . "'");
	}
	
	/**
	 * 一个手机号一天收到的条数
	 * @param unknown $mobile
	 */
	public function getTodayCountByMobile($mobile) {
		return $this->db->getRowCount("select * from " . self::$table . "  where mobile='" . $mobile . "' and cdate > '" . date('Y-m-d') . "'");
	}
	
	/**
	 * 一个手机号最新收到的一条短信
	 * @param unknown $mobile
	 */
	public function getLatestOneByMobile($mobile) {
		return $this->db->fetOne(self::$table, '*', "mobile='" . $mobile . "' order by id desc");
	}
	
	public function getByUserIdAndCodeAndMobile($user_id, $code, $mobile) {
		return $this->db->fetOne(self::$table, '*', "mobile='" . $mobile . "' and verify_code='" . $code . "' and user_id=" . $user_id . " and cdate > '" . date('Y-m-d') . "'");
	}
	
	
	/**
	 * add
	 *
	 * @param unknown $data
	 * @return void|resource
	 */
    public function addOne($data) {
    	return $this->db->add(self::$table, $data);
    }

    /**
     * update
     *
     * @param unknown $data
     * @return void|resource
     */
    public function updateOne($data) {
    	return $this->db->update(self::$table, $data, 'id=' . $data['id']);
    }

    /**
     * delete
     *
     * @param unknown $id
     * @return void|resource
     */
	public function deleteOne($id) {
	    if(!isset($id) || !CommonFuncs::checkId($id))
	        return;
	    return $this->db->execute("delete from " . self::$table . " where id=" . $id);
	}
}