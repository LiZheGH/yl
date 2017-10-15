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
	public function getListByWhere($where){
	    return $this->db->getAll("SELECT * FROM $this->table ".$where);
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
	public function updateByWhere($data,$where) {
		return $this->db->update($this->table, $data,$where);
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
	public function batchAdd($dataList,$num='30') {
	    $i = 0;
	    $tempArr = array();
	    foreach ($dataList as $data){
	        $i++ ;
	        $tempArr[ceil($i/$num)][] = $data;
	    }
	    foreach ($tempArr as $listData){
	        $res = $this->db->batchAdd($this->table, $listData);
	        if (!$res)
	            return false;
	    }
	    return true;
	}
}