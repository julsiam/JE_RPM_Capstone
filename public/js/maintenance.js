$(document).ready(function () {
    $('.maintenance-details-button').click(function () {
        var maintenanceId = $(this).data('maintenance-id');
        $.ajax({
            url: '/getMaintenanceDetails/', // Replace with your route
            type: 'GET',
            data: { 'data-maintenance-id': maintenanceId },

            success: function (data) {
                $('#modal_author_header').text('Maintenance Request By: ' + data.user.first_name + ' ' + data.user.last_name);
                $('#modal_location').text(data.user.property.location);
                $('#modal_room_unit').text(data.user.property.room_unit);
                $('#modal_maintenance_status').val(data.status);
                $('#modal_author').text(data.user.first_name + ' ' + data.user.last_name);
                var dateRequested = new Date(data.date_requested);
                var options = {
                    timeZone: 'UTC', // Use UTC or your desired timezone
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                    // hour: 'numeric',
                    // minute: 'numeric',
                    // hour12: true
                };
                var formattedDate = dateRequested.toLocaleString('en-US', options);
                $('#modal_date_requested').text(formattedDate);
                $('#modal_request_type').val(data.request_type);
                $('#modal_priority').val(data.priority);
                $('#modal_description').text(data.description);
            },

            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });

    // $('#updateRequestButton').click(function () {
    //     $.ajax({
    //         url: '/update-maintenance-status',
    //         type: 'POST',
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             maintenanceId: $('#maintenanceId').val(), // Ensure you have the correct field name here
    //             modal_maintenance_status: $('#modal_maintenance_status').val(),
    //         },
    //         success: function (response) {
    //             // Handle success (e.g., display a success message)
    //             $('#maintenanceModal').modal('hide'); // Hide the modal
    //         },
    //         error: function (xhr, status, error) {
    //             // Handle error (e.g., display an error message)
    //         }
    //     });
    // });
});


// function updateModalWithData(data) {
//     $('#modal_author_header').text('Maintenance Request By: ' + data.user.first_name + ' ' + data.user.last_name);
//     $('#modal_location').text(data.user.property.location);
//     $('#modal_room_unit').text(data.user.property.room_unit);
//     $('#modal_maintenance_status').val(data.status);
//     $('#modal_author').text(data.user.first_name + ' ' + data.user.last_name);
//     var dateRequested = new Date(data.date_requested);
//     var options = {
//         timeZone: 'UTC', // Use UTC or your desired timezone
//         month: 'long',
//         day: 'numeric',
//         year: 'numeric',
//         // hour: 'numeric',
//         // minute: 'numeric',
//         // hour12: true
//     };
//     var formattedDate = dateRequested.toLocaleString('en-US', options);
//     $('#modal_date_requested').text(formattedDate);
//     $('#modal_request_type').val(data.request_type);
//     $('#modal_priority').val(data.priority);
//     $('#modal_description').text(data.description);

//     // Update status using a separate AJAX request
//     console.log($('#modal_maintenance_status').val()),

//     $.ajax({
//         url: '/update-maintenance-status',
//         type: 'POST',
//         data: {
//             _token: '{{ csrf_token() }}',
//             maintenanceId: data.id, // Ensure you have the correct field name here
//             modal_maintenance_status: $('#modal_maintenance_status').val(),
//         },
//         success: function (response) {
//             // Handle success (e.g., display a success message)
//         },
//         error: function (xhr, status, error) {
//             // Handle error (e.g., display an error message)
//         }
//     });
// }
