<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 * llx
 * ImportData
 */
class ImportData extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_import_data";

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
	public function getListByReportTime($report_time){
	   $sql = "SELECT * FROM ".$this->table." WHERE 1=1";
	   if ($report_time)
	       $sql .= " AND `report_time` >= '".$report_time."-01' AND `report_time` <= '".$report_time."-".CommonFuncs::getMonthDateNum($report_time)."'";
	   return $this->db->getAll($sql);
	}
	public function getListByYearReportTime($report_time){
	    $sql = "SELECT * FROM ".$this->table." WHERE 1=1";
	    if ($report_time)
	        $sql .= " AND `report_time` >= '".$report_time."-01-01' AND `report_time` <= '".$report_time."-12-31'";
	    return $this->db->getAll($sql);
	}
}