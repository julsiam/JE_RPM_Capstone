$('#profilePictureInput').on('change', function () {
    var fileInput = $(this)[0];
    var file = fileInput.files[0];

    if (file) {
        var formData = new FormData();
        formData.append('profile_picture', file);

        $.ajax({
            url: '/edit_profile',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#profile_pic').attr('src', data.profile_picture)
            },
            error: function (error) {
                console.error('Error:', error);
            },
        });
        // $(this).closest('form').submit();

    }
});
