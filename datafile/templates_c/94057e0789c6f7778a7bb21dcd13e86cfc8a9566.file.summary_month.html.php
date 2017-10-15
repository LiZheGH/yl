<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 09:30:10
         compiled from "/www/yl/application/views/admin/standard/summary_month.html" */ ?>
<?php /*%%SmartyHeaderCode:114108300759dec5a2698d09-13042239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94057e0789c6f7778a7bb21dcd13e86cfc8a9566' => 
    array (
      0 => '/www/yl/application/views/admin/standard/summary_month.html',
      1 => 1507756650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114108300759dec5a2698d09-13042239',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dec5a26cedf1_72695568',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dec5a26cedf1_72695568')) {function content_59dec5a26cedf1_72695568($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          	<div class="caption"> <i class="fa fa-globe"></i>按月汇总数据</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
        		<div class="form-group col-sm-8" style="padding:10px 0 0 0;float: left;margin-top:0px;line-height: 34px;height: 26px;">
					<label class="control-label" style="padding:0;width:90px;float:left">选择年份</label>
					<div class="col-sm-5" style="padding:0">
		            	<div class="input-group date">
		                	<select id="report_time" name="report_time" class="form-control">
		                		<option value="2017">2017</option>
		                	</select>
		                 	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		             	</div>
		       		</div>
		        </div>
        	</div>
		   	<table id="tableId" data-url="/Standard/ajaxGetSummaryMonthList" data-sort-name="id" data-toggle="table"
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
        url: '/Standard/ajaxGetSummaryMonthList',
        query:{
        	report_time:$("#report_time").val()
        }
    });
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>