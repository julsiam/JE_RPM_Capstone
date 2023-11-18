document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("profilePictureInput").addEventListener("change", function () {
        var input = this;
        var preview = document.getElementById("profilePicturePreview");
        var saveButton = document.getElementById("saveButton");

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                saveButton.style.display = "inline"; // Enable the "Save" button
            };

            reader.readAsDataURL(input.files[0]);
        }
    });
});
// $('.profile_edit_btn').click(function () {
//     var profileId = $(this).data('profile-id');
//     $.ajax({
//         url: '/get_profile_details/',
//         type: 'GET',
//         data: { 'data-profile-id': profileId },

//         success: function (data) {
//             $('#edit_profile_id').val(data.id);
//             $('#edit_firstname').val(data.first_name);
//             $('#edit_lastname').val(data.last_name);
//             $('#edit_email').val(data.email);
//             $('#edit_phone').val(data.phone_number);
//             $('#edit_birthdate').val(data.birthdate);
//             $('#edit_age').val(data.age);
//             $('#edit_address').val(data.address);

//         },
//         error: function (error) {
//             console.error(error);
//         }
//     })
// })

