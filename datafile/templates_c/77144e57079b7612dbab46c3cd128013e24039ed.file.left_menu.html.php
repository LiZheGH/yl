<?php /* Smarty version Smarty-3.1.13, created on 2017-10-15 08:22:09
         compiled from "/private/var/www/yl/application/views/admin/common/left_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:5509349759e0b0b6996655-91692257%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '77144e57079b7612dbab46c3cd128013e24039ed' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/common/left_menu.html',
      1 => 1508026925,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5509349759e0b0b6996655-91692257',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0b0b69d9168_72682404',
  'variables' => 
  array (
    'cUser' => 0,
    'menu' => 0,
    'pmenu' => 0,
    'cmenu' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0b0b69d9168_72682404')) {function content_59e0b0b69d9168_72682404($_smarty_tpl) {?><div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul data-slide-speed="200" data-auto-scroll="true" data-keep-expanded="false" class="page-sidebar-menu">
			<li class="sidebar-toggler-wrapper" style='margin-bottom:0px;'>
        		<div class="sidebar-toggler"> </div>
      		</li>
	  		<li class="start active open"><a href="/welcome/index"><i class="icon-home"></i><span class="title">欢迎</span></a></li>
			<?php if ($_smarty_tpl->tpl_vars['cUser']->value['is_admin']){?>
			<li class="">
		      	<a href="javascript:;">
		      		<i class="glyphicon glyphicon-cog"></i>
		      		<span class="title">系统管理</span>
		      		<span class="selected"></span>
		      		<span class="arrow open"></span>
		      	</a>
        		<ul class="sub-menu">
					<li> <a href="/system/account/list">账号管理</a></li>
					<li> <a class="ajax-link" href="/system/role/list">角色管理 </a> </li>
					<li> <a class="ajax-link" href="/system/power/list">菜单管理 </a> </li>
				</ul>
			</li>
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
      		<li>
		      	<a href="javascript:;">
		      		<i class="glyphicon glyphicon-eye-close"></i>
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
		   	<li>
		   	    <a href="javascript:;">
			  	  	<i class="glyphicon glyphicon-book"></i>
			  	  	<span class="title">质量检测指标</span>
			  	  	<span class="selected"></span>
			  	  	<span class="arrow"></span>
			    </a>
				<ul class="sub-menu">
					<li><a href="/standard/list_data">历史上报查看</a></li>
					<li><a href="/standard/import_data">导入数据</a></li>
					<li><a href="/standard/edit_data">修改数据</a></li>
					<li><a href="/standard/summary_month">按月份汇总数据</a></li>
					<li><a href="/standard/summary_section">按科室汇总数据</a></li>
					<li><a href="/standard/export_data">导出数据</a></li>
					<li><a href="/standard/report_form">质量科目报表</a></li>
					<li><a href="/standard/report_indicators">选择上报指标</a></li>
					<li><a href="/standard/report_department">选择上报部门</a></li>
					<li><a href="/standard/export_dictionary">导出科室字典</a></li>
					<li><a href="/standard/dictionaries">检测指标字典</a></li>
				</ul>
			</li>
			<?php }else{ ?>
			<?php if (!empty($_smarty_tpl->tpl_vars['menu']->value)){?>
			<?php  $_smarty_tpl->tpl_vars['pmenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pmenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pmenu']->key => $_smarty_tpl->tpl_vars['pmenu']->value){
$_smarty_tpl->tpl_vars['pmenu']->_loop = true;
?>
			<li>
		   	    <a href="javascript:;">
			  	  	<i class="<?php echo $_smarty_tpl->tpl_vars['pmenu']->value['icon'];?>
"></i>
			  	  	<span class="title"><?php echo $_smarty_tpl->tpl_vars['pmenu']->value['power_name'];?>
</span>
			  	  	<span class="selected"></span>
			  	  	<span class="arrow"></span>
			    </a>
				<ul class="sub-menu">
					<?php if (!empty($_smarty_tpl->tpl_vars['pmenu']->value['child'])){?>
					<?php  $_smarty_tpl->tpl_vars['cmenu'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cmenu']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pmenu']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cmenu']->key => $_smarty_tpl->tpl_vars['cmenu']->value){
$_smarty_tpl->tpl_vars['cmenu']->_loop = true;
?>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['cmenu']->value['uri'];?>
"><?php echo $_smarty_tpl->tpl_vars['cmenu']->value['power_name'];?>
</a></li>
					<?php } ?>
					<?php }?>
				</ul>
			</li>
			<?php } ?>
			<?php }?>
			<?php }?>
		</ul>
	</div>
</div><?php }} ?>