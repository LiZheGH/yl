<?php /* Smarty version Smarty-3.1.13, created on 2017-10-10 23:57:45
         compiled from "/private/var/www/yl/application/views/admin/common/footer.html" */ ?>
<?php /*%%SmartyHeaderCode:186870549759d49e312ed2b6-11228255%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72091ffb9859931a3f48871597d0e22e57c421db' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/common/footer.html',
      1 => 1507651058,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186870549759d49e312ed2b6-11228255',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d49e312f0ab5_75430860',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d49e312f0ab5_75430860')) {function content_59d49e312f0ab5_75430860($_smarty_tpl) {?><div class="page-footer" style="display:none;">
  <div class="page-footer-inner"> &copy;copyright 2016 </div>
  <div class="scroll-to-top"> <i class="icon-arrow-up"></i> </div>
</div>
<div id="auto-close-dialogBox"></div>
    <!-- system modal start -->
    <div id="ycf-alert" class="modal" style="z-index:99999;">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h5 class="modal-title"><i class="fa fa-exclamation-circle"></i> [Title]</h5>
          </div>
          <div class="modal-body large">
            <p>[Message]</p>
          </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-primary ok" data-dismiss="modal">[BtnOk]</button>
            <button type="button" class="btn btn-default cancel" data-dismiss="modal">[BtnCancel]</button>
          </div>
        </div>
      </div>
    </div>
  <!-- system modal end -->
  <!-- system diy sysAlert start-->
	<button class="btn btn-primary noty" data-noty-options="" id="sysMsg" style="display:none;">
        <i class="glyphicon glyphicon-bell icon-white"></i>
    </button>
    <div id="foo"></div>
  	
	<style>
		#foo{
			width: 100%;
		    height: 108%;
		    position: fixed;
		    top: 0;
		    left: 0;
		    background: rgba(0,0,0,0.5);
			display:none;
			z-index:99999999999;
		}
	</style>
    <script>

    		/* 	text   文字;
    			type   类型;		[success 绿色,error 红色,alert 白色]
    			layout 位置;		[topLeft 左上,topCenter 中上,topRight 右上]
    					   	   	[center 正中],[bottomLeft 左下,bottomRight 右下]
    		*/
    		function sysAlert(text,type){
            alert(text);
            return false;
    		};
    		//菊花
    		var spinnerOpts = {
    		    lines: 12, 		// 共有几条线组成
    		    length: 10, 		// 每条线的长度
    		    width: 5, 		// 每条线的粗细
    		    radius: 10, 	// 内圈的大小
    		    corners: 1, 	// 圆角的程度
    		    rotate: 0, 		// 整体的角度（因为是个环形的，所以角度变不变其实都差不多）
    		    color: '#fff', 	// 颜色 #rgb 或 #rrggbb
    		    speed: 1, 		// 速度：每秒的圈数
    		    trail: 60, 		// 高亮尾巴的长度
    		    shadow: false, 	// 是否要阴影
    		    hwaccel: false, // 是否用硬件加速
    		    className: 'spinner', // class的名字
    		    zIndex: 7, 		// z-index的值 2e9（默认为2000000000）
    		    top: '45%', 		// 样式中的top的值（以像素为单位，写法同css）
    		    left: '50%', 	// 样式中的left的值（以像素为单位，写法同css）
    		};
    		var target = document.getElementById('foo');
    		var spinner = new Spinner(spinnerOpts);
    		spinner.spin(target);
    		//菊花-显示
    		function juhuaShow(){
    			spinner.spin(target);
    			$("#foo").show();
    		}
    		//菊花-隐藏
    		function juhuaHide(){
    			spinner.spin();
    			$("#foo").hide();
    		}
    </script>
    <style>
    	#ycf-alert .modal-header{
			color:#fff;
    		background:#578ebe;
    	}
    </style>
    
  <!-- system diy sysAlert end-->
<?php }} ?>