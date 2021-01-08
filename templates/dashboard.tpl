{include file="header.tpl"}
<div class="modal" tabindex="-1" role="dialog" id="add-tag-modal" aria-labelledby="add-tag-modal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="max-height: 500px; overflow: overlay;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add User Tag</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
			</div>
	    	<form class="form" action="ajax_request.php?callback=add_user_tag" method="POST" id="add_tag_form" autocomplete="off">
		  		<div class="modal-body">
		    		<div class="form-group">
						<label for="User Tag">Add Tag <span class="text-danger">*</span></label>
                        <ul id="user_tags" class="tagit ui-widget ui-widget-content ui-corner-all">
                        </ul>
                        <input type="hidden" value="">
						<input type="hidden" name="email" id="email" value="{$user_record_detail.email}">
                        <small class="input-error h4 text-danger"></small>
                        <small class="input-success h4 text-success"></small>
					</div>
		  		</div>
			  	<div class="modal-footer">
			    	<button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
			    	<button type="submit" class="btn btn-success">Save Tags</button>
			  	</div>
	    	</form>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="add-note-modal" aria-labelledby="add-note-modal" aria-hidden="true">
	<div class="modal-dialog" role="document" style="max-height: 500px; overflow: overlay;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Add User Note</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  		<span aria-hidden="true">&times;</span>
				</button>
			</div>
	    	<form class="form" action="ajax_request.php?callback=add_user_note" method="POST" id="add_note_form" autocomplete="off">
		  		<div class="modal-body">
		    		<div class="form-group">
						<label for="User Note">Add Note <span class="text-danger">*</span></label>
                        <textarea name="user_note" class="form-control" id="user_note" cols="30" rows="4" placeholder="Add a note"></textarea>
						<input type="hidden" name="email" id="email" value="{$user_record_detail.email}">
                        <small class="input-error h4 text-danger"></small>
                        <small class="input-success h4 text-success"></small>
					</div>
		  		</div>
			  	<div class="modal-footer">
			    	<button type="button" class="btn btn-secondary float-left" data-dismiss="modal">Close</button>
			    	<button type="submit" class="btn btn-success">Save Note</button>
			  	</div>
	    	</form>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 offset-md-1 col-12">
			<div class="p-3 border rounded border-secodary bg-light">
				<div class="d-flex justify-content-between">
					<div>
						<h1 class="text-left d-inline-block">Dashboard</h1>
					</div>
					<div><i class="fa fa-user"></i> {$user_name} <button class="btn btn-danger btn-sm">Logout</button></div>
				</div>
				<div>
					<div class="page-heading border-top border-bottom pt-2 mb-3">
						<div class="d-flex justify-content-between">
							<h4>Products Listing</h4>
							<div><a href="add_product.php" class="d-inline-block align-super"><button class="btn btn-sm btn-primary">Add Product</button></a></div>
						</div>
					</div>
                    <table class="table" id="user_products">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Thumbnail</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Date Add</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="empty-records d-none text-center">
                        <img src="undraw_empty_xct9.svg" alt="Empty records" width="250px">
                        <p class="text-danger">No Products Added Yet.</p>
                    </div>
                </div>
			</div> 
		</div>
	</div>
</div>


<script>
	var error = '';
	var notice = '';
    var user_tags = '{$user_record_detail.user_tags|default:''}';
</script>

{include file="footer.tpl"}
