// function addTenantWithProperty(propertyId) {
//     // Get all the tenant information from the form
//     const firstName = $('#first_name').val();
//     const lastName = $('#last_name').val();
//     const phoneNumber = $('#phone_number').val();
//     const email = $('#email').val();
//     const age = $('#age').val();
//     const birthdate = $('#birthdate').val();
//     const gender = $('#gender').val();
//     const address = $('#address').val();
//     const occupation = $('#occupation').val();
//     const workAddress = $('#work_address').val();
//     // const location = $('#location').val();
//     // const roomUnit = $('#room_unit').val();
//     // const roomFee = $('#room_fee_display').val();

//     $.ajax({
//         type: 'POST',
//         url: '/add_tenant', // Replace this with the URL to your server endpoint to add the tenant with property details
//         data: {
//             property_id: propertyId,
//             first_name: firstName,
//             last_name: lastName,
//             phone_number: phoneNumber,
//             email: email,
//             age:age,
//             birthdate:birthdate,
//             gender: gender,
//             address: address,
//             occupation:occupation,
//             work_address:workAddress,

//             _token: '{{ csrf_token() }}' // Include the CSRF token
//         },

//         dataType: 'json',
//         success: function (data) {
//             // Handle the success response (e.g., show a success message or redirect)
//             console.log(data);
//             console.log(propertyId)
//             // Optionally, show a success message to the user
//             alert('Tenant added successfully!');
//             // You can redirect to another page if needed
//             // window.location.href = '/tenants';
//         },
//         error: function (error) {
//             // Handle the error response (e.g., show an error message)
//             console.error(error);
//             alert('An error occurred while adding the tenant.');
//         }
//     });
// }

