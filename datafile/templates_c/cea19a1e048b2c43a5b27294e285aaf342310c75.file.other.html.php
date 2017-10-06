<?php /* Smarty version Smarty-3.1.13, created on 2017-10-03 23:01:56
         compiled from "/private/var/www/yl/application/views/admin/abnormal/other.html" */ ?>
<?php /*%%SmartyHeaderCode:118489419859d329520d9448-30697337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cea19a1e048b2c43a5b27294e285aaf342310c75' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/abnormal/other.html',
      1 => 1507042821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118489419859d329520d9448-30697337',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d3295212b3e4_97647423',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d3295212b3e4_97647423')) {function content_59d3295212b3e4_97647423($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>异常事件上报-其他事件报告</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
				<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;</button>
		   	</div>
		   <table id="tableId" data-url="/Abnormal/ajaxOtherList" data-sort-name="id" data-sort-order="desc" data-toggle="table"
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
						<label class="col-sm-2 control-label">事发地点</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="incident_location" value="病室">病室</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="走廊">走廊</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="卫生间">卫生间</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="浴室">浴室</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="护士站">护士站</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="治疗室">治疗室</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="手术室">手术室</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="诊室">诊室</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="incident_location" value="户外">户外</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="incident_location" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发处置</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control incident_disposal" name="incident_disposal[]" value="观察生命体">观察生命体</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control incident_disposal" name="incident_disposal[]" value="医疗护理实施">医疗护理实施</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control incident_disposal" name="incident_disposal[]" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事件发生前<br />患者所处状态</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="意识障碍">意识障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="听觉障碍">听觉障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="视觉障碍">视觉障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="语音障碍">语音障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="精神障碍">精神障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="痴呆/记忆障碍">痴呆/记忆障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="嗜睡障碍">嗜睡障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="下肢功能障碍">下肢功能障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="上肢功能障碍">上肢功能障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="行走障碍">行走障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="紫绀/呼吸困难">紫绀/呼吸困难</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="寒战/高温">寒战/高温</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="皮肤粘膜障碍">皮肤粘膜障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="抽搐状态">抽搐状态</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="床上安静休息">床上安静休息</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="麻醉状态">麻醉状态</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="乘轮椅">乘轮椅</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="使用镇静剂后">使用镇静剂后</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="正常行走中">正常行走中　　　　</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="无任何障碍表现">无任何障碍表现</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="障碍情况不明">障碍情况不明</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="pre_incident_state" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">给患者造成的<br>功能损害</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="functional_impairment" value="意识障碍">意识障碍</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="听觉损害">听觉损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="语音损害">语音损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="精神损害">精神损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="视觉损害">视觉损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="痴呆/记忆损害">痴呆/记忆损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="下肢功能损害">下肢功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="functional_impairment" value="上肢功能损害">上肢功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="行走损害">行走损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="神经系统功能损害">神经系统功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="心血管系统功能损害">心血管系统功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="呼吸系统功能损害">呼吸系统功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="functional_impairment" value="泌尿系统功能损害">泌尿系统功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="皮肤粘膜功能损害">皮肤粘膜功能损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="无任何损害">无任何损害</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="损害不明">损害不明</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="functional_impairment" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者意识<br>状态发生前</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="pre_patient_state" value="清醒">清醒</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="pre_patient_state" value="嗜睡">嗜睡</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="pre_patient_state" value="昏睡">昏睡</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="pre_patient_state" value="昏迷">昏迷</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="pre_patient_state" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者意识<br>状态发生后</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="after_patient_state" value="清醒">清醒</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="after_patient_state" value="嗜睡">嗜睡</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="after_patient_state" value="昏睡">昏睡</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="after_patient_state" value="昏迷">昏迷</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="after_patient_state" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">患者诊断</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="patient_diagnosis" placeholder="患者诊断">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发通知</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护理部">护理部</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护士长">护士长</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="护理人员">护理人员</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="医师">医师</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="家属">家属</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notice_of_incident" name="notice_of_incident[]" value="其他">其他</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">院内感染类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="infected_type" value="实施环节">实施环节</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="infected_type" value="治安伤害">治安伤害</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">输血事件类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="blood_type" value="输血错误">输血错误</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_type" value="输血反应">输血反应</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">麻醉事件类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="anaesthesia_type" value="神经阻滞">神经阻滞</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="anaesthesia_type" value="椎管内">椎管内</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="anaesthesia_type" value="全麻">全麻</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="anaesthesia_type" value="插管">插管</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">医疗处置类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="medical_type" value="医疗事件">医疗事件</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="medical_type" value="护理事件">护理事件</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">医疗处置类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="equipment_type" value="植入材料">植入材料</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="equipment_type" value="医疗仪器">医疗仪器</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">警戒事件类型</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="alert_type" value="意外死亡">意外死亡</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="alert_type" value="器官重大损害或功能永久丧失">器官重大损害或功能永久丧失</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="alert_type" value="手术错误">手术错误</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="alert_type" value="诱拐/抱错婴儿">诱拐/抱错婴儿</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">谁发现的</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="who_found" placeholder="谁发现的">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">谁的错误</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="whose_mistake" placeholder="谁的错误">
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
						<label class="col-sm-2 control-label">患者职别</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="patient_position" value="城镇居民">城镇居民</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="农民">农民</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="学生">学生</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="军人">军人</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="企业职工">企业职工</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="外资企业">外资企业</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="机关">机关</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="退休/离休">退休/离休</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="patient_position" value="其他">其他</label>
							<label class="radio" style="float:left;margin-left: 21px;">
								<input type="radio" class="form-control" name="patient_position" value="不明">不明</label>
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
					<input id="id" name="id" value="0" type="hidden" />
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="modalSubmit">提交</button>
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
					<input name="type" type="hidden" value="other" />
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
					<input name="type" type="hidden" value="other" />
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="evaluationSubmit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	//上报提交
	$("#modalSubmit").click(function(){
        var validateForm = function(){
        	var inputArr = ['event_time','report_name','event_type','patient','anamnesis_num','patient_age'];
        	var textArr = ['事发时间','上报人姓名','事件类型','患者姓名','患者病例号','患者年龄'];
        	for(var i=0;i< inputArr.length;i++){
        		var val = $("input[name='"+inputArr[i]+"']").val();
        		if(val == 0 || val == ''){
        			alert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        	var selectArr = ['report_section','incident','patient_section','event_section'];
        	var textArr = ['上报科室','事发经过','患者科室','事发科室'];
        	for(var i=0;i< selectArr.length;i++){
        		var val = $("#"+selectArr[i]+"").val();
        		if(val == 0 || val == ''){
        			alert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#myModal').modal('hide');
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				alert(data['msg']);
			}
        };
        var options= {
                url : "/Abnormal/ajaxOtherAddOrUpdate",
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
				alert('三种类别，存在问题，至少填写一项！');
				return false;
			}
        	var correction1 = $("textarea[name='correction1']").val();
        	var correction2 = $("textarea[name='correction2']").val();
        	var correction3 = $("textarea[name='correction3']").val();
        	if(correction1.length == 0 && correction2.length == 0 && correction3.length == 0){
				alert('三种类别，改进措施，至少填写一项！');
				return false;
			}
        	var responsible1 = $("input[name='responsible1']").val();
        	var responsible2 = $("input[name='responsible2']").val();
        	var responsible3 = $("input[name='responsible3']").val();
        	if(responsible1.length == 0 && responsible2.length == 0 && responsible3.length == 0){
				alert('三种类别，责任人，至少填写一项！');
				return false;
			}
        	var over_time1 = $("input[name='over_time1']").val();
        	var over_time2 = $("input[name='over_time2']").val();
        	var over_time3 = $("input[name='over_time3']").val();
        	if(over_time1.length == 0 && over_time2.length == 0 && over_time3.length == 0){
				alert('三种类别，完成时限，至少填写一项！');
				return false;
			}
        	var head_department = $("input[name='head_department']").val();
        	var head_nurse = $("input[name='head_nurse']").val();
        	if(head_department.length == 0 && head_nurse.length == 0 ){
        		alert('科主任，护士长，至少填写一项！');
				return false;
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#analysisModal').modal('hide');
			} else {
				alert(data['msg']);
			}
        };
        var options= {
                url : "/Abnormal/ajaxAnalysisSubmit",
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
        		alert("请选择【可能再发生频率】！");
        		return false;
        	}
        	if( $(".event_cause:checked").length < 1 ){
        		alert("请选择【事件原因归类】！");
        		return false;
        	}
        	if( $("input[name='severity']:checked").length != 1 ){
        		alert("请选择【严重程度】！");
        		return false;
        	}
        	if( $("textarea[name='improvement']").val().length == 0 ){
        		alert("请填写【验证改进】！");
        		return false;
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#evaluationModal').modal('hide');
			} else {
				alert(data['msg']);
			}
        };
        var options= {
                url : "/Abnormal/ajaxEvaluationSubmit",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : false,//数据返回后，是否清除表单内容
        };
        $("#evaluationForm").ajaxForm(options);
	});
});
function showStatus(value,row,index){
	if(row.status == 1){
		return '<font color="green"></font>';
	}else{
		return '待审核';
	}
}
function getSection(value,row,index){
	return $("#report_section").find("option[value='"+row.report_section+"']").text();
}
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil">编辑</i>',
        '</a> ',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash">删除</i>',
        '</a>',
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
	    	        url:'/Abnormal/ajaxOtherDelete',
	    	        type:'post',
	    			dataType : 'json',
	    			data : encodeURI('id=' + row.id),
	    			async: false,
	    			success:function(data){
	    	        	if(data['success']) {
	    	        		$('#myModal').modal('hide');
	    	        		alert(data['msg']);
	    	        		refresh()
	    	        		$('#oneForm')[0].reset();
	    				} else {
	    					alert(data['msg']);
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
        url: '/Abnormal/ajaxOtherList'
    });
}
function showModal() {
	$('#modalTitle').html('新增');
	$('#oneForm')[0].reset();
	$('#id').val('');
	$('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opUpdate(row){
    $('#modalTitle').html('修改');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	var inputArr = ['event_time','report_name','report_time','event_type','patient',
	                'anamnesis_num','patient_age','patient_diagnosis','who_found','whose_mistake'];
	for(var i=0;i< inputArr.length;i++){
		$("input[name='"+inputArr[i]+"']").val(row[inputArr[i]]);
	}
	var idArr = ['report_section','incident','patient_section','event_section'];
	for(var i=0;i< idArr.length;i++){
		$("#"+idArr[i]+"").val(row[idArr[i]]);
	}
	var radioArr = ['incident_link','incident_location','pre_incident_state','functional_impairment','pre_patient_state',
	                'after_patient_state','patient_gender','patient_type','patient_position','infected_type','blood_type',
	                'anaesthesia_type','medical_type','equipment_type','alert_type','patient_response'];
	for(var i=0;i< radioArr.length;i++){
		$("input[name='"+radioArr[i]+"'][value='"+row[radioArr[i]]+"']").prop("checked",true);
	}
	var checkArr = ['incident_disposal','pressure_location','notice_of_incident'];
	for(var i=0;i< checkArr.length;i++){
		if(row[checkArr[i]]){
			var vals = row[checkArr[i]].split(",");
			for(var j in vals){
				$("."+checkArr[i]+"[value='"+vals[j]+"']").prop("checked",true);
			}
		}
	}
    $('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function analysis(row){
	$("#analysis_id").val(row.id);
	$.post(
		"/Abnormal/ajaxGetOneAnalysis",
		{"a_id":row.id,"type":"other"},
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
		"/Abnormal/ajaxGetOneEvaluation",
		{"a_id":row.id,"type":"other"},
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
</html>
<?php }} ?>