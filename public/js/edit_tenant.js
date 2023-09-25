function fetchTenantsList() {
    // Use AJAX to fetch the list of tenants
    $.ajax({
        url: "/tenants-list",
        method: 'GET',
        success: function (data) {
            // Populate the table with the fetched data
            const tableBody = $("#tenantTable tbody");
            tableBody.empty(); // Clear existing rows
            data.forEach(function (tenant) {
                const row = $("<tr>");
                row.append($("<td>").text(tenant.id));
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

function selectTenant(id, name, email) { //retrieve data and display to the edit page
    // Do something with the selected tenant (e.g., update the form fields)
    $("#tenant_id").val(id);
    $("#tenant_name").val(name);
    $("#tenant_email").val(email);

    $.ajax({
        url: '/get-tenant-details',
        method: 'GET',
        data: { id: id },
        success: function (data) {
            $('#email').val(data.email);
            $('#phone_number').val(data.phone_number);
            $("#address").val(data.address);
            $("#first_name").val(data.first_name);
            $("#last_name").val(data.last_name);
            $("#birthdate").val(data.birthdate);
            $("#age").val(data.age);
            $("#gender").val(data.gender);
            $("#occupation").val(data.occupation);

            const rentalData = data.rental; //rental data to display in table in edit page

            if (rentalData) {
                var rentStarted = new Date(rentalData.rent_started);
                console.log(rentalData.rent_from)
                var options = {
                    timeZone: 'UTC', // Use UTC or your desired timezone
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric',
                    // hour: 'numeric',
                    // minute: 'numeric',
                    // hour12: true
                };
                var formattedRentStarted = rentStarted.toLocaleString('en-US', options);


                $("#rental_id").val(rentalData.id);
                $("#edit_location").val(rentalData.property.location);
                $("#edit_room_unit").val(rentalData.property.room_unit);
                $("#edit_rent_started").val(formattedRentStarted);
                $("#edit_rent_from").val(rentalData.rent_from);
                $("#edit_due_date").val(rentalData.due_date);
                $("#edit_room_rent").val(rentalData.property.room_fee);
                $("#edit_water_bill").val(rentalData.water_bill);
                $("#edit_electric_bill").val(rentalData.electric_bill);
                $("#edit_total_bill").val(rentalData.total_bill);
                $("#edit_amount_paid").val(rentalData.amount_paid);
                $("#edit_balance").val(rentalData.balance);
                $("#edit_status").val(rentalData.status);
            }
        },

        error: function (xhr, status, error) {
            console.error(error);
        }
    });

    // Close the modal
    $('#tenantModal').modal('hide');
}

