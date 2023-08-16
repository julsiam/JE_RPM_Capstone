$(document).ready(function () {
    $('.maintenance-details-button').click(function () {
        var maintenanceId = $(this).data('maintenance-id');
        $.ajax({
            url: '/getMaintenanceDetails/', // Replace with your route
            type: 'GET',
            data: { 'data-maintenance-id': maintenanceId },

            success: function (data) {
                $('#modal_id').val(data.id);
                $('#modal_author_header').text('Requested By: ' + data.user.first_name + ' ' + data.user.last_name);
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
});






// $(document).ready(function () {
//     $(document).on('click', '.detailsButton', function () {
//         var requestId = $(this).val();
//         $('#maintenanceModal').modal('show');

//         $.ajax({
//             type: 'GET',
//             url: '/getMaintenanceDetails/' + maintenanceId, // Replace with your route
//             success: function (response) {
//                 $('#modal_id').val(response.maintenance.id);
//                 $('#modal_author_header').text('Maintenance Request By: ' + response.maintenance.user.first_name + ' ' + response.maintenance.user.last_name);
//                 $('#modal_location').text(response.maintenance.user.property.location);
//                 $('#modal_room_unit').text(response.maintenance.user.property.room_unit);
//                 $('#modal_maintenance_status').val(response.maintenance.status);
//                $('#modal_author').text(response.maintenance.user.first_name + ' ' + response.maintenance.user.last_name);
//                 var dateRequested = new Date(response.maintenance.date_requested);
//                 var options = {
//                     timeZone: 'UTC', // Use UTC or your desired timezone
//                     month: 'long',
//                     day: 'numeric',
//                     year: 'numeric',
//                     // hour: 'numeric',
//                     // minute: 'numeric',
//                     // hour12: true
//                 };
//                 var formattedDate = dateRequested.toLocaleString('en-US', options);
//                 $('#modal_date_requested').text(formattedDate);
//                 $('#modal_request_type').val(response.maintenance.request_type);
//                 $('#modal_priority').val(response.maintenance.priority);
//                 $('#modal_description').text(response.maintenance.description);
//             },

//             error: function (xhr, status, error) {
//                 console.error(error);
//             }
//         });
//     })

// });
