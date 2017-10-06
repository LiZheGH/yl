<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 系统角色与权限关系表
 * 
 * @author mxj
 *
 */
class SystemRolePower {
	
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
	 * Mc SystemRolePower
	 *
	 * @var McSystemRolePower
	 */
	protected $mcSystemRolePower = NULL;
	
	/**
	 * Instance
	 *
	 * @var SystemRolePower
	 */
	private static $instance = NULL;
	
	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;
	
	/**
	 * Current SystemRolePower
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
	 * @return SystemRolePower
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
		return $this->db->getOne("select * from system_role_power where 1=1 and id=" . $id);
	}
	
	/**
	 * get by roleId
	 * 
	 * @param unknown $role_id
	 * @return void|Ambigous <string, multitype:>
	 */
	public function getByRoleId($role_id) {
	    if(!CommonFuncs::checkId($role_id))
	        return;
	    return $this->db->getAll("select * from system_role_power where 1=1 and role_id=" . $role_id);
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
        if(!isset($data['power_id']) || !CommonFuncs::checkId($data['power_id']))
            return;
        return $this->db->execute("insert into system_role_power(role_id, power_id) values(" . $data['role_id'] . ", " . $data['power_id'] . ")");
            
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
	    return $this->db->execute("delete from system_role_power where 1=1 and id=" . $id);
	}
	
	
	public function deleteByRoleId($role_id) {
	    return $this->db->execute("delete from system_role_power where role_id=" . $role_id);
	}
}