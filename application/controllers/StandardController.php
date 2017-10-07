<?php
require_once CTRL_DIR . 'WebBaseController.php';
require_once 'lib/CommonFuncs.php';

/**
 *
 * @author llx
 */
class StandardController extends WebBaseController {

	/**
	 *
	 * @var Section
	 */
	protected $section;
	/**
	 *
	 * @var Dictionary
	 */
	protected $dictionary;

	/**
	 * Construct
	 */
	public function __construct($params) {
		parent::__construct ($params);
		$this->log ( '', $_SERVER ["REQUEST_URI"] );
		$this->smarty->assign ( 'WEB_IMG_BASE_URL', WEB_IMG_BASE_URL );
		$this->smarty->assign ( 'VIEW_DIR', VIEW_DIR );
		$this->__initSystemAccountInfo ();
		$this->smarty->assign ( 'curUser', $this->curUser );
		$this->__checkAdminUserLogin();
	}
    //质量指标字典
	public function indexAction() {
	    $this->smarty->display(VIEW_DIR . "standard/dictionaries.html");
	}
	//质量指标字典 列表
    public function ajaxDictionaryListAction(){
        $list = $this->dictionary->getParentList();
        $childList = $this->dictionary->getChildCountNumList();
        foreach ($list as $key => $value){
            $list[$key]['child_num'] = isset($childList[$value['p_id']])?$childList[$value['p_id']]:0;
        }
        $this->__displayOutput($list);
    }
    //质量指标字典 添加提交
    public function ajaxDictionaryAddAction(){
        $data = array(
            'cdate'     => date('Y-m-d H:i:s'),
            'p_id'      => 0,
            'type_name' => $this->__getParam('type_name')
        );
        if (empty($data['type_name']))
            $this->__ajaxReturn(false,'请填写名称');
        $res = $this->dictionary->add($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //质量指标字典 修改提交
    public function ajaxDictionaryUpdateAction(){
        $id = intval($this->__getParam('id'));
        $type_name = $this->__getParam('type_name');
        $res = $this->dictionary->update(array('id' => $id,'type_name'=>$type_name));
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //质量指标字典 删除
    public function ajaxSectionDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->section->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
	protected function log($title, $log_data = '') {
		$f = fopen ( $this->log_file, 'a+' );
		fwrite ( $f, date ( 'Y-m-d H:i:s', time () ) . '_' . microtime () . ' ' . $title . ':' . $log_data . "\r\n\r\n" );
		fclose ( $f );
	}
}

?>