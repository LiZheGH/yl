<?php /* Smarty version Smarty-3.1.13, created on 2017-10-03 22:56:51
         compiled from "/private/var/www/yl/application/views/admin/goodsIndex/banner.html" */ ?>
<?php /*%%SmartyHeaderCode:64162239559d3a533c888c0-30879362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0950f9ef02a3b71194a092098ecbf99642db2e77' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/goodsIndex/banner.html',
      1 => 1506342841,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64162239559d3a533c888c0-30879362',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sessionid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d3a533cd2710_91789561',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d3a533cd2710_91789561')) {function content_59d3a533cd2710_91789561($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script type="text/javascript">	
	$(function(){
		var myDate = new Date();
		$('#file_upload').uploadify({
			'formData'  : {
				'timestamp' : myDate.getTime(),
				'token'     : 'aaa' + myDate.getTime(),
				'sessionid' : $('#sessionid').val()
			},
			'swf'      : '/public/misc/uploadify.swf',
			'uploader' : '/goodsIndex/uploadifyImg',
			'multi' : false,
			onUploadStart:function(){
				$("#file_upload-button").removeClass('error_boder');
				$(".uploadify-queue-item").remove();
			},
			onUploadSuccess: function(file,data,response){
				var res = JSON.parse(data);
				//console.log(data);
				if(! res.success){
					alert(res.msg);
					return false;
				}
				$('#image').val(res.file_url);
				$('#goods_img').html('<a target="_blank" href="'+res.file_url+'"><img src="'+res.file_url+'" style="height:100px;width:100px;"/></a>');
			}

		});
	})
	
	function opUpdate(row){
        $('#modalTitle').html('修改');
		$('#modalSubmit').attr('onclick', 'updateOne()');
		$('#oneForm')[0].reset();
		$('#id').val(row.id); 		
        $('#goods_id').val(row.goods_id);
		$('#name').html(row.goods_name);
		$('#goods_sku').html(row.goods_sku);
		$('#image').val(row.image);
		$('#goods_img').html('<a target="_blank" href="'+row.image+'"><img src="'+row.image+'" style="height:100px;width:100px;"/></a>');
		$('#sort').val(row.sort);
		$('#goodsModal').modal('show');
	}
	
	
	
	function updateOne() {
		var id = $('#id').val();
		var goods_id = $('#goods_id').val();
		var image = $('#image').val();
		if(goods_id == ''){
			alert('请选择商品！');
			return false;
		}
		if(image == ''){
			alert('请上传图片！');
			return false;
		}
		var sort = $('#sort').val();
    	$.ajax({
	        url:'/goodsIndex/ajaxGoodsIndexUpdate',
	        type:'post',
			dataType : 'json',
			data : encodeURI('id=' + id + '&goods_id=' + goods_id + '&image=' + image + '&sort='+sort),
			async: false,
			success:function(data){
	        	if(data['success']) {
	        		alert(data['msg']);
	        		$('#goodsModal').modal('hide');
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
		
	function showModal() {
		$('#modalTitle').html('新增');
		$('#modalSubmit').attr('onclick', 'addGoods()');
		$('#oneForm')[0].reset();
		$('#goods_id').val('');
		$('#name').html('');
		$('#goods_sku').html('');
		$('#image').val('');
		$('#goods_img').html('');
		$('#goodsModal').modal('show');
	}
</script>
<body class="page-header-fixed page-quick-sidebar-over-content">
<div class="page-container"> <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

  <div class="page-content-wrapper">
    <div class="page-content">
      <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>轮播商品 </div>
          
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showModal();">&nbsp;&nbsp;新增&nbsp;&nbsp;
					</button>
		    </div>
			<table id="tableId" data-url="/goodsIndex/ajaxGoodsIndexList/type/1" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-field="id">ID</th>
						<th data-field="goods_sku">商品sku</th>
						<th data-field="goods_name">商品名称</th>
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
<div class="modal fade" id="goodsModal" tabindex="-1" role="dialog"
		aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalTitle">新增商品</h3>
			</div>
			<div class="modal-body">
				<form role="form" id="oneForm" class="form-horizontal">	
					<input type="hidden" id="id" value=""/>			
               		<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label">商品</label>
	                    <div class="col-sm-9">
	                        <input id="s1_1" style="width:70px;cursor: pointer;" readonly class="ironly" onClick="openWindow('goods_id','name', this);" value="关联商品" />
	                        <input type="hidden" class="form-control" id="goods_id" name="goods_id" >    
	                    </div>  
                	</div>
                	<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label">商品名称</label>
	                    <div class="col-sm-9" style="margin-top:7.5px;">
	                       <span id="name"></span>  
	                    </div>  
                	</div>
                	<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label">商品sku</label>
	                    <div class="col-sm-9" style="margin-top:7.5px;">
	                       <span id="goods_sku"></span>  
	                    </div>  
                	</div>
                	<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label">商品图片(750*372)</label>
	                    <div class="col-sm-9" style="margin-top:7.5px;">
	                    	<span id="goods_img"></span>
	                    </div>  
                	</div>
                	<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label"></label>
	                    <div class="col-sm-9">
	                    	<input id="file_upload" name="file_upload" type="file" >
				            <input type="hidden" id="image" name="image" value="" />
				            <input type="hidden" id="sessionid" name="sessionid" value="<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
"/> 
	                    </div>  
                	</div>
                	<div class="form-group">
	                    <label for="first_level" class="col-sm-2 control-label">排序</label>
	                    <div class="col-sm-9">
				            <input class="form-control" type="text" id="sort" name="sort" value="" />
	                    </div>  
                	</div>
                	
               </form>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="id1" value=""/>
				<a href="#" class="btn btn-default" data-dismiss="modal">取消</a>
				<a href="#" class="btn btn-primary" id="modalSubmit" onClick="addGoods();">提交</a>
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
								url:'/goodsIndex/ajaxGoodsIndexDelete',
								type:'post',
								dataType : 'json',
								data : encodeURI('id=' + row.id),
								async: false,
								success:function(data){
							       	if(data['success']) {
							       		alert(data['msg']);
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
				  });
    }
};

function refresh()
{
	$('#tableId').bootstrapTable('refresh', {
        url: '/goodsIndex/ajaxGoodsIndexList/type/1'
    });
}

function openWindow(goods_id,name) {
	window.open ('/goodsIndex/selectGoods?goods_id=' + goods_id + '&name=' + name ,'newwindow','height=800,width=900,top=0,left=0,toolbar=no,menubar=no,scrollbars=yes, resizable=yes,location=no, status=no')   
}

function addGoodsOne(id,name){	
	$.ajax({
		url:'/goodsIndex/ajaxGetOneGoods',
		type:'post',
		dataType:'json',
		data: encodeURI('id='+id),
		success:function(data){
			if(data){
				$('#goods_id').val(id);
				$('#name').html(data['goods_name']);
				$('#goods_sku').html(data['goods_sku']);
				$('#image').val(data['image']);
				$('#goods_img').html('<a target="_blank" href="'+data['image']+'"><img src="'+data['image']+'" style="height:100px;width:100px;"/></a>');
			}
		}
	});
}

function addGoods(){
	var goods_id = $('#goods_id').val();
	var image = $('#image').val();
	if(goods_id == ''){
		alert('请选择商品！');
		return false;
	}
	if(image == ''){
		alert('请上传图片！');
		return false;
	}
	var sort = $('#sort').val();
	$.ajax({
        url:'/goodsIndex/ajaxGoodsIndexAdd',
        type:'post',
		dataType : 'json',
		data : encodeURI('goods_id=' + goods_id + '&image=' + image + '&sort=' + sort + '&type=1'),
		async:false,
        success:function(data){
        	if(data['success']) {
        		refresh();
        		alert(data['msg']);
        		$('#goodsModal').modal('hide');
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