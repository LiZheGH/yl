<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 * llx
 * ReportIndicators
 */
class ReportIndicators extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_report_indicators";

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
	public function getList(){
	    $list = $this->db->getAll("SELECT * FROM ".$this->table." WHERE 1=1");
	    $data = array();
	    foreach ($list as $info){
	        $data[$info['section']] = $info;
	    }
	    return $data;
	}
	public function getOneBySection($section){
	    return $this->db->getOne("SELECT * FROM ".$this->table." WHERE `section`='{$section}'");
	}
	public function deleteAll() {
	    return $this->db->delete($this->table, '1=1');
	}
}