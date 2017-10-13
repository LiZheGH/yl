<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 *  llx
 * AbnormalMedicine
 */
class AbnormalMedicine extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_abnormal_medicine";

	/**
	 * Get instance
	 *
	 * @param boolean $cli
	 * @return User
	 */
	/**
	 * db
	 *
	 * @var PDOMysql
	 */
	protected $db = NULL;

	/**
	 * Instance
	 *
	 * @var User
	 */
	private static $instance = NULL;


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

	public static function getInstance($cli = false)
	{
		if (empty(self::$instance)) {
			self::$instance = new self($cli);
		}
		return self::$instance;
	}

	public function getListByUserId($uid) {
	    return $this->db->getAll("SELECT * FROM ".$this->table." WHERE `uid`='{$uid}'");
	}
	public function getKeyInfo(){
	    $data = $this->getAll();
	    $param = array();
	    foreach($data as $k => $v){
	        $param[$v['id']] = $v;
	    }
	    return $param;
	}
}