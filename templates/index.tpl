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
			<div class="p-3 border rounded border-secodary bg-light">
				<h1 class="text-center">Triksale- <u>Sell Old stuff</u></h1>
				<hr>
				<div class="row mt-4">
					{if $product_details}
						{foreach $product_details as $product}
							<div class="col-md-4">
								<a href="product.php?id={$product.id}" class="product-link" title="{$product.name}" data-toggle="tooltip" data-placement="left">
									<div class="product text-center">
										<div class="product_post text-secondary text-right" style="font-size: 12px"><i class="far fa-clock"></i> {if $product.date_add == 0}Today{else}{$product.date_add} days ago{/if}</div>
										{if $product.image_name}
											<img src="uploads/product_images/{$product.image_name}" alt="" class="mt-2" width="">
										{else}
											<img src="uploads/avatar_720x720_crop_center.jpg" alt="" class="" width="">
										{/if}

										<div class="mt-2">{$product.name|substr:0:65}</div>
										<div class="font-weight-bold">Rs. {$product.price}</div>
									</div>
								</a>
							</div>
						{/foreach}
					{else}
						<div class="empty-records text-center">
							<img src="undraw_empty_xct9.svg" alt="Empty records" width="250px">
							<p class="text-danger">No Products Found.</p>
						</div>
					{/if}
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
