<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 04:44:08
         compiled from "/private/var/www/yl/application/views/admin/standard/list_data.html" */ ?>
<?php /*%%SmartyHeaderCode:59717257759ddd562ec7583-90980418%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbd2900ba39a816a9949ce0eff34d85ffa3fcee6' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/list_data.html',
      1 => 1507754574,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59717257759ddd562ec7583-90980418',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59ddd562ee7305_59237772',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'exportDictionaryList' => 0,
    'section_id' => 0,
    'sectionList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59ddd562ee7305_59237772')) {function content_59ddd562ee7305_59237772($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          	<div class="caption"> <i class="fa fa-globe"></i>查看历史上报</div>
        </div>
        <div class="portlet-body">
        	<div class="form-group col-sm-9" style="float: left;margin-top: 1em;line-height: 34px;height: 26px;">
				<label class="col-sm-2 control-label">选择上报月份</label>
				<div class="col-sm-5">
	            	<div class="input-group date">
	                	<input type="text" id="report_time" name="report_time" placeholder="上报月份" class="form-control month" />
	                 	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
	             	</div>
	       		</div>
	        </div>
        	<div id="toolbar1" style="margin-bottom:0px;">
        	</div>
		   	<table id="tableId" data-url="/Standard/ajaxImportDataList" data-sort-name="id" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
						<th data-field="cdate">上传时间</th>
						<th data-field="type_name">质量科目名称</th>
						<th data-field="standard">标准</th>
						<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['exportDictionaryList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
						<?php if ($_smarty_tpl->tpl_vars['section_id']->value==0){?>
						<th data-field="s0">全院</th>
						<?php }else{ ?>
						<th data-field="s<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['sectionList']->value[$_smarty_tpl->tpl_vars['section_id']->value];?>
</th>
						<?php }?>
						<?php } ?>
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

<script type="text/javascript">
//时间控件-不要改这的代码，这里有个 假递归
var myDate = new Date();
var report_time = $('#report_time').val();
if( report_time == '');
	$('#report_time').val(myDate.getFullYear()+'-'+(1+myDate.getMonth()));
dateArr = [];
for(var i=-5;i < 6;i++){
	dateArr[i+5] = parseInt(i)+parseInt(myDate.getFullYear());
}
$('#report_time').monthpicker({
	years: dateArr,
	onMonthSelect: function(m, y) {
		for(var i=-5;i < 6;i++){
			dateArr[i+5] = parseInt(i)+parseInt(y);
		}
		refresh();
	}
});
function indexFormatter(value, row, index) {
	return index+1;
}
function refresh(){
	$('#report_time').monthpicker({
		years: dateArr,
		onMonthSelect: function(m, y) {
			for(var i=-5;i < 6;i++){
				dateArr[i+5] = parseInt(i)+parseInt(y);
			}
			refresh();
		}
    });
	$('#tableId').bootstrapTable('refresh', {
        url: '/Standard/ajaxImportDataList',
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