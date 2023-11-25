$(document).ready(function () {
    $('#inactiveTenantsData').on('click', '.inactiveDetailsBtn', function () {
        var tenantId = $(this).data('inactiveTenant-id'); // Update here
        var paymentHistory = $('#inactive_payment_history tbody');
        paymentHistory.empty();


        $.ajax({
            url: '/inactive-tenant-details',
            method: 'GET',
            data: { 'data-inactiveTenant-id': tenantId }, // Update here

            success: function (data) {
                    console.log(data)
                var moveinDate = new Date(data.rental.rent_started);
                var bday = new Date(data.birthdate);
                var options = {
                    timeZone: 'UTC', // Use UTC or your desired timezone
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                };


                var moveInDate = moveinDate.toLocaleString('en-US', options);
                var bdate = bday.toLocaleString('en-US', options);

                $('#inactive_tenant_id').val(data.id);
                $('#inactive_profile').attr('src', data.profile_picture);
                $('#inactive_email').val(data.email)
                $('#inactive_phone_number').val(data.phone_number);
                $('#inactive_address').val(data.address)
                $('#inactive_first_name').val(data.first_name);
                $('#inactive_last_name').val(data.last_name)
                $('#inactive_birthdate').val(bdate);
                $('#inactive_age').val(data.age)
                $('#inactive_gender').val(data.gender);
                $('#inactive_occupation').val(data.occupation);
                $('#inactive_work_address').val(data.work_address);
                $('#inactive_location').val(data.rental.property.location);
                $('#inactive_room_unit').val(data.rental.property.room_unit);
                $('#inactive_movein_date').val(moveInDate);
                $('#updateDetailsBtn').val(data.id);


                if (data.file.length > 0) {
                    var defaultPhotoUrl = "{{ asset('image/default_photo.png') }}";

                    var idPhotoPath = data.file.find(file => file.type === 'id_photo');
                    var contractPath = data.file.find(file => file.type === 'contract_pdf');

                    if (idPhotoPath) {
                        $('#inactive_tenant_idPhoto').attr('src', 'https://jerpm.s3.amazonaws.com/' + idPhotoPath.file_path);
                    } else {
                        $('#inactive_tenant_idPhoto').attr('src', defaultPhotoUrl); // No ID photo available
                    }

                    if (contractPath) {
                        $('#inactive_contractLink').attr('href', 'https://jerpm.s3.amazonaws.com/' + contractPath.file_path);
                    } else {
                        $('#inactive_contractLink').attr('href', ' '); // No contract available
                    }
                }

                if (data.rental.rental_history.length > 0) {
                    // Iterate through rental history and create rows in the table
                    data.rental.rental_history.forEach(function (historyItem) {
                        var month = new Date(historyItem.end_date);
                        var dueDate = new Date(historyItem.end_date);
                        var datePaid = new Date(historyItem.created_at);
                        var options = {
                            timeZone: 'UTC', // Use UTC or your desired timezone
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                        };
                        var month_options = {
                            timeZone: 'UTC', // Use UTC or your desired timezone
                            month: 'long',
                        };
                        var due = dueDate.toLocaleString('en-US', options);
                        var _datePaid = datePaid.toLocaleString('en-US', options);
                        var _month = month.toLocaleString('en-US', month_options);

                        var row = $('<tr>');
                        row.append($('<td>').text(_month));
                        row.append($('<td>').text(historyItem.total_rent));
                        row.append($('<td>').text(due));
                        row.append($('<td>').text(_datePaid));
                        row.append($('<td>').text(historyItem.initial_paid_amount));
                        row.append($('<td>').text(historyItem.status));

                        paymentHistory.append(row);
                    });

                } else {
                    // If no rental history is available, you can display a message or handle it accordingly
                    var noHistoryRow = $('<tr>');
                    noHistoryRow.append($('<td colspan="6">').text('No rental history available.'));
                    paymentHistory.append(noHistoryRow);
                }
            }

        })
    })
});

