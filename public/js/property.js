$(document).ready(function () {

    $('#propertyTable').on('click', '.propertyDetailsBtn', function () {
        var propertyId = $(this).data('property-id');
        $.ajax({
            url: '/get_property_details/',
            type: 'GET',
            data: { 'data-property-id': propertyId },

            success: function (data) {
                $('#edit_property_id').val(data.id);
                $('#edit_location').val(data.location);
                $('#edit_room_unit').val(data.room_unit);
                $('#edit_room_fee').val(data.room_fee);
                $('#edit_inclusions').val(data.inclusion);
                $('#edit_occupant').val(data.user ? (data.user.first_name + ' ' + data.user.last_name): 'No Occupant');
                $('#edit_status').val(data.status);
            },
            error: function (error) {
                console.error(error);
            }
        })
    })

});
