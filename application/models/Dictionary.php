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

	public function getParentList(){
	   return $this->db->getAll("SELECT * FROM ".$this->table." WHERE `p_id`='0'");
	}
    public function getChildCountNumList() {
        $data = $this->db->getAll("SELECT COUNT(`id`) as num,`p_id` FROM ".$this->table." WHERE `p_id` != 0 GROUP BY `p_id`");
        $list = array();
        foreach ($data as $info){
            $list[$info['p_id']] = $info['num'];
        }
        return $list;
    }

}