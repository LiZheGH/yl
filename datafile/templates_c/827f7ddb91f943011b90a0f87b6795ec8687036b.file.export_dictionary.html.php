<?php /* Smarty version Smarty-3.1.13, created on 2017-10-09 14:12:16
         compiled from "/private/var/www/yl/application/views/admin/standard/export_dictionary.html" */ ?>
<?php /*%%SmartyHeaderCode:173108803359dae99dd78c56-39076272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '827f7ddb91f943011b90a0f87b6795ec8687036b' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/export_dictionary.html',
      1 => 1507529531,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173108803359dae99dd78c56-39076272',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dae99dd96d85_33254616',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dae99dd96d85_33254616')) {function content_59dae99dd96d85_33254616($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>导出科室字典</div>
        </div>
        <div class="portlet-body">
			<form role="form" id="form" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-1 control-label"></label>
						<div class="col-sm-9">
							<p style="color:red;font-size:20px" id="default_value"></p>
	                    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 controls" style="line-height: 40px;">
							<?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
							<label class="checkbox" style="float:left;width:15%;">
								<input type="checkbox" class="form-control section" name="section[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" style="float:left;" value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
">
								<span style="float:left;"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</span>
								<input type="number" name="standard[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" class="form-control" style="width:80px;float:right;">
							</label>
                    		<?php } ?>
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<a class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="submit">提交</button>
				</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.form-horizontal .form-group {
    margin:0;
}
.checkbox{
	margin-left:10%;
}
.checkbox:nth-child(4n-3){
	margin-left:5%;
}
</style>
<script type="text/javascript">
$(function(){
	//列表
	$.post(
		"/Standard/ajaxGetExportDictionary",
		{},function(data){
			for(var i in data){
				$("input[name='section["+i+"]']").prop("checked",true);
				$("input[name='standard["+i+"]']").val(data[i]);
			}
		},"json"
	);
	//添加
	$("#submit").click(function(){
	    var validateForm = function(){
	    }
	    var showResponse = function(data){
	   		alert(data['msg']);
	    };
	    var options= {
	            url : "/Standard/ajaxExportDictionarySubmit",
	            dataType:  'json',//数据类型
	            beforeSubmit: validateForm,
	            success : showResponse,
	            resetForm : false,//数据返回后，是否清除表单内容
	    };
	    $("#form").ajaxForm(options);
	});
});

</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>