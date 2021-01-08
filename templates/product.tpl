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
                <div class="row">
                    <div class="col-sm-3 col-12"><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></div>
                    <div class="col-sm-9 col-12"><h1 class="text-center">Triksale- <u>Sell Old stuff</u></h1></div>
                </div>
				
				<hr>
				<div class="row mt-4">
					<div class="col-md-6 product_images mb-3 text-center">
                        {if $images}
                            {foreach $images as $image_name}
                                <img src="uploads/product_images/{$image_name}" alt="" class="p-2" width="">
                            {/foreach}
                        {else}
                            <img src="uploads/avatar_720x720_crop_center.jpg" alt="" class="d-block mb-3" width="">
                        {/if}
					</div>
                    <div class="col-md-6">
                        <div class=" text-left">
                            <div><span class="badge badge-secondary">{$product_detail.category_name}</span></div>
                            <div class="h3">{$product_detail.name}</div>
                            <div class="font-weight-bold">Rs. {$product_detail.price}</div>
                            <div class="mt-2 text-secondary small"><p>{$product_detail.description}</p></div>
                        </div>

                        <div class="add-comment-wrapper">
                            <button class="btn btn-primary" onclick="javascript: $('#add-comment').slideToggle();" id="add-comment-btn" data-value="0">Add Comment</button>
                            <div id="add-comment" class="card p-2 mt-2" style="display:none;">
                                <form action="add_comment.php" class="form" id="add_product_comment_form">
                                    <div class="form-group">
                                        <label for="Name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name">
                                        <input type="hidden" name="product_id" value="{$product_detail.id}">
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

<script>
	var error = '';
	var notice = '';
</script>

{include file="footer.tpl"}
