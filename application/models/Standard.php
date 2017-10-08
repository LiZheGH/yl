<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 * llx
 * AbnormalFall
 */
class Standard extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_standard";

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
	public function getListByDid($d_id){
	    $list = $this->db->getAll("SELECT * FROM ".$this->table." WHERE `d_id` = '{$d_id}'");
	    $data = array();
	    foreach ($list as $info){
	        $data[$info['section']] = $info['standard'];
	    }
	    return $data;
	}
	public function deleteByDid($d_id) {
	    return $this->db->delete($this->table, '`d_id`=' . $d_id);
	}
	public function batchAdd($dataList,$num='30') {
	    $i = 0;
	    $tempArr = array();
	    foreach ($dataList as $data){
	        $i++ ;
	        $tempArr[ceil($i/$num)][] = $data;
	    }
	    foreach ($tempArr as $listData){
	        $res = $this->db->batchAdd($this->$table, $listData);
	        if (!$res)
	            return false;
	    }
	    return true;
	}
}