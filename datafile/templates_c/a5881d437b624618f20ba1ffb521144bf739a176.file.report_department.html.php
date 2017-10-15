<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 20:03:06
         compiled from "/www/yl/application/views/admin/standard/report_department.html" */ ?>
<?php /*%%SmartyHeaderCode:45694491559dec61b17fb08-96390604%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5881d437b624618f20ba1ffb521144bf739a176' => 
    array (
      0 => '/www/yl/application/views/admin/standard/report_department.html',
      1 => 1507809785,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45694491559dec61b17fb08-96390604',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dec61b1c44f3_71650056',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dec61b1c44f3_71650056')) {function content_59dec61b1c44f3_71650056($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>选择上报部门</div>
        </div>
        <div class="portlet-body">
			<form role="form" id="form" class="form-horizontal" method="POST">
				<div class="modal-body" style="padding:15px 0;">
					<div class="form-group">
						<div class="col-sm-12 controls" style="line-height: 40px;">
	                    	<label class="checkbox" style="float:left;margin-left: 5%">
	                    		<input type="checkbox" class="form-control checkall">全选</label>
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
							<label class="checkbox" style="float:left;width:16%;">
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
	//全选
	$(".checkall").change(function(){
		$(".section").prop("checked",$(this).is(':checked'));
	});
	//列表
	$.post(
		"/Standard/ajaxGetReportDepartment",
		{},function(data){
			for(var i in data){
				$("input[name='section["+i+"]']").prop("checked",true);
				$("input[name='standard["+i+"]']").val(data[i]);
				if($(".section").length == $(".section:checked").length){
					$(".checkall").prop("checked",true);
				}
			}
		},"json"
	);
	//添加
	$("#submit").click(function(){
	    var validateForm = function(){
	    }
	    var showResponse = function(data){
	    	Calert(data['msg']);
	    };
	    var options= {
	            url : "/Standard/ajaxSubmitReportDepartment",
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
</html><?php }} ?>