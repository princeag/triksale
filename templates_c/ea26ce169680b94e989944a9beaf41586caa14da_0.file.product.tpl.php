<?php
/* Smarty version 3.1.32, created on 2021-01-08 19:50:51
  from '/opt/lampp/htdocs/triksale/templates/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ff86a433b7b19_35598765',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea26ce169680b94e989944a9beaf41586caa14da' => 
    array (
      0 => '/opt/lampp/htdocs/triksale/templates/product.tpl',
      1 => 1610115649,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff86a433b7b19_35598765 (Smarty_Internal_Template $_smarty_tpl) {
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
                <div class="row">
                    <div class="col-sm-3 col-12"><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></div>
                    <div class="col-sm-9 col-12"><h1 class="text-center">Triksale- <u>Sell Old stuff</u></h1></div>
                </div>
				
				<hr>
				<div class="row mt-4">
					<div class="col-md-6 product_images mb-3 text-center">
                        <?php if ($_smarty_tpl->tpl_vars['images']->value) {?>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['images']->value, 'image_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['image_name']->value) {
?>
                                <img src="uploads/product_images/<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
" alt="" class="p-2" width="">
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php } else { ?>
                            <img src="uploads/avatar_720x720_crop_center.jpg" alt="" class="d-block mb-3" width="">
                        <?php }?>
					</div>
                    <div class="col-md-6">
                        <div class=" text-left">
                            <div><span class="badge badge-secondary"><?php echo $_smarty_tpl->tpl_vars['product_detail']->value['category_name'];?>
</span></div>
                            <div class="h3"><?php echo $_smarty_tpl->tpl_vars['product_detail']->value['name'];?>
</div>
                            <div class="font-weight-bold">Rs. <?php echo $_smarty_tpl->tpl_vars['product_detail']->value['price'];?>
</div>
                            <div class="mt-2 text-secondary small"><p><?php echo $_smarty_tpl->tpl_vars['product_detail']->value['description'];?>
</p></div>
                        </div>

                        <div class="add-comment-wrapper">
                            <button class="btn btn-primary" onclick="javascript: $('#add-comment').slideToggle();" id="add-comment-btn" data-value="0">Add Comment</button>
                            <div id="add-comment" class="card p-2 mt-2" style="display:none;">
                                <form action="add_comment.php" class="form" id="add_product_comment_form">
                                    <div class="form-group">
                                        <label for="Name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name">
                                        <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['product_detail']->value['id'];?>
">
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="Comment">Comment <span class="text-danger">*</span> <div class="d-inline-block text-secondary small"><span class="counter">0</span> / 250</div></label>
                                        <textarea name="comment" id="comment" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success btn-sm" type="submit">Add Comment <span class="text-danger">*</span></button>
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="javascript: $('#add-comment').slideUp('slow');">Cancel</button>
                                    </div>
                                    <div class="form-response h4">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
