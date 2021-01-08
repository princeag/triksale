
$("#add_tag_form").submit(function(e){
    e.preventDefault();
    page_action = $(this).attr('action');
    var form_data = $(this).serializeArray();
    console.log(form_data);
    var has_error = false;
    $("#add_tag_form").find(".input-error, .input-success").text('');
    
    if($("[name='tags[]']").length == 0) {
        $("#add_tag_form").find(".input-error").text('Add some user tags');
        return false;
    }

    $.ajax({
        method: 'POST',
        url: page_action,
        data: form_data,
        success: function(data){
            console.log(data);
            data = JSON.parse(data);
            if(typeof data.err != 'undefined') {
                $("#add_tag_form").find(".input-error").text(data.err);
            }
            else {
                console.log(data.notice)
                $("#add_tag_form").find(".input-success").text(data.notice);
                setTimeout(function(){ window.location.reload(); },  1500);
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

$("#add_note_form").submit(function(e){
    e.preventDefault();
    page_action = $(this).attr('action');
    var form_data = $(this).serializeArray();
    console.log(form_data);
    var has_error = false;
    $("#add_note_form").find(".input-error, .input-success").text('');
    
    if($("#user_note").val().trim() == '') {
        $("#add_note_form").find(".input-error").text('Add user note');
        return false;
    }

    $.ajax({
        method: 'POST',
        url: page_action,
        data: form_data,
        success: function(data){
            data =  JSON.parse(data);
            console.log(data);

            if(typeof data.err != 'undefined') {
                $("#add_note_form").find(".input-error").text(data.err);
            }
            else {
                $("#add_note_form").find(".input-success").text(data.notice);
                setTimeout(function(){ window.location.reload(); },  1500);
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
var i =0;
$("#product_images").change(function(){
    input = this;
    console.log('here')
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        console.log(input.files[0])
        new_img = $(".img-skeleton").clone();

        reader.onload = function(e) {
            new_img.removeClass('d-none img-skeleton').addClass('img-div');
            new_img.find('img').attr('src', e.target.result);
            $("#product_medias").append(new_img)
            i++;
            console.log(i)
        }

        var form_data = new FormData();
 
        // Read selected files
        form_data.append("product_images", input.files[0]);
        
        // AJAX request
        $.ajax({
            url: 'upload.php', 
            type: 'POST',
            data: form_data,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data)
                if(typeof data.err != 'undefined') {
                    $(".alert.error").removeClass('d-none').find('span').text(data.err);
                }
                else {
                    console.log(data.notice)
                    new_img.find('input').val(data.name);
                    // $(".alert.notice").removeClass('d-none').find('span').text(data.notice);
                    // setTimeout(function(){ window.location.reload(); },  1500);
                }
            }
        });
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
})

$(".img-del").click(function(){
    var _parent = $(this).parent('.img-div');
    var img_name = _parent.find('.old_images').val();
    var product_id = $('[name="id"]').val();
    var form_data = new FormData();
    form_data.append('image_name', img_name)
    form_data.append('product_id', product_id)


    $.ajax({
        url: 'ajax_request.php?callback=delete_img', 
        type: 'POST',
        data: form_data,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
            console.log(data)
            if(typeof data.err != 'undefined') {
                $(".alert.error").removeClass('d-none').find('span').text(data.err);
            }
            else {
                console.log(data.notice);
                _parent.remove();
                $(".alert.notice").removeClass('d-none').find('span').text(data.notice);
                // setTimeout(function(){ window.location.reload(); },  1500);
            }
        }
    });
})

$("#add_product_form").submit(function(e){
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
                // setTimeout(()=>{ window.location.href = 'dashboard.php'; }, 1500);
                setTimeout(()=>{ window.location.reload(); }, 1500);
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


column_defs = [
    {
        'data': 'id',
        'searchable': true,
        'targets': [0],
    },
    {
        'data': 'image_name',
        'searchable': false,
        'targets': [1],
        'render': function(data, type, row, meta){
            if(data)
                return '<img class="img-thumbnail" width="60" src="uploads/product_images/'+data+'">';
            else
                return '<i class="fa fa-user-circle text-light"></i>';
        }
    },
    {
        'data': 'name',
        'searchable': true,
        'targets': [2],
    },
    {
        'data': 'price',
        'searchable': true,
        'targets': [3],
    },
    {
        'data': 'quantity',
        'searchable': true,
        'targets': [4]
    },
    {
        'data': 'date_add',
        'searchable': true,
        'targets': [5]
    },
    {
        'data': 'action',
        'searchable': true,
        'targets': [6],
        'render': function(data, type, row, meta){
            return '<a href="add_product.php?id='+row.id+'">View</a>';
        }
    }
];

var mytabel = $('#user_products').DataTable({
    'paging': true,
    "processing": true,
    "searching": true,
    "searchDelay": 550,
    "serverSide": true,
    "columnDefs": column_defs,
    "order": [[0, "desc"]],
    "stateSave": true,
    "pagingType": "simple_numbers",
    "scrollY":        "500px",
    "scrollCollapse": true,
    "lengthChange": true,
    "lengthMenu": [ 15, 30, 50 ],
    "pageLength": 15,
    "language": {
        "info": "Showing page _PAGE_ of _PAGES_"
    },
    // "dom": 'Bfrtip',
    // "buttons": [
    //     {
    //         extend: 'colvis',
    //         columns: ':not(.noVis)'
    //     }
    // ],
    "initComplete": function() {
        var is_empty = $('body').find('.dataTables_empty').length;

        if(is_empty) {
            $(".empty-records").removeClass('d-none');   
            $('#user_products_wrapper, .bulk, .recently_added, .dataTables_info, .dataTables_paginate, .dataTables_filter, .dataTables_length, .filter_by').addClass('d-none');
        }

        $(".dataTables_filter input")
        .unbind() // Unbind previous default bindings
        .bind("input", function(e) { // Bind our desired behavior
            // If the length is 3 or more characters, or the user pressed ENTER, search
            if(this.value.length > 3 || e.keyCode == 13) {
                // Call the API search function
                mytabel.search(this.value).draw();
            }
            // Ensure we clear the search if they backspace far enough
            if(this.value == "") {
                mytabel.search("").draw();
            }
            return;
        });
    },
    "drawCallback": function( settings ) {
         
    },
    "ajax": {
        "url": "ajax_request.php?callback=getUserProducts",
        "method": "POST",
        "dataSrc": function(data) {
            // data = JSON.parse(data.data);
            // data = data.data;
            console.log(data);
            var table_data = data.data;
            $(".total_resource").text(table_data.length);
            return data.data;
        }
    }
});