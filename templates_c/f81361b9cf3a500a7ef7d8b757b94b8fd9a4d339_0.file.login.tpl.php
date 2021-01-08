<?php
/* Smarty version 3.1.32, created on 2021-01-07 14:46:49
  from '/opt/lampp/htdocs/triksale/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ff6d181d25a87_71914816',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f81361b9cf3a500a7ef7d8b757b94b8fd9a4d339' => 
    array (
      0 => '/opt/lampp/htdocs/triksale/templates/login.tpl',
      1 => 1610011008,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff6d181d25a87_71914816 (Smarty_Internal_Template $_smarty_tpl) {
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
				<h2 class="text-center">Login Account - <u>trikSale</u></h2>
				<hr>
				<div class="row mt-4">
					<div class="col-md-10 col-12 mx-auto">
						<form action="auth_process.php?callback=login" methid="POST" class="form" id="login_user_form">
							<div class="form-group">
								<div class="row">
									<div class="col-3">
										<label for="Email Id">Email Address <span class="text-danger">*</span></label>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="email">	
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-3">
										<label for="Password">Password <span class="text-danger">*</span></label>
									</div>
									<div class="col">
										<input type="password" class="form-control" name="password" placeholder="******">	
									</div>
								</div>
							</div>
							<div class="form-group text-right">
								<button type="submit" name="submit" class="btn btn-success">Login my account</button> <b>OR</b> <span class="small">I don't have a account</span> <a href="register.php">Register</a>
							</div>
						</form>
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
