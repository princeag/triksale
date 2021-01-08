$(document).ready(function(){
    $('body').tooltip({
        selector: 'a',
        placement: 'left'
    });
    
    $(document).find('[data-toggle="tooltip"]').tooltip();
    
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("#dob").datepicker({
        
    })

    $("button.close").click(function(e){
        e.preventDefault();
        $(this).parent('.alert').addClass('d-none');
    })

    $('#short_bio').on("input", function(e){
        let _this_val = $(this).val();
        var currentLength = _this_val.length;
        var _this_counter = $(this).prev().find('.counter');
        var maxLength = 250;

        if(maxLength - currentLength <= 10)
            _this_counter.removeClass('text-warning').addClass('text-danger');
        else if(maxLength - currentLength <= 20)
            _this_counter.addClass('text-warning').removeClass('text-danger');
        else
            _this_counter.removeClass('text-danger text-warning');
        
        if(currentLength >= maxLength) {
            $(this).val(_this_val.substr(0, 250));
            _this_counter.text(maxLength);
        }else {
            _this_counter.text(currentLength);
        }
    });

    $('#comment').on("input", function(e){
        let _this_val = $(this).val();
        var currentLength = _this_val.length;
        var _this_counter = $(this).prev().find('.counter');
        var maxLength = 250;

        if(maxLength - currentLength <= 10)
            _this_counter.removeClass('text-warning').addClass('text-danger');
        else if(maxLength - currentLength <= 20)
            _this_counter.addClass('text-warning').removeClass('text-danger');
        else
            _this_counter.removeClass('text-danger text-warning');
        
        if(currentLength >= maxLength) {
            $(this).val(_this_val.substr(0, 250));
            _this_counter.text(maxLength);
        }else {
            _this_counter.text(currentLength);
        }
    });

    $("#register_user_form").submit(function(e){
        $(".alert").addClass('d-none');
		e.preventDefault();
		page_action = $(this).attr('action');
		var form_data = $(this).serializeArray();
		console.log(form_data);
        var formData = new FormData();
        var form_fields = [];
        var has_error = false;
        
        $.each(form_data, function(i, ele){
            form_fields.push(ele.name);
            let ele_val = ele.value;
            has_error = false;

            if(ele_val.trim() == '') {
                let ele_name = ele.name;
                ele_name = ele_name.split('_').join(' ');
                ele_name = ele_name.charAt(0).toUpperCase()+ele_name.slice(1);
                $(".alert.error").removeClass('d-none').find('span').text(ele_name + ' is required');   
                has_error = true;
            }
            else if(ele.name == 'email') {
	            if(!verifyEmail(ele.value)) {
                    $(".alert.error").removeClass('d-none').find('span').text('Email is invalid');
                    has_error = true;
                }
            }
            else if(ele.name == 'mobile') {
                const mobile_regex = /\d{10}$/;

	            if(!mobile_regex.test(ele.value)) {
                    $(".alert.error").removeClass('d-none').find('span').text('Mobile is invalid');
                    has_error = true;
                }
            }
            else if(ele.name == 'password') {
                const pwd_regex = /\w{6,15}$/;

	            if(!pwd_regex.test(ele.value)) {
                    $(".alert.error").removeClass('d-none').find('span').text('Password is invalid');
                    has_error = true;
                }
            }
            
            if(has_error)
                return false;
        })

        if(has_error) {
            return false;
        }
        // else if(typeof $('#profile')[0].files[0] == 'undefined') {
        //     $(".alert.error").removeClass('d-none').find('span').text('Add a profile image');   
        //     has_error = true;
        // }

        if(has_error) {
            return false;
        }
        
		formData.append('profile', $('#profile')[0].files[0]);

        $.each(form_data, function(i, ele){
            formData.append(ele.name, ele.value);
        })

		$.ajax({
            method: 'POST',
			url: page_action,
			mimeType: 'multipart/form-data',
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
            success: function(data){
				console.log(data);

				if(typeof data.err != 'undefined') {
                    $(".alert.error").removeClass('d-none').find('span').text(data.err);
				}
				else {
                    $(".alert.notice").removeClass('d-none').find('span').text(data.notice);
                    setTimeout(()=>{ window.location.href = 'dashboard.php'; }, 1500);
				}
            },
            error: function(xhr, status, error){
            },
            complete: function(xhr, status){
                // console.log(xhr)
                // console.log(status)
            }
		})
	})

    $("#login_user_form").submit(function(e){
        $(".alert").addClass('d-none');
		e.preventDefault();
		page_action = $(this).attr('action');
		var form_data = $(this).serializeArray();
		console.log(form_data);
        // var formData = new FormData();
        var formData = {};
        var has_error = false;
        
        $.each(form_data, function(i, ele){
            let ele_val = ele.value;
            has_error = false;

            if(ele_val.trim() == '') {
                let ele_name = ele.name;
                ele_name = ele_name.split('_').join(' ');
                ele_name = ele_name.charAt(0).toUpperCase()+ele_name.slice(1);
                $(".alert.error").removeClass('d-none').find('span').text(ele_name + ' is required');   
                has_error = true;
            }
            else if(ele.name == 'email') {
	            if(!verifyEmail(ele.value)) {
                    $(".alert.error").removeClass('d-none').find('span').text('Email is invalid');
                    has_error = true;
                }
            }
            
            if(has_error)
                return false;

            // console.log(ele.value)
            // formData.append(ele.name, ele.value);
            // console.log(formData.email)

            formData[ele.name] = ele_val;
        })

        if(has_error) {
            return false;
        }
        console.log(formData)
		$.ajax({
            method: 'POST',
			url: page_action,
            data: formData,
            // contentType: false,
            // processData: false,
            dataType: 'json',
            success: function(data){
				console.log(data.err);

				if(typeof data.err != 'undefined') {
                    $(".alert.error").removeClass('d-none').find('span').text(data.err);
				}
				else {
                    $(".alert.notice").removeClass('d-none').find('span').text(data.notice);
                    setTimeout(()=>{ window.location.href = 'dashboard.php'; }, 1500);
				}
            },
            error: function(xhr, status, error){
            },
            complete: function(xhr, status){
                // console.log(xhr)
                // console.log(status)
            }
		})
	})

    $("#add_product_comment_form").submit(function(e){
        $(".form-response").html('');
		e.preventDefault();
		page_action = $(this).attr('action');
		var form_data = $(this).serializeArray();
		console.log(form_data);
        var formData = new FormData();
        var has_error = false;
        
        $.each(form_data, function(i, ele){
            console.log(ele.name)
            console.log(ele.value)
            let ele_val = ele.value;
            has_error = false;

            if(ele_val.trim() == '') {
                let ele_name = ele.name;
                ele_name = ele_name.split('_').join(' ');
                ele_name = ele_name.charAt(0).toUpperCase()+ele_name.slice(1);
                $(".form-response").html('<span class="text-danger">'+(ele_name + ' is required')+"</span>");
                has_error = true;
            }
            else if(ele.name == 'email') {
                const email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	            if(!email_regex.test(ele.value)) {
                    has_error = true;
                    $(".form-response").html('<span class="text-danger">'+'Email is invalid'+"</span>");
                }
            }
            
            if(has_error)
                return false;
        })
        
        if(has_error) {
            return false;
        }
        
        $.each(form_data, function(i, ele){
            formData.append(ele.name, ele.value);
        })

		$.ajax({
            method: 'POST',
			url: page_action,
			data: formData,
			dataType: 'json',
			contentType: false,
			processData: false,
            success: function(data){
				console.log(data);

				if(typeof data.err != 'undefined') {
                    $(".form-response").html('<span class="text-danger">'+data.err+"</span>");
				}
				else {
                    $(".form-response").html('<span class="text-success">'+data.notice+"</span>");
                    setTimeout(()=>{ $("#add-comment").slideUp(); }, 1500);
				}
            },
            error: function(xhr, status, error){
            },
            complete: function(xhr, status){
                // console.log(xhr)
                // console.log(status)
            }
		})
    })
    
    $( '#add-comment-btn' ).click(function() {
        let opened = $(this).data('value');
        $(this).data('value', opened == '0' ? 1 : 0);
        
        if(opened == '0'){
            $("#add_product_comment_form").find('input[name!="product_id"], textarea').val('');
        }
    });
});

function verifyEmail(email) {
    const email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(email_regex.test(email)) {
        return true;
    }

    return false;
}

