
//   datatable script
let table = {};
$(function () {
    var HostUrl = window.location.origin;
    table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,


        ajax: {
            url: HostUrl + "/comments",
            type: "GET",
        },
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'author',
            name: 'author'
        },
        {
            data: 'text',
            name: 'text'
        },
        {
            data: 'article_id',
            name: 'article_id'
        },
        {
            data: "edit",
            name: "edit",
            render: function (d, t, r, m) {
                var RowData = r;
                return `
                         <a class="btn btn-info" href="${HostUrl + "/comments/" + RowData.id + "/edit"}">edit</a>
                         `;

            }
        },
        {
            data: "delete",
            name: "delete",
            render: function (d, t, r, m) {
                var RowData = r;
                var TokenValue = $('input[name="_token"]').val();
                return `
                         <button type="button" class="btn btn-danger btn-flat btn-sm remove-article" data-id="${RowData.id}">delete  </button>`;
            }
        },
        ]
    });

});




// jquery confirm script
$(document).on("click", "button.remove-article", function () {
    var Host = window.location.origin;
    var current_object = $(this);
    var id = current_object.attr('data-id');
    if (id == null || id == "") {
        swal("Can't Read Article Id", {
            icon: "warning",
        });
        return;
    }  

    swal({
        title: "Are you sure?",
        text: "You will delete this article!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({
                url: Host + "/comments/delete/" + id,
                type: "GET",
                dataType: 'json',
            }).done(function (result) {
                if (result.msg !== null && result.msg !== "" && result.msg !== undefined) {

                    swal(result.msg, {
                        icon: "error",
                    });

                } else {

                    table.ajax.reload();
                }
            });


        }
    });

});


$(document).ready(function() {
    $('form[id="basic-form2"]').validate({
        rules: {
            author:"required",
            text:"required",
            article_id:"required",
        },
        messages: {
            author: 'This field is required',
            text: 'This field is required',
            article_id: 'This field is required',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
  
});

