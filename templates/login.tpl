{include file="header.tpl"}

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

<script>
	var error = '';
	var notice = '';
</script>

{include file="footer.tpl"}