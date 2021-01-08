<?php
/* Smarty version 3.1.32, created on 2021-01-08 17:10:51
  from '/opt/lampp/htdocs/triksale/templates/add_product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ff844c3207659_69982686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2d34d9d0d6e29942ec265425f4573f1614b4bb6' => 
    array (
      0 => '/opt/lampp/htdocs/triksale/templates/add_product.tpl',
      1 => 1610106048,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff844c3207659_69982686 (Smarty_Internal_Template $_smarty_tpl) {
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
			<div class="p-2 border rounded border-secodary bg-light">
				<div class="d-flex justify-content-between">
					<div>
						<h1 class="text-left d-inline-block">Dashboard</h1>
					</div>
					<div><i class="fa fa-user"></i> <?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
 <button class="btn btn-danger btn-sm">Logout</button></div>
				</div>
				<div>
					<div class="page-heading border-top border-bottom pt-2 mb-3">
						<div class="d-flex justify-content-between">
							<h4><a href="dashboard.php"><i class="fa fa-home"></i></a> <?php if ($_smarty_tpl->tpl_vars['product_details']->value) {?>Edit<?php } else { ?>Add<?php }?> Product <span class="text-secondary"><?php if ($_smarty_tpl->tpl_vars['product_details']->value) {?>#<?php echo $_smarty_tpl->tpl_vars['product_details']->value['id'];
}?></span></h4>
						</div>
					</div>
					<div class="col-md-10 col-12 mx-auto">
						<form action="add_product_process.php" methid="POST" class="form" enctype="multipart/form-data" id="add_product_form">
							<div class="form-group">
                                <label for="Name">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Honda Scooter" value="<?php if ($_smarty_tpl->tpl_vars['product_details']->value) {
echo $_smarty_tpl->tpl_vars['product_details']->value['name'];
}?>">	
								<?php if ($_smarty_tpl->tpl_vars['product_details']->value) {?>
								<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['product_details']->value['id'];?>
">
								<?php }?>
							</div>
							<div class="form-group">
                                <label for="Product Description">Product Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="5"><?php if ($_smarty_tpl->tpl_vars['product_details']->value) {
echo $_smarty_tpl->tpl_vars['product_details']->value['description'];
}?></textarea>	
							</div>
							<div class="form-group">
                                <label for="Price">Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="price" value="<?php if ($_smarty_tpl->tpl_vars['product_details']->value) {
echo $_smarty_tpl->tpl_vars['product_details']->value['price'];
}?>">	
							</div>
							<div class="form-group">
                                <label for="Quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" min="1" value="<?php if ($_smarty_tpl->tpl_vars['product_details']->value) {
echo $_smarty_tpl->tpl_vars['product_details']->value['quantity'];
} else { ?>1<?php }?>">	
							</div>
							<div class="form-group">
                                <label for="Category">Category <span class="text-danger">*</span></label>
                                <select name="category" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'name', false, 'id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['product_details']->value && $_smarty_tpl->tpl_vars['product_details']->value['category_id'] == $_smarty_tpl->tpl_vars['id']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
							</div>
						
							<div class="form-group">
                                <label for="Upload Product Img">Upload Product Images </label>
                                <div class="d-flex">
                                    <div class="d-flex flex-wrap" id="product_medias">
										<?php if ($_smarty_tpl->tpl_vars['images']->value) {?>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['images']->value, 'image_name', false, 'image_id');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['image_id']->value => $_smarty_tpl->tpl_vars['image_name']->value) {
?>
												<div class="img-div">
													<div class="img-del" title="Delete Img" data-toggle="tooltip"><i class="fa fa-trash-alt"></i></div>
													<img src="uploads/product_images/<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
" alt="" class="img-thumbnail">
													<input type="hidden" class="old_images" value="<?php echo $_smarty_tpl->tpl_vars['image_name']->value;?>
">
												</div>
											<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
										<?php }?>
                                    </div>
                                    <div class="custom-file">
                                        <label for="product_images" class="custom-file-label text-center"><input type="file" name="product_images" id="product_images" class="custom-file-input"><i class="fa fa-camera fa-3x"></i><br>Add Media</label>
                                    </div>
                                </div>
                                <p class="small text-secondary">Max 10 images can be uploaded in a single product.</p>
							</div>
							<div class="form-group text-left">
								<button type="submit" name="submit" class="btn btn-success">Save Product</button>
							</div>
						</form>
					</div>
					<div class="img-skeleton d-none">
						<img src="" alt="" class="img-thumbnail">
						<input type="hidden" name="images[]" class="images">
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
