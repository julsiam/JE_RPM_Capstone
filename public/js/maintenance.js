$(document).ready(function () {
    $('.maintenance-details-button').click(function () {
        var maintenanceId = $(this).data('maintenance-id');
        $.ajax({
            url: '/getMaintenanceDetails/',
            type: 'GET',
            data: { 'data-maintenance-id': maintenanceId },

            success: function (data) {
                $('#modal_id').val(data.id);
                console.log(data.schedule)
                if (data.user && data.user.status === 'Active') {
                    // $('#modal_author_header').text('Requested By: ' + data.user.first_name + ' ' + data.user.last_name);
                    $('#modal_location').text(data.user.property.location);
                    $('#modal_room_unit').text(data.user.property.room_unit);
                } else {
                    $('#modal_author_header').text('NOTE: Requestor is no longer a Tenant');
                    $('#modal_location').text('N/A (User inactive)');
                    $('#modal_room_unit').text('N/A (User inactive)');
                }

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
                $('#modal_category').val(data.category);
                $('#modal_priority').val(data.priority);
                $('#modal_description').text(data.description);
                $('#modal_schedule').val(moment(data.schedule).format('YYYY-MM-DDTHH:mm:ss'));

            },

            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});
