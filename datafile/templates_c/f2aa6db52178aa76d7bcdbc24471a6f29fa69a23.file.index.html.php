<?php /* Smarty version Smarty-3.1.13, created on 2017-10-14 00:23:41
         compiled from "/private/var/www/yl/application/views/admin/index.html" */ ?>
<?php /*%%SmartyHeaderCode:31822513759e0e88d1ae405-25713018%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2aa6db52178aa76d7bcdbc24471a6f29fa69a23' => 
    array (
      0 => '/private/var/www/yl/application/views/admin/index.html',
      1 => 1506342841,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31822513759e0e88d1ae405-25713018',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59e0e88d1c3be1_54955573',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59e0e88d1c3be1_54955573')) {function content_59e0e88d1c3be1_54955573($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script>
	window.location.href = '/system/account/list';
</script>
<body>


</body>
</html>
<?php }} ?>