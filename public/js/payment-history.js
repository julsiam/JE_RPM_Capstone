$('.historyDetailsBtn').click(function () {
    var historyId = $(this).data('payment-id');
    $.ajax({
        url: '/get-payment-history',
        type: 'GET',
        data: { 'data-payment-id': historyId },

        success: function (data) {
            console.log(data)

            var formattedDateTime = new Date(data.updated_at).toISOString().replace('T', ' ').substring(0, 19);

            $('#date_time').text(formattedDateTime);
            $('#amount').text(data.initial_paid_amount); // Use the correct attribute name
            $('#status').text(data.status);

            // Show the modal
            $('#detailsModal').modal('show');
        },
        
        error: function (error) {
            console.error(error);
        }
    })
})


