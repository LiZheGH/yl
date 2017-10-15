<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 09:30:02
         compiled from "/www/yl/application/views/admin/standard/edit_data.html" */ ?>
<?php /*%%SmartyHeaderCode:146484429859dec59acc0476-17607788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '671ab33632d85d48ce75a237e3d51771dca54205' => 
    array (
      0 => '/www/yl/application/views/admin/standard/edit_data.html',
      1 => 1507756650,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146484429859dec59acc0476-17607788',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dec59acf94b5_84144849',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dec59acf94b5_84144849')) {function content_59dec59acf94b5_84144849($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          	<div class="caption"> <i class="fa fa-globe"></i>修改数据</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
        		<div class="form-group col-sm-8" style="padding:10px 0 0 0;float: left;margin-top:0px;line-height: 34px;height: 26px;">
	        		<div style="padding:0;width:85px;float:left;">
	        			<button class="btn btn-primary btn-sm" onClick="showModal();">批量修改</button>
	        		</div>
	        		<div style="padding:0;width:85px;float:left;">
		        		<button class="btn btn-primary btn-sm" onClick="showModal();">批量删除</button>
	        		</div>
					<label class="control-label" style="padding:0;width:90px;float:left">选择上报月份</label>
					<div class="col-sm-5" style="padding:0">
		            	<div class="input-group date">
		                	<input type="text" id="report_time" name="report_time" placeholder="上报月份" class="form-control month" />
		                 	<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		             	</div>
		       		</div>
		        </div>
        	</div>
		   	<table id="tableId" data-url="/Standard/ajaxEditImportDataList" data-sort-name="id" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
						<th data-field="section_name">部门</th>
						<th data-field="type_name">质量科目名称</th>
						<th data-field="standard">标准</th>
						<th data-field="value">实际值</th>
						<th data-field="report_section_name">上报部门</th>
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

<style>
.pull-left{width:70%;margin-top:0!important}
</style>
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
        url: '/Standard/ajaxEditImportDataList',
        query:{
        	report_time:$("#report_time").val()
        }
    });
}
function operateFormatter(value, row, index) {
    return [
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash">删除</i>',
        '</a>'
    ].join('');
}
window.operateEvents = {
    'click .remove': function (e, value, row, index) {
		Modal.confirm({
			msg: "<div style='text-align: center;'>是否删除记录？</div>",
			title: "删除记录"
		}).on( function (e) {
			if(e) {
				$.ajax({
	    	        url:'/Standard/ajaxImportDataDelete',
	    	        type:'post',
	    			dataType : 'json',
	    			data : encodeURI('id=' + row.id),
	    			async: false,
	    			success:function(data){
	    	        	if(data['success']) {
	    	        		$('#myModal').modal('hide');
	    	        		Calert(data['msg']);
	    	        		refresh()
	    				} else {
	    					Calert(data['msg']);
	    				}
	    	        },
	    	        error:function(){}
	    	     });
	    	}
	  });
    }
};
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>