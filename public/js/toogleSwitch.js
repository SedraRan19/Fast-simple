$(function () {
    $('.toggle-class').change(function () {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var plan_id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: update_status,
            data: { 'is_active': status, 'id': plan_id },
            success: function (data) {
                if (data) {
                    toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": 'toast-bottom-center'
                    }
                    toastr.success("Plan Status Updated Successfully");
                } else {
                    toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": 'toast-bottom-center'
                    }
                    toastr.error("Error In Updating Status");
                }
            }
        });
    })
});
