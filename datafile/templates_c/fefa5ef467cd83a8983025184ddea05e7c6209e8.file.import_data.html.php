<?php /* Smarty version Smarty-3.1.13, created on 2017-10-11 21:46:10
         compiled from "/private/var/www/yl/application/views/admin/standard/import_data.html" */ ?>
<?php /*%%SmartyHeaderCode:76854796059dc928c1c8776-47427842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fefa5ef467cd83a8983025184ddea05e7c6209e8' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/standard/import_data.html',
      1 => 1507728822,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '76854796059dc928c1c8776-47427842',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dc928c1e64f5_30265363',
  'variables' => 
  array (
    'VIEW_DIR' => 0,
    'sessionid' => 0,
    'reportDictionaryList' => 0,
    'section_id' => 0,
    'sectionList' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dc928c1e64f5_30265363')) {function content_59dc928c1e64f5_30265363($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<script>
var myDate = new Date();
</script>

<body class="page-header-fixed page-quick-sidebar-over-content">
	<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/left_menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<div class="page-content-wrapper"><div class="page-content">
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>
      <div class="portlet box blue-madison">
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-globe"></i>导入数据</div>
        </div>
        <div class="portlet-body">
			<form role="form" id="form" class="form-horizontal" method="POST">
				<div class="modal-body">
					<div class="form-group">
		            	<label class="col-sm-2 control-label"><font color="red">*</font>必须选择上报日期</label>
						<div class="col-sm-3">
			                <div class="input-group date">
			                    <input type="text" id="report_time" name="report_time" placeholder="上报日期" class="form-control datetimepicker1" />
			                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
		                </div>
		            </div>
	                <input type="hidden" id="sessionid" name="sessionid" value="<?php echo $_smarty_tpl->tpl_vars['sessionid']->value;?>
"/>
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['section_id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['reportDictionaryList']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['section_id']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
					<?php if ($_smarty_tpl->tpl_vars['section_id']->value!=0){?>
					<div class="form-group col-sm-6" style="margin-left:10px;">
						<div class="col-sm-12" style="border:1px solid #e5e5e5;padding-top: 1em;">
							<div style="float:left;margin:0 10px;">
			                   	 <input id="file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
" name="file_upload" type="file" style="width:200px;float:left;">
			                   	 <input type="hidden" id="file_id" name="file_id"/>
		                   	</div>
		                   	<a onclick="ajaxDownTemplate(<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
)" style="float:right;width:45%;line-height:30px;">
		                   		<span><i class="glyphicon glyphicon-download"></i>下载 <font color="#555" class="t_<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['sectionList']->value[$_smarty_tpl->tpl_vars['section_id']->value];?>
</font> 标准模板</span>
		                	</a>
		                </div>
	                </div>
	                
	                <script>
	                $('#file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
').uploadify({
	            		'formData'  : {
	            			'timestamp' : myDate.getTime(),
	            			'token'     : 'aaa' + myDate.getTime(),
	            			'sessionid' : $('#sessionid').val(),
	            		},
	            		'swf'      : '/public/misc/uploadify.swf',
	            		'uploader' : '/Standard/ajaxUploadData',
	            		'multi' : false,
	            		'fileTypeExts':'*.xlsx',
	            		'onInit': function () {
	            		    $(".uploadify-queue").hide();
	            		},
	            		onUploadStart:function(){
	            			var report_time = $('#report_time').val();
	            			if(report_time == ''){
	            				Calert("请选择上报日期");
	            				$('#file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
').uploadify('cancel');
	            				return false;
	            			}
	            			$("#file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
")
	            				.uploadify("settings", "formData", {
	            					'report_section':<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
,
	            					'report_time' : $('#report_time').val()
	            				});
	            			juhuaShow();
	            		},
	            		onUploadSuccess: function(file,data,response){
	            			juhuaHide();
	            			var message = ''
	            			if(!data){
	            				return false;
	            			}else{
	            				var res = JSON.parse(data);
	            				Calert(res.msg);
	            				if(res.success){
									$("#file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
-button").find(".uploadify-button-text")
										.append('<span style="color:#5cb85c;margin-left:10px;"><i class="glyphicon glyphicon-ok-circle"></i>成功</span>');
	            				}
	            			}
	            		}
	            	});
	                $("#file_upload<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
-button")
		                .find(".uploadify-button-text")
		                .html('<i class="glyphicon glyphicon-upload"></i>上传 <font color="#555">'+$(".t_<?php echo $_smarty_tpl->tpl_vars['section_id']->value;?>
").text()+'</font> 模板');
	                </script>
	                
					<?php }?>
	           		<?php } ?>
					<div class="form-group" style="clear:both;padding:40px 3%;">
						<div class="col-sm-12">
							<p><em style="color:#aaa">注意：</em></p>
	                    	<p><em style="color:#aaa">1.模板表的项目名称和科室名称不能随意修改,如果修改必须保证与标准名称相同。</em></p>
	                    	<p><em style="color:#aaa">2.列标题中科室名称的顺序可以自行调整,不影响导入。</em></p>
	                    	<p><em style="color:#aaa">3.实际数值不准许带有％等其他字符，必须都是数字（正数，负数，小数（小数点后最多保留3位）的一种 ）。</em></p>
	                    	<p><em style="color:#aaa">另外:如果对应数值是空则不能导入,如果需要导入空的,建议将数值写成0</em></p>
						</div>
					</div>
				</div>
				<div class="modal-footer">
				</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.uploadify,.swfupload,.uploadify-button {
	width:100%!important;
	left:0!important;
	text-align: left!important;
}
.uploadify-button,.uploadify-button:hover{
	background:rgba(0,0,0,0)!important;
	border:0!important;
}
.uploadify-button-text{
	color:#5b9bd1!important;
	text-shadow: none!important;
	font-weight: normal!important;
	font-size:13px!important;
    text-align: left!important;
}
</style>
<script type="text/javascript">
$(function(){
	//时间控件
	$(".datetimepicker1").datetimepicker({
		format:'Y-m-d',
		timepicker:false,
		daypicker:false,
		maxDate:true,
		formatDate:'Y-m-d',
	});
	//全选
	$(".checkall").change(function(){
		$(".section").prop("checked",$(this).is(':checked'));
	});
	//列表
	$.post(
		"/Standard/ajaxGetExportDictionary",
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
	   		window.location.reload();
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
//下载
function ajaxDownTemplate(section){
	$.post(
		"/Standard/ajaxDownTemplate/",
		{"section":section},
		function(data){
			if(data.success){
				window.location.href = "/Standard/downTemplate/section/"+section;
			} else {
				Calert(data.msg);
				return ;
			}
		}
	);
}
</script>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</body>
</html>
<?php }} ?>