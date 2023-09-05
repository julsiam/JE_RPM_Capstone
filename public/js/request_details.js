
$(document).ready(function () {
    $('.detailsBtn').click(function () {
        var requestId = $(this).data('request-id');
        $.ajax({
            url: '/getReqDetails', // Replace with your route
            type: 'GET',
            data: { 'data-request-id': requestId },

            success: function (data) {
                console.log(data);
                $('#details_id').val(data.id);
                $('#details_location').text(data.user.property.location);
                $('#details_room_unit').text(data.user.property.room_unit);
                $('#details_status').text(data.status);
                $('#details_author').text(data.user.first_name + ' ' + data.user.last_name);
                var dateRequested = new Date(data.created_at);
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
                $('#details_date_requested').text(formattedDate);
                $('#details_request_type').text(data.request_type);
                $('#details_priority').text(data.priority);
                $('#details_description').text(data.description);
            },

            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});


$(document).ready(function () {
    $('#addRequestModal').on('shown.bs.modal', function () {
        var currentDate = new Date().toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            // hour: 'numeric',
            // minute: 'numeric',
            // hour12: true

        });

        $('#hidden_request_date_requested').val(currentDate);

        document.getElementById('request_date_requested').textContent = currentDate;
    });
});
