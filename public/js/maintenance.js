$(document).ready(function () {
    $('.btn-details').click(function () {
        var maintenanceId = $(this).data('maintenance-id');

        $.ajax({
            url: '/getMaintenanceDetails/' + maintenanceId, // Replace with your route
            type: 'GET',
            success: function (data) {
                $('#modal_location').text(data.location);
                $('#modal_room_unit').text(data.room_unit);
                $('#modal_location').text(data.location);
                $('#modal_room_unit').text(data.room_unit);

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
