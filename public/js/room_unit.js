$(document).ready(function () {
    // Get the location and room unit dropdown elements
    const locationDropdown = $('#location');
    const roomUnitDropdown = $('#room_unit');
    const roomFeeField = $('#room_fee');
    const roomFeeDisplayField = $('#room_fee_display'); // Assuming this is the field in Rental Information section
    const propertyIdField = $('#property_id');

    // Function to update the room unit dropdown based on the selected location
    function updateRoomUnits(location) {
        // Make an AJAX request to fetch the room units for the selected location
        $.ajax({
            type: 'GET',
            url: '/get_room_units', // Replace this with the URL to your server endpoint to fetch room units
            data: { location: location },
            dataType: 'json',
            success: function (data) {
                roomUnitDropdown.empty();

                roomUnitDropdown.append($('<option>', {
                    value: '',
                    text: 'Choose available room unit'
                }));

                $.each(data, function (index, roomUnit) {
                    roomUnitDropdown.append($('<option>', {
                        value: roomUnit,
                        text: roomUnit
                    }));
                });
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function updateRoomDetails(location, roomUnit) {
        $.ajax({
            type: 'GET',
            url: '/get_room_details',
            data: { location: location, room_unit: roomUnit },
            dataType: 'json',
            success: function (data) {
                roomFeeField.val(data.room_fee);
                roomFeeDisplayField.val(data.room_fee); // Set the room fee in the Rental Information section
                propertyIdField.val(data.id);
            }
        });
    }

    // Add event listener to the location dropdown
    locationDropdown.on('change', function () {
        const selectedLocation = locationDropdown.val();
        updateRoomUnits(selectedLocation);
    });

    roomUnitDropdown.on('change', function () {
        const selectedLocation = locationDropdown.val();
        const selectedRoomUnit = roomUnitDropdown.val();
        updateRoomDetails(selectedLocation, selectedRoomUnit);
    });
});
