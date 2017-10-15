<?php /* Smarty version Smarty-3.1.13, created on 2017-10-14 00:26:10
         compiled from "/private/var/www/yl/application/views/admin/standard/report_indicators.html" */ ?>
<?php /*%%SmartyHeaderCode:86525687259e0e9228b3666-49610777%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73b010c75cd4a8f6299c3d0c4183db2ecc4abcf5' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/report_indicators.html',
      1 => 1507662593,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86525687259e0e9228b3666-49610777',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'exportDictionaryList' => 0,
    'section_id' => 0,
    'sectionList' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0e9228fa436_90168115',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0e9228fa436_90168115')) {function content_59e0e9228fa436_90168115($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>选择上报指标</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
				<!-- <a class="btn btn-primary btn-sm" href="/standard/report_department">&nbsp;&nbsp;选择上报部门&nbsp;&nbsp;</a> -->
		   	</div>
		   <table id="tableId" data-url="/Standard/ajaxGetReportIndicators" data-sort-name="id" data-sort-order="asc" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id" data-formatter="indexFormatter">索引ID</th>
						<th data-field="name">上报科室名称</th>
						<th data-field="subject_num">质量科目数量</th>
						<th data-field="section_num">负责科室数量</th>
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
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="child_title"></h3>
			</div>
			<div class="modal-body" style="padding:15px 20px;">
				<table id="tableList" data-sort-name="id" data-sort-order="asc" data-toggle="table"
			   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true">
					<thead>
						<tr>
							<th data-checkbox="true"></th>
							<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
							<th data-field="type_name">目标科目</th>
							<th data-field="standard" data-formatter="formatStandard">标准</th>
							<th data-field="computation">计算方法</th>
							<th data-field="operate" data-formatter="listFormatter" data-events="listEvents">操作</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="SubjectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="Subjec_title">选择科目</h3>
			</div>
			<div class="modal-body" style="padding:15px 20px;">
				<div id="toolbar2" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="SubjecSubmit();">保存管理科目</button>
				</div>
				<table id="SubjectList"  data-url="/Standard/ajaxDictionaryGetAllChild"  data-sort-name="id" data-sort-order="asc" data-toggle="table"
			   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar2">
					<thead>
						<tr>
							<th data-checkbox="true"></th>
							<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
							<th data-field="type_name">质量科目名称</th>
							<th data-field="standard" data-formatter="formatStandard">标准</th>
							<th data-field="computation" >计算方法</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="SectionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="Section_title">负责科室管理</h3>
			</div>
			<form role="form" id="SectionForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-1 control-label"></label>
						<div class="col-sm-9">
							<p style="color:red;font-size:20px" id="default_value"></p>
	                    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['exportDictionaryList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['section_id']->value!=0){?>
							<label class="checkbox" style="float:left;margin-left:15%;width:35%;">
								<input type="checkbox" class="form-control section" name="section[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" style="float:left;" value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
">
								<span style="float:left;"><?php echo $_smarty_tpl->tpl_vars['sectionList']->value[$_smarty_tpl->tpl_vars['section_id']->value];?>
</span>
								<input type="number" name="standard[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" class="form-control" style="width:120px;float:right;">
							</label>
							<?php }?>
                    		<?php } ?>
                    		<label class="checkbox" style="float:left;margin-left:15%;width:35%;">
								<input type="checkbox" class="form-control section" name="section[0]" style="float:left;" value="0">
								<span style="float:left;">全院</span>
								<input type="number" name="standard[0]" class="form-control" style="width:120px;float:right;">
							</label>
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="edit_id" name="section_id" value=""/>
					<a class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="SectionSubmit">提交</button>
				</div>
        	</form>
		</div>
	</div>
</div>

<script type="text/javascript">
function formatStandard(value, row, index) {
	return row.range+row.standard;
}
function indexFormatter(value, row, index) {
	return index+1;
}
function refresh(){
	$('#tableId').bootstrapTable('refresh', {
        url: '/Standard/ajaxGetReportIndicators'
    });
}
function operateFormatter(value, row, index) {
    return [
        '<a class="list ml10" href="javascript:void(0)" title="List">',
            '<i class="glyphicon glyphicon-eye-open">查看详细</i> ',
        '</a> ',
        ' <a class="CheckSubject ml10" href="javascript:void(0)" title="CheckSubject">',
            ' <i class="glyphicon glyphicon-check">选择科目</i> ',
        '</a> ',
        ' <a class="CheckSection ml10" href="javascript:void(0)" title="CheckSection">',
            ' <i class="glyphicon glyphicon-check">负责科室管理</i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .list': function (e, value, row, index) {
        opList(row);
    },
    'click .CheckSubject': function (e, value, row, index) {
    	CheckSubject(row);
    },
    'click .CheckSection': function (e, value, row, index) {
    	CheckSection(row);
    }
};
function opList(row){
	refreshChild(row.section);
	$("#edit_id").val(row.section);
	$("#child_title").html("上报部门:<font color='red'>"+row.name+" </font> 详情");
	$('#listModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function CheckSubject(row) {
	$("#edit_id").val(row.section);
	$("#Subjec_title").html("上报部门:<font color='red'>"+row.name+" </font> 选择科目");
	$('#SubjectModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function CheckSection(row) {
	$("#edit_id").val(row.section);
	$("#Section_title").html("上报部门:<font color='red'>"+row.name+" </font> 负责科室管理");
	if(row['section_ids']){
		var vals = row['section_ids'].split(",");
		for(var i in vals){
			$("#SectionForm").find("input[name='section["+vals[i]+"]']").prop("checked",true);
		}
	}
	$('#SectionModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function refreshChild(section){
	$('#tableList').bootstrapTable('refresh', {
        url: '/Standard/ajaxIndicatorsChildList/section/'+section
    });
}
function listFormatter(value, row, index) {
	return [
		'<a class="remove ml10" href="javascript:void(0)" title="Remove">',
			'<i class="glyphicon glyphicon-trash">删除 </i>',
		'</a>'
    ].join('');
}
window.listEvents = {
	'click .remove': function (e, value, row, index) {
		Modal.confirm({
			msg: "<div style='text-align: center;'>是否删除记录？</div>",
			title: "删除记录"
		}).on( function (e) {
			if(e) {
				$.ajax({
	    	        url:'/Standard/ajaxDeleteSubjec',
	    	        type:'post',
	    			dataType : 'json',
	    			data : encodeURI('id=' + row.id+'&section='+$("#edit_id").val()),
	    			async: false,
	    			success:function(data){
	    	        	if(data['success']) {
	    	        		refresh();
	    	        		refreshChild($("#edit_id").val());
	    	        		Calert(data['msg']);
	    				} else {
	    					Calert(data['msg']);
	    				}
	    	        },
	    	        error:function(){}
	    	     });
	    	}
	  });
    }
}
function SubjecSubmit(){
	var TableData = $('#SubjectList').bootstrapTable('getSelections');
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
			'/Standard/ajaxSubmitSubjec',
			{
				'subject_ids':ids,
				'section':$("#edit_id").val()
			},
			function(data){
				Calert(data.msg);
				if(data.success){
					$('#SubjectModal').modal('hide');
					refreshChild($("#edit_id").val());
					refresh();
					$("input[type='checkbox']").prop("checked",false);
				}
			},"json"
		);
	}
}
$(function(){
	//添加修改子类提交
	$("#SectionSubmit").click(function(){
        var validateForm = function(){
        }
        var showResponse = function(data){
        	if(data['success']) {
        		Calert(data['msg']);
        		$('#SectionModal').modal('hide');
        		refreshChild($("#edit_id").val());
        		refresh();
			} else {
				Calert(data['msg']);
			}
        };
        var options= {
                url : "/Standard/ajaxSubmitSection",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : true,//数据返回后，是否清除表单内容
        };
        $("#SectionForm").ajaxForm(options);
	});
});
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>