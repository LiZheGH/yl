<?php /* Smarty version Smarty-3.1.13, created on 2017-10-15 05:25:04
         compiled from "/private/var/www/yl/application/views/admin/examine/medicine.html" */ ?>
<?php /*%%SmartyHeaderCode:192721582259e280b004c485-39002254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '58297a9cb6b2ed906a8428baa318aca928f02eb2' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/examine/medicine.html',
      1 => 1507868856,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192721582259e280b004c485-39002254',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e280b00a83f2_91452861',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e280b00a83f2_91452861')) {function content_59e280b00a83f2_91452861($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>异常事件审核-给药错误报告</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
				<!-- <button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;</button> -->
		   	</div>
		   <table id="tableId" data-url="/Examine/ajaxMedicineList" data-sort-name="id" data-sort-order="desc" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id">ID</th>
						<th data-field="report_name">上报人</th>
						<th data-field="event_type">类型</th>
						<th data-field="report_time">上报时间</th>
						<th data-field="event_time">事发时间</th>
						<th data-field="patient">患者姓名</th>
						<th data-field="anamnesis_num">病历号</th>
						<th data-field="report_section" data-formatter="getSection">上报科室</th>
						<th data-field="status" data-formatter="showStatus">状态</th>
						<th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">操作</th>
					</tr>
				</thead>
			</table>
			<div class="row pull-right">
				<ul class="pagination">
				</ul>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalTitle">新增</h3>
			</div>
			<form role="form" id="oneForm" class="form-horizontal" method="POST">
				<div class="modal-body">
		            <div class="form-group">
		            	<label class="col-sm-2 control-label">事发时间</label>
						<div class="col-sm-9">
			                <div class="input-group date">
			                    <input type="text" name="event_time" placeholder="事发时间" class="form-control datetimepicker" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
		                </div>
		            </div>
		            <div class="form-group">
						<label class="col-sm-2 control-label">事发科室</label>
						<div class="col-sm-9">
							<select  class="form-control" id="event_section" name="event_section">
	                    			<option value="0">--请选择--</option>
	                    		<?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
	                    			<option value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</option>
	                    		<?php } ?>
	                    	</select>
	                    </div>
					</div>
		            <div class="form-group">
						<label class="col-sm-2 control-label">事件类型(问题)</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="event_type" placeholder="事件类型(问题)">
	                    </div>
					</div>
		            <div class="form-group">
						<label class="col-sm-2 control-label">事件经过</label>
						<div class="col-sm-9">
	                    	<textarea type="text"  class="form-control" id="incident" name="incident" placeholder="事件经过......"></textarea>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发环节</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="incident_link" value="开具">开具→</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="转录">转录→</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="发药">发药→</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="配药">配药→</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="给药">给药</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">发生问题药品名称</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="drug_name" placeholder="发生问题药品名称">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发处置用药<br>药物名称</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="disposal_drug_name" placeholder="事发处置用药|药物名称">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发处置检查<br>检查项目</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="disposal_check_items" placeholder="事发处置检查|检查项目">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">处置方式</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="立即停止">立即停止</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="观察病情">观察病情</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="记录病情">记录病情</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="抢救">抢救</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否服药</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="is_take_drug" value="药品已服用">药品已服用</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_take_drug" value="药品未服用">药品未服用</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_take_drug" value="不确定">不确定</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者诊断</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="patient_diagnosis" placeholder="患者诊断">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">错误的病人或药品</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="error_drug" value="名称相似">名称相似</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="error_drug" value="包装相似">包装相似</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="error_drug" value="违反禁忌症">违反禁忌症</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="error_drug" value="违反配伍禁忌">违反配伍禁忌</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="error_drug" value="病人的错误服用">病人的错误服用</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="error_drug" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">用药反应</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="medication_response" value="无">无</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="medication_response" value="轻度反应">轻度反应未给予处理 观察病情</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="medication_response" value="一般反应">一般反应 给予用药等措施</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="medication_response" value="严重反应">严重反应 采取抢救等措施 患者恢复</label>
	                    	<label class="radio" style="float:left;margin-left: 18px;">
	                    		<input type="radio" class="form-control" name="medication_response" value="残疾或死亡">严重反应 导致患者残疾或死亡</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发通知</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="主任">主任</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="医师">医师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="药师">药师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护士长">护士长</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护士">护士</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护理部">护理部</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="家属">家属</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="患者">患者</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">正确药品</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="correct_medicines" placeholder="正确药品">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">错误药品</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="wrong_drugs" placeholder="错误药品">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">正确剂量</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="correct_dose" placeholder="正确剂量">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">错误剂量</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="wrong_dose" placeholder="错误剂量">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">正确时间</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="correct_time" placeholder="正确时间">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">错误时间</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="wrong_time" placeholder="错误时间">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">正确途径</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="right_way" placeholder="正确途径">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">错误途径</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="wrong_way" placeholder="错误途径">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">谁发现的</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control who_found" name="who_found[]" value="医师">医师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control who_found" name="who_found[]" value="护士">护士</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control who_found" name="who_found[]" value="药师">药师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control who_found" name="who_found[]" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">谁的错误</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control whose_mistake" name="whose_mistake[]" value="医师">医师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control whose_mistake" name="whose_mistake[]" value="护士">护士</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control whose_mistake" name="whose_mistake[]" value="药师">药师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control whose_mistake" name="whose_mistake[]" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者科室</label>
						<div class="col-sm-9">
							<select  class="form-control" id="patient_section" name="patient_section">
	                    			<option value="0">--请选择--</option>
	                    		<?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
	                    			<option value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</option>
	                    		<?php } ?>
	                    	</select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者姓名</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="patient" placeholder="患者姓名">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者病例号</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="anamnesis_num" placeholder="患者病例号">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者性别</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="patient_gender" value="男">男</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_gender" value="女">女</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者年龄</label>
						<div class="col-sm-9">
	                    	<input type="number"  class="form-control" name="patient_age" placeholder="患者年龄">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者类别</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="patient_type" value="住院患者">住院患者</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_type" value="急诊患者">急诊患者</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_type" value="门诊患者">门诊患者</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_type" value="其它顾客">其它顾客</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者反应</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="radio" style="float:left;margin-left: 20px;">
	                    		<input type="radio" class="form-control" name="patient_response" value="无">无</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_response" value="声称向上级反映">声称向上级反映</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_response" value="声称要诉讼">声称要诉讼</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_response" value="不知道">不知道</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="patient_response" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">当事人职称</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="party_title" placeholder="当事人职称">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">当事人姓名</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="party_name" placeholder="当事人姓名">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">当事人工龄</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="working_years" placeholder="当事人工龄">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">当事人班次</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="shift" placeholder="当事人班次">
	                    </div>
					</div>
					<div class="form-group">
		            	<label class="col-sm-2 control-label">上报时间</label>
						<div class="col-sm-9">
			                <div class="input-group date">
			                    <input type="text" name="report_time" placeholder="上报时间" class="form-control datetimepicker" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
		                </div>
		            </div>
					<div class="form-group">
						<label class="col-sm-2 control-label">上报科室</label>
						<div class="col-sm-9">
	                    	<select  class="form-control" id="report_section" name="report_section">
	                    			<option value="0">--请选择--</option>
	                    		<?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
	                    			<option value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</option>
	                    		<?php } ?>
	                    	</select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">上报人姓名</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="report_name" placeholder="上报人姓名">
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<label class="col-sm-2 control-label">审核意见</label>
						<div class="col-sm-9">
	                    	<textarea type="text"  class="form-control" id="examine_info" name="examine_info" placeholder="审核意见"></textarea>
	                    </div>
					</div>
					<input id="id" name="id" value="0" type="hidden" />
					<input id="is_adopt" name="is_adopt" value="1" type="hidden" />
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="reject" style="background:red;">不予通过</button>
					<button class="btn btn-primary" id="modalSubmit">审核通过</button>
				</div>
            </form>
		</div>
	</div>
</div>
<div class="modal fade" id="analysisModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>管路事件报告/分析<br>【事件分析及改进】</h3>
			</div>
			<form role="form" id="analysisForm" class="form-horizontal" method="POST">
				<div class="modal-body" style="padding:15px">
					<table class="table table-bordered table-striped responsive">
						<thead>
							<tr>
								<th>类别</th>
								<th>存在问题</th>
								<th>改进措施</th>
								<th>责任人</th>
								<th>完成时限</th>
							</tr>
						</thead>
	                    <tbody>
		                    <tr>
	                        	<td>人员</td>
								<td><textarea class="form-control" name="problem1"></textarea></td>
								<td><textarea class="form-control" name="correction1"></textarea></td>
								<td><input type="text"  class="form-control" name="responsible1"></td>
								<td>
									<div class="input-group date">
					                    <input type="text" name="over_time1" class="form-control datetimepicker" placeholder="完成时限"/>
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					                </div>
			                	</td>
	                        </tr>
		                    <tr>
	                        	<td>方法</td>
								<td><textarea class="form-control" name="problem2"></textarea></td>
								<td><textarea class="form-control" name="correction2"></textarea></td>
								<td><input type="text"  class="form-control" name="responsible2"></td>
								<td>
									<div class="input-group date">
					                    <input type="text" name="over_time2" class="form-control datetimepicker" placeholder="完成时限"/>
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					                </div>
			                	</td>
	                        </tr>
		                    <tr>
	                        	<td>环节</td>
								<td><textarea class="form-control" name="problem3"></textarea></td>
								<td><textarea class="form-control" name="correction3"></textarea></td>
								<td><input type="text"  class="form-control" name="responsible3"></td>
								<td>
									<div class="input-group date">
					                    <input type="text" name="over_time3" class="form-control datetimepicker" placeholder="完成时限"/>
					                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
					                </div>
			                	</td>
	                        </tr>
                        </tbody>
                    </table>
					<div class="form-group">
						<label class="col-sm-2 control-label">科主任</label>
						<div class="col-sm-4">
	                    	<input type="text"  class="form-control" name="head_department" placeholder="科主任">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">护士长</label>
						<div class="col-sm-4">
	                    	<input type="text"  class="form-control" name="head_nurse" placeholder="护士长">
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="" id="analysis_id" name="analysis_id" />
					<input name="type" type="hidden" value="medicine" />
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="analysisSubmit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="evaluationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>管路事件报告/分析<br><font color="red">管路事件异常处理报告单</font></h3>
			</div>
			<form role="form" id="evaluationForm" class="form-horizontal" method="POST">
				<div class="modal-body" style="padding:15px">
					<table class="table table-bordered table-striped responsive">
						<thead>
							<tr>
								<th colspan="2">【评估】</th>
							</tr>
						</thead>
	                    <tbody>
		                    <tr>
	                        	<th style="width:125px">【此类事件可能<br>再发生频率评估】</th>
								<td>
									<div class="controls" style="line-height: 40px;">
										<label class="radio" style="float:left;margin-left: 20px;">
											<input type="radio" class="form-control" name="frequency" value="数周/数月内">数周/数月内</label>
				                    	<label class="radio" style="float:left;margin-left: 40px;">
				                    		<input type="radio" class="form-control" name="frequency" value="一年数次">一年数次</label>
				                    	<label class="radio" style="float:left;margin-left: 40px;">
				                    		<input type="radio" class="form-control" name="frequency" value="1~2年一次">1~2年一次</label>
				                    	<label class="radio" style="float:left;margin-left: 40px;">
				                    		<input type="radio" class="form-control" name="frequency" value="2~5年一次">2~5年一次</label>
				                    	<label class="radio" style="float:left;margin-left: 40px;">
				                    		<input type="radio" class="form-control" name="frequency" value="5年以上一次">5年以上一次</label>
				                    	<label class="radio" style="float:left;margin-left: 40px;">
				                    		<input type="radio" class="form-control" name="frequency" value="不知道">不知道</label>
				                    </div>
								</td>
	                        </tr>
		                    <tr>
	                        	<th>【事件原因归类】</th>
								<td>
									<div class="controls" style="line-height: 40px;">
				                    	<label class="checkbox" style="float:left;margin-left: 20px;">
				                    		<input type="checkbox" class="form-control event_cause" name="event_cause[]" value="人为">人为</label>
				                    	<label class="checkbox" style="float:left;margin-left: 30px;">
				                    		<input type="checkbox" class="form-control event_cause" name="event_cause[]" value="机器">机器</label>
				                    	<label class="checkbox" style="float:left;margin-left: 30px;">
				                    		<input type="checkbox" class="form-control event_cause" name="event_cause[]" value="材料">材料</label>
				                    	<label class="checkbox" style="float:left;margin-left: 30px;">
				                    		<input type="checkbox" class="form-control event_cause" name="event_cause[]" value="方法">方法</label>
				                    	<label class="checkbox" style="float:left;margin-left: 30px;">
				                    		<input type="checkbox" class="form-control event_cause" name="event_cause[]" value="环节">环节</label>
				                    </div>
								</td>
	                        </tr>
		                    <tr>
	                        	<th>【严重程度】</th>
								<td>
									<div class="controls" style="line-height: 40px;">
										<label class="radio" style="margin-left: 20px;">
											<input type="radio" class="form-control" name="severity" value="几乎发生">几乎发生：由于不经意或适时的介入，使可能发生的事件并未真正发生。</label>
				                    	<label class="radio" style="margin-left: 20px;">
				                    		<input type="radio" class="form-control" name="severity" value="轻微伤害">轻微伤害：虽发生异常事件，但是未造成任何伤害也无需额外的赔偿。</label>
				                    	<label class="radio" style="margin-left: 20px;">
				                    		<input type="radio" class="form-control" name="severity" value="轻度伤害">轻度伤害：发生异常事件，并造成了暂时性的伤害，需要干预或延长住院时间。</label>
				                    	<label class="radio" style="margin-left: 20px;">
				                    		<input type="radio" class="form-control" name="severity" value="中度伤害">中度伤害：发生异常事件，并因此因素造成永久性功能障碍。</label>
				                    	<label class="radio" style="margin-left: 20px;">
				                    		<input type="radio" class="form-control" name="severity" value="重度伤害">重度伤害：发生异常事件，并导致人员死亡</label>
				                    	<label class="radio" style="margin-left: 20px;">
				                    		<input type="radio" class="form-control" name="severity" value="无法判定">无法判定伤害严重程度。</label>
				                    </div>
								</td>
	                        </tr>
	                         <tr>
	                        	<th>【验证改进】</th>
								<td>
									<textarea class="form-control" id="improvement" name="improvement"></textarea>
								</td>
	                        </tr>
                        </tbody>
                    </table>
				</div>
				<div class="modal-footer">
					<input type="hidden" value="" name="evaluation_id" id="evaluation_id" />
					<input name="type" type="hidden" value="medicine" />
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="evaluationSubmit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	//不予通过
	$("#reject").click(function(){
		$("#is_adopt").val(0);
		$("#modalSubmit").click();
	});
	//审核通过
	$("#modalSubmit").click(function(){
        var validateForm = function(){
        	var inputArr = ['event_time','report_name','event_type','patient','anamnesis_num',
        	                'patient_age','shift','party_name','party_title','working_years'];
        	var textArr = ['事发时间','上报人姓名','事件类型','患者姓名','患者病例号',
        	                '患者年龄','当事人班次','当事人姓名','当事人职称','当事人工龄'];
        	for(var i=0;i< inputArr.length;i++){
        		var val = $("input[name='"+inputArr[i]+"']").val();
        		if(val == 0 || val == ''){
        			Calert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        	var selectArr = ['report_section','incident','patient_section','event_section'];
        	var textArr = ['上报科室','事发经过','患者科室','事发科室'];
        	for(var i=0;i< selectArr.length;i++){
        		var val = $("#"+selectArr[i]+"").val();
        		if(val == 0 || val == ''){
        			Calert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		Calert(data['msg']);
        		$('#myModal').modal('hide');
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				Calert(data['msg']);
			}
        };
        var options= {
                url : "/Examine/ajaxMedicineAddOrUpdate",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : false,//数据返回后，是否清除表单内容
        };
        $("#oneForm").ajaxForm(options);
	});
	//分析提交
	$("#analysisSubmit").click(function(){
        var validateForm = function(){
        	var problem1 = $("textarea[name='problem1']").val();
        	var problem2 = $("textarea[name='problem2']").val();
        	var problem3 = $("textarea[name='problem3']").val();
			if(problem1.length == 0 && problem2.length == 0 && problem3.length == 0){
				Calert('三种类别，存在问题，至少填写一项！');
				return false;
			}
        	var correction1 = $("textarea[name='correction1']").val();
        	var correction2 = $("textarea[name='correction2']").val();
        	var correction3 = $("textarea[name='correction3']").val();
        	if(correction1.length == 0 && correction2.length == 0 && correction3.length == 0){
				Calert('三种类别，改进措施，至少填写一项！');
				return false;
			}
        	var responsible1 = $("input[name='responsible1']").val();
        	var responsible2 = $("input[name='responsible2']").val();
        	var responsible3 = $("input[name='responsible3']").val();
        	if(responsible1.length == 0 && responsible2.length == 0 && responsible3.length == 0){
				Calert('三种类别，责任人，至少填写一项！');
				return false;
			}
        	var over_time1 = $("input[name='over_time1']").val();
        	var over_time2 = $("input[name='over_time2']").val();
        	var over_time3 = $("input[name='over_time3']").val();
        	if(over_time1.length == 0 && over_time2.length == 0 && over_time3.length == 0){
				Calert('三种类别，完成时限，至少填写一项！');
				return false;
			}
        	var head_department = $("input[name='head_department']").val();
        	var head_nurse = $("input[name='head_nurse']").val();
        	if(head_department.length == 0 && head_nurse.length == 0 ){
        		Calert('科主任，护士长，至少填写一项！');
				return false;
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		Calert(data['msg']);
        		$('#analysisModal').modal('hide');
			} else {
				Calert(data['msg']);
			}
        };
        var options= {
                url : "/Examine/ajaxAnalysisSubmit",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : false,//数据返回后，是否清除表单内容
        };
        $("#analysisForm").ajaxForm(options);
	});
	//分析提交
	$("#evaluationSubmit").click(function(){
        var validateForm = function(){
        	if( $("input[name='frequency']:checked").length != 1 ){
        		Calert("请选择【可能再发生频率】！");
        		return false;
        	}
        	if( $(".event_cause:checked").length < 1 ){
        		Calert("请选择【事件原因归类】！");
        		return false;
        	}
        	if( $("input[name='severity']:checked").length != 1 ){
        		Calert("请选择【严重程度】！");
        		return false;
        	}
        	if( $("textarea[name='improvement']").val().length == 0 ){
        		Calert("请填写【验证改进】！");
        		return false;
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		Calert(data['msg']);
        		$('#evaluationModal').modal('hide');
			} else {
				Calert(data['msg']);
			}
        };
        var options= {
                url : "/Examine/ajaxEvaluationSubmit",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : false,//数据返回后，是否清除表单内容
        };
        $("#evaluationForm").ajaxForm(options);
	});
});
function showStatus(value,row,index){
	if(row.status == -1){
		return '<font color="red">被驳回</font>';
	}else if(row.status == 0){
		return '待上报';
	}else if(row.status == 4){
		return '审核通过';
	} else {
		return '待审核';
	}
}
function getSection(value,row,index){
	return $("#report_section").find("option[value='"+row.report_section+"']").text();
}
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon glyphicon-eye-close">审核</i>',
        '</a> ',
        '<a class="analysis ml10" href="javascript:void(0)" title="Analysis">',
            '<i class="glyphicon glyphicon-filter">分析</i>',
        '</a>',
        '<a class="evaluation ml10" href="javascript:void(0)" title="Evaluation">',
            '<i class="glyphicon glyphicon-eye-open">评估</i>',
        '</a>',
    ].join('');
}
window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        opUpdate(row);
    },
    'click .remove': function (e, value, row, index) {
		Modal.confirm({
			msg: "<div style='text-align: center;'>是否删除记录？</div>",
			title: "删除记录"
		}).on( function (e) {
			if(e) {
				$.ajax({
	    	        url:'/Examine/ajaxMedicineDelete',
	    	        type:'post',
	    			dataType : 'json',
	    			data : encodeURI('id=' + row.id),
	    			async: false,
	    			success:function(data){
	    	        	if(data['success']) {
	    	        		$('#myModal').modal('hide');
	    	        		Calert(data['msg']);
	    	        		refresh()
	    	        		$('#oneForm')[0].reset();
	    				} else {
	    					Calert(data['msg']);
	    				}
	    	        },
	    	        error:function(){}
	    	     });
	    	}
	  });
    },
    'click .analysis':function (e, value, row, index) {
    	analysis(row);
    },
	'click .evaluation':function (e, value, row, index) {
		evaluation(row);
    }
};

function refresh(){
	$('#tableId').bootstrapTable('refresh', {
        url: '/Examine/ajaxMedicineList'
    });
}
function showModal() {
	$('#modalTitle').html('新增');
	$('#oneForm')[0].reset();
	$('#id').val('');
	$('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opUpdate(row){
    $('#modalTitle').html('审核');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	var inputArr = ['event_time','event_type','drug_name','disposal_drug_name','disposal_check_items',
	                'patient_diagnosis','correct_medicines','wrong_drugs','correct_dose','wrong_dose',
	                'correct_time','wrong_time','right_way','wrong_way','patient','anamnesis_num',
	                'patient_age','party_title','party_name','working_years','shift','report_time','report_name'];
	for(var i=0;i< inputArr.length;i++){
		$("input[name='"+inputArr[i]+"']").val(row[inputArr[i]]);
	}
	var idArr = ['report_section','incident','patient_section','event_section'];
	for(var i=0;i< idArr.length;i++){
		$("#"+idArr[i]+"").val(row[idArr[i]]);
	}
	var radioArr = ['incident_link','is_take_drug','error_drug','medication_response',
	                'patient_gender','patient_type','patient_response'];
	for(var i=0;i< radioArr.length;i++){
		$("input[name='"+radioArr[i]+"'][value='"+row[radioArr[i]]+"']").prop("checked",true);
	}
	var checkArr = ['disposal_methods','notice_of_incident','who_found','whose_mistake'];
	for(var i=0;i< checkArr.length;i++){
		if(row[checkArr[i]]){
			var vals = row[checkArr[i]].split(",");
			for(var j in vals){
				$("."+checkArr[i]+"[value='"+vals[j]+"']").prop("checked",true);
			}
		}
	}
	$(".modal-body").find("input").prop("disabled",true);
	$(".modal-body").find("textarea").prop("disabled",true);
	$(".modal-body").find("select").prop("disabled",true);
	$("#examine_info").val(row.examine_info);
    $('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function analysis(row){
	$("#analysis_id").val(row.id);
	$.post(
		"/Examine/ajaxGetOneAnalysis",
		{"a_id":row.id,"type":"medicine"},
		function(data){
			if(data.success){
				var info = data.data;
				var areaArr = ['problem1','problem2','problem3','correction1','correction2','correction3'];
				for(var i in areaArr){
					$("textarea[name='"+areaArr[i]+"']").val(info[areaArr[i]]);
				}
				var inputArr = ['responsible1','responsible2','responsible3','over_time1','over_time2','over_time3','head_department','head_nurse'];
				for(var i in inputArr){
					$("input[name='"+inputArr[i]+"']").val(info[inputArr[i]]);
				}
			} else {
				$("#analysisForm")[0].reset();
			}
		},"json"
	);
	$('#analysisModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function evaluation(row){
	$("#evaluation_id").val(row.id);
	$.post(
		"/Examine/ajaxGetOneEvaluation",
		{"a_id":row.id,"type":"medicine"},
		function(data){
			if(data.success){
				var info = data.data;
				var radioArr = ['frequency','severity'];
				for(var i=0;i< radioArr.length;i++){
					$("input[name='"+radioArr[i]+"'][value='"+info[radioArr[i]]+"']").prop("checked",true);
				}
				var vals = info.event_cause.split(",");
				for(var i in vals){
					$(".event_cause[value='"+vals[i]+"']").prop("checked",true);
				}
				$("#improvement").val(info['improvement']);
			} else {
				$("#evaluationForm")[0].reset();
			}
		},"json"
	);
	$('#evaluationModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>