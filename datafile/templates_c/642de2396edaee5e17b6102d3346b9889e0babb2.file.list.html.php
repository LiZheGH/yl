<?php /* Smarty version Smarty-3.1.13, created on 2017-10-03 22:56:43
         compiled from "/private/var/www/yl/application/views/admin/store/list.html" */ ?>
<?php /*%%SmartyHeaderCode:143320131759d3a52bbdfbe7-51357531%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '642de2396edaee5e17b6102d3346b9889e0babb2' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/store/list.html',
      1 => 1506342841,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143320131759d3a52bbdfbe7-51357531',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'expressList' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d3a52bc32917_77958776',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d3a52bc32917_77958776')) {function content_59d3a52bc32917_77958776($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">	
function showCountType(value, row, index){    //1-按重量，2-按件数，3-按体积',
	if(row.count_type == 1){
		return '按重量';
	}else if(row.count_type == 2){
		return '按件数';
	}else if(row.count_type == 3){
		return '按体积';
	}	
}

function showStoreType(value, row, index){    //1-国内仓，2-保税仓，3-海外仓',
	if(row.store_type == 1){
		return '国内仓';
	}else if(row.store_type == 2){
		return '保税仓';
	}else if(row.store_type == 3){
		return '海外仓';
	}	
}

	function showModal() {
		$('#modalTitle').html('新增');
		$('#modalSubmit').attr('onclick', 'addOne()');
		$('#oneForm')[0].reset();
		$('#myModal').modal('show');
	}
	
	function refresh()
	{
		$('#tableId').bootstrapTable('refresh', {
	        url: '/store/ajaxStoreList'
	    });
	}
</script>
<body class="page-header-fixed page-quick-sidebar-over-content">
<div class="page-container"> <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>仓库管理 </div>
          
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;
					</button>
		    </div>
			<table id="tableId" data-url="/store/ajaxStoreList" data-sort-name="id" data-sort-order="desc" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="store_name">仓库名称</th>
						<th data-field="store_type" data-formatter="showStoreType">仓库类型</th>
						<th data-field="count_type" data-formatter="showCountType">计件方式</th>
						<th data-field="first_level">首重</th>
						<th data-field="first_price">首重价格</th>
						<th data-field="add_level">续重</th>
						<th data-field="add_price">续重价格</th>
						<th data-field="express">快递</th>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalTitle">新增</h3>
			</div>
			<div class="modal-body">
				<form role="form" id="oneForm" class="form-horizontal">
				<input id="id" type="hidden" />
				<div class="form-group">
					<label for="store_name" class="col-sm-2 control-label">仓库名称</label>
					<div class="col-sm-9">
                    	<input type="text" class="form-control" id="store_name" placeholder="仓库名称">
                    </div>
				</div>
				<div class="form-group">
					<label for="store_name" class="col-sm-2 control-label">仓库类型</label>
					<div class="col-sm-9">
                    	<select id="store_type" class="form-control">
                    		<option value="1">国内仓</option>
                    		<option value="2">保税仓</option>
                    		<option value="3">海外仓</option>
                    	</select>
                    </div>
				</div>
				<div class="form-group">
					<label for="count_type" class="col-sm-2 control-label">计价方式</label>
					<div class="col-sm-9">
						<label><input name="count_type" type="radio" value="1" />按重量</label> 
						<label style="margin-left:10px;"><input name="count_type" type="radio" value="2"/>按件数 </label>
						<label style="margin-left:10px;"><input name="count_type" type="radio" value="3"/>按体积 </label>
					</div>
				</div>
                <div class="form-group">
                    <label for="first_level" class="col-sm-2 control-label">首重</label>
                    <div class="col-sm-9">
                    	<input type="text" class="form-control" id="first_level" placeholder="首重">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="first_price" class="col-sm-2 control-label">首重价格</label>
                    <div class="col-sm-9">
                    	<input type="text" class="form-control" id="first_price" placeholder="首重价格">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="add_level" class="col-sm-2 control-label">续重</label>
                    <div class="col-sm-9">
                    	<input type="text" class="form-control" id="add_level" placeholder="续重">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="add_price" class="col-sm-2 control-label">续重价格</label>
                    <div class="col-sm-9">
                    	<input type="text" class="form-control" id="add_price" placeholder="续重价格">
                    </div>
                </div> 
                <div class="form-group">
                    <label for="add_price" class="col-sm-2 control-label">快递</label>
                    <div class="col-sm-9">
                    	<select id="express" class="form-control">
                    		<option value="">--请选择--</option>
                    		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['expressList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
                    		<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</option>
                    		<?php } ?>
                    	</select>
                    </div>
                </div> 
               </form>
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
/*         '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash"></i>',
        '</a>' */
    ].join('');
}

window.operateEvents = {
    'click .edit': function (e, value, row, index) {
        //alert('You click edit icon, row: ' + JSON.stringify(row));
        opUpdate(row);
        //console.log(value, row, index);
    },
    'click .remove': function (e, value, row, index) {
    	Modal.confirm(
				  {
				    msg: "是否删除记录？",
				    title: "删除记录"
				  })
				  .on( function (e) {
				    	//alert("返回结果：" + e);
				    	if(e) {
				    		$.ajax({
				    	        url:'/store/ajaxStoreDelete',
				    	        type:'post',
				    			dataType : 'json',
				    			data : encodeURI('id=' + row.id),
				    			async: false,
				    			success:function(data){
				    	        	if(data['success']) {
				    	        		//sysAlert("删除成功!", "success");
				    	        		$('#myModal').modal('hide');
				    	        		refresh()
				    	        		$('#oneForm')[0].reset(); 
				    				} else {
				    					alert(data['msg']);
				    				}
				    	        },
				    	        error:function(){
				    	       	 	
				    	        }

				    	     });
				    	}
				  });
    }
};


function opUpdate(row) {
	$('#modalTitle').html('修改');
	$('#modalSubmit').attr('onclick', 'updateOne()');
	$('#oneForm')[0].reset();
	$('#id').val(row.id);
	$('#store_name').val(row.store_name); 
	$('#store_type').val(row.store_type); 
	$('input[name="count_type"][value='+row.count_type+']').attr("checked",true);
	$('#first_level').val(row.first_level);
	$('#first_price').val(row.first_price);
	$('#add_level').val(row.add_level); 
	$('#add_price').val(row.add_price);
	$('#express').val(row.express);
	$('#myModal').modal('show'); 
}


function addOne() {
	var store_name = $('#store_name').val();
	var store_type = $('#temp_type').val(); 
	var count_type = $('input[name="count_type"]:checked').val();
	var first_level = $('#first_level').val();
	var first_price = $('#first_price').val();
	var add_level = $('#add_level').val(); 
	var add_price = $('#add_price').val();
	var express = $('#express').val();
	$.ajax({
        url:'/store/ajaxStoreAdd',
        type:'post',
		dataType : 'json',
		data : encodeURI('store_name=' + store_name + '&store_type=' + store_type +
				'&count_type=' + count_type +
				'&first_level=' + first_level +
				'&first_price=' + first_price +
				'&add_level=' + add_level +
				'&add_price=' + add_price +
				'&express=' + express
				),
        success:function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#myModel').modal('hide');
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

function updateOne(){
	var id = $('#id').val();
	var store_name = $('#store_name').val(); 
	var store_type = $('#store_type').val();
	var count_type = $('input[name="count_type"]:checked').val();
	var first_level = $('#first_level').val();
	var first_price = $('#first_price').val();
	var add_level = $('#add_level').val(); 
	var add_price = $('#add_price').val();
	var express = $('#express').val();
	$.ajax({
        url:'/store/ajaxStoreUpdate',
        type:'post',
		dataType : 'json',
		data : encodeURI('id=' + id + '&store_name=' + store_name + '&store_type=' + store_type +
				'&count_type=' + count_type +
				'&first_level=' + first_level +
				'&first_price=' + first_price +
				'&add_level=' + add_level +
				'&add_price=' + add_price +
				'&express=' + express
				),
        success:function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#myModel').modal('hide');
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