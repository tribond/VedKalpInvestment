$(document).ready(function () {
    $('#contactApplication').submit(function (e) {
        e.preventDefault();
    });
    $('#contactApplication').validate({
        errorClass: 'text-danger',
        rules: {
            name: 'required',
            email: 'required',
            subject: 'required',
            message: 'required',
        },
        messages: {
            name: 'Name is required.',
            email: 'Email is required.',
            subject: 'Subject is required.',
            message: 'Message is required.',
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                url: `${contactUsLeadUrl}`,
                method: 'POST',
                data: formData,
                contentType: 'JSON',
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.status == true) {
                        $('.application-success').text(response.message);
                    } else {
                        $('.application-error').text(response.message);
                    }
                    form.reset();
                },
                error: function (xhr, status, error) {
                    // Handle error
                    $('.application-error').text('Error: ' + error);
                }
            });

        }
    });
});