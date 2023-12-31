function fetchTenantsList() {
    $.ajax({
        url: "/tenants-list",
        method: 'GET',
        success: function (data) {
            const tableBody = $("#tenantTable tbody");
            tableBody.empty();
            data.forEach(function (tenant) {
                const row = $("<tr>");
                row.append($("<td hidden>").text(tenant.id));
                row.append($("<td>").text(tenant.first_name + " " + tenant.last_name));
                row.append($("<td>").text(tenant.email));
                row.append($("<td>").html(`<button class="btn btn-primary btn-sm" onclick="selectTenant('${tenant.id}', '${tenant.first_name}', '${tenant.last_name}', '${tenant.email}')">Select</button>`));
                tableBody.append(row);
            });

            // Show the modal
            $('#tenantModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}


$(document).ready(function () {

    var tenantData = JSON.parse(localStorage.getItem('tenantData'));

    var bday = new Date(tenantData.birthdate);
    var options = {
        timeZone: 'UTC', // Use UTC or your desired timezone
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    };
    var bdate = bday.toLocaleString('en-US', options);

    $('#email').val(tenantData.email);
    $('#phone_number').val(tenantData.phone_number);
    $("#address").val(tenantData.address);
    $("#first_name").val(tenantData.first_name);
    $("#last_name").val(tenantData.last_name);
    $("#birthdate").val(bdate);
    $("#age").val(tenantData.age);
    $("#gender").val(tenantData.gender);
    $("#occupation").val(tenantData.occupation);

    var rentStarted = new Date(tenantData.rental.rent_started);
    var options = {
        timeZone: 'UTC', // Use UTC or your desired timezone
        month: 'long',
        day: 'numeric',
        year: 'numeric',
    };
    var formattedRentStarted = rentStarted.toLocaleString('en-US', options);
    // Parse the datetime string from the tenantData and create a Date object
    var dueDate = new Date(tenantData.rental.due_date);

    // Format the date as 'yyyy-MM-dd'
    var formattedDueDate = dueDate.toISOString().split('T')[0];

    $("#rental_id").val(tenantData.rental.id);
    $("#edit_location").val(tenantData.rental.property.location);
    $("#edit_room_unit").val(tenantData.rental.property.room_unit);
    $("#edit_rent_started").val(formattedRentStarted);
    $("#edit_rent_from").val(tenantData.rental.rent_from);
    $("#edit_due_date").val(formattedDueDate);
    $("#edit_room_rent").val(tenantData.rental.property.room_fee);
    $("#edit_water_bill").val(tenantData.rental.water_bill);
    $("#edit_electric_bill").val(tenantData.rental.electric_bill);
    $("#edit_total_bill").val(tenantData.rental.total_bill);
    $("#edit_amount_paid").val(tenantData.rental.amount_paid);
    $("#edit_balance").val(tenantData.rental.balance);
    $("#edit_status").val(tenantData.rental.status);

    if (tenantData.file.length > 0) {
        var defaultPhotoUrl = "{{ asset('image/default_photo.png') }}";

        var idPhotoPath = tenantData.file.find(file => file.type === 'id_photo');
        var contractPath = tenantData.file.find(file => file.type === 'contract_pdf');

        if (idPhotoPath) {
            $('#idPhoto').attr('src', 'https://jerpm.s3.amazonaws.com/' + idPhotoPath.file_path);
        } else {
            $('#idPhoto').attr('src', defaultPhotoUrl); // No ID photo available
        }

        if (contractPath) {
            $('#contractLink').attr('href', 'https://jerpm.s3.amazonaws.com/' + contractPath.file_path);
        } else {
            $('#contractLink').attr('href', ' '); // No contract available
        }
    }
});





function selectTenant(id, name, email) { //retrieve data and display to the edit page

    // $("#tenant_id").val(id);
    // $("#tenant_name").val(name);
    // $("#tenant_email").val(email);

    $.ajax({
        url: '/get-tenant-details',
        method: 'GET',
        data: { id: id },
        success: function (data) {
            var bday = new Date(data.birthdate);
            var options = {
                timeZone: 'UTC', // Use UTC or your desired timezone
                month: 'long',
                day: 'numeric',
                year: 'numeric',
            };
            var bdate = bday.toLocaleString('en-US', options);

            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $("#address").val(data.address);
            $("#first_name").val(data.first_name);
            $("#last_name").val(data.last_name);
            $("#birthdate").val(bdate);
            $("#age").val(data.age);
            $("#gender").val(data.gender);
            $("#occupation").val(data.occupation);

            var rentStarted = new Date(data.rental.rent_started);
            var options = {
                timeZone: 'UTC', // Use UTC or your desired timezone
                month: 'long',
                day: 'numeric',
                year: 'numeric',
            };
            var formattedRentStarted = rentStarted.toLocaleString('en-US', options);
            // Parse the datetime string from the data and create a Date object
            var dueDate = new Date(data.rental.due_date);

            // Format the date as 'yyyy-MM-dd'
            var formattedDueDate = dueDate.toISOString().split('T')[0];

            $("#rental_id").val(data.rental.id);
            $("#edit_location").val(data.rental.property.location);
            $("#edit_room_unit").val(data.rental.property.room_unit);
            $("#edit_rent_started").val(formattedRentStarted);
            $("#edit_rent_from").val(data.rental.rent_from);
            $("#edit_due_date").val(formattedDueDate);
            $("#edit_room_rent").val(data.rental.property.room_fee);
            $("#edit_water_bill").val(data.rental.water_bill);
            $("#edit_electric_bill").val(data.rental.electric_bill);
            $("#edit_total_bill").val(data.rental.total_bill);
            $("#edit_amount_paid").val(data.rental.amount_paid);
            $("#edit_balance").val(data.rental.balance);
            $("#edit_status").val(data.rental.status);

            if (data.file.length > 0) {
                var defaultPhotoUrl = "{{ asset('image/default_photo.png') }}";

                var idPhotoPath = data.file.find(file => file.type === 'id_photo');
                var contractPath = data.file.find(file => file.type === 'contract_pdf');

                if (idPhotoPath) {
                    $('#idPhoto').attr('src', 'https://jerpm.s3.amazonaws.com/' + idPhotoPath.file_path);
                } else {
                    $('#idPhoto').attr('src', defaultPhotoUrl); // No ID photo available
                }

                if (contractPath) {
                    $('#contractLink').attr('href', 'https://jerpm.s3.amazonaws.com/' + contractPath.file_path);
                } else {
                    $('#contractLink').attr('href', ' '); // No contract available
                }
            }
        },

        error: function (xhr, status, error) {
            console.error(error);
        }
    });

    // Close the modal
    $('#tenantModal').modal('hide');
}


