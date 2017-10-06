<?php
require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';
class SystemUser{    
    const STATUS_NORMAL = 0;
    const STATUS_LOCK = 1;
	/**
	 * mc tmp expire
	 *
	 * @var integer
	 */
	protected $mcTmpExpire;
	
	/**
	 * db
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
	 * Mc SystemAccount
	 *
	 * @var McSystemAccount
	 */
	protected $mcSystemAccount = NULL;
	
	/**
	 * Instance
	 *
	 * @var SystemAccount
	 */
	private static $instance = NULL;
	
	/**
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;
	
	/**
	 * Current SystemAccount
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
     * @return SystemAccount
     */
    public static function getInstance($cli = false)
    {
        if (empty(self::$instance)) {
            self::$instance = new self($cli);
        }
        return self::$instance;
    }
	/**
	 * get account list
	 * 
	 * @return Ambigous <string, multitype:>
	 */
	public function getAll() {
	    return $this->db->getAll("select * from t_ymg_customer");
	}
	
	public function getPageData($page, $rows) {
		return $this->db->getAll("select `id`,`name`,`email`,`created_at`,`company_name`,`company_area`,`company_address`,`linkman_name`,`linkman_phone`,`cust_stat` from t_ymg_customer order by cust_stat DESC limit " . ($page-1)*$rows . ", " . $rows);
	}
	public function getBaseArea(){
	    $BaseAreaArr = $this->db->getAll("SELECT `id`,`area_name` FROM `t_ymg_base_area`");
	    $AreaArr = array();
	    foreach ($BaseAreaArr as $key=>$value){
	        $AreaArr[$value['id']] = $value['area_name'];
	    }
	    return $AreaArr;
	}
	public function getCount() {
		$data = $this->db->fetRowCount('t_ymg_customer', 'id', '1=1');
		if($data)
			return $data['num'];
		else
			return 0;
	}
}