<?php /* Smarty version Smarty-3.1.13, created on 2017-10-12 09:29:06
         compiled from "/www/yl/application/views/admin/index.html" */ ?>
<?php /*%%SmartyHeaderCode:54638037559dec562b8a046-45546470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5505abc919ae81c2a325b9160e2a9218cd9affbe' => 
    array (
      0 => '/www/yl/application/views/admin/index.html',
      1 => 1507301984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54638037559dec562b8a046-45546470',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_DIR' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_59dec562bbc364_27877121',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59dec562bbc364_27877121')) {function content_59dec562bbc364_27877121($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['VIEW_DIR']->value)."common/header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<script>
	window.location.href = '/system/account/list';
</script>
<body>


</body>
</html>
<?php }} ?>