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
                $("#rental_id").val(rentalData.id);
                $("#location").val(rentalData.property.location);
                $("#room_unit").val(rentalData.property.room_unit);
                $("#rent_from").val(rentalData.rent_from);
                $("#due_date").val(rentalData.due_date);
                $("#room_rent").val(rentalData.property.room_fee);
                $("#water_bill").val(rentalData.water_bill);
                $("#electric_bill").val(rentalData.electric_bill);
                $("#total_bill").val(rentalData.total_bill);
                $("#amount_paid").val(rentalData.amount_paid);
                $("#balance").val(rentalData.balance);
                $("#status").val(rentalData.status);
            }
        },

        error: function (xhr, status, error) {
            console.error(error);
        }
    });

    // Close the modal
    $('#tenantModal').modal('hide');
}


