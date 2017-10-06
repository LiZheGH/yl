<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * 系统用户角色
 * 
 * @author mxj
 *
 */
class SystemRole {
    const STATUS_NORMAL = 0;
    const STATUS_LOCK = 1;
	
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
	 * Mc SystemRole
	 *
	 * @var McSystemRole
	 */
	protected $mcSystemRole = NULL;
	
	/**
	 * Instance
	 *
	 * @var SystemRole
	 */
	private static $instance = NULL;
	
	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;
	
	/**
	 * Current SystemRole
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
	 * @return SystemRole
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
		return $this->db->getOne("select * from system_role where 1=1 and id=" . $id);
	}
	
	/**
	 * get all role
	 * 
	 * @return Ambigous <string, multitype:>
	 */
	public function getAll() {
	    return $this->db->getAll("select * from system_role ");
	}
	
	public function getAllKey(){
	    $data = $this->getAll();
	    $keys = array();
	    if($data){
	        foreach($data as $k => $v){
	           $keys[] = $k;    
	        }
	    }
	    return $keys;
	}
	
	public function getPageData($page, $rows) {
		return $this->db->getAll("select * from system_role order by id desc limit " . ($page-1)*$rows . ", " . $rows);
	}
	
	public function getCount() {
		$data = $this->db->fetRowCount('system_role', 'id', '1=1');
		if($data)
			return $data['num'];
		else
			return 0;
	}
	
// 	public function update($data) {
// 	    return $this->db->executeSql("update system_account set ")
// 	}
	
	public function getByRoleName($role_name) {
	    $data = $this->db->getAll("select * from system_role where role_name='" . $role_name . "'");
	    if($data)
	        return $data[0];
	    else
	        return;
	}
	
	/**
	 * add
	 * 
	 * @param unknown $data
	 * @return void|resource
	 */
    public function add($data) {
        if(!isset($data['role_name']) || !$data['role_name'])
            return;
        return $this->db->execute("insert into system_role(role_name, rdate, udate, status) values('" . $data['role_name'] . "', '" . date('Y-m-d H:i:s') . "', '" . date('Y-m-d H:i:s') . "', " . self::STATUS_NORMAL . ")");
            
    }
    
    /**
     * update
     * 
     * @param unknown $data
     * @return void|resource
     */
    public function update($data) {
        if(!isset($data['id']) || !CommonFuncs::checkId($data['id']))
            return;
        if(!isset($data['role_name']) || !$data['role_name'])
            return;
        return $this->db->execute("update system_role set role_name='" . $data['role_name'] . "' where id=" . $data['id']);
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
	    return $this->db->execute("delete from system_role where id=" . $id);
	}
}