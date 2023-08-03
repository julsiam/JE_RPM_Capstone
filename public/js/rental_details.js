$(document).ready(function () {
    // Function to update the rental information fields with the data from the other sections
    function updateRentalInfo() {
        // Personal Information Section
        const firstName = $('#first_name').val();
        const lastName = $('#last_name').val();

        // Accommodation Information Section
        const location = $('#location').val();
        const roomUnit = $('#room_unit').val();
        const roomFee = $('#room_fee').val();

        // Update the fields in the rental information section
        $('#name').val(firstName + ' ' + lastName);
        $('#propLocation').val(location);
        $('#room_unit_display').val(roomUnit);
       // $('#room_fee_display').val(roomFee);
       // $('#property_id').val(location + ' - ' + roomUnit);

    } 

    // Add event listeners to update the rental information section on input change in other sections
    $('#first_name').on('input', updateRentalInfo);
    $('#last_name').on('input', updateRentalInfo);
    $('#location').on('change', updateRentalInfo);
    $('#room_unit').on('change', updateRentalInfo);
   // $('#room_fee').on('input', updateRentalInfo);

    // Initialize the form fields on page load
    updateRentalInfo();

});
