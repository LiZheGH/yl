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
	 *
	 * @var Standard
	 */
	protected $standard;

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
		$this->smarty->assign('sectionList',$this->section->getKeyNameInfo());
		$this->__checkAdminUserLogin();
	}
    //质量指标字典
	public function indexAction() {
	    $this->smarty->display(VIEW_DIR . "standard/dictionaries.html");
	}
	//质量指标字典 列表
    public function ajaxDictionaryListAction(){
        $list = $this->dictionary->getListByPid();
        $childList = $this->dictionary->getChildCountNumList();
        foreach ($list as $key => $value){
            $list[$key]['child_num'] = isset($childList[$value['id']])?$childList[$value['id']]:0;
        }
        $this->__displayOutput($list);
    }
    //质量指标字典 添加提交
    public function ajaxDictionaryAddAction(){
        $data = array(
            'cdate'     => date('Y-m-d H:i:s'),
            'p_id'      => 0,
            'status'    => 1,
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
    public function ajaxDictionaryDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->dictionary->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //子类展示
    public function ajaxDictionaryChildListAction(){
        $p_id = intval($this->__getParam('id'));
        $list = $this->dictionary->getListByPid($p_id);
        $this->__displayOutput($list);
    }
    //子类 添加&修改
    public function ajaxDictionaryChildAddUpdateAction(){
        $data = array(
            'id'                => $this->__getParam('id'),
            'cdate'             => date('Y-m-d H:i:s'),
            'p_id'              => $this->__getParam('p_id'),
            'type_name'         => $this->__getParam('type_name'),
            'standard'          => $this->__getParam('standard'),
            'computation'       => $this->__getParam('computation'),
            'range'             => $this->__getParam('range'),
            'statistical_mode'  => $this->__getParam('statistical_mode'),
            'formula'           => '',
            'is_formula'        => '否',
            'formula_num'       => '0',
            'monitor_focus'     => '否',
            'is_multi_index'    => '否',
            'status'            => $this->__getParam('status')
        );
        if (empty($data['id'])){
            unset($data['id']);
            $res = $this->dictionary->add($data);
        } else
            $res = $this->dictionary->update($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //设置公式
    public function ajaxDictionarySetFormulaAction(){
        $data = array(
            'id'              => $this->__getParam('id'),
            'cdate'           => date('Y-m-d H:i:s'),
            'formula'         => isset($_POST['formula'])?$_POST['formula']:'',
            'formula_section' => empty($_POST['section']) ? NULL:implode(',', $_POST['section'])
        );
        if (empty($data['formula']))
            $data['is_formula'] = '否';
        else
            $data['is_formula'] = '是';
        if (!empty($data['formula_section']))
            $data['formula_num'] = count($_POST['section']);
        $res = $this->dictionary->update($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //多标准值
    public function ajaxDictionaryGetMoreAction(){
        $id = intval($this->__getParam('id'));
        $list = $this->standard->getListByDid($id);
        $this->__displayOutput($list);
    }
    //多标准添加&修改
    public function ajaxDictionaryMoreAddUpdateAction(){
        $d_id = intval($this->__getParam('d_id'));
        $section = isset($_POST['section']) ? $_POST['section']:array();
        $data = array();
        if (!empty($section)){
            foreach ($section as $val){
                $data[] = array(
                    'd_id'      => $d_id,
                    'section'   => $val,
                    'standard'  => intval($_POST['standard'][$val])
                );
            }
            $dictionaryData = array(
                'id'            => $d_id,
                'cdate'         => date('Y-m-d H:i:s'),
                'is_multi_index'=> '是'
            );
        } else {
            $dictionaryData = array(
                'id'            => $d_id,
                'cdate'         => date('Y-m-d H:i:s'),
                'is_multi_index'=> '否'
            );
        }
        $this->dictionary->update($dictionaryData);
        $this->standard->deleteByDid($d_id);
        $res = true;
        if (!empty($data))
            $res = $this->standard->batchAdd($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //设置重点监测科目&作废
    public function ajaxUpdateChildAction(){
        $ids = $this->__getParam('ids');
        $status = intval($this->__getParam('status'));
        $data = array('cdate'=>date('Y-m-d H:i:s'));
        if ($status == 1)
            $data['monitor_focus'] = '是';
        elseif($status == 2)
            $data['monitor_focus'] = '否';
        elseif($status == 3)
            $data['status'] = 0;
        elseif($status == 4)
            $data['status'] = 1;
        elseif($status == 5){
            $data['is_formula'] = '否';
            $data['formula'] = NULL;
            $data['formula_num'] = 0;
            $data['formula_section'] = NULL;
        }
        $res = $this->dictionary->updateByIds($ids,$data);
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