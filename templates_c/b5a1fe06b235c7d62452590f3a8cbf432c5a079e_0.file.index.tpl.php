<?php
/* Smarty version 3.1.32, created on 2021-01-08 17:48:50
  from '/opt/lampp/htdocs/triksale/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ff84daa52ae40_20562997',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b5a1fe06b235c7d62452590f3a8cbf432c5a079e' => 
    array (
      0 => '/opt/lampp/htdocs/triksale/templates/index.tpl',
      1 => 1610108329,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff84daa52ae40_20562997 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 offset-md-2 col-12">
			<div class="alert alert-success alert-dismissible fade show notice d-none">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				<strong>Success!</strong> <span></span>
			</div>
			<div class="alert alert-danger alert-dismissible fade show error d-none">
				<button type="button" class="close">&times;</button>
				<strong>Error!</strong> <span></span>
			</div>
			<div class="p-3 border rounded border-secodary bg-light">
				<h1 class="text-center">Triksale- <u>Sell Old stuff</u></h1>
				<hr>
				<div class="row mt-4">
					<?php if ($_smarty_tpl->tpl_vars['product_details']->value) {?>
						<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product_details']->value, 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
							<div class="col-md-4">
								<a href="product.php?id=<?php echo $_smarty_tpl->tpl_vars['product']->value['id'];?>
" class="product-link" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
" data-toggle="tooltip" data-placement="left">
									<div class="product text-center">
										<div class="product_post text-secondary text-right" style="font-size: 12px"><i class="far fa-clock"></i> <?php if ($_smarty_tpl->tpl_vars['product']->value['date_add'] == 0) {?>Today<?php } else {
echo $_smarty_tpl->tpl_vars['product']->value['date_add'];?>
 days ago<?php }?></div>
										<?php if ($_smarty_tpl->tpl_vars['product']->value['image_name']) {?>
											<img src="uploads/product_images/<?php echo $_smarty_tpl->tpl_vars['product']->value['image_name'];?>
" alt="" class="mt-2" width="">
										<?php } else { ?>
											<img src="uploads/avatar_720x720_crop_center.jpg" alt="" class="" width="">
										<?php }?>

										<div class="mt-2"><?php echo substr($_smarty_tpl->tpl_vars['product']->value['name'],0,65);?>
</div>
										<div class="font-weight-bold">Rs. <?php echo $_smarty_tpl->tpl_vars['product']->value['price'];?>
</div>
									</div>
								</a>
							</div>
						<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php } else { ?>
						<div class="empty-records text-center">
							<img src="undraw_empty_xct9.svg" alt="Empty records" width="250px">
							<p class="text-danger">No Products Found.</p>
						</div>
					<?php }?>
				</div>
			</div> 
		</div>
	</div>
</div>

<?php echo '<script'; ?>
>
	var error = '';
	var notice = '';
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
