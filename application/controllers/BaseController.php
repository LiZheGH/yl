<?php
require_once CTRL_DIR . 'WebBaseController.php';
require_once 'lib/CommonFuncs.php';

/**
 *
 * @author llx
 */
class BaseController extends WebBaseController {

	/**
	 *
	 * @var Section
	 */
	protected $section;

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
    //科室管理
	public function indexAction() {
	    $this->smarty->display(VIEW_DIR . "base/section.html");
	}
	//科室管理 列表
    public function ajaxSectionListAction(){
        $this->__displayOutput($this->section->getAll());
    }
    //科室管理 添加提交
    public function ajaxSectionAddAction(){
        $name = $this->__getParam('name');
        $status = intval($this->__getParam('status'));
        $res = $this->section->add(array('name'=>$name,'status'=>$status));
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //科室管理 修改提交
    public function ajaxSectionUpdateAction(){
        $id = intval($this->__getParam('id'));
        $name = $this->__getParam('name');
        $status = intval($this->__getParam('status'));
        $res = $this->section->update(array('id' => $id,'name'=>$name,'status'=>$status));
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //科室管理 删除
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