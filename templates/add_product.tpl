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
				<div class="d-flex justify-content-between">
					<div>
						<h1 class="text-left d-inline-block">Dashboard</h1>
					</div>
					<div><i class="fa fa-user"></i> {$user_name} <button class="btn btn-danger btn-sm">Logout</button></div>
				</div>
				<div>
					<div class="page-heading border-top border-bottom pt-2 mb-3">
						<div class="d-flex justify-content-between">
							<h4><a href="dashboard.php"><i class="fa fa-home"></i></a> {if $product_details}Edit{else}Add{/if} Product <span class="text-secondary">{if $product_details}#{$product_details.id}{/if}</span></h4>
						</div>
					</div>
					<div class="col-md-10 col-12 mx-auto">
						<form action="add_product_process.php" methid="POST" class="form" enctype="multipart/form-data" id="add_product_form">
							<div class="form-group">
                                <label for="Name">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Honda Scooter" value="{if $product_details}{$product_details.name}{/if}">	
								{if $product_details}
								<input type="hidden" name="id" value="{$product_details.id}">
								{/if}
							</div>
							<div class="form-group">
                                <label for="Product Description">Product Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="5">{if $product_details}{$product_details.description}{/if}</textarea>	
							</div>
							<div class="form-group">
                                <label for="Price">Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="price" value="{if $product_details}{$product_details.price}{/if}">	
							</div>
							<div class="form-group">
                                <label for="Quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" min="1" value="{if $product_details}{$product_details.quantity}{else}1{/if}">	
							</div>
							<div class="form-group">
                                <label for="Category">Category <span class="text-danger">*</span></label>
                                <select name="category" id="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    {foreach $categories as $id => $name}
                                        <option value="{$id}" {if $product_details && $product_details.category_id == $id}selected{/if}>{$name}</option>
                                    {/foreach}
                                </select>
							</div>
						
							<div class="form-group">
                                <label for="Upload Product Img">Upload Product Images </label>
                                <div class="d-flex">
                                    <div class="d-flex flex-wrap" id="product_medias">
										{if $images}
											{foreach $images as $image_id => $image_name}
												<div class="img-div">
													<div class="img-del" title="Delete Img" data-toggle="tooltip"><i class="fa fa-trash-alt"></i></div>
													<img src="uploads/product_images/{$image_name}" alt="" class="img-thumbnail">
													<input type="hidden" class="old_images" value="{$image_name}">
												</div>
											{/foreach}
										{/if}
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

<script>
	var error = '';
	var notice = '';
</script>

{include file="footer.tpl"}
