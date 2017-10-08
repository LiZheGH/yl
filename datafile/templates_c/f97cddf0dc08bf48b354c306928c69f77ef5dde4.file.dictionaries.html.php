<?php /* Smarty version Smarty-3.1.13, created on 2017-10-08 22:49:51
         compiled from "/private/var/www/yl/application/views/admin/standard/dictionaries.html" */ ?>
<?php /*%%SmartyHeaderCode:106657305059d49e014e1d86-66322281%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f97cddf0dc08bf48b354c306928c69f77ef5dde4' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/dictionaries.html',
      1 => 1507474124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '106657305059d49e014e1d86-66322281',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d49e014e2525_55985901',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sectionList' => 0,
    'section_id' => 0,
    'section' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d49e014e2525_55985901')) {function content_59d49e014e2525_55985901($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<link rel="stylesheet" type="text/css" href="/public/css/multi-select.css">
<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>质量指标字典</div>
        </div>
        <div class="portlet-body">
        	<div id="toolbar1" style="margin-bottom:0px;">
				<button class="btn btn-primary btn-sm" onClick="showModal();">添加质量科目类型</button>
		   	</div>
		   <table id="tableId" data-url="/Standard/ajaxDictionaryList" data-sort-name="id" data-sort-order="asc" data-toggle="table"
		   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar1">
				<thead>
					<tr>
						<th data-checkbox="true"></th>
						<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
						<th data-field="type_name">质量科目类型名称</th>
						<th data-field="child_num">子类数量</th>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalTitle">新增</h3>
			</div>
			<div class="modal-body">
				<form role="form" id="oneForm" class="form-horizontal">
					<input id="id" type="hidden" />
					<div class="form-group">
						<label class="col-sm-2 control-label">质量科目类型名称</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" id="type_name" placeholder="质量科目类型名称">
	                    </div>
					</div>
               	</form>
			</div>
			<div class="modal-footer">
				<a class="btn btn-default" data-dismiss="modal">取消</a>
				<a class="btn btn-primary" id="modalSubmit" onclick="addOne();">提交</a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" style="width:98%;">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="child_title"></h3>
			</div>
			<div class="modal-body" style="padding:15px 20px;">
				<div id="toolbar2" style="margin-bottom:0px;">
					<button class="btn btn-primary btn-sm" onClick="showChildModal();">添加子类</button>
			   	</div>
				<table id="tableList" data-sort-name="id" data-sort-order="asc" data-toggle="table"
			   		data-click-to-select="true"  data-pagination="true"  data-show-refresh="true" data-show-columns="true" data-search="true" data-toolbar="#toolbar2">
					<thead>
						<tr>
							<th data-checkbox="true"></th>
							<th data-field="id" data-formatter="indexFormatter" >索引ID</th>
							<th data-field="type_name">质量科目名称</th>
							<th data-field="statistical_mode">统计方法</th>
							<th data-field="standard" data-formatter="formatStandard">标准</th>
							<th data-field="computation">计算方法</th>
							<th data-field="is_formula">是公式</th>
							<th data-field="formula_num">公式科室数</th>
							<th data-field="status" data-formatter="showStatus">是否作废</th>
							<th data-field="monitor_focus">重点监测</th>
							<th data-field="is_multi_index">多标准</th>
							<th data-field="operate" data-formatter="operateChildFormatter" data-events="operateChildEvents">操作</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ChildModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3 id="modalChildTitle">新增</h3>
			</div>
			<form role="form" id="childForm" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-2 control-label">质量目标名称</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" id="child_type_name" name="type_name" placeholder="质量目标名称">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">计算方法</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" id="computation" name="computation" placeholder="计算方法">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">正常值范围</label>
						<div class="col-sm-9">
							<select  class="form-control" id="range" name="range">
                    			<option value="0">--请选择--</option>
                    			<option value="＞">＞（大于）</option>
                    			<option value="≥">≥（大于等于）</option>
                    			<option value="＝">＝（等于）</option>
                    			<option value="≤">≤（小于等于）</option>
                    			<option value="＜">＜（小于）</option>
	                    	</select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">标准</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" id="standard" name="standard" placeholder="标准">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">统计方式</label>
						<div class="col-sm-9">
	                    	<select  class="form-control" id="statistical_mode" name="statistical_mode">
                    			<option value="0">--请选择--</option>
                    			<option value="平均值">平均值</option>
                    			<option value="求和">求和</option>
                    			<option value="计数">计数</option>
                    			<option value="最大值">最大值</option>
                    			<option value="最大值">最大值</option>
	                    	</select>
	                    	<em style="color:#aaa">(如:患者满意度,汇总的时候需要取平均值,请选择"平均值"; 出院人数,汇总的时候需要求和,则应该选择"求和")</em>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">是否作废</label>
						<div class="col-sm-9 controls" style="line-height: 40px;">
	                    	<label class="radio" style="float:left;margin-left: 20px;">
	                    		<input type="radio" class="form-control" name="status" value="1" checked>否</label>
							<label class="radio" style="float:left;margin-left: 40px;">
								<input type="radio" class="form-control" name="status" value="0">是</label>
	                    </div>
					</div>
				</div>
				<div class="modal-footer">
					<input id="child_id" name="id" type="hidden" />
					<input type="hidden" id="edit_id" name="p_id" />
					<a class="btn btn-default" data-dismiss="modal">取消</a>
					<button class="btn btn-primary" id="ChildSubmit">提交</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header"  style="text-align:center;">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>设置公式&应用科室</h3>
			</div>
			<div class="modal-body">
				<form role="form" id="oneSetForm" class="form-horizontal">
					<input id="id" type="hidden" />
					<div class="form-group">
						<label class="col-sm-2 control-label">公式内容</label>
						<div class="col-sm-9">
	                    	<input type="text"  class="form-control" id="formula" placeholder="公式内容">
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">公式应用科室</label>
						<div class="col-sm-9">
	                    	<select id='section' name="section" multiple='multiple'>
							    <?php  $_smarty_tpl->tpl_vars['section'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['section']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sectionList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['section']->key => $_smarty_tpl->tpl_vars['section']->value){
$_smarty_tpl->tpl_vars['section']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['section']->key;
?>
	                    			<option value="<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['section']->value;?>
</option>
	                    		<?php } ?>
						    </select>
	                    </div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-9">
							<p><em style="color:#aaa">注意: 设置公式的科目名称的计算方法中,只能够采用</em></p>
	                    	<p style="color:red;font-size:20px">+ - * / ( ) sum avg</p>
	                    	<p><em style="color:#aaa">上述符号.sum(科目名称)表示汇总[全院]之外的某些科室的某个科目的汇总值,并存入[全院]的记录中.</em></p>
	                    	<p><em style="color:#aaa">同理 avg则是[全院]之外的某些科室的某个科目的平均值,并存入[全院]的记录中.</em></p>
	                    	<p><em style="color:#aaa"><font color="red">例如:</font> 出院病人好转治愈率 的公式: (出院病人好转数+出院病人治愈数)*100/出院人数总计</em></p>
	                    	<p><em style="color:#aaa">如果计算率,必须*100否则以小数显示.</em></p>
	                    	<p><em style="color:#aaa"><font color="red">再如: </font>员工满意度 的公式: avg(员工满意度)</em></p>
	                    	<p><em style="color:#aaa">说明:汇总公式不能与其他预算符号混合使用!</em></p>
						</div>
					</div>
               	</form>
			</div>
			<div class="modal-footer">
				<input type="hidden" id="set_id" />
				<a class="btn btn-default" data-dismiss="modal">取消</a>
				<a class="btn btn-primary" id="modalSubmit" onclick="addSetOne();">提交</a>
			</div>
		</div>
	</div>
</div>

<script src="/public/js/jquery.multi-select.js"></script>
<script type="text/javascript">
$('#section').multiSelect();
function showStatus(value,row,index){
	if(row.status == 1){
		return '<font color="green">否</font>';
	}else{
		return '<font color="red">是</font>';
	}
}
function formatStandard(value, row, index) {
	return row.range+row.standard;
}
function indexFormatter(value, row, index) {
	return index+1;
}
function operateFormatter(value, row, index) {
    return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil">修改</i>',
        '</a> ',
        '<a class="list ml10" href="javascript:void(0)" title="List">',
            '<i class="glyphicon glyphicon-eye-open">查看子类</i>',
        '</a> ',
        '<a class="add ml10" href="javascript:void(0)" title="AddChild">',
            '<i class="glyphicon glyphicon-plus">添加子类</i>',
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
    'click .list': function (e, value, row, index) {
        opList(row);
    },
    'click .add': function (e, value, row, index) {
        opAdd(row);
    },
    'click .remove': function (e, value, row, index) {
		Modal.confirm({
			msg: "<div style='text-align: center;'>是否删除记录？</div>",
			title: "删除记录"
		}).on( function (e) {
			if(e) {
				$.ajax({
	    	        url:'/Standard/ajaxDictionaryDelete',
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
        url: '/Standard/ajaxDictionaryList'
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
    	str += '&type_name=' + $("#type_name").val();
	str = str.substr(1);
	$.ajax({
        url:'/Standard/ajaxDictionaryAdd/',
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
	$("#type_name").val(row.type_name);
    $('#myModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function updateOne() {
	var id = $('#id').val();
	var str = '';
	str += '&type_name=' + $("#type_name").val();
	$.ajax({
        url:'/Standard/ajaxDictionaryUpdate',
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
function refreshChild(id){
	$('#tableList').bootstrapTable('refresh', {
        url: '/Standard/ajaxDictionaryChildList/id/'+id
    });
}
function opList(row){
	refreshChild(row.id);
	$("#child_title").html("质量科目类型:<font color='red'>"+row.type_name+"</font>");
	$("#edit_id").val(row.id);
	$('#listModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function showChildModal(){
	$('#childForm')[0].reset();
	$("#modalChildTitle").html("新增 "+$("#child_title").html()+" 子类");
	$('#ChildModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opAdd(row){
	$('#childForm')[0].reset();
	$("#modalChildTitle").html("新增 质量科目类型:<font color='red'>"+row.type_name+"</font> 子类");
	$('#ChildModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opChildUpdate(row){
	$("#modalChildTitle").html("修改 "+$("#child_title").html()+" 子类");
	$('#childForm')[0].reset();
	$('#child_id').val(row.id);
	$("#child_type_name").val(row.type_name);
	$("#standard").val(row.standard);
	$("#computation").val(row.computation);
	$("#range").val(row.range);
	$("#statistical_mode").val(row.statistical_mode);
	$("input[name='status'][value='"+row.status+"']").prop("checked",true);
	$('#ChildModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opChildSet(row){
	$('#oneSetForm')[0].reset();
	$("#set_id").val(row.id);
	$("#formula").val(row.formula);
	var vals = row['formula_section'].split(",");
	for(var i in vals){
		$("#section").find("option[value='"+vals[i]+"']").prop("selected",true);
	}
	$('#section').multiSelect('refresh');
	$('#setModal').modal('show').find(".modal-dialog").addClass("modal-lg");
}
function opChildMore(row){

}
function addSetOne(){
	$.post(
		'/Standard/ajaxDictionarySetFormula',
		{
			'id':$('#set_id').val(),
			'formula':$("#formula").val(),
			'section':$("#section").val()
		},function(data){
			if(data['success']) {
        		alert(data['msg']);
        		$('#setModal').modal('hide');
        		refreshChild($("#edit_id").val());
			} else {
				alert(data['msg']);
			}
		},"json"
	);
}
function operateChildFormatter(value, row, index) {
	return [
        '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
            '<i class="glyphicon glyphicon-pencil">修改</i>',
        '</a> ',
        '<a class="set ml10" href="javascript:void(0)" title="List">',
            '<i class="glyphicon glyphicon-edit">设置为公式</i>',
        '</a><br>',
        '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-trash">删除 </i>',
        '</a>',
        '<a class="more ml10" href="javascript:void(0)" title="AddChild">',
            ' <i class="glyphicon glyphicon-th">多标准值</i>',
        '</a> '
    ].join('');
}
window.operateChildEvents = {
	    'click .edit': function (e, value, row, index) {
	        opChildUpdate(row);
	    },
	    'click .set': function (e, value, row, index) {
	    	opChildSet(row);
	    },
	    'click .more': function (e, value, row, index) {
	    	opChildMore(row);
	    },
	    'click .remove': function (e, value, row, index) {
			Modal.confirm({
				msg: "<div style='text-align: center;'>是否删除记录？</div>",
				title: "删除记录"
			}).on( function (e) {
				if(e) {
					$.ajax({
		    	        url:'/Standard/ajaxDictionaryDelete',
		    	        type:'post',
		    			dataType : 'json',
		    			data : encodeURI('id=' + row.id),
		    			async: false,
		    			success:function(data){
		    	        	if(data['success']) {
		    	        		alert(data['msg']);
		    	        		refreshChild($("#edit_id").val());
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
$(function(){
	//添加修改子类提交
	$("#ChildSubmit").click(function(){
        var validateForm = function(){
        	var inputArr = ['type_name','type_name'];
        	var textArr = ['质量目标名称','标准'];
        	for(var i=0;i< inputArr.length;i++){
        		var val = $("input[name='"+inputArr[i]+"']").val();
        		if(val == 0 || val == ''){
        			alert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        	var selectArr = ['range','statistical_mode'];
        	var textArr = ['正常值范围','统计方式'];
        	for(var i=0;i< selectArr.length;i++){
        		var val = $("#"+selectArr[i]+"").val();
        		if(val == 0 || val == ''){
        			alert(textArr[i]+' 为空!');
        			return false;
        		}
        	}
        }
        var showResponse = function(data){
        	if(data['success']) {
        		alert(data['msg']);
        		$('#ChildModal').modal('hide');
        		refreshChild($("#edit_id").val());
        		$('#childForm')[0].reset();
			} else {
				alert(data['msg']);
			}
        };
        var options= {
                url : "/Standard/ajaxDictionaryChildAddUpdate",
                dataType:  'json',//数据类型
                beforeSubmit: validateForm,
                success : showResponse,
                resetForm : false,//数据返回后，是否清除表单内容
        };
        $("#childForm").ajaxForm(options);
	});
});
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>