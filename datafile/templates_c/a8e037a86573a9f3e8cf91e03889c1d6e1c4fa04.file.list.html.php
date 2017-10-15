<?php /* Smarty version Smarty-3.1.13, created on 2017-10-15 07:05:46
         compiled from "/private/var/www/yl/application/views/admin/system/power/list.html" */ ?>
<?php /*%%SmartyHeaderCode:82413082959e1f0ddb8f555-47294913%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8e037a86573a9f3e8cf91e03889c1d6e1c4fa04' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/system/power/list.html',
      1 => 1508022341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82413082959e1f0ddb8f555-47294913',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e1f0ddbc8b17_03411059',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e1f0ddbc8b17_03411059')) {function content_59e1f0ddbc8b17_03411059($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<body class="page-header-fixed page-quick-sidebar-over-content">
<div class="page-container"> <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>菜单管理 </div>

        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showModal(0);">新增菜单</button>
		   </div>
          	<table id="tableId" data-toggle="table"  data-url="/system/ajaxPowerGetList"  data-height="auto"
				 data-sort-name="sort" data-sort-order="asc" data-show-toggle="true" data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="power_name">权限</th>
						<th data-field="uri">访问URL</th>
						<th data-field="sort">排序</th>
						<th data-field="operate" data-formatter="operateFormatter" data-events="operateEvents">操作</th>
					</tr>
				</thead>
				<tbody id="list_body">
				</tbody>
			</table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="child_title"></h3>
			</div>
			<div class="modal-body" style="padding:15px 20px;">
				<div id="toolbar2" style="margin-bottom:0px;">
					<button id="addChild" class="btn btn-primary btn-sm">添加菜单</button>
			   	</div>
				<table id="tableList" data-sort-name="id" data-sort-order="asc" data-toggle="table"
			   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar2">
					<thead>
						<tr>
							<th data-checkbox="true"></th>
							<th data-field="id" >ID</th>
							<th data-field="power_name">权限</th>
							<th data-field="uri">访问URL</th>
							<th data-field="sort">排序</th>
							<th data-field="operate" data-formatter="operateChildFormatter" data-events="operateChildEvents">操作</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalTitle"></h3>
			</div>
			<div class="modal-body">
				<form role="form" id="oneForm">
					<input id="id" type="hidden" />
                   <div class="form-group">
                       <label for="power_name">菜单名称</label>
                       <input type="text" class="form-control" id="power_name" placeholder="菜单名称">
                   </div>
                   <div class="form-group">
                       <label for="uri">访问URL</label>
                       <input type="text" class="form-control" id="uri" placeholder="访问URL">
                   </div>
                   <div class="form-group">
                       <label for="sort">排序</label>
                       <input type="text" class="form-control" id="sort" placeholder="排序（从小到大）">
                   </div>
                   <div class="form-group">
                       <label for="sort">属于</label>
                       <input type="hidden" id="p_id" value="" />
                       <span class="form-control" id="p_name"></span>
                   </div>
               </form>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
				<a href="#" class="btn btn-primary" id="modalSubmit" onclick="addOne();">提交</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function addOne() {
	var power_name = $('#power_name').val();
	var uri = $('#uri').val();
	var sort = $('#sort').val();
	var p_id = $('#p_id').val();
	$.post(
		'/system/ajaxPowerAdd',
		{
			'power_name':power_name,
			'uri':uri,
			'sort':sort,
			'p_id':p_id
		},function(data){
			Calert(data.msg);
        	if(data.success) {
        		$('#myModal').modal('hide');
        		$('#tableId').bootstrapTable('refresh', {
                    url: '/system/ajaxPowerGetList'
                });
        		refreshChild(p_id);
			}
		},'json'
	);
}
function opUpdate(row){
	$('#oneForm')[0].reset();
    $('#modalTitle').html('修改菜单');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	$('#power_name').val(row.power_name);
	$('#sort').val(row.sort);
	$('#uri').val(row.uri);
	getList(0);
	$('#myModal').modal('show');
}
function updateOne() {
	var id = $('#id').val();
	var power_name = $('#power_name').val();
	var uri = $('#uri').val();
	var sort = $('#sort').val();
	var p_id = $('#p_id').val();
	$.post(
		'/system/ajaxPowerUpdate',
		{
			'id':id,
			'power_name':power_name,
			'uri':uri,
			'sort':sort,
			'p_id':p_id
		},function(data){
			Calert(data.msg);
        	if(data.success) {
        		$('#myModal').modal('hide');
        		$('#tableId').bootstrapTable('refresh', {
                    url: '/system/ajaxPowerGetList'
                });
			}
		},'json'
	);
}
function showModal(p_id) {
	$('#modalTitle').html('新增菜单');
	$('#modalSubmit').attr('onclick', 'addOne()');
	$('#oneForm')[0].reset();
	getList(p_id);
	$('#myModal').modal('show');
}
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil">修改</i>',
        '</a> ',
        '<a class="child ml10" href="javascript:void(0)" title="AddChild">',
            '<i class="glyphicon glyphicon-indent-left">子菜单</i>',
        '</a> ',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash">删除</i>',
        '</a>'
    ].join('');
}

window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        opUpdate(row);
    },
    'click .child': function (e, value, row, index) {
    	child(row);
    },
    'click .remove': function (e, value, row, index) {
		Modal.confirm({
			msg: "是否删除菜单？",
			title: "删除菜单"
		}).on( function (e) { if(e) {
			$.ajax({
    	        url:'/system/ajaxPowerDelete',
    	        type:'post',
    			dataType : 'json',
    			data : encodeURI('id=' + row.id),
    			async: false,
    			success:function(data){
					if(data['result_code'] == 0) {
						$('#myModal').modal('hide');
						$('#tableId').bootstrapTable('refresh', {
							url: '/system/ajaxPowerGetList'
						});
						$('#oneForm')[0].reset();
					} else {
						alert(data['info']);
					}
				},
    	        error:function(){

    	        }
			});
		}});
    }
};
function child(row){
	$("#child_title").html('【'+row.power_name+'】菜单列表');
	refreshChild(row.id);
	$("#addChild").attr("onclick","showModal("+row.id+")");
	$('#listModal').modal('show');
}
function getList(p_id){
	$.post(
		'/system/ajaxPowerGetList',
		{
			'p_id':0
		},function(data){
			var html = '';
			if(p_id == 0 ){
				$("#p_id").val(0);
				$("#p_name").html('<font color="#578ebe">【顶级菜单】</font>菜单子项');
			} else {
				for(var i in data){
					var value = data[i];
					if(value.id == p_id){
						$("#p_id").val(p_id);
						$("#p_name").html('<font color="#578ebe">【'+value.power_name+'】</font>菜单子项');
					}
				}
			}
		}
	);
}
function refreshChild(p_id){
	$('#tableList').bootstrapTable('refresh', {
        url: '/system/ajaxPowerGetList/p_id/'+p_id
    });
}
function operateChildFormatter(value, row, index) {
	return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil">修改</i>',
        '</a> ',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash">删除 </i>',
        '</a>'
    ].join('');
}
window.operateChildEvents = {
    'click .edit': function (e, value, row, index) {
        opChildUpdate(row);
    },
    'click .remove': function (e, value, row, index) {
    	Modal.confirm({
			msg: "是否删除菜单？",
			title: "删除菜单"
		}).on( function (e) { if(e) {
			$.ajax({
    	        url:'/system/ajaxPowerDelete',
    	        type:'post',
    			dataType : 'json',
    			data : encodeURI('id=' + row.id),
    			async: false,
    			success:function(data){
					Calert(data['info']);
					if(data['result_code'] == 0) {
						refreshChild(row.p_id);
					}
				},
    	        error:function(){

    	        }
			});
		}});
    }
};
function opChildUpdate(row){
	$('#oneForm')[0].reset();
    $('#modalTitle').html('修改子菜单');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	$('#power_name').val(row.power_name);
	$('#sort').val(row.sort);
	$('#uri').val(row.uri);
	getList(row.p_id);
	$('#myModal').modal('show');
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>