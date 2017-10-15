<?php /* Smarty version Smarty-3.1.13, created on 2017-10-13 20:27:11
         compiled from "/private/var/www/yl/application/views/admin/system/account/list.html" */ ?>
<?php /*%%SmartyHeaderCode:89313128559e0b11f7af8a5-58484424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '048017ad47eba615435adad688873417646ddbf1' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/system/account/list.html',
      1 => 1507865404,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89313128559e0b11f7af8a5-58484424',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'role_list' => 0,
    'role' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0b11f7e7f54_16674080',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0b11f7e7f54_16674080')) {function content_59e0b11f7e7f54_16674080($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script>
$(function() {
	var myDate = new Date();
	$('#file_upload').uploadify({
		'formData'     : {
			'timestamp' : myDate.getTime(),
			'token'     : 'aaa' + myDate.getTime()
		},
		'swf'      : '/public/misc/uploadify.swf',
		'uploader' : '/webBase/uploadify',
		onUploadSuccess: function(file,data,response){
			$('#avatar').attr('src',data);
		}
	});
});
</script>
<body class="page-header-fixed page-quick-sidebar-over-content" style="overflow:hidden;">
<div class="page-container"> <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>账号管理 </div>

        </div>

        <div class="portlet-body">
        <div id="toolbar1" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;
					</button>
		</div>
          <table id="tableId" data-toggle="table"  data-url="/system/ajaxAccountGetList" data-height="auto"
									data-sort-name="sort_weight" data-sort-order="desc" data-show-toggle="true" data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="username">账户名</th>
						<th data-field="email">邮箱</th>
						<th data-field="ldate">最后一次登录时间</th>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="text-align:center;">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h3 id="modalTitle">新增账户</h3>
				</div>
				<div class="modal-body">
					<form role="form" id="accountForm">
					<input id="account_id" type="hidden" />
                    <div class="form-group">
                        <label for="username">用户名</label>
                        <input type="text" class="form-control" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
	                        <label for="avatar">头像</label>
	                        <span class="help-block">
		                        <img id="avatar" style="width:103px;height:75px;margin-bottom:5px;" src="/public/img/icon.png"  class="cover" placeholder="新闻配图">
		                        <input id="file_upload" name="file_upload" type="file" multiple="true">
		                    </span>
	                </div>
                    <div class="form-group" >
                        <label for="role_ids">角色</label>
                        <div class="" id="roles">
                        	<?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['role']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['role_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value){
$_smarty_tpl->tpl_vars['role']->_loop = true;
?>
	                        	<label class="checkbox-inline">
								<input id="role<?php echo $_smarty_tpl->tpl_vars['role']->value['id'];?>
" class="role_ids" name="role_ids" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['id'];?>
" >
								<?php echo $_smarty_tpl->tpl_vars['role']->value['role_name'];?>

								</label>
                        	<?php } ?>
						</div>
                    </div>
                    <div class="form-group">
						<label class="col-sm-1 control-label" style="padding-left: 0;">权重</label>
						<div>
							<em style="color:#ccc">（分为4个级别，数值越大，权重越高）</em>
							<select  class="form-control" id="level" name="level">
                    			<option value="1">1：（普通职工）</option>
                    			<option value="2">2：（科室管理人员）</option>
                    			<option value="3">3：（医院管理人员）</option>
                    			<option value="4">4：（集团管理人员）</option>
	                    	</select>
	                    </div>
					</div>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
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
			  msg: "是否删除？",
			  title: "删除"
			})
			.on( function (e) {
			 	if(e) {
			 		$.ajax({
			 	        url:'/system/ajaxAccountDelete',
			 	        type:'post',
			 			dataType : 'json',
			 			data : encodeURI('id=' + row.id),
			 			async: false,
			 			success:function(data){
		    	        	if(data['result_code'] == 0) {
		    	        		Calert("删除成功!");
		    	        		refresh();
		    	        		$('#accountForm')[0].reset();
		    				} else {
		    					Calert(data['info']);
		    					return false;
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
        url: '/system/ajaxAccountGetList'
    });
	window.location.reload();
}

function opUpdate(row) {
	$('#modalTitle').html('修改');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#id').val(row.id);
	$('.role_ids').removeAttr("checked");
	$.ajax({
        url:'/system/ajaxAccountGetOne',
        type:'post',
		dataType : 'json',
		data: encodeURI('id=' + row.id),
		async: false,
        success:function(data){
        	$('#account_id').val(data['id']);
        	$('#username').val(data['username']);
        	$('#password').val('');
        	$('#email').val(data['email']);
        	$('#status').val(data['status']);
        	$('#level').val(data['level']);
        	if(data['avatar'] == ''){
        		$('#avatar').attr('src','/public/img/icon.png');
        	}else{
        		$('#avatar').attr('src',data['avatar']);
        	}
        	if(data['role_ids']){
        		var daily_num = data['role_ids'].split(',');
        		for(var i in daily_num ){
        			$(".role_ids[value='"+daily_num[i]+"']").prop("checked",true);
        		}
        	}
		},
		error:function(){

	    }
	});
	$('#myModal').modal('show');
}

function addOne() {
	var username = $('#username').val();
	var password = $('#password').val();
	var role_ids = $('#role_id').val();
	var daily_str = $(".role_ids:checked");
	var role_ids = '';
	for(var i=0;i<daily_str.length;i++){
		role_ids += daily_str.eq(i).val()+',';
	}
	if(role_ids.length > 1)
		role_ids = role_ids.substring(0, role_ids.length-1);
	var email = $('#email').val();
	var status = $('#status').val();
	var level = $('#level').val();
	var avatar = $('#avatar').attr('src');
	$.ajax({
        url:'/system/ajaxAccountAdd',
        type:'post',
		dataType : 'json',
		data : encodeURI('username=' + username +  '&password=' + password + '&role_ids=' + role_ids + '&email=' + email + '&level=' + level +'&status=' + status + '&avatar=' + avatar),
        success:function(data){
        	if(data['result_code'] == 0) {
        		Calert("添加成功!");
        		refresh();
        		$('#accountForm')[0].reset();
			} else {
				Calert(data['info']);
				return false;
			}
        },
        error:function(){

        }

     });
}

function updateOne() {
	var id = $('#account_id').val();
	var username = $('#username').val();
	var password = $('#password').val();
	var role_ids = $('#role_id').val();
	var daily_str = $(".role_ids:checked");
	var role_ids = '';
	for(var i=0;i<daily_str.length;i++){
		role_ids += daily_str.eq(i).val()+',';
	}
	if(role_ids.length > 1)
		role_ids = role_ids.substring(0, role_ids.length-1);
	var email = $('#email').val();
	var status = $('#status').val();
	var level = $('#level').val();
	var avatar = $('#avatar').attr('src');
	$.ajax({
        url:'/system/ajaxAccountUpdate',
        type:'post',
		dataType : 'json',
		data : encodeURI('id=' + id + '&username=' + username +  '&password=' + password + '&role_ids=' + role_ids + '&level=' + level + '&email=' + email + '&status=' + status + '&avatar=' + avatar),
        success:function(data){
        	if(data['result_code'] == 0) {
        		Calert("修改成功!");
        		refresh();
        		$('#accountForm')[0].reset();
			} else {
				Calert(data['info']);
				return false;
			}
        },
        error:function(){

        }

     });
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
		$('#accountForm')[0].reset();
		$('#myModal').modal('show');
	}


</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html><?php }} ?>