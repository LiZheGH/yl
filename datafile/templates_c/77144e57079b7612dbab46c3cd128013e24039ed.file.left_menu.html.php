<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 16:02:29
         compiled from "/private/var/www/yl/application/views/admin/common/left_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:186008652059d49e312ae7e4-62552054%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77144e57079b7612dbab46c3cd128013e24039ed' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/common/left_menu.html',
      1 => 1507795321,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186008652059d49e312ae7e4-62552054',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59d49e312e9c51_64527882',
  'variables' => 
  array (
    'cUser' => 0,
    'power' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59d49e312e9c51_64527882')) {function content_59d49e312e9c51_64527882($_smarty_tpl) {?><div class="page-sidebar-wrapper">
  <div class="page-sidebar navbar-collapse collapse">
    <ul data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false" class="page-sidebar-menu">
      <li class="sidebar-toggler-wrapper" style='margin-bottom:0px;'>
        <div class="sidebar-toggler"> </div>
      </li>
	  <li class="start active open"><a href="/welcome/index"><i class="icon-home"></i><span class="title">欢迎</span></a></li>
 	<?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']||in_array('/system/',$_smarty_tpl->tpl_vars['power']->value)){?>
      <li class="">
      	<a href="javascript:;">
      		<i class="glyphicon glyphicon-cog"></i>
      		<span class="title">系统管理</span>
      		<span class="selected"></span>
      		<span class="arrow open"></span>
      	</a>
        <ul class="sub-menu">
          <li> <a href="/system/account/list"> <i class="icon-bar-chart"></i> 账号管理 </a> </li>
          <li> <a class="ajax-link" href="/system/role/list"> <i class="icon-bulb"></i> 角色管理 </a> </li>
          <li> <a class="ajax-link" href="/system/power/list"> <i class="icon-graph"></i> 权限管理 </a> </li>
        </ul>
      </li>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']||in_array('/base/',$_smarty_tpl->tpl_vars['power']->value)){?>
      <li>
      	<a href="javascript:;">
      		<i class="glyphicon glyphicon-th-list"></i>
      		<span class="title">基础信息管理</span>
      		<span class="selected"></span>
      		<span class="arrow"></span>
      	</a>
      	<ul class="sub-menu">
			<li><a href="/base/section">科室管理</a></li>
		</ul>
      </li>
      <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']||in_array('/abnormal/',$_smarty_tpl->tpl_vars['power']->value)){?>
      <li>
      	<a href="javascript:;">
      		<i class="glyphicon glyphicon-list-alt"></i>
      		<span class="title">异常事件上报</span>
      		<span class="selected"></span>
      		<span class="arrow"></span>
		</a>
		<ul class="sub-menu">
			<li><a href="/abnormal/piping">管路事件报告</a></li>
			<li><a href="/abnormal/medicine">给药错误报告</a></li>
			<li><a href="/abnormal/stab">锐器刺伤报告</a></li>
			<li><a href="/abnormal/pressure">压疮事件报告</a></li>
			<li><a href="/abnormal/fall">跌倒坠床报告</a></li>
			<li><a href="/abnormal/other">其他事件报告</a></li>
		</ul>
	   </li>
	   <?php }?>
      <?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']||in_array('/examine/',$_smarty_tpl->tpl_vars['power']->value)){?>
      <li>
      	<a href="javascript:;">
      		<i class="glyphicon glyphicon-list-alt"></i>
      		<span class="title">异常事件审核</span>
      		<span class="selected"></span>
      		<span class="arrow"></span>
		</a>
		<ul class="sub-menu">
			<li><a href="/examine/piping">管路事件报告</a></li>
			<li><a href="/examine/medicine">给药错误报告</a></li>
			<li><a href="/examine/stab">锐器刺伤报告</a></li>
			<li><a href="/examine/pressure">压疮事件报告</a></li>
			<li><a href="/examine/fall">跌倒坠床报告</a></li>
			<li><a href="/examine/other">其他事件报告</a></li>
		</ul>
	   </li>
	   <?php }?>
	   <?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']||in_array('/standard/',$_smarty_tpl->tpl_vars['power']->value)){?>
	   <li>
	   	    <a href="javascript:;">
		  	  	<i class="glyphicon glyphicon-book"></i>
		  	  	<span class="title">质量检测指标</span>
		  	  	<span class="selected"></span>
		  	  	<span class="arrow"></span>
		    </a>
			<ul class="sub-menu">
				<!-- <li><a href="#">各科质量数据上报</a></li> -->
				<li><a href="/standard/list_data">历史上报查看</a></li>
				<li><a href="/standard/import_data">导入数据</a></li>
				<li><a href="/standard/edit_data">修改数据</a></li>
				<li><a href="/standard/summary_month">按月份汇总数据</a></li>
				<li><a href="/standard/summary_section">按科室汇总数据</a></li>
				<li><a href="/standard/export_data">导出数据</a></li>
				<li><a href="#">质量科目报表</a></li>
				<li><a href="/standard/report_indicators">选择上报指标</a></li>
				<li><a href="/standard/report_department">选择上报部门</a></li>
				<!-- <li><a href="#">重点检查颜色设置</a></li> -->
				<li><a href="/standard/irrelevant">选择无关科室</a></li>
				<li><a href="/standard/export_dictionary">导出科室字典</a></li>
				<li><a href="/standard/dictionaries">检测指标字典</a></li>
			</ul>
		</li>
		<?php }?>
    </ul>
  </div>
</div>
<div class="page-quick-sidebar-wrapper">
  <div class="page-quick-sidebar">
    <div class="nav-justified">
      <ul class="nav nav-tabs nav-justified">
        <li class="active"> <a href="#quick_sidebar_tab_1" data-toggle="tab"> Users <span class="badge badge-danger">2</span> </a> </li>
        <li> <a href="#quick_sidebar_tab_2" data-toggle="tab"> Alerts <span class="badge badge-success">7</span> </a> </li>
        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> More<i class="fa fa-angle-down"></i> </a>
          <ul class="dropdown-menu pull-right" role="menu">
            <li> <a href="#quick_sidebar_tab_3" data-toggle="tab"> <i class="icon-bell"></i> Alerts </a> </li>
            <li class="divider"> </li>
            <li> <a href="#quick_sidebar_tab_3" data-toggle="tab"> <i class="icon-settings"></i> Settings </a> </li>
          </ul>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
          <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd" data-wrapper-class="page-quick-sidebar-list">
            <h3 class="list-heading">Staff</h3>
            <ul class="media-list list-items">
              <li class="media">
                <div class="media-status"> <span class="badge badge-success">8</span> </div>
                <img class="media-object" src="/public/drp/assets/admin/layout/img/avatar3.jpg" alt="...">
                <div class="media-body">
                  <h4 class="media-heading">Bob Nilson</h4>
                  <div class="media-heading-sub"> Project Manager </div>
                </div>
              </li>
              <li class="media"> <img class="media-object" src="/public/drp/assets/admin/layout/img/avatar1.jpg" alt="...">
                <div class="media-body">
                  <h4 class="media-heading">Nick Larson</h4>
                  <div class="media-heading-sub"> Art Director </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="page-quick-sidebar-item">
            <div class="page-quick-sidebar-chat-user">
              <div class="page-quick-sidebar-nav"> <a href="javascript:;" class="page-quick-sidebar-back-to-list"><i class="icon-arrow-left"></i>Back</a> </div>
              <div class="page-quick-sidebar-chat-user-messages">
                <div class="post out"> <img class="avatar" alt="" src="/public/drp/assets/admin/layout/img/avatar3.jpg"/>
                  <div class="message"> <span class="arrow"></span> <a href="#" class="name">Bob Nilson</a> <span class="datetime">20:15</span> <span class="body"> When could you send me the report ? </span> </div>
                </div>
                <div class="post in"> <img class="avatar" alt="" src="/public/drp/assets/admin/layout/img/avatar2.jpg"/>
                  <div class="message"> <span class="arrow"></span> <a href="#" class="name">Ella Wong</a> <span class="datetime">20:15</span> <span class="body"> Its almost done. I will be sending it shortly </span> </div>
                </div>
              </div>
              <div class="page-quick-sidebar-chat-user-form">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Type a message here...">
                  <div class="input-group-btn">
                    <button type="button" class="btn blue"><i class="icon-paper-clip"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
          <div class="page-quick-sidebar-alerts-list">
            <h3 class="list-heading">General</h3>
            <ul class="feeds list-items">
              <li> <a href="#">
                <div class="col1">
                  <div class="cont">
                    <div class="cont-col1">
                      <div class="label label-sm label-default"> <i class="fa fa-briefcase"></i> </div>
                    </div>
                    <div class="cont-col2">
                      <div class="desc"> IPO Report for year 2013 has been released. </div>
                    </div>
                  </div>
                </div>
                <div class="col2">
                  <div class="date"> 20 mins </div>
                </div>
                </a> </li>
            </ul>
            <h3 class="list-heading">System</h3>
            <ul class="feeds list-items">
              <li> <a href="#">
                <div class="col1">
                  <div class="cont">
                    <div class="cont-col1">
                      <div class="label label-sm label-info"> <i class="fa fa-briefcase"></i> </div>
                    </div>
                    <div class="cont-col2">
                      <div class="desc"> IPO Report for year 2013 has been released. </div>
                    </div>
                  </div>
                </div>
                <div class="col2">
                  <div class="date"> 20 mins </div>
                </div>
                </a> </li>
            </ul>
          </div>
        </div>
        <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
          <div class="page-quick-sidebar-settings-list">
            <h3 class="list-heading">General Settings</h3>
            <ul class="list-items borderless">
              <li> Enable Notifications
                <input type="checkbox" class="make-switch" checked data-size="small" data-on-color="success" data-on-text="ON" data-off-color="default" data-off-text="OFF">
              </li>
            </ul>
            <h3 class="list-heading">System Settings</h3>
            <ul class="list-items borderless">
              <li> Security Level
                <select class="form-control input-inline input-sm input-small">
                  <option value="1">Normal</option>
                  <option value="2" selected>Medium</option>
                  <option value="e">High</option>
                </select>
              </li>
              <li> Failed Email Attempts
                <input class="form-control input-inline input-sm input-small" value="5"/>
              </li>
            </ul>
            <div class="inner-content">
              <button class="btn btn-success"><i class="icon-settings"></i> Save Changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }} ?>