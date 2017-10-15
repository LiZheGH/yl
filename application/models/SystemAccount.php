<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 系统用户账户
 *
 * @author mxj
 *
 */
class SystemAccount {

    const STATUS_NORMAL = 0;
    const STATUS_LOCK = 1;
	/**
	 * mc tmp expire
	 *
	 * @var integer
	 */
	protected $mcTmpExpire;

	/**
	 * db
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
	 * Mc SystemAccount
	 *
	 * @var McSystemAccount
	 */
	protected $mcSystemAccount = NULL;

	/**
	 * Instance
	 *
	 * @var SystemAccount
	 */
	private static $instance = NULL;

	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;

	/**
	 * Current SystemAccount
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
	 * @return SystemAccount
	 */
	public static function getInstance($cli = false)
	{
		if (empty(self::$instance)) {
			self::$instance = new self($cli);
		}
		return self::$instance;
	}

	/**
	 * update password
	 *
	 * @param unknown $new_password
	 * @param unknown $id
	 * @return resource
	 */
	public function updatePassword($new_password, $id) {
	    if(!$new_password || !CommonFuncs::checkMd5String($new_password))
	        return;
	    if(!$id || !CommonFuncs::checkId($id))
	        return;
		return $this->db->executeSql("update system_account set password='" . $new_password . "', udate = '" . date('Y-m-d H:i:s') . "' where 1=1 and id=" . $id);
	}

	/**
	 * add
	 *
	 * @param unknown $data
	 * @return void|resource
	 */
	public function add($data) {
	   return $this->db->add('system_account', $data);
	}

	/**
	 * get by id
	 *
	 * @param int $id
	 * @return void|Ambigous <>
	 */
	public function getById($id) {
		if(!CommonFuncs::checkId($id))
			return;

		$sql = "select * from system_account where 1=1 and id=" . $id;
		return $this->db->getOne($sql);
	}

	/**
	 * get account list
	 *
	 * @return Ambigous <string, multitype:>
	 */
	public function getAll() {
	    return $this->db->getAll("select * from system_account");
	}

	public function getPageData($page, $rows) {
		return $this->db->getAll("select * from system_account order by id desc limit " . ($page-1)*$rows . ", " . $rows);
	}

	public function getCount() {
		$data = $this->db->fetRowCount('system_account', 'id', '1=1');
		if($data)
			return $data['num'];
		else
			return 0;
	}

	/**
	 *
	 * @param unknown $data
	 */
	public function update($data) {
		return $this->db->update('system_account', $data, " `id`='{$data['id']}'");
	}

	public function updateldate($id) {
	    return $this->db->execute("update system_account set ldate='" . date('Y-m-d H:i:s') . "' where 1=1 and id=" . $id);
	}

	/**
	 * get by username
	 *
	 * @param unknown $name
	 * @return void|Ambigous <>
	 */
	public function getByUserName($name) {
		if(!$name)
			return;
		return $this->db->fetOne('system_account', '*', 'username="' . $name . '"');
	}

	public function delete($id) {
	    return $this->db->execute("delete from system_account where id=" . $id);
	}

	/**
	 * whether password is valid
	 *
	 * @param string $password
	 * @return boolean
	 */
	public function isValidPassword($password) {
		if(strlen($password) == 32)
			return true;
		else
			return false;
	}


}