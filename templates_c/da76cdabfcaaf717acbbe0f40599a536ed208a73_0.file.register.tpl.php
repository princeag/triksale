<?php
/* Smarty version 3.1.32, created on 2021-01-07 15:09:06
  from '/opt/lampp/htdocs/triksale/templates/register.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5ff6d6baca0488_93033668',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da76cdabfcaaf717acbbe0f40599a536ed208a73' => 
    array (
      0 => '/opt/lampp/htdocs/triksale/templates/register.tpl',
      1 => 1610012345,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ff6d6baca0488_93033668 (Smarty_Internal_Template $_smarty_tpl) {
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
				<h2 class="text-center">Create Account - <u>trikSale</u></h2>
				<hr>
				<div class="row mt-4">
					<div class="col-md-10 col-12 mx-auto">
						<form action="auth_process.php?callback=register" methid="POST" class="form" enctype="multipart/form-data" id="register_user_form">
							<div class="form-group">
								<div class="row">
									<div class="col-3">
										<label for="Full Name">Full Name <span class="text-danger">*</span></label>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="name" placeholder="John Doe">	
									</div>
								</div>
							</div>
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
										<label for="Mobile Number">Mobile <span class="text-danger">*</span></label>
									</div>
									<div class="col">
										<input type="text" class="form-control" name="mobile">	
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
										<p class="small text-secondary mb-0">Password contains a-z, A-Z, 0-9 & _, and password should be 6 to 15 character long.</p>
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<div class="row">
									<div class="col-3">
										<label for="Upload Profile Img">Upload Profile </label>
									</div>
									<div class="col">
										<div class="custom-file">
											<input type="file" name="profile" id="profile" class="custom-file-input">
											<label for="profile_img" class="custom-file-label">Click Here to Upload Profile</label>
											<p class="small text-secondary">Profile picture accepted only in png or jpeg.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group text-right">
								<button type="submit" name="submit" class="btn btn-success">Create my account</button> <b>OR</b> <span class="small">Already have a account</span> <a href="login.php">Login</a>
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
