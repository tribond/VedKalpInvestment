$(document).ready(function () {
    $('#lrf-form').submit(function (e) {
        e.preventDefault();
    });
    $('#lrf-form').validate({
        errorClass: 'text-danger',
        errorPlacement: function (error, element) {
            element.next('label').replaceWith(error);
        },
        rules: {
            email: 'required',
            password: 'required'
        },
        messages: {
            email: 'Email Address is required.',
            password: 'Password is required.'
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $('#ajaxloader').show();
            $.ajax({
                url: `${signInUrl}`,
                method: 'POST',
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (!response.status) {
                        // Handle error response
                        if (typeof response.message === 'object') {
                            $.each(response.message, function (field, messages) {
                                var errorContainer = $('[name="' + field + '"]').next('.error-message');
                                if (errorContainer.length) {
                                    errorContainer.text(messages[0]).show();
                                }
                            });
                        } else {
                            $('[name="email"]').next('.error-message').text(response.message).show();
                        }
                    } else {
                        form.reset();
                        window.location.href = dashboardUrl;
                    }
                    $('#ajaxloader').hide();
                },
                error: function (xhr, status, error) {
                    // Handle error
                    $('.application-error').text('Error: ' + error);
                    $('#ajaxloader').hide();
                }
            });

        }
    });
});