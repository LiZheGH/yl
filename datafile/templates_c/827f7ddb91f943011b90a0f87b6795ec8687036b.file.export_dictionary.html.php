<?php /* Smarty version Smarty-3.1.13, created on 2017-10-09 11:37:12
         compiled from "/private/var/www/yl/application/views/admin/standard/export_dictionary.html" */ ?>
<?php /*%%SmartyHeaderCode:173108803359dae99dd78c56-39076272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '827f7ddb91f943011b90a0f87b6795ec8687036b' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/export_dictionary.html',
      1 => 1507520229,
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
						<div class="col-sm-9 controls" style="line-height: 40px;">
							<?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
							<label class="checkbox" style="float:left;margin-left:5%;width:20%;">
								<input type="checkbox" class="form-control section" name="section[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" style="float:left;" value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
">
								<span style="float:left;"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</span>
								<input type="number" name="standard[<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
]" class="form-control" style="width:100px;float:right;">
							</label>
                    		<?php } ?>
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="more_id" name="d_id"/>
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
</style>
<script type="text/javascript">
function showStatus(value,row,index){
	if(row.status == 1){
		return '<font color="green">有效</font>';
	}else{
		return '<font color="red">无效</font>';
	}
}
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil"></i>',
        '</a> ',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash"></i>',
        '</a>'
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
	    	        url:'/base/ajaxSectionDelete',
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
    }
};

function refresh(){
	$('#tableId').bootstrapTable('refresh', {
        url: '/base/ajaxSectionList'
    });
}

function showModal() {
	$('#modalTitle').html('新增');
	$('#modalSubmit').attr('onclick', 'addOne()');
	$('#oneForm')[0].reset();
	$('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}

function addOne() {
	var str = '';
    	str += '&name=' + $("#name").val();
    	str += '&status=' + $("input[name='status']:checked").val();
	str = str.substr(1);
	$.ajax({
        url:'/base/ajaxSectionAdd',
        type:'post',
		dataType : 'json',
		data : encodeURI(str),
        success:function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#myModal').modal('hide');
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				alert(data['msg']);
			}
        },
        error:function(){

        }

     });
}

function opUpdate(row){
    $('#modalTitle').html('修改');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	$("#name").val(row.name);
	$("input[value='"+row.status+"']").prop("checked",true);
    $('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function updateOne() {
	var id = $('#id').val();
	var str = '';
	str += '&name=' + $("#name").val();
	str += '&status=' + $("input[name='status']:checked").val();
	$.ajax({
        url:'/base/ajaxSectionUpdate',
        type:'post',
		dataType : 'json',
		data : encodeURI('id=' + id + str),
		async: false,
		success:function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#myModal').modal('hide');
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				alert(data['msg']);
			}
        },
        error:function(){

        }
	});
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>