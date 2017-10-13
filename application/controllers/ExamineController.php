<?php
require_once CTRL_DIR . 'WebBaseController.php';
require_once 'lib/CommonFuncs.php';

/**
 *
 * @author llx
 */
class ExamineController extends WebBaseController {

	/**
	 *
	 * @var AbnormalPiping
	 */
	protected $abnormalPiping;
	/**
	 *
	 * @var AbnormalMedicine
	 */
	protected $abnormalMedicine;
	/**
	 *
	 * @var AbnormalStab
	 */
	protected $abnormalStab;
	/**
	 *
	 * @var AbnormalPressure
	 */
	protected $abnormalPressure;
	/**
	 *
	 * @var AbnormalFall
	 */
	protected $abnormalFall;
	/**
	 *
	 * @var AbnormalOther
	 */
	protected $abnormalOther;
	/**
	 *
	 * @var Section
	 */
	protected $section;
	/**
	 *
	 * @var Analysis
	 */
	protected $analysis;
	/**
	 *
	 * @var Evaluation
	 */
	protected $evaluation;
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
		$this->smarty->assign('sectionList',$this->section->getKeyNameInfo());
	}
	//事件审核-管路 列表
    public function ajaxPipingListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalPiping->getListByUserLevel($level));
    }
    //事件审核-管路 审核提交
    public function ajaxPipingAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalPiping->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalPiping->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核-给药 列表
    public function ajaxMedicineListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalMedicine->getListByUserLevel($level));
    }
    //事件审核-给药 审核提交
    public function ajaxMedicineAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalMedicine->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalMedicine->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核-锐器 列表
    public function ajaxStabListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalStab->getListByUserLevel($level));
    }
    //事件审核-锐器 审核提交
    public function ajaxStabAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalStab->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalStab->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核-压疮 列表
    public function ajaxPressureListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalPressure->getListByUserLevel($level));
    }
    //事件审核-压疮 审核提交
    public function ajaxPressureAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalPressure->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalPressure->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核-坠床 列表
    public function ajaxFallListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalFall->getListByUserLevel($level));
    }
    //事件审核-坠床 审核提交
    public function ajaxFallAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalFall->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalFall->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核-其他 列表
    public function ajaxOtherListAction(){
        $level = $this->curUser['level']-1;
        $this->__displayOutput($this->abnormalOther->getListByUserLevel($level));
    }
    //事件审核-其他 审核提交
    public function ajaxOtherAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'examine_date'      => date('Y-m-d H:i:s'),
            'examine_info'      => $this->__getParam('examine_info'),
            'examine_id'        => $this->curUser['id']
        );
        if (intval($this->__getParam('is_adopt')) == 1){
            $data['status'] = $this->curUser['level'];
        } else {
            $data['status'] = -1;
        }
        if ($data['id'] > 0)
            $res = $this->abnormalOther->update($data);
        else{
            unset($data['id']);
            $res = $this->abnormalOther->add($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核 分析 获取信息
    public function ajaxGetOneAnalysisAction(){
        $a_id = $this->__getParam('a_id');
        $type = $this->__getParam('type');
        $analysisInfo = $this->analysis->getOneByAidAndType($a_id,$type);
        $this->__ajaxReturn(!empty($analysisInfo),'ok',$analysisInfo);
    }
    //事件审核 分析提交
    public function ajaxAnalysisSubmitAction(){
        $data = array(
            'a_id'          => $this->__getParam('analysis_id'),
            'type'          => $this->__getParam('type'),
            'cdate'         => date('Y-m-d H:i:s'),
            'problem1'      => $this->__getParam('problem1'),
            'problem2'      => $this->__getParam('problem2'),
            'problem3'      => $this->__getParam('problem3'),
            'correction1'   => $this->__getParam('correction1'),
            'correction2'   => $this->__getParam('correction2'),
            'correction3'   => $this->__getParam('correction3'),
            'responsible1'  => $this->__getParam('responsible1'),
            'responsible2'  => $this->__getParam('responsible2'),
            'responsible3'  => $this->__getParam('responsible3'),
            'over_time1'    => $this->__getParam('over_time1'),
            'over_time2'    => $this->__getParam('over_time2'),
            'over_time3'    => $this->__getParam('over_time3'),
            'head_department'=> $this->__getParam('head_department'),
            'head_nurse'    => $this->__getParam('head_nurse')
        );
        $analysisInfo = $this->analysis->getOneByAidAndType($data['a_id'],$data['type']);
        if (empty($analysisInfo))
            $res = $this->analysis->add($data);
        else{
            $data['id'] = $analysisInfo['id'];
            $res = $this->analysis->update($data);
        }
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件审核 分析 获取信息
    public function ajaxGetOneEvaluationAction(){
        $a_id = $this->__getParam('a_id');
        $type = $this->__getParam('type');
        $evaluationInfo = $this->evaluation->getOneByAidAndType($a_id,$type);
        $this->__ajaxReturn(!empty($evaluationInfo),'ok',$evaluationInfo);
    }
    //事件审核 评估提交
    public function ajaxEvaluationSubmitAction(){
        $data = array(
            'a_id'          => $this->__getParam('evaluation_id'),
            'type'          => $this->__getParam('type'),
            'cdate'         => date('Y-m-d H:i:s'),
            'frequency'     => $this->__getParam('frequency'),
            'event_cause'   => implode(',', $_POST['event_cause']),
            'severity'      => $this->__getParam('severity'),
            'improvement'   => $this->__getParam('improvement')
        );
        $evaluationInfo = $this->evaluation->getOneByAidAndType($data['a_id'],$data['type']);
        if (empty($evaluationInfo))
            $res = $this->evaluation->add($data);
        else{
            $data['id'] = $evaluationInfo['id'];
            $res = $this->evaluation->update($data);
        }
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