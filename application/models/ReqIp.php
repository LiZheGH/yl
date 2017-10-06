<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 顶
 * 
 * @author mxj
 *
 */
class ReqIp {
	
	/**
	 * mc tmp expire
	 *
	 * @var integer
	 */
	protected $mcTmpExpire;
	
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
	 * @var ReqIp
	 */
	private static $instance = NULL;
	
	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;
	
	
	
	/**
	 * Construct
	 *
	 * @param boolean $cli
	*/
	protected function __construct($cli)
	{
		//init db
		$this->db = new PDOMysql();
	}
	
	protected $table = 'req_ip';
	
	/**
	 * Get instance
	 *
	 * @param boolean $cli
	 * @return ReqIp
	 */
	public static function getInstance($cli = false)
	{
		if (empty(self::$instance)) {
			self::$instance = new self($cli);
		}
		return self::$instance;
	}
	
	
	/**
	 * get by id
	 * 
	 * @param unknown $id
	 * @return void|Ambigous <>
	 */
	public function getById($id) {
		if(!CommonFuncs::checkId($id))
			return;
		return $this->db->fetOne($this->table, '*', 'id=' . $id);
	}
	
	/**
	 * get all role
	 * 
	 * @return Ambigous <string, multitype:>
	 */
	public function getAll() {
	    return $this->db->getAll("select * from " . $this->table);
	}
	
	public function add($data) {
		return $this->db->add($this->table, $data);
	}
	
	public function getMinuteCount($ip) {
		$data =  $this->db->fetRowCount($this->table, 'id', "ip='" . $ip . "' and cdate >='" . date('Y-m-d H:i:s', time()-60) . "'");
		if($data)
			return $data['num'];
		else
			return 0;
	}

	public function getTodayCount($ip) {
		$data =  $this->db->fetRowCount($this->table, 'id', "ip='" . $ip . "' and cdate >='" . date('Y-m-d H:i:s', time()-24*60*60) . "'");
		if($data)
			return $data['num'];
		else
			return 0;
	}
}
