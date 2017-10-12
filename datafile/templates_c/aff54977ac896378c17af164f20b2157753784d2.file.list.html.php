<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 14:25:12
         compiled from "/private/var/www/yl/application/views/admin/system/role/list.html" */ ?>
<?php /*%%SmartyHeaderCode:203795743959dbc473dbc645-98316014%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aff54977ac896378c17af164f20b2157753784d2' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/system/role/list.html',
      1 => 1507575036,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203795743959dbc473dbc645-98316014',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dbc473e1ed90_67415940',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'power_list' => 0,
    'power' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dbc473e1ed90_67415940')) {function content_59dbc473e1ed90_67415940($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
<div class="page-container"> <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>角色管理 </div>

        </div>

        <div class="portlet-body">
        <div id="toolbar1" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;
					</button>
		</div>
          <table id="tableId" data-toggle="table"  data-url="/system/ajaxRoleGetList" data-height="auto"
				 data-sort-name="sort_weight" data-sort-order="desc" data-show-toggle="true" data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="role_name">角色</th>
						<th data-field="status" data-formatter="showStatus">状态</th>
						<th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">操作</th>
					</tr>
				</thead>
			</table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade " id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">

		<div class="modal-dialog modal-sm" >
			<div class="modal-content">
				<div class="modal-header"  style="text-align:center;">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h4 id="modalTitle">新增角色</h4>
				</div>
				<div class="modal-body">
					<form role="form" id="oneForm">
					<input id="id" type="hidden" />
                    <div class="form-group">
                        <label for="role_name">角色名</label>
                        <input type="text" class="form-control" id="role_name" placeholder="角色名">
                    </div>
                    <div class="form-group" >
                        <label for="power_ids">权限</label>
                        <div class="" id="powers">
                        	<?php  $_smarty_tpl->tpl_vars['power'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['power']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['power_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['power']->key => $_smarty_tpl->tpl_vars['power']->value){
$_smarty_tpl->tpl_vars['power']->_loop = true;
?>
	                        	<label class="checkbox-inline">
								<input id="power<?php echo $_smarty_tpl->tpl_vars['power']->value['id'];?>
" class="power_ids" name="power_ids" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['power']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['power']->value['uri']=='/welcome/'){?>checked="checked" disabled="disabled"<?php }?>>
								<?php echo $_smarty_tpl->tpl_vars['power']->value['power_name'];?>

								</label>
                        	<?php } ?>
						</div>
                    </div>
                    <div class="form-group">
						<label for="statusDiv">状态</label>
						<div class="" id="statusDiv">
							<select id="status" style="float:left;" class="form-control ng-pristine ng-invalid ng-invalid-required">
								<option value="0">正常</option>
								<option value="1">锁定</option>
							</select>
						</div>
					</div>
                </form>
                <br/>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
					<a href="#" class="btn btn-primary" id="modalSubmit" data-dismiss="modal" onclick="addOne();">提交</a>
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
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
    	Modal.confirm(
				  {
				    msg: "是否删除角色？",
				    title: "删除角色"
				  })
				  .on( function (e) {
				    	//alert("返回结果：" + e);
				    	if(e) {
				    		$.ajax({
				    	        url:'/system/ajaxRoleDelete',
				    	        type:'post',
				    			dataType : 'json',
				    			data : encodeURI('id=' + row.id),
				    			async: false,
				    			success:function(data){
				    	        	if(data['result_code'] == 0) {
				    	        		refresh();
				    	        		$('#oneForm')[0].reset();
				    				} else {
				    					Calert(data['info']);
				    				}
				    	        },
				    	        error:function(){

				    	        }

				    	     });
				    	}
				  });
    }
};

function refresh() {
	$('#tableId').bootstrapTable('refresh', {
        url: '/system/ajaxRoleGetList'
    });
}

function opUpdate(row) {
	$('#modalTitle').html('修改');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#id').val(row.id);
	$('#role_name').val(row.role_name);
	$('.power_ids').removeAttr("checked");
	$.ajax({
        url:'/system/ajaxGetPower',
        type:'post',
		dataType : 'json',
		data: encodeURI('id=' + row.id),
		async: false,
        success:function(data){
        	if(data['have_power']){
	        	for(var key in data['have_power']) {
					var obj = data['have_power'][key];
	                $('#power' + obj['id']).attr("checked","true");
				}
        	}
		},
		error:function(){

	    }
	});
	$('#status').val(row.status);
	$('#myModal').modal('show');
}


</script>
<script type="text/javascript">
	$(function() {
		$('#tableId').bootstrapTable().on('dbl-click-row.bs.table', function (e, row, $element) {
            opUpdate(row);
        });
	});

	function showStatus(value, row, index) {
		if(value == 0) {
			return '正常';
		} else if(value == 1) {
			return '锁定';
		}
	}

	function showModal() {
		$('#modalTitle').html('新增');
		$('#modalSubmit').attr('onclick', 'addOne()');
		$('#oneForm')[0].reset();
		$('#myModal').modal('show');
	}
</script>
<script>
function addOne() {
	var role_name = $('#role_name').val();
	var status = $("#status").val();
	var m_s = $('#powers').find('input');
	var power_ids = '';
	if(m_s && m_s.length > 0) {
		for(var i=0; i<m_s.length; i++) {
			if($(m_s[i]).attr('checked') == 'checked')
				power_ids += $(m_s[i]).val() + ',';
		}
	}
	if(power_ids.length > 0) {
		power_ids = power_ids.substring(0, power_ids.length - 1);
	}
	if(!role_name) {
		$('#role_name').focus();
		return false;
	}
	//alert(username + '|' + password + '|' + email + '|' + role_ids + '|' + status);
	$.ajax({
        url:'/system/ajaxRoleAdd',
        type:'post',
		dataType : 'json',
		data : encodeURI('role_name=' + role_name +  '&status=' + status + '&power_ids=' + power_ids),
        success:function(data){
        	if(data['result_code'] == 0) {
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				Calert(data['info']);
			}
        },
        error:function(){

        }

     });
}

function updateOne() {
	var id = $('#id').val();
	var role_name = $('#role_name').val();
	var status = $('#status').val();
	var m_s = $('#powers').find('input');
	var power_ids = '';
	if(m_s && m_s.length > 0) {
		for(var i=0; i<m_s.length; i++) {
			if($(m_s[i]).attr('checked') == 'checked')
				power_ids += $(m_s[i]).val() + ',';
		}
	}
	if(power_ids.length > 0) {
		power_ids = power_ids.substring(0, power_ids.length - 1);
	}
	if(!role_name) {
		$('#role_name').focus();
		return false;
	}
	$.ajax({
        url:'/system/ajaxRoleUpdate',
        type:'post',
		dataType : 'json',
		data : encodeURI('id=' + id + '&role_name=' + role_name + '&status=' + status + '&power_ids=' + power_ids),
		async: false,
		success:function(data){
        	if(data['result_code'] == 0) {
        		refresh();
        		$('#oneForm')[0].reset();
			} else {
				Calert(data['info']);
			}
        },
        error:function(){

        }

     });
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>