let table = {};
$(function () {
    var HostUrl = window.location.origin;
    table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: HostUrl + "/organizations",
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
            data: 'location',
            name: 'location'
        },
        {
            data: 'employees',
            name: 'employees'
        },

        {
            data: "edit",
            name: "edit",
            render: function (d, t, r, m) {
                var RowData = r;
                return `
                         <a class="btn btn-info" href="${HostUrl + "/organizations/" + RowData.id + "/edit"}">edit</a>
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
                         <button type="button" class="btn btn-danger btn-flat btn-sm remove-organization" data-id="${RowData.id}">delete  </button>`;
            }
        },
        ]
    });

});




// jquery confirm script
$(document).on("click", "button.remove-organization", function () {
    var Host = window.location.origin;
    var current_object = $(this);
    var id = current_object.attr('data-id');
    if (id == null || id == "") {
        swal("Can't Read organization Id", {
            icon: "warning",
        });
        return;
    }
    swal({
        title: "Are you sure?",
        text: "You will delete this organization!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        cancelButtonClass: '#DD6B55',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Delete!',
    }).then((willDelete) => {
        if (willDelete) {

            $.ajax({
                url: Host + "/organizations/delete/" + id,
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
    $('form[id="basic-form"]').validate({
        rules: {
            name:"required",
            location:"required",
            employees:"required",
        },
        messages: {
            name: 'This field is required',
            location: 'This field is required',
            employees: 'This field is required',
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
  
});

