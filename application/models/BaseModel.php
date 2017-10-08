<?php

require_once 'lib/PDOMysql.php';
require_once 'lib/CommonFuncs.php';

/**
 * llx
 * 模型基类
 */
class BaseModel {

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
	 * Profiler
	 *
	 * @var Profiler
	 */
	protected $profiler = NULL;


	protected $table;

	/**
	 * Construct
	 *
	 * @param boolean $cli
	*/
	protected function __construct($cli)
	{

	}
	public function add($data) {
	    if($this->db->add($this->table, $data)) {
	    	return $this->db->getLastId();
	    } else {
	    	return false;
	    }
	}
	public function getById($id) {
		if(!CommonFuncs::checkId($id))
			return;
		return $this->db->fetOne($this->table, '*', 'id=' . $id);
	}
	public function getAll() {
	    return $this->db->getAll("SELECT * FROM $this->table WHERE 1=1");
	}
	public function getPageData($page, $rows, $order_by=' order by id desc ') {
		return $this->db->fetAll($this->table, '*', $order_by . ' ' . "LIMIT " . ($page-1)*$rows . ", " . $rows, '1=1');
	}
	public function getCount() {
		$data = $this->db->fetRowCount($this->table, 'id', '1=1');
		if($data)
			return $data['num'];
		else
			return 0;
	}
	public function update($data) {
		return $this->db->update($this->table, $data, 'id=' . $data['id']);
	}
	public function delete($id) {
	    return $this->db->delete($this->table, 'id=' . $id);
	}
	public function getTableColumns(){
	    $data = $this->db->getFields($this->table);
	    foreach($data as $val){
	        $column[] = $val['Field'];
	    }
	    return $column;
	}
}