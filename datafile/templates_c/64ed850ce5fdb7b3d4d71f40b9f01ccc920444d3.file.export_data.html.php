<?php /* Smarty version Smarty-3.1.13, created on 2017-10-14 18:24:14
         compiled from "/private/var/www/yl/application/views/admin/standard/export_data.html" */ ?>
<?php /*%%SmartyHeaderCode:64635120759e0b0b695d3a8-17534240%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64ed850ce5fdb7b3d4d71f40b9f01ccc920444d3' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/export_data.html',
      1 => 1507976652,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64635120759e0b0b695d3a8-17534240',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0b0b697d573_21108127',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0b0b697d573_21108127')) {function content_59e0b0b697d573_21108127($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          	<div class="caption"> <i class="fa fa-globe"></i>导出数据</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
        		<div class="form-group col-sm-8" style="width:600px;padding:10px 0 0 0;float: left;margin:0px;line-height: 34px;height: 44px;">
			        <a class="btn btn-primary btn-sm" onClick="downExcel();" style="float:left;margin:4px 10px 0 0;">导出数据</a>
					<label class="control-label" style="padding:0;width:90px;float:left">选择起止日期</label>
					<div class="col-sm-9" style="padding:0;width:410px;">
		            	<div class="col-sm-5" style="padding:0;width:150px">
			                <div class="input-group date">
			                    <input type="text" id="report_time_start" placeholder="上报日期" class="form-control datetimepicker1" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
		                </div>
		                <div style="float:left;margin:0 10px;">-</div>
		            	<div class="col-sm-5" style="padding:0;width:150px">
			                <div class="input-group date">
			                    <input type="text" id="report_time_end" placeholder="上报日期" class="form-control datetimepicker1" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
		                </div>
		       		</div>
		        </div>
        	</div>
		   	<table id="tableId" data-url="/Standard/ajaxGetExportDataList" data-sort-name="id" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
						<th data-field="section_name">部门</th>
						<th data-field="type_name">质量科目名称</th>
						<th data-field="standard">标准</th>
						<th data-field="m01">一月</th>
						<th data-field="m02">二月</th>
						<th data-field="m03">三月</th>
						<th data-field="m04">四月</th>
						<th data-field="m05">五月</th>
						<th data-field="m06">六月</th>
						<th data-field="m07">七月</th>
						<th data-field="m08">八月</th>
						<th data-field="m09">九月</th>
						<th data-field="m10">十月</th>
						<th data-field="m11">十一</th>
						<th data-field="m12">十二</th>
						<th data-field="average" data-formatter="averageFormatter">平均</th>
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

<style>
.pull-left{width:70%;margin-top:0!important}
</style>
<script type="text/javascript">
//时间控件
$(".datetimepicker1").datetimepicker({
	format:'Y-m-d',
	timepicker:false,
	daypicker:false,
	maxDate:true,
	formatDate:'Y-m-d'
}).change(function(){
	refresh();
});
var myDate = new Date();
$("#report_time_start").val(myDate.getFullYear()+'-'+(1+myDate.getMonth())+'-01');
$("#report_time_end").val(myDate.getFullYear()+'-'+(1+myDate.getMonth())+'-'+myDate.getDate() );
function indexFormatter(value, row, index) {
	return index+1;
}
function averageFormatter(value, row, index) {
	if(row.status == 0)
		return row.average;
	else if(row.status == -1)
		return '<i class="glyphicon glyphicon-arrow-down" style="color:red">'+row.average+'</i>';
	else if(row.status == 1)
		return '<i class="glyphicon glyphicon-arrow-up" style="color:red">'+row.average+'</i>';
}
function refresh(){
	$('#tableId').bootstrapTable('refresh', {
        url: '/Standard/ajaxGetExportDataList',
        query:{
        	report_time_start:$("#report_time_start").val(),
        	report_time_end:$("#report_time_end").val()
        }
    });
}
function downExcel(){
	var TableData = $('#tableId').bootstrapTable('getSelections');
	var ids = '';
	for(var i in TableData){
		var id = 1+TableData[i].id;
		if(ids)
			ids += ","+id;
		else
			ids = id;
	}
	if(!ids || ids == ''){
		Calert("请至少选择一条记录");
		return false;
	} else {
		var s=$("#report_time_start").val();
    	var e=$("#report_time_end").val();
		window.location.href = '/Standard/ajaxExportImportDataList/s/'+s+'/e/'+e+'/ids/'+ids;
	}
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>