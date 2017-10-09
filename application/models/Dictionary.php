<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 * llx
 * Dictionary
 */
class Dictionary extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_index_dictionary";

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
	public function updateByIds($ids,$data){
        return $this->db->update($this->table,$data,"`id` IN ( ".$ids." )");
	}
	public function getListByPid($p_id=0){
	    return $this->db->getAll("SELECT * FROM ".$this->table." WHERE `p_id`='{$p_id}'");
	}
    public function getChildCountNumList() {
        $data = $this->db->getAll("SELECT COUNT(`id`) as num,`p_id` FROM ".$this->table." WHERE `p_id` != 0 GROUP BY `p_id`");
        $list = array();
        foreach ($data as $info){
            $list[$info['p_id']] = $info['num'];
        }
        return $list;
    }
    public function getAllChildList(){
        return $this->db->getAll("SELECT `id`,`p_id`,`type_name`,`range`,`standard`,`computation` FROM ".$this->table." WHERE `p_id` != 0");
    }
    public function getListByIds($ids) {
        return $this->db->getAll("SELECT * FROM ".$this->table." WHERE `id` IN({$ids})");
    }
}