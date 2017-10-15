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
	 *
	 * @var ExportDictionary
	 */
	protected $exportDictionary;
	/**
	 *
	 * @var ReportdeDpartment
	 */
	protected $reportdeDpartment;
	/**
	 *
	 * @var ReportIndicators
	 */
	protected $reportIndicators;
    /**
     *
     * @var ImportData
     */
	protected $importData;

	private $sectionList;
	private $exportDictionaryList;
	private $reportDictionaryList;
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

		$this->sectionList = $this->section->getKeyNameInfo();
		$this->smarty->assign('sectionList',$this->sectionList);

		$this->exportDictionaryList = $this->exportDictionary->getList();
		$this->smarty->assign('exportDictionaryList',$this->exportDictionaryList);

		$this->reportDictionaryList = $this->reportdeDpartment->getList();
		$this->smarty->assign('reportDictionaryList',$this->reportDictionaryList);

		if ($this->__getParam('sessionid') && ($session_id = $this->__getParam('sessionid')) != session_id()) {
		    $this->__log('sessionid', $this->__getParam('sessionid'));
		    session_destroy();
		    session_id($session_id);
		    session_start();
		    setcookie('PHPSESSID', $session_id, 0);
		    $this->curUser = isset($_SESSION['retailer_account']) ? $_SESSION['retailer_account'] : array();
		}
		$this->smarty->assign('sessionid', session_id());
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
            'standard'          => intval($this->__getParam('standard')),
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
    //导出科室字典列表
    public function ajaxGetExportDictionaryAction(){
        $this->__displayOutput($this->exportDictionaryList);
    }
    //导出科室字典提交
    public function ajaxExportDictionarySubmitAction(){
        $section = isset($_POST['section']) ? $_POST['section']:array();
        $data = array();
        if (!empty($section)){
            foreach ($section as $val){
                $data[] = array(
                    'section'   => $val,
                    'standard'  => intval($_POST['standard'][$val])
                );
            }
        }
        $this->exportDictionary->deleteAll();
        if (!empty($data))
            $res = $this->exportDictionary->batchAdd($data);
        else
            $res = true;
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //选择无关科室列表
    public function ajaxDictionaryGetAllChildAction(){
        $this->__displayOutput($this->dictionary->getAllChildList());
    }
    //选择上报部门
    public function ajaxGetReportDepartmentAction(){
        $this->__displayOutput($this->reportDictionaryList);
    }
    //选择上报部门-提交
    public function ajaxSubmitReportDepartmentAction(){
        $section = isset($_POST['section']) ? $_POST['section']:array();
        $data = array();
        if (!empty($section)){
            foreach ($section as $val){
                $data[] = array(
                    'section'   => $val,
                    'standard'  => intval($_POST['standard'][$val])
                );
            }
        }
        $this->reportdeDpartment->deleteAll();
        if (!empty($data))
            $res = $this->reportdeDpartment->batchAdd($data);
        else
            $res = true;
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //选择上报指标-列表
    public function ajaxGetReportIndicatorsAction(){
        $list = $this->reportdeDpartment->getAll();
        $sectionKeyInfo = $this->sectionList;
        $reportKeyInfo = $this->reportIndicators->getList();
        foreach ($list as $key => $value){
            $list[$key]['name'] = $sectionKeyInfo[$value['section']];
            $list[$key]['subject_num'] = isset($reportKeyInfo[$value['section']]['subject_num'])?
                                            $reportKeyInfo[$value['section']]['subject_num']:0;
            $list[$key]['section_num'] = isset($reportKeyInfo[$value['section']]['section_num'])?
                                            $reportKeyInfo[$value['section']]['section_num']:0;
            $list[$key]['subject_ids'] = isset($reportKeyInfo[$value['section']]['subject_ids'])?
                                            $reportKeyInfo[$value['section']]['subject_ids']:'';
            $list[$key]['section_ids'] = isset($reportKeyInfo[$value['section']]['section_ids'])?
                                            $reportKeyInfo[$value['section']]['section_ids']:'';
        }
        $this->__displayOutput($list);
    }
    //选择上报指标-详情列表
    public function ajaxIndicatorsChildListAction(){
        $section = intval($this->__getParam('section'));
        $list = $this->reportIndicators->getOneBySection($section);
        $data = array();
        if (isset($list['subject_ids']) && $list['subject_ids'] != '')
            $data = $this->dictionary->getListByIds($list['subject_ids']);
        $this->__displayOutput($data);
    }
    //选择上报指标-详情列表-删除
    public function ajaxDeleteSubjecAction(){
        $subject_id = intval($this->__getParam('id'));
        $section = intval($this->__getParam('section'));
        $list = $this->reportIndicators->getOneBySection($section);
        if (isset($list['subject_ids'])){
            $listSubjectNumArr = explode(",",$list['subject_ids']);
            $key = array_search($subject_id, $listSubjectNumArr);
            if ($key !== false)
                array_splice($listSubjectNumArr, $key, 1);
            $data = array(
                'id'          => $list['id'],
                'cdate'       => date('Y-m-d H:i:s'),
                'subject_ids' => implode(",",$listSubjectNumArr),
                'subject_num' => count($listSubjectNumArr)
            );
            if (empty($data['subject_ids']))
                $data['subject_ids'] = NULL;
            $res = $this->reportIndicators->update($data);
            if ($res)
                $this->__ajaxReturn(true,'成功');
            else
                $this->__ajaxReturn(false,'失败');
        } else {
            $this->__ajaxReturn(false,'失败,缺少ID');
        }
    }
    //选择上报指标-选择科目提交
    public function ajaxSubmitSubjecAction(){
        $data = array(
            'cdate'         => date('Y-m-d H:i:s'),
            'section'       => intval($this->__getParam('section')),
            'subject_ids'   => $this->__getParam('subject_ids')
        );
        $list = $this->reportIndicators->getOneBySection($data['section']);
        if (isset($list['id'])){
            $data['id'] = $list['id'];
            if (empty($list['subject_ids']))
                $allSubjectArr = explode(',',$data['subject_ids']);
            else
                $allSubjectArr = explode(',',$list['subject_ids'].','.$data['subject_ids']);
            $allSubjectArr = array_flip(array_flip($allSubjectArr));
            $data['subject_ids'] = implode(",",$allSubjectArr);
            $data['subject_num'] = count($allSubjectArr);
            $res = $this->reportIndicators->update($data);
        } else
            $res = $this->reportIndicators->add($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //选择上报指标-负责科室管理-提交
    public function ajaxSubmitSectionAction(){
        $data = array(
            'cdate'         => date('Y-m-d H:i:s'),
            'section'       => intval($this->__getParam('section_id')),
            'section_ids'   => implode(',',$_POST['section'])
        );
        $list = $this->reportIndicators->getOneBySection($data['section']);
        if (isset($list['id'])){
            $data['id'] = $list['id'];
            $data['section_num'] = count(explode(',',$data['section_ids']));
            $res = $this->reportIndicators->update($data);
        } else
            $res = $this->reportIndicators->add($data);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //导入数据-下载模板-验证导出
    public function ajaxDownTemplateAction(){
        $section = intval($this->__getParam('section'));
        $exportList = $this->reportIndicators->getOneBySection($section);
        if (empty($exportList['subject_num']))
            $this->__ajaxReturn(false, '当前科室 上报指标 无【管理质量科目】');
        elseif (empty($exportList['section_num']))
            $this->__ajaxReturn(false, '当前科室 上报指标 无【负责科室】');
        else
            $this->__ajaxReturn(true, 'ok');
    }
    //导入数据-下载模板
    public function downTemplateAction(){
        set_time_limit(0);
        ini_set("memory_limit","512M");
        header('Content-Type: application/vnd.ms-excel');
        $section = intval($this->__getParam('section'));
        $reportIndicatorsInfo = $this->reportIndicators->getOneBySection($section);
        $sectionKeyInfo = $this->sectionList;
        $data = array();
        $sectionArr = explode(',',$reportIndicatorsInfo['section_ids']);
        $i = 69;
        foreach ($sectionArr as $val){
            if ($val != 0)
                $data['1'][chr($i++)] = $sectionKeyInfo[$val];
        }
        $dictionaryList = $this->dictionary->getListByIds($reportIndicatorsInfo['subject_ids']);
        $i = 2;
        foreach ($dictionaryList as $value){
            $data[$i++] = array(
                'A' => $value['id'],
                'B' => $value['type_name'],
                'C' => $value['range'].$value['standard']
            );
        }
        $fileName = "模板.xlsx";
        require_once 'lib/PHPExcel.php';
        require_once 'lib/PHPExcel/IOFactory.php';
        require_once 'lib/PHPExcel/Reader/Excel2007.php';
        // 创建PHPExcel对象
        $objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load(BASE_DIR . "public/temp/" . $fileName);
        // 循环设置特殊值
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $line) {
            foreach ($line as $k => $v) {
                $objActSheet->setCellValue($k . $key, $v);
            }
        }
        // 重命名表
        $fileName = iconv("utf-8", "gb2312", $sectionKeyInfo[$section]."模板.xlsx");
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); // 文件通过浏览器下载
        exit();
    }
    //导入数据-提交模板
    public function ajaxUploadDataAction(){
        if (empty($_FILES))
            $this->__ajaxReturn(false, '文件丢失！');

        $tempFile = $_FILES['Filedata']['tmp_name'];
        $fileParts = pathinfo($_FILES['Filedata']['name']);
        $data = array(
            'file_ext' => $fileParts['extension'],
            'original_name' => $_FILES['Filedata']['name'], // 客户端文件的原名称
            'mime_type' => mime_content_type($_FILES['Filedata']['tmp_name']), // 文件的 MIME类型，需要浏览器提供该信息的支持，例如"image/gif"
            'file_size' => $_FILES['Filedata']['size']
        ); // 已上传文件的大小，单位为字节

        if (strtolower($data['file_ext']) != 'xlsx')
            $this->__ajaxReturn(false, '非法文件，服务器拒绝接收！');
        // 将文件移到缓存
        $targetFile = '/var/tmp/' . CommonFuncs::getUUID() . '.' . $fileParts['extension'];
        move_uploaded_file($tempFile, $targetFile);
        // 解析xls文件
        $xls_data = CommonFuncs::parseXLS2($targetFile, 1);
        if (! $xls_data || ! is_array($xls_data)){
            $error_msg = array(
                'success' => false,
                'msg' => '文件解析失败，请检查文件内容！',
                'type' => 'error'
            );
            $this->__displayOutput($error_msg);
        }
        $SysDate = date("Y-m-d H:i:s");
        $report_time = $this->__getParam('report_time');
        if (empty($report_time) || strtotime($report_time) > time() )
            $this->__ajaxReturn(false,'上报时间不合法！');
        // 初始化数据
        $report_section = intval($this->__getParam('report_section'));
        $sectionList = $this->sectionList;
        $sectionList = array_flip($sectionList);
        $sectionList['全院'] = 0;
        $headerInfo = $xls_data['1'];
        foreach ($headerInfo as $key => $value){
            if ($key < 3)
                unset($headerInfo[$key]);
            else{
                $value = trim($value);
                if ($value == '')
                    unset($headerInfo[$key]);
                else
                    $headerInfo[$key] = $value;
            }
        }
        unset($xls_data['1']);
        $data = array();
        foreach ($xls_data as $line){
            if (empty($line['0'])) break;
            foreach ($headerInfo as $k => $value){
                if ($k < 2)
                    continue;
                else
                    $data[] = array(
                        'cdate'             => $SysDate,
                        'report_time'       => $report_time,
                        'report_section'    => $report_section,
                        'section'           => intval($sectionList[$value]),
                        'subject_id'        => intval($line['0']),
                        'value'             => $line[$k]
                    );
            }
        }
        $res = $this->importData->batchAdd($data);
        if ($res)
            $this->__ajaxReturn(true, '上传成功');
        else
            $this->__ajaxReturn(false, '上传失败');
    }
    //历史上报数据
    public function ajaxImportDataListAction(){
        $report_time = $this->__getParam('report_time');
        if (empty($report_time))
            $report_time = date("Y-m");
        else
            $report_time = date("Y-m",strtotime($report_time));
        $list = $this->importData->getListByReportTime($report_time);
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $data = array();
        foreach ($list as $value) {
            $data[$value['cdate'].$value['subject_id']][$value['section']] = $value['value'];
        }
        $listData = array();
        $i = 0;
        foreach ($data as $key => $sectionList){
            $listData[$i]['id'] = $i;
            $listData[$i]['cdate'] = substr($key,0,19);
            $subject_id = substr($key,19);
            $listData[$i]['type_name'] = $allChild[$subject_id]['type_name'];
            $listData[$i]['standard'] = $allChild[$subject_id]['range'].$allChild[$subject_id]['standard'];
            foreach ($sectionList as $section => $value){
                $listData[$i]['s'.$section] = $value;
            }
            $i++;
        }
        $this->__displayOutput($listData);
    }
    //修改数据
    public function ajaxEditImportDataListAction(){
        $report_time = $this->__getParam('report_time');
        if (empty($report_time))
            $report_time = date("Y-m");
        else
            $report_time = date("Y-m",strtotime($report_time));
        $list = $this->importData->getListByReportTime($report_time);
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $listData = array();
        foreach ($list as $value){
            if ($value['section'] == 0)
                $section_name = '全院';
            else
                $section_name = $this->sectionList[$value['section']];
            if ($value['report_section'] == 0)
                $report_section_name = '全院';
            else
                $report_section_name = $this->sectionList[$value['report_section']];
            $listData[] = array(
                'id'                    => $value['id'],
                'section_name'          => $section_name,
                'type_name'             => $allChild[$value['subject_id']]['type_name'],
                'standard'              => $allChild[$value['subject_id']]['range'].$allChild[$value['subject_id']]['standard'],
                'value'                 => $value['value'],
                'report_section_name'   => $report_section_name
            );
        }
        $this->__displayOutput($listData);
    }
    //导入数据 - 删除
    public function ajaxImportDataDeleteAction(){
        $id = intval($this->__getParam('id'));
        $res = $this->importData->delete($id);
        if ($res)
            $this->__ajaxReturn(true,'成功');
        else
            $this->__ajaxReturn(false,'失败');
    }
    //按月汇总
    public function ajaxGetSummaryMonthListAction(){
        $report_time = $this->__getParam('report_time');
        if (empty($report_time))
            $report_time = date("Y");
        else
            $report_time = date("Y",strtotime($report_time));
        $list = $this->importData->getListByYearReportTime($report_time);
        $data = array();
        foreach ($list as $value){
            $month = substr($value['report_time'],5,2);
            $data[$value['section'].'-'.$value['subject_id']][$month] = $value['value'];
        }
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $listData = array();
        $i = 0;
        foreach ($data as $key => $value){
            $sectionSubjectArr = explode('-',$key);
            $subject_id = $sectionSubjectArr[1];
            $listData[$i]['id'] = $i;
            if ($sectionSubjectArr[0] == 0)
                $section_name = '全院';
            else
                $section_name = $this->sectionList[$sectionSubjectArr[0]];
            $listData[$i]['section_name'] = $section_name;
            $listData[$i]['type_name'] = $allChild[$subject_id]['type_name'];
            $listData[$i]['standard'] = $allChild[$subject_id]['range'].$allChild[$subject_id]['standard'];
            $num = 0;
            $sum = 0;
            foreach ($value as $k => $v){
                $listData[$i]['m'.$k] = $v;
                $num++;
                $sum += $v;
            }
            $average = $sum/$num;
            $listData[$i]['average'] = $average;
            if (
                    in_array($allChild[$subject_id]['range'],array('≥','＞'))
                && $average < $allChild[$subject_id]['standard']
            ) {
                 $listData[$i]['status'] = -1;
            } elseif (
                    in_array($allChild[$subject_id]['range'],array('≤','＜'))
                && $average > $allChild[$subject_id]['standard']
            ){
                 $listData[$i]['status'] = 1;
            } else {
                 $listData[$i]['status'] = 0;
            }
            $i++;
        }
        $this->__displayOutput($listData);
    }
    //按科室汇总
    public function ajaxGetSummarySectionListAction(){
        $report_time = $this->__getParam('report_time');
        if (empty($report_time))
            $report_time = date("Y-m");
        else
            $report_time = date("Y-m",strtotime($report_time));
        $list = $this->importData->getListByReportTime($report_time);
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $data = array();
        foreach ($list as $value){
            $data[$value['subject_id']][$value['section']] = $value['value'];
        }
        $listData = array();
        $i = 0;
        foreach ($data as $subject_id => $sectionList){
            $listData[$i] = array(
                'id'                    => $subject_id,
                'type_name'             => $allChild[$subject_id]['type_name'],
                'standard'              => $allChild[$subject_id]['range'].$allChild[$subject_id]['standard'],
            );
            foreach ($sectionList as $section =>  $value){
                $listData[$i]['s'.$section] = $value;
            }
            $i++;
        }
        $this->__displayOutput($listData);
    }
    //导出数据-展示
    public function ajaxGetExportDataListAction(){
        $start_time = $this->__getParam('report_time_start');
        $end_time = $this->__getParam('report_time_end');
        if (empty($start_time) && empty($end_time)){
            $start_time = date("Y-m-01");
            $end_time = date("Y-m-d");
        } else {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time);
            if ($start_time > $end_time){
                $temp_time = $start_time;
                $start_time = $end_time;
                $end_time = $temp_time;
            }
            $start_time = date("Y-m-d",$start_time);
            $end_time = date("Y-m-d",$end_time);
        }
        $where = " WHERE `report_time` >= '{$start_time}' AND `report_time` <= '{$end_time}'";
        $list = $this->importData->getListByWhere($where);
        $data = array();
        foreach ($list as $value){
            $month = substr($value['report_time'],5,2);
            $data[$value['section'].'-'.$value['subject_id']][$month] = $value['value'];
        }
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $listData = array();
        $i = 0;
        foreach ($data as $key => $value){
            $sectionSubjectArr = explode('-',$key);
            $subject_id = $sectionSubjectArr[1];
            $listData[$i]['id'] = $i;
            if ($sectionSubjectArr[0] == 0)
                $section_name = '全院';
            else
                $section_name = $this->sectionList[$sectionSubjectArr[0]];
            $listData[$i]['section_name'] = $section_name;
            $listData[$i]['type_name'] = $allChild[$subject_id]['type_name'];
            $listData[$i]['standard'] = $allChild[$subject_id]['range'].$allChild[$subject_id]['standard'];
            $num = 0;
            $sum = 0;
            foreach ($value as $k => $v){
                $listData[$i]['m'.$k] = $v;
                $num++;
                $sum += $v;
            }
            $average = $sum/$num;
            $listData[$i]['average'] = $average;
            if (
                in_array($allChild[$subject_id]['range'],array('≥','＞'))
                && $average < $allChild[$subject_id]['standard']
            ) {
                $listData[$i]['status'] = -1;
            } elseif (
                in_array($allChild[$subject_id]['range'],array('≤','＜'))
                && $average > $allChild[$subject_id]['standard']
            ){
                $listData[$i]['status'] = 1;
            } else {
                $listData[$i]['status'] = 0;
            }
            $i++;
        }
        $this->__displayOutput($listData);
    }
    //导出数据-下载Excel
    public function ajaxExportImportDataListAction(){
        set_time_limit(0);
        $start_time = $this->__getParam('s');
        $end_time = $this->__getParam('e');
        if (empty($start_time) && empty($end_time)){
            $start_time = date("Y-m-01");
            $end_time = date("Y-m-d");
        } else {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time);
            if ($start_time > $end_time){
                $temp_time = $start_time;
                $start_time = $end_time;
                $end_time = $temp_time;
            }
            $start_time = date("Y-m-d",$start_time);
            $end_time = date("Y-m-d",$end_time);
        }
        $where = " WHERE `report_time` >= '{$start_time}' AND `report_time` <= '{$end_time}'";
        $list = $this->importData->getListByWhere($where);
        $data = array();
        foreach ($list as $value){
            $month = substr($value['report_time'],5,2);
            $data[$value['section'].'-'.$value['subject_id']][$month] = $value['value'];
        }
        $allChild = $this->dictionary->getAllChildKeyInfo();
        $listData = array();
        $i = 0;
        $idsArr = explode(',',$this->__getParam('ids'));
        foreach ($data as $key => $value){
            if (!in_array(($i+1),$idsArr)){
                $i++;
                continue;
            }
            $sectionSubjectArr = explode('-',$key);
            $subject_id = $sectionSubjectArr[1];
            $listData[$i]['id'] = $i;
            if ($sectionSubjectArr[0] == 0)
                $section_name = '全院';
            else
                $section_name = $this->sectionList[$sectionSubjectArr[0]];
            $listData[$i]['section_name'] = $section_name;
            $listData[$i]['type_name'] = $allChild[$subject_id]['type_name'];
            $listData[$i]['standard'] = $allChild[$subject_id]['range'].$allChild[$subject_id]['standard'];
            $num = 0;
            $sum = 0;
            foreach ($value as $k => $v){
                $listData[$i]['m'.$k] = $v;
                $num++;
                $sum += $v;
            }
            $average = $sum/$num;
            $listData[$i]['average'] = $average;
            if (
                in_array($allChild[$subject_id]['range'],array('≥','＞'))
                && $average < $allChild[$subject_id]['standard']
            ) {
                $listData[$i]['status'] = -1;
            } elseif (
                in_array($allChild[$subject_id]['range'],array('≤','＜'))
                && $average > $allChild[$subject_id]['standard']
            ){
                $listData[$i]['status'] = 1;
            } else {
                $listData[$i]['status'] = 0;
            }
            $i++;
        }
        $data = array();
        $statusArr = array('0'=>'↓','1'=>'','2'=>'↑');
        $data[1]['A'] = '起止日期：'.$start_time.' 至 '.$end_time;
        $i = 3;
        foreach ($listData as $value){
            $data[$i++] = array(
                'A' => $i-3,
                'B' => $value['section_name'],
                'C' => $value['type_name'],
                'D' => $value['standard'],
                'E' => isset($value['m01'])?$value['m01']:'',
                'F' => isset($value['m02'])?$value['m02']:'',
                'G' => isset($value['m03'])?$value['m03']:'',
                'H' => isset($value['m04'])?$value['m04']:'',
                'I' => isset($value['m05'])?$value['m05']:'',
                'J' => isset($value['m06'])?$value['m06']:'',
                'K' => isset($value['m07'])?$value['m07']:'',
                'L' => isset($value['m08'])?$value['m08']:'',
                'M' => isset($value['m09'])?$value['m09']:'',
                'N' => isset($value['m010'])?$value['m010']:'',
                'O' => isset($value['m011'])?$value['m011']:'',
                'P' => isset($value['m012'])?$value['m012']:'',
                'Q' => $value['average'].$statusArr[$value['status']+1],
            );
        }
        $fileName = "导出模板.xlsx";
        require_once 'lib/PHPExcel.php';
        require_once 'lib/PHPExcel/IOFactory.php';
        require_once 'lib/PHPExcel/Reader/Excel2007.php';
        // 创建PHPExcel对象
        $objPHPExcel = new PHPExcel();
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load(BASE_DIR . "public/temp/" . $fileName);
        // 循环设置特殊值
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $line) {
            foreach ($line as $k => $v) {
                $objActSheet->setCellValue($k . $key, $v);
            }
        }
        // 重命名表
        $fileName = iconv("utf-8", "gb2312", "导出数据".$start_time."至".$end_time.".xlsx");
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output'); // 文件通过浏览器下载
        exit();
    }
	protected function log($title, $log_data = '') {
		$f = fopen ( $this->log_file, 'a+' );
		fwrite ( $f, date ( 'Y-m-d H:i:s', time () ) . '_' . microtime () . ' ' . $title . ':' . $log_data . "\r\n\r\n" );
		fclose ( $f );
	}
}

?>