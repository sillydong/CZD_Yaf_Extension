<?php /* Smarty version Smarty-3.1.13, created on 2013-08-29 10:42:13
         compiled from "/Volumes/DATA/Source/space_idea/PHPProject/CZD_Yaf_Extension/application/views/index/index.phtml" */ ?>
<?php /*%%SmartyHeaderCode:2017023773521eb3d2c1f822-74498396%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ecb5c42bf8c2e3a4b792ce5e0e00f638543effc6' => 
    array (
      0 => '/Volumes/DATA/Source/space_idea/PHPProject/CZD_Yaf_Extension/application/views/index/index.phtml',
      1 => 1377744126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2017023773521eb3d2c1f822-74498396',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521eb3d2c24bf2_18248779',
  'variables' => 
  array (
    'name' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521eb3d2c24bf2_18248779')) {function content_521eb3d2c24bf2_18248779($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('header.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</div>
<?php echo $_smarty_tpl->getSubTemplate ('footer.phtml', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }} ?>