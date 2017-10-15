<?php /* Smarty version Smarty-3.1.13, created on 2017-10-14 12:41:30
         compiled from "/www/yl/application/views/admin/abnormal/stab.html" */ ?>
<?php /*%%SmartyHeaderCode:51873202259e0161e572003-62029248%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '019b605732f0f752ce16a16633d2a3029591cbcd' => 
    array (
      0 => '/www/yl/application/views/admin/abnormal/stab.html',
      1 => 1507897500,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51873202259e0161e572003-62029248',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0161e609d34_85537540',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0161e609d34_85537540')) {function content_59e0161e609d34_85537540($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>异常事件上报-锐器刺伤报告</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
				<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;</button>
				<button class="btn btn-primary btn-sm" onClick="examine();">&nbsp;&nbsp;上报&nbsp;&nbsp;</button>
				<button class="btn btn-primary btn-sm" onClick="downExcel();">&nbsp;&nbsp;下载Excel&nbsp;&nbsp;</button>
		   	</div>
		   <table id="tableId" data-url="/Abnormal/ajaxStabList" data-sort-name="id" data-sort-order="desc" data-toggle="table"
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
								<input type="radio" class="form-control" name="incident_link" value="注射">注射</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="手术">手术</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="配药">配药</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="采血">采血</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="清理器械">清理器械</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="处理锐器物">处理锐器物</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_link" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">事发地点</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="incident_location" value="病房">病房</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="门诊">门诊</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="急诊">急诊</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="ICU">ICU</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="手术室">手术室</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="产房">产房</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="血库">血库</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="incident_location" value="供应室">供应室</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">受伤程度</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="degree_injury" value="轻度">轻度(表皮刺伤 未出血或滴出血)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="degree_injury" value="轻度">轻度(皮肤刺伤 有出血)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="degree_injury" value="轻度">轻度(深层刺伤 大量出血)</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">锐器种类</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="stab_type" value="刀片">刀片</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name=stab_type value="安瓿">安瓿</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="针头">针头</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="缝合针">缝合针</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="口腔探针">口腔探针</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="玻片">玻片</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="剪刀">剪刀</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_type" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">锐器目的</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="stab_objective" value="皮下注射">皮下注射</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="静脉输液">静脉输液</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="放置动静脉导管">放置动静脉导管</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="抽取血液/体液">抽取血液/体液</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="缝合">缝合</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="切开">切开</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="stab_objective" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">血液检查</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="blood_test" value="未做">未做</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HBV(+)">HBV(+)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HBV(-)">HBV(-)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HCV(+)">HCV(+)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HCV(-)">HCV(-)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HIV(+)">HIV(+)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_test" value="HIV(-)">HIV(-)</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">伤害来源</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="hurt_from" value="自身">自身</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="hurt_from" value="自身">自身</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="hurt_from" value="家属">家属</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="hurt_from" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">伤者类别</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="casualty_category" value="护士">护士</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="casualty_category" value="医生">医生</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="casualty_category" value="技师">技师</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="casualty_category" value="工人">工人</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="casualty_category" value="进修生/实习生">进修生/实习生</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="casualty_category" value="病人">病人</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否被血污染</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="blood_contaminated" value="是">是</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_contaminated" value="否">否</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="blood_contaminated" value="不知道">不知道</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否穿透手套</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="is_gloves" value="是">是</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_gloves" value="否">否</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_gloves" value="未戴手套">未戴手套</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否接种乙肝疫苗</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="radio" style="float:left;margin-left: 20px;">
	                    		<input type="radio" class="form-control" name="is_hepatitis" value="否">否</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="is_hepatitis" value="是大于等于5年">是(≤5年)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_hepatitis" value="是大于5年">是(>5年)</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="is_hepatitis" value="是大于10年">是(>10年)</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否正确操作</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<label class="radio" style="float:left;margin-left: 20px;">
								<input type="radio" class="form-control" name="correct_operation" value="是">是</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="correct_operation" value="否">否</label>
	                    	<label class="radio" style="float:left;margin-left: 40px;">
	                    		<input type="radio" class="form-control" name="correct_operation" value="不知道">不知道</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否立即通知</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control notified_immediately" name="notified_immediately[]" value="上级主管">上级主管</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notified_immediately" name="notified_immediately[]" value="院感办">院感办</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notified_immediately" name="notified_immediately[]" value="病人家属">病人家属</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control notified_immediately" name="notified_immediately[]" value="其它">其它</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">病人源情况</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="不清楚">不清楚</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HBV(+)">HBV(+)</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HBV(-)">HBV(-)</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HCV(+)">HCV(+)</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HCV(-)">HCV(-)</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HIV(+)">HIV(+)</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control patient_origin" name="patient_origin[]" value="HIV(-)">HIV(-)</label>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">处置方式</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 20px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="挤出受损部位血液→">挤出受损部位血液→</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="用流动水冲洗→">用流动水冲洗→</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="用肥皂洗手→">用肥皂洗手→</label>
	                    	<label class="checkbox" style="float:left;margin-left: 30px;">
	                    		<input type="checkbox" class="form-control disposal_methods" name="disposal_methods[]" value="碘酒酒精消毒">碘酒酒精消毒</label>
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
						<label class="col-sm-2 control-label">被刺伤者工龄</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" name="working_years" placeholder="被刺伤者工龄">
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
					<input name="type" type="hidden" value="stab" />
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
					<input name="type" type="hidden" value="stab" />
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
        	var inputArr = ['event_time','report_name','event_type','patient','anamnesis_num',
        	                'patient_age','working_years'];
        	var textArr = ['事发时间','上报人姓名','事件类型','患者姓名','患者病例号',
        	                '患者年龄','被刺伤者工龄'];
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
                url : "/Abnormal/ajaxStabAddOrUpdate",
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
	if(row.status == -1){
		return '<font color="red">被驳回</font>';
	}else if(row.status == 0){
		return '待上报';
	}else if(row.status == 4){
		return '<font color="green">审核通过</font>';
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
	    	        url:'/Abnormal/ajaxStabDelete',
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
        url: '/Abnormal/ajaxStabList'
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
	var inputArr = ['event_time','event_type','patient','anamnesis_num','patient_age','working_years','report_time','report_name'];
	for(var i=0;i< inputArr.length;i++){
		$("input[name='"+inputArr[i]+"']").val(row[inputArr[i]]);
	}
	var idArr = ['report_section','incident','patient_section','event_section'];
	for(var i=0;i< idArr.length;i++){
		$("#"+idArr[i]+"").val(row[idArr[i]]);
	}
	var radioArr = ['incident_link','incident_location','degree_injury','stab_type','stab_objective','blood_test','hurt_from',
	                'casualty_category','blood_contaminated','is_gloves','is_hepatitis','correct_operation','patient_gender'];
	for(var i=0;i< radioArr.length;i++){
		$("input[name='"+radioArr[i]+"'][value='"+row[radioArr[i]]+"']").prop("checked",true);
	}
	var checkArr = ['notified_immediately','patient_origin','disposal_methods'];
	for(var i=0;i< checkArr.length;i++){
		if(row[checkArr[i]]){
			var vals = row[checkArr[i]].split(",");
			for(var j in vals){
				$("."+checkArr[i]+"[value='"+vals[j]+"']").prop("checked",true);
			}
		}
	}
	if(row.status > 0 ){
		$(".modal-body").find("input").prop("disabled",true);
		$(".modal-body").find("textarea").prop("disabled",true);
		$(".modal-body").find("select").prop("disabled",true);
		if(row.status != 4){
			$('#modalTitle').html('<font color="red">审核中禁止修改</font>');
		} else {
			$('#modalTitle').html('<font color="green">已通过禁止修改</font>');
		}
	} else {
		$('#modalTitle').html('修改');
		$(".modal-body").find("input").prop("disabled",false);
		$(".modal-body").find("textarea").prop("disabled",false);
		$(".modal-body").find("select").prop("disabled",false);
	}
    $('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function analysis(row){
	$("#analysis_id").val(row.id);
	$.post(
		"/Abnormal/ajaxGetOneAnalysis",
		{"a_id":row.id,"type":"stab"},
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
		{"a_id":row.id,"type":"stab"},
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
function examine(){
	var TableData = $('#tableId').bootstrapTable('getSelections');
	var ids = '';
	for(var i in TableData){
		if(ids)
			ids += ","+TableData[i].id;
		else
			ids = TableData[i].id;
	}
	if(!ids || ids == ''){
		Calert("请至少选择一条记录");
		return false;
	} else {
		$.post(
			'/Abnormal/ajaxAbnormalExamine',
			{
				'ids':ids,
				'type':'stab'
			},
			function(data){
				Calert(data.msg);
				refresh();
			},"json"
		);
	}
}
function downExcel(){
	var TableData = $('#tableId').bootstrapTable('getSelections');
	var ids = '';
	for(var i in TableData){
		if(ids)
			ids += ","+TableData[i].id;
		else
			ids = TableData[i].id;
	}
	if(!ids || ids == ''){
		Calert("请至少选择一条记录");
		return false;
	} else {
		window.location.href = '/Abnormal/ajaxAbnormalDownExcel/type/stab/ids/'+ids;
	}
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>