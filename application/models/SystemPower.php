<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 系统权限
 *
 * @author mxj
 *
 */
class SystemPower {

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
	 * Mc SystemPower
	 *
	 * @var McSystemPower
	 */
	protected $mcSystemPower = NULL;

	/**
	 * Instance
	 *
	 * @var SystemPower
	 */
	private static $instance = NULL;

	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;

	/**
	 * Current SystemPower
	 *
	 * @var array
	 */
	protected $currentUser = NULL;


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

	/**
	 * Get instance
	 *
	 * @param boolean $cli
	 * @return SystemPower
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
		return $this->db->getOne("select * from system_power where 1=1 and id=" . $id);
	}
	public function getByIds($ids) {
		return $this->db->getAll("select * from system_power where id IN(".$ids.") ORDER BY p_id,sort");
	}

	public function getAll() {
	    return $this->db->getAll("select * from system_power ORDER BY p_id,sort");
	}

	public function getPageData($page, $rows) {
		return $this->db->getAll("select * from system_power order by id desc limit " . ($page-1)*$rows . ", " . $rows);
	}

	public function getCount() {
		$data = $this->db->fetRowCount('system_power', 'id', '1=1');
		if($data)
			return $data['num'];
		else
			return 0;
	}
	public function getByPowerName($power_name) {
	    return $this->db->getAll("select * from system_power where power_name='" . $power_name . "'");
	}
	public function getListByPid($p_id){
	   return $this->db->getAll("SELECT * FROM system_power WHERE p_id='{$p_id}' ORDER BY `sort`");

	}
	/**
	 * add
	 *
	 * @param unknown $data
	 * @return void|resource
	 */
    public function add($data) {
        return $this->db->add('system_power', $data);
    }

    /**
     * update
     *
     * @param unknown $data
     * @return void|resource
     */
    public function update($data) {
        return $this->db->update('system_power',$data," `id`='{$data['id']}'");
    }

    /**
     * delete
     *
     * @param unknown $id
     * @return void|resource
     */
	public function delete($id) {
	    if(!isset($id) || !CommonFuncs::checkId($id))
	        return;
	    return $this->db->execute("delete from system_power where id=" . $id);
	}
}