<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 19:10:43
         compiled from "/www/yl/application/views/admin/common/header.html" */ ?>
<?php /*%%SmartyHeaderCode:61300627359dec558876350-93672222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0892cedf6af27e88629f2d48ad611442b19747e' => 
    array (
      0 => '/www/yl/application/views/admin/common/header.html',
      1 => 1507806635,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61300627359dec558876350-93672222',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dec558884cf7_45117884',
  'variables' => 
  array (
    'curUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dec558884cf7_45117884')) {function content_59dec558884cf7_45117884($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>中美医疗集团不良事件上报系统</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<link rel="shortcut icon" type="image/x-icon" href="/public/img/icon.png" />

<link href="/public/drp/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="/public/drp/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="/public/drp/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="/public/drp/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="/public/drp/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="/public/drp/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href='/public/css/noty_theme_default.css' rel='stylesheet'>
<link href='/public/css/uploadify.css' rel='stylesheet'>

<!--[if lt IE 9]>
<script src="/public/drp/assets/global/plugins/respond.min.js"></script>
<script src="/public/drp/assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/public/drp/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/public/js/jquery.noty.js"></script>
<script src="/public/drp/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="/public/drp/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="/public/drp/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/public/js/jquery.uploadify-3.1.min.js"></script>
<!--
<script src="/public/drp/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
 -->
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--
<script src="/public/drp/assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/jquery.pulsate.min.js" type="text/javascript"></script>
 -->

<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->

<!--
<script src="/public/drp/assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="/public/drp/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
 -->
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/public/drp/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/public/drp/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/public/drp/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>

<script src="/public/drp/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/public/drp/assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="/public/drp/assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>

<script src="/public/bootstrap-table/bootstrap-table.js"></script>
<link rel="stylesheet" href="/public/bootstrap-table/bootstrap-table.css">

<link rel="stylesheet" href="/public/css/jquery.datetimepicker.css">
<script type="text/javascript" src="/public/js/jquery.datetimepicker.full.js"></script>

<link rel="stylesheet" href="/public/css/jquery.monthpicker.css">
<script type="text/javascript" src="/public/js/jquery.monthpicker.js"></script>

<script type="text/javascript" src="/public/js/jquery.form.js"></script>
<link rel="stylesheet" href="/public/css/jquery.dialogbox.css">
<script type="text/javascript" src="/public/js/spin.js"></script>
<script type="text/javascript" src="/public/js/jquery.dialogBox.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   QuickSidebar.init(); // init quick sidebar
   Demo.init(); // init demo features
   Index.init();
   Index.initDashboardDaterange();
   Index.initJQVMAP(); // init index page's custom scripts
   Index.initCalendar(); // init index page's custom scripts
   Index.initCharts(); // init index page's custom scripts
   Index.initChat();
   Index.initMiniCharts();
   Tasks.initDashboardWidget();


   var msie = navigator.userAgent.match(/msie/i);
   //highlight current / active link

   $('ul.sub-menu li').removeClass('active');
   $('li.start').removeClass('start active open');
   $('ul.sub-menu li a').each(function () {
   	//console.log($($(this))[0].href);
       if ($($(this))[0].href == String(window.location)) {
           	$(this).parent().addClass('active');
           	$(this).parent().parent().parent().addClass('start active open');
       }
   });

   //establish history variables
   var
       History = window.History, // Note: We are using a capital H instead of a lower h
       //State = History.getState(),
       $log = $('#log');
});
//弹窗
function Calert(content,title,time){
	var title = arguments[1] || '<i class="fa fa-exclamation-circle" style="margin-right:5px;"></i><span>系统提示</span>';
	var time = arguments[2] || 2500;
	$('#auto-close-dialogBox').dialogBox({
		autoHide: true,
		time: time,
		title: title,
		content: content
	});
}
$(function () {
	//时间控件
	$(".datetimepicker").datetimepicker({
		format:'Y-m-d H:i',
		formatTime:'H:i',
		formatDate:'Y-m-d',
		step:10,
	});
	  window.Modal = function () {
	    var reg = new RegExp("\\[([^\\[\\]]*?)\\]", 'igm');
	    var alr = $("#ycf-alert");
	    var ahtml = alr.html();

	    //关闭时恢复 modal html 原样，供下次调用时 replace 用
	    //var _init = function () {
	    //	alr.on("hidden.bs.modal", function (e) {
	    //		$(this).html(ahtml);
	    //	});
	    //}();

	    /* html 复原不在 _init() 里面做了，重复调用时会有问题，直接在 _alert/_confirm 里面做 */


	    var _alert = function (options) {
	      alr.html(ahtml);	// 复原
	      alr.find('.ok').removeClass('btn-primary').addClass('btn-primary');
	      alr.find('.cancel').hide();
	      _dialog(options);

	      return {
	        on: function (callback) {
	          if (callback && callback instanceof Function) {
	            alr.find('.ok').click(function () { callback(true) });
	          }
	        }
	      };
	    };

	    var _confirm = function (options) {
	      alr.html(ahtml); // 复原
	      alr.find('.ok').removeClass('btn-primary').addClass('btn-primary');
	      alr.find('.cancel').show();
	      _dialog(options);

	      return {
	        on: function (callback) {
	          if (callback && callback instanceof Function) {
	            alr.find('.ok').click(function () { callback(true) });
	            alr.find('.cancel').click(function () { callback(false) });
	          }
	        }
	      };
	    };

	    var _dialog = function (options) {
	      var ops = {
	        msg: "提示内容",
	        title: "操作提示",
	        btnok: "确定",
	        btncl: "取消"
	      };

	      $.extend(ops, options);

	      console.log(alr);

	      var html = alr.html().replace(reg, function (node, key) {
	        return {
	          Title: ops.title,
	          Message: ops.msg,
	          BtnOk: ops.btnok,
	          BtnCancel: ops.btncl
	        }[key];
	      });

	      alr.html(html);
	      alr.modal({
	        width: 500,
	        backdrop: 'static'
	      });
	    }

	    return {
	      alert: _alert,
	      confirm: _confirm
	    }

	  }();
	});
</script>
<style>
/*body{overflow:hidden;}*/
</style>

</head>
<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
    	<img src="/public/img/icon.png" alt="logo" class="logo-default" style="width: 30px;float: left;margin: 7px 0 0 0;"/>
    	<a href="/system/" style="line-height:45px;font-size:20px;color:white;">中美医疗集团</a>
      <div class="menu-toggler sidebar-toggler hide">
        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
      </div>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <!-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="icon-bell"></i> <span class="badge badge-default"> 7 </span> </a>
          <ul class="dropdown-menu">
            <li class="external">
              <h3><span class="bold">12 pending</span> notifications</h3>
              <a href="extra_profile.html">view all</a> </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                <li> <a href="javascript:;"> <span class="time">just now</span> <span class="details"> <span class="label label-sm label-icon label-success"> <i class="fa fa-plus"></i> </span> New user registered. </span> </a> </li>
              </ul>
            </li>
          </ul>
        </li> -->
        <!-- END NOTIFICATION DROPDOWN -->
        <!-- BEGIN INBOX DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <!-- <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="icon-envelope-open"></i> <span class="badge badge-default"> 4 </span> </a>
          <ul class="dropdown-menu">
            <li class="external">
              <h3>You have <span class="bold">7 New</span> Messages</h3>
              <a href="page_inbox.html">view all</a> </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                <li> <a href="inbox.html?a=view"> <span class="photo"> <img src="/public/drp/assets/admin/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span> <span class="subject"> <span class="from"> Lisa Wong </span> <span class="time">Just Now </span> </span> <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span> </a> </li>
              </ul>
            </li>
          </ul>
        </li> -->
        <!-- END INBOX DROPDOWN -->
        <!-- BEGIN TODO DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <!-- <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <i class="icon-calendar"></i> <span class="badge badge-default"> 3 </span> </a>
          <ul class="dropdown-menu extended tasks">
            <li class="external">
              <h3>You have <span class="bold">12 pending</span> tasks</h3>
              <a href="page_todo.html">view all</a> </li>
            <li>
              <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                <li> <a href="javascript:;"> <span class="task"> <span class="desc">New release v1.2 </span> <span class="percent">30%</span> </span> <span class="progress"> <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"><span class="sr-only">40% Complete</span></span> </span> </a> </li>
              </ul>
            </li>
          </ul>
        </li> -->
        <!-- END TODO DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-user"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> <img alt="" class="img-circle" src="<?php echo $_smarty_tpl->tpl_vars['curUser']->value['avatar'];?>
"/> <span class="username username-hide-on-mobile"> <?php echo $_smarty_tpl->tpl_vars['curUser']->value['username'];?>
 </span> <i class="fa fa-angle-down"></i> </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li> <a href="/system/logout"> <i class="icon-logout"></i> 退出 </a> </li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li style="display:none;" class="dropdown dropdown-quick-sidebar-toggler"> <a href="javascript:;" class="dropdown-toggle"> <i class="icon-logout"></i> </a> </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<div class="clearfix"> </div>
<?php }} ?>