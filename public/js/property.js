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

    var roomUnitInput = $("#room_unit");
    var locationInput = $("#location");
    var existingRoomUnitInputs = $('[name^="room_unit"]');

    locationInput.on("input", function () {
        var location = locationInput.val().substring(0, 3).toUpperCase();
        var availableNumber = 1;

        if (location === "") {
            roomUnitInput.val(""); // Clear the room unit field if location is empty
            return;
        }

        existingRoomUnitInputs.each(function () {
            var value = $(this).val().toUpperCase();
            if (value.startsWith("JE_" + location + "-")) {
                var number = parseInt(value.substring(7), 10);
                if (!isNaN(number) && number >= availableNumber) {
                    availableNumber = number + 1;
                }
            }
        });

        roomUnitInput.val("JE_" + location + "-" + availableNumber.toString().padStart(2, "0"));
    });
});

