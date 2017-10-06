<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
require_once MODEL_DIR . 'BaseModel.php';

/**
 * llx
 * Evaluation
 */
class Evaluation extends BaseModel{

	/**
	 * @var unknown
	 */
	protected $table = "yl_evaluation";

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
    public function getOneByAidAndType($a_id,$type) {
        return $this->db->getOne("SELECT * FROM ".$this->table." WHERE `a_id`='{$a_id}' AND `type`='{$type}'");
    }
}