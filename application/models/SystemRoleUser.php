<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 系统角色与用户关系表
 * 
 * @author mxj
 *
 */
class SystemRoleUser {
	
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
	 * Mc SystemRoleUser
	 *
	 * @var McSystemRoleUser
	 */
	protected $mcSystemRoleUser = NULL;
	
	/**
	 * Instance
	 *
	 * @var SystemRoleUser
	 */
	private static $instance = NULL;
	
	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;
	
	/**
	 * Current SystemRoleUser
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
	 * @return SystemRoleUser
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
		return $this->db->getOne("select * from system_role_user where 1=1 and id=" . $id);
	}
	
	/**
	 * get by accountId
	 * 
	 * @param unknown $account_id
	 * @return void|Ambigous <string, multitype:>
	 */
	public function getByAccountId($account_id) {
	    if(!CommonFuncs::checkId($account_id))
	        return;
	    return $this->db->getAll("select * from system_role_user where 1=1 and account_id=" . $account_id);
	}
	
	/**
	 * add
	 * 
	 * @param unknown $data
	 * @return void|resource
	 */
    public function add($data) {
        if(!isset($data['role_id']) || !CommonFuncs::checkId($data['role_id']))
            return;
        if(!isset($data['account_id']) || !CommonFuncs::checkId($data['account_id']))
            return;
        return $this->db->execute("replace into system_role_user(role_id, account_id) values(" . $data['role_id'] . ", " . $data['account_id'] . ")");
            
    }
    
    
    public function deleteByAccountId($account_id) {
        return $this->db->execute("delete from system_role_user where account_id=" . $account_id);
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
	    return $this->db->execute("delete from system_role_user where 1=1 and id=" . $id);
	}
}