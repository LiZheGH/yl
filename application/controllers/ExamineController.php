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
	//事件上报-管路 列表
    public function ajaxPipingListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalPiping->getListByUserId($uid));
    }
    //事件上报-管路 添加/更新 提交
    public function ajaxPipingAddOrUpdateAction(){
        $data = array(
            'id'                => intval($this->__getParam('id')),
            'cdate'             => date('Y-m-d H:i:s'),
            'uid'               => $this->curUser['id'],
            'event_time'        => $this->__getParam('event_time'),
            'report_name'       => $this->__getParam('report_name'),
            'report_time'       => $this->__getParam('report_time'),
            'event_type'        => $this->__getParam('event_type'),
            'report_section'    => $this->__getParam('report_section'),
            'patient'           => $this->__getParam('patient'),
            'anamnesis_num'     => $this->__getParam('anamnesis_num'),
            'incident_disposal' => empty($_POST['incident_disposal'])?
                                    '':implode(',', $_POST['incident_disposal']),
            'patient_response'  => $this->__getParam('patient_response'),
            'notice_of_incident'=> $this->__getParam('notice_of_incident'),
            'incident'          => $this->__getParam('incident'),
            'patient_gender'    => $this->__getParam('patient_gender'),
            'patient_age'       => $this->__getParam('patient_age'),
            'patient_section'   => $this->__getParam('patient_section'),
            'shift'             => $this->__getParam('shift'),
            'party_name'        => $this->__getParam('party_name'),
            'event_section'     => $this->__getParam('event_section'),
            'party_title'       => $this->__getParam('party_title'),
            'patient_type'      => $this->__getParam('patient_type'),
            'patient_edu'       => $this->__getParam('patient_edu'),
            'health_education'  => $this->__getParam('health_education'),
            'fixation_method'   => $this->__getParam('fixation_method'),
            'escort'            => $this->__getParam('escort'),
            'complication'      => empty($_POST['complication']) ?
                                    '':implode(',', $_POST['complication']),
            'sedative'          => $this->__getParam('sedative'),
            'sedatives_before'  => $this->__getParam('sedatives_before'),
            'conscious_state'   => empty($_POST['conscious_state']) ?
                                    '': implode(',', $_POST['conscious_state']),
            'mentality'         => $this->__getParam('mentality'),
            'activity_ability'  => $this->__getParam('activity_ability'),
            'working_years'     => $this->__getParam('working_years'),
            'self_care_ability' => $this->__getParam('self_care_ability'),
            'status'            => 0
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-管路 删除
    public function ajaxPipingDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalPiping->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报-给药 列表
    public function ajaxMedicineListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalMedicine->getListByUserId($uid));
    }
    //事件上报-给药 添加/更新 提交
    public function ajaxMedicineAddOrUpdateAction(){
        $data = array(
            'id'                    => intval($this->__getParam('id')),
            'cdate'                 => date('Y-m-d H:i:s'),
            'uid'                   => $this->curUser['id'],
            'status'                => 0,
            'event_time'            => $this->__getParam('event_time'),
            'event_section'         => $this->__getParam('event_section'),
            'event_type'            => $this->__getParam('event_type'),
            'incident'              => $this->__getParam('incident'),
            'incident_link'         => $this->__getParam('incident_link'),
            'drug_name'             => $this->__getParam('drug_name'),
            'disposal_drug_name'    => $this->__getParam('disposal_drug_name'),
            'disposal_check_items'  => $this->__getParam('disposal_check_items'),
            'disposal_methods'      => empty($_POST['disposal_methods']) ?
                                        '':implode(',', $_POST['disposal_methods']),
            'is_take_drug'          => $this->__getParam('is_take_drug'),
            'patient_diagnosis'     => $this->__getParam('patient_diagnosis'),
            'error_drug'            => $this->__getParam('error_drug'),
            'medication_response'   => $this->__getParam('medication_response'),
            'notice_of_incident'    => empty($_POST['notice_of_incident']) ?
                                        '':implode(',', $_POST['notice_of_incident']),
            'correct_medicines'     => $this->__getParam('correct_medicines'),
            'wrong_drugs'           => $this->__getParam('wrong_drugs'),
            'correct_dose'          => $this->__getParam('correct_dose'),
            'wrong_dose'            => $this->__getParam('wrong_dose'),
            'correct_time'          => $this->__getParam('correct_time'),
            'wrong_time'            => $this->__getParam('wrong_time'),
            'right_way'             => $this->__getParam('right_way'),
            'wrong_way'             => $this->__getParam('wrong_way'),
            'who_found'             => empty($_POST['who_found']) ?
                                        '':implode(',', $_POST['who_found']),
            'whose_mistake'         => empty($_POST['whose_mistake']) ?
                                        '':implode(',', $_POST['whose_mistake']),
            'patient_section'       => $this->__getParam('patient_section'),
            'patient'               => $this->__getParam('patient'),
            'patient_gender'        => $this->__getParam('patient_gender'),
            'anamnesis_num'         => $this->__getParam('anamnesis_num'),
            'patient_age'           => $this->__getParam('patient_age'),
            'patient_type'          => $this->__getParam('patient_type'),
            'patient_response'      => $this->__getParam('patient_response'),
            'party_name'            => $this->__getParam('party_name'),
            'party_title'           => $this->__getParam('party_title'),
            'working_years'         => $this->__getParam('working_years'),
            'shift'                 => $this->__getParam('shift'),
            'report_time'           => $this->__getParam('report_time'),
            'report_section'        => $this->__getParam('report_section'),
            'report_name'           => $this->__getParam('report_name'),
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-给药 删除
    public function ajaxMedicineDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalMedicine->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报-锐器 列表
    public function ajaxStabListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalStab->getListByUserId($uid));
    }
    //事件上报-锐器 添加/更新 提交
    public function ajaxStabAddOrUpdateAction(){
        $data = array(
            'id'                    => intval($this->__getParam('id')),
            'cdate'                 => date('Y-m-d H:i:s'),
            'uid'                   => $this->curUser['id'],
            'status'                => 0,
            'event_time'            => $this->__getParam('event_time'),
            'event_section'         => $this->__getParam('event_section'),
            'event_type'            => $this->__getParam('event_type'),
            'incident'              => $this->__getParam('incident'),
            'incident_link'         => $this->__getParam('incident_link'),
            'incident_location'     => $this->__getParam('incident_location'),
            'degree_injury'         => $this->__getParam('degree_injury'),
            'stab_type'             => $this->__getParam('stab_type'),
            'stab_objective'        => $this->__getParam('stab_objective'),
            'blood_test'            => $_POST['blood_test'],
            'hurt_from'             => $this->__getParam('hurt_from'),
            'casualty_category'     => $this->__getParam('casualty_category'),
            'blood_contaminated'    => $this->__getParam('blood_contaminated'),
            'is_gloves'             => $this->__getParam('is_gloves'),
            'is_hepatitis'          => $this->__getParam('is_hepatitis'),
            'correct_operation'     => $this->__getParam('correct_operation'),
            'notified_immediately'  => empty($_POST['notified_immediately']) ?
                                        '':implode(',', $_POST['notified_immediately']),
            'patient_origin'        => empty($_POST['patient_origin']) ?
                                        '':implode(',', $_POST['patient_origin']),
            'disposal_methods'      => empty($_POST['disposal_methods']) ?
                                        '':implode(',', $_POST['disposal_methods']),
            'patient'               => $this->__getParam('patient'),
            'patient_gender'        => $this->__getParam('patient_gender'),
            'anamnesis_num'         => $this->__getParam('anamnesis_num'),
            'patient_age'           => $this->__getParam('patient_age'),
            'working_years'         => $this->__getParam('working_years'),
            'report_time'           => $this->__getParam('report_time'),
            'report_section'        => $this->__getParam('report_section'),
            'report_name'           => $this->__getParam('report_name'),
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-锐器 删除
    public function ajaxStabDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalStab->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报-压疮 列表
    public function ajaxPressureListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalPressure->getListByUserId($uid));
    }
    //事件上报-压疮 添加/更新 提交
    public function ajaxPressureAddOrUpdateAction(){
        $data = array(
            'id'                    => intval($this->__getParam('id')),
            'cdate'                 => date('Y-m-d H:i:s'),
            'uid'                   => $this->curUser['id'],
            'status'                => 0,
            'event_time'            => $this->__getParam('event_time'),
            'event_section'         => $this->__getParam('event_section'),
            'event_type'            => $this->__getParam('event_type'),
            'incident'              => $this->__getParam('incident'),
            'incident_disposal'     => empty($_POST['incident_disposal']) ?
                                        '':implode(',', $_POST['incident_disposal']),
            'pre_incident_state'    => $this->__getParam('pre_incident_state'),
            'functional_impairment' => $this->__getParam('functional_impairment'),
            'pressure_origin'       => $this->__getParam('pressure_origin'),
            'pressure_location'     => empty($_POST['pressure_location']) ?
                                        '':implode(',', $_POST['pressure_location']),
            'pressure_area'         => $this->__getParam('pressure_area'),
            'pressure_level'        => $this->__getParam('pressure_level'),
            'patient_diagnosis'     => $this->__getParam('patient_diagnosis'),
            'notice_of_incident'    => empty($_POST['notice_of_incident']) ?
                                        '':implode(',', $_POST['notice_of_incident']),
            'patient_section'       => $this->__getParam('patient_section'),
            'patient'               => $this->__getParam('patient'),
            'patient_gender'        => $this->__getParam('patient_gender'),
            'anamnesis_num'         => $this->__getParam('anamnesis_num'),
            'patient_age'           => $this->__getParam('patient_age'),
            'patient_type'          => $this->__getParam('patient_type'),
            'patient_position'      => $this->__getParam('patient_position'),
            'medical_category'      => $this->__getParam('medical_category'),
            'patient_edu'           => $this->__getParam('patient_edu'),
            'patient_response'      => $this->__getParam('patient_response'),
            'report_time'           => $this->__getParam('report_time'),
            'report_section'        => $this->__getParam('report_section'),
            'report_name'           => $this->__getParam('report_name'),
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-压疮 删除
    public function ajaxPressureDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalPressure->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报-坠床 列表
    public function ajaxFallListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalFall->getListByUserId($uid));
    }
    //事件上报-坠床 添加/更新 提交
    public function ajaxFallAddOrUpdateAction(){
        $data = array(
            'id'                    => intval($this->__getParam('id')),
            'cdate'                 => date('Y-m-d H:i:s'),
            'uid'                   => $this->curUser['id'],
            'status'                => 0,
            'event_time'            => $this->__getParam('event_time'),
            'event_section'         => $this->__getParam('event_section'),
            'event_type'            => $this->__getParam('event_type'),
            'incident'              => $this->__getParam('incident'),
            'incident_link'         => $this->__getParam('incident_link'),
            'incident_location'     => $this->__getParam('incident_location'),
            'incident_disposal'     => empty($_POST['incident_disposal']) ?
                                        '':implode(',', $_POST['incident_disposal']),
            'pre_incident_state'    => $this->__getParam('pre_incident_state'),
            'functional_impairment' => $this->__getParam('functional_impairment'),
            'pre_patient_state'     => $this->__getParam('pre_patient_state'),
            'after_patient_state'   => $this->__getParam('after_patient_state'),

            'injury_classification' => $this->__getParam('injury_classification'),
            'patient_diagnosis'     => $this->__getParam('patient_diagnosis'),
            'notice_of_incident'    => empty($_POST['notice_of_incident']) ?
                                        '':implode(',', $_POST['notice_of_incident']),
            'patient_section'       => $this->__getParam('patient_section'),
            'patient'               => $this->__getParam('patient'),
            'patient_gender'        => $this->__getParam('patient_gender'),
            'anamnesis_num'         => $this->__getParam('anamnesis_num'),
            'patient_age'           => $this->__getParam('patient_age'),
            'patient_type'          => $this->__getParam('patient_type'),
            'patient_position'      => $this->__getParam('patient_position'),
            'medical_category'      => $this->__getParam('medical_category'),
            'patient_edu'           => $this->__getParam('patient_edu'),
            'governance_capability' => $this->__getParam('governance_capability'),
            'escort'                => $this->__getParam('escort'),
            'patient_response'      => $this->__getParam('patient_response'),
            'party_name'            => $this->__getParam('party_name'),
            'party_title'           => $this->__getParam('party_title'),
            'working_years'         => $this->__getParam('working_years'),
            'shift'                 => $this->__getParam('shift'),
            'report_time'           => $this->__getParam('report_time'),
            'report_section'        => $this->__getParam('report_section'),
            'report_name'           => $this->__getParam('report_name'),
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-坠床 删除
    public function ajaxFallDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalFall->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报-其他 列表
    public function ajaxOtherListAction(){
        $uid = $this->curUser['id'];
        $this->__displayOutput($this->abnormalOther->getListByUserId($uid));
    }
    //事件上报-其他 添加/更新 提交
    public function ajaxOtherAddOrUpdateAction(){
        $data = array(
            'id'                    => intval($this->__getParam('id')),
            'cdate'                 => date('Y-m-d H:i:s'),
            'uid'                   => $this->curUser['id'],
            'status'                => 0,
            'event_time'            => $this->__getParam('event_time'),
            'event_section'         => $this->__getParam('event_section'),
            'event_type'            => $this->__getParam('event_type'),
            'incident'              => $this->__getParam('incident'),
            'incident_link'         => $this->__getParam('incident_link'),
            'incident_location'     => $this->__getParam('incident_location'),
            'incident_disposal'     => empty($_POST['incident_disposal']) ?
                                        '':implode(',', $_POST['incident_disposal']),
            'pre_incident_state'    => $this->__getParam('pre_incident_state'),
            'functional_impairment' => $this->__getParam('functional_impairment'),
            'pre_patient_state'     => $this->__getParam('pre_patient_state'),
            'after_patient_state'   => $this->__getParam('after_patient_state'),
            'patient_diagnosis'     => $this->__getParam('patient_diagnosis'),
            'notice_of_incident'    => empty($_POST['notice_of_incident']) ?
                                        '':implode(',', $_POST['notice_of_incident']),
            'infected_type'         => $this->__getParam('infected_type'),
            'blood_type'            => $this->__getParam('blood_type'),
            'anaesthesia_type'      => $this->__getParam('anaesthesia_type'),
            'medical_type'          => $this->__getParam('medical_type'),
            'equipment_type'        => $this->__getParam('equipment_type'),
            'alert_type'            => $this->__getParam('alert_type'),
            'who_found'             => $this->__getParam('who_found'),
            'whose_mistake'         => $this->__getParam('whose_mistake'),
            'patient_section'       => $this->__getParam('patient_section'),
            'patient'               => $this->__getParam('patient'),
            'patient_gender'        => $this->__getParam('patient_gender'),
            'anamnesis_num'         => $this->__getParam('anamnesis_num'),
            'patient_age'           => $this->__getParam('patient_age'),
            'patient_type'          => $this->__getParam('patient_type'),
            'patient_position'      => $this->__getParam('patient_position'),
            'medical_category'      => $this->__getParam('medical_category'),
            'patient_response'      => $this->__getParam('patient_response'),
            'report_time'           => $this->__getParam('report_time'),
            'report_section'        => $this->__getParam('report_section'),
            'report_name'           => $this->__getParam('report_name'),
        );
        if (empty($data['report_time']))
            $data['report_time'] = date('Y-m-d H:i:s');
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
    //事件上报-其他 删除
    public function ajaxOtherDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->abnormalOther->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //事件上报 分析 获取信息
    public function ajaxGetOneAnalysisAction(){
        $a_id = $this->__getParam('a_id');
        $type = $this->__getParam('type');
        $analysisInfo = $this->analysis->getOneByAidAndType($a_id,$type);
        $this->__ajaxReturn(!empty($analysisInfo),'ok',$analysisInfo);
    }
    //事件上报 分析提交
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
    //事件上报 分析 获取信息
    public function ajaxGetOneEvaluationAction(){
        $a_id = $this->__getParam('a_id');
        $type = $this->__getParam('type');
        $evaluationInfo = $this->evaluation->getOneByAidAndType($a_id,$type);
        $this->__ajaxReturn(!empty($evaluationInfo),'ok',$evaluationInfo);
    }
    //事件上报 评估提交
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