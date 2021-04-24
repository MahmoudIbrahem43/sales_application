let table = {};
$(function () {
    var HostUrl = window.location.origin;
    table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: HostUrl + "/products",
            type: "GET",
        },
        columns: [{
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: "logo",
            name: "logo",
            render: function(d, t, r, m) {
                if (d == null) {
                    return null;
                } else {
                    return `
                        <img src="${d}" width="80" height="80">
                              `;
                }
            }
        },
        {
            data: 'price',
            name: 'price'
        },
        {
            data: 'organization_id',
            name: 'organization_id'
        },

        {
            data: "edit",
            name: "edit",
            render: function (d, t, r, m) {
                var RowData = r;
                return `
                         <a class="btn btn-info" href="${HostUrl + "/products/" + RowData.id + "/edit"}">edit</a>
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
                         <button type="button" class="btn btn-danger btn-flat btn-sm remove-product" data-id="${RowData.id}">delete  </button>`;
            }
        },
        ]
    });

});




// jquery confirm script
$(document).on("click", "button.remove-product", function () {
    var Host = window.location.origin;
    var current_object = $(this);
    var id = current_object.attr('data-id');
    if (id == null || id == "") {
        swal("Can't Read product Id", {
            icon: "warning",
        });
        return;
    }
    swal({
        title: "Are you sure?",
        text: "You will delete this product!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({
                url: Host + "/products/delete/" + id,
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
            name:"required",
            logo:"required",
            price:"required",
            organization_id:"required",
        },
        messages: {
            name: 'This field is required',
            logo: 'This field is required',
            price: 'This field is required',
            organization_id: 'This field is required',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
  
});

